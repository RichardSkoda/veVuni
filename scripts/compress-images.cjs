const sharp = require('sharp');
const path = require('path');
const fs = require('fs');

const IMAGES_DIR = path.join(__dirname, '..', 'src', 'assets', 'images');
const MAX_WIDTH = 1920;
const MAX_HEIGHT = 1920;
const WEBP_QUALITY = 80;
const JPEG_QUALITY = 80;
// Only process files larger than this threshold (bytes)
const SIZE_THRESHOLD = 500 * 1024; // 500 KB

const SUPPORTED_EXTENSIONS = ['.jpg', '.jpeg', '.png', '.webp'];

async function getAllImages(dir) {
  const results = [];
  const entries = fs.readdirSync(dir, { withFileTypes: true });
  for (const entry of entries) {
    const fullPath = path.join(dir, entry.name);
    if (entry.isDirectory()) {
      results.push(...await getAllImages(fullPath));
    } else {
      const ext = path.extname(entry.name).toLowerCase();
      if (SUPPORTED_EXTENSIONS.includes(ext)) {
        results.push(fullPath);
      }
    }
  }
  return results;
}

async function compressImage(filePath) {
  const stat = fs.statSync(filePath);
  const sizeMB = (stat.size / 1024 / 1024).toFixed(2);
  const ext = path.extname(filePath).toLowerCase();

  if (stat.size < SIZE_THRESHOLD) {
    return { file: filePath, skipped: true, reason: 'below threshold', size: sizeMB };
  }

  try {
    const image = sharp(filePath);
    const metadata = await image.metadata();

    let pipeline = sharp(filePath).rotate(); // auto-rotate based on EXIF

    // Resize if larger than max dimensions
    if (metadata.width > MAX_WIDTH || metadata.height > MAX_HEIGHT) {
      pipeline = pipeline.resize(MAX_WIDTH, MAX_HEIGHT, {
        fit: 'inside',
        withoutEnlargement: true,
      });
    }

    // Convert to WebP if it's a large JPG/PNG, otherwise optimize in place
    const isLargeNonWebp = ext !== '.webp' && stat.size > 1024 * 1024;
    let outputPath;
    let outputBuffer;

    if (isLargeNonWebp) {
      // Convert to WebP
      outputPath = filePath.replace(/\.[^.]+$/, '.webp');
      outputBuffer = await pipeline.webp({ quality: WEBP_QUALITY }).toBuffer();
    } else if (ext === '.webp') {
      outputPath = filePath;
      outputBuffer = await pipeline.webp({ quality: WEBP_QUALITY }).toBuffer();
    } else if (ext === '.png') {
      outputPath = filePath;
      outputBuffer = await pipeline.png({ quality: 80, compressionLevel: 9 }).toBuffer();
    } else {
      outputPath = filePath;
      outputBuffer = await pipeline.jpeg({ quality: JPEG_QUALITY, mozjpeg: true }).toBuffer();
    }

    const newSizeMB = (outputBuffer.length / 1024 / 1024).toFixed(2);
    const savings = ((1 - outputBuffer.length / stat.size) * 100).toFixed(1);

    // Only save if we actually reduced size
    if (outputBuffer.length < stat.size) {
      fs.writeFileSync(outputPath, outputBuffer);
      // Remove original if we converted to a different format
      if (outputPath !== filePath && fs.existsSync(filePath)) {
        fs.unlinkSync(filePath);
      }
      return { file: path.basename(filePath), newFile: path.basename(outputPath), before: sizeMB, after: newSizeMB, savings, converted: outputPath !== filePath };
    } else {
      return { file: filePath, skipped: true, reason: 'already optimized', size: sizeMB };
    }
  } catch (err) {
    return { file: filePath, error: err.message };
  }
}

async function main() {
  console.log('Scanning images...\n');
  const images = await getAllImages(IMAGES_DIR);
  console.log(`Found ${images.length} images\n`);

  let totalBefore = 0;
  let totalAfter = 0;
  let processed = 0;
  let skipped = 0;
  let converted = 0;

  for (const img of images) {
    const result = await compressImage(img);
    if (result.error) {
      console.log(`  ERROR: ${path.relative(IMAGES_DIR, img)} - ${result.error}`);
    } else if (result.skipped) {
      skipped++;
    } else {
      processed++;
      totalBefore += parseFloat(result.before);
      totalAfter += parseFloat(result.after);
      if (result.converted) converted++;
      console.log(`  ${result.file} -> ${result.newFile}: ${result.before} MB -> ${result.after} MB (-${result.savings}%)`);
    }
  }

  console.log(`\n--- Summary ---`);
  console.log(`Processed: ${processed} files`);
  console.log(`Converted to WebP: ${converted} files`);
  console.log(`Skipped (small/optimized): ${skipped} files`);
  console.log(`Total saved: ${(totalBefore - totalAfter).toFixed(1)} MB`);
  console.log(`Before: ${totalBefore.toFixed(1)} MB -> After: ${totalAfter.toFixed(1)} MB`);
}

main().catch(console.error);
