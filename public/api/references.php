<?php
/**
 * References API
 * GET  /api/references.php          — vrátí všechny reference (veřejné)
 * POST /api/references.php          — přidá novou referenci (vyžaduje heslo)
 * POST /api/references.php?delete=1 — smaže referenci (vyžaduje heslo)
 */

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, X-Admin-Token');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

// --- Config ---
$dataDir    = __DIR__ . '/data';
$dataFile   = $dataDir . '/references.json';
$uploadsDir = __DIR__ . '/uploads/references';

// Admin password hash — change this on first deploy!
// Default: "VeVuniAdmin2026" — generate new hash: php -r "echo password_hash('YourPassword', PASSWORD_BCRYPT);"
$adminPasswordHash = '$2a$12$k2QS8srOuBlNgVCUr924ROa0hYcMt3XaKgR9jGMOMLyBuEL8M3VV.';

// Create directories if needed
if (!is_dir($dataDir)) {
    mkdir($dataDir, 0755, true);
}
if (!is_dir($uploadsDir)) {
    mkdir($uploadsDir, 0755, true);
}

// --- Helpers ---
function loadReferences($file) {
    if (!file_exists($file)) {
        return [];
    }
    $json = file_get_contents($file);
    $data = json_decode($json, true);
    return is_array($data) ? $data : [];
}

function saveReferences($file, $data) {
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function verifyAdmin($hash) {
    $token = $_SERVER['HTTP_X_ADMIN_TOKEN'] ?? '';
    if (!$token || !password_verify($token, $hash)) {
        http_response_code(401);
        echo json_encode(['error' => 'Neplatné heslo.']);
        exit;
    }
}

function sanitize($str) {
    return htmlspecialchars(trim($str), ENT_QUOTES, 'UTF-8');
}

// --- GET: return all references ---
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $refs = loadReferences($dataFile);
    echo json_encode($refs);
    exit;
}

// --- POST ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verifyAdmin($adminPasswordHash);

    // Delete reference
    if (isset($_GET['delete'])) {
        $input = json_decode(file_get_contents('php://input'), true);
        $id = $input['id'] ?? '';
        if (!$id) {
            http_response_code(400);
            echo json_encode(['error' => 'Chybí ID reference.']);
            exit;
        }
        $refs = loadReferences($dataFile);
        $refs = array_values(array_filter($refs, function ($r) use ($id) {
            return ($r['id'] ?? '') !== $id;
        }));
        saveReferences($dataFile, $refs);
        echo json_encode(['success' => true]);
        exit;
    }

    // Add reference — expects multipart/form-data
    $car     = sanitize($_POST['car'] ?? '');
    $service = sanitize($_POST['service'] ?? '');
    $quote   = sanitize($_POST['quote'] ?? '');
    $author  = sanitize($_POST['author'] ?? '');

    if (!$car || !$service) {
        http_response_code(400);
        echo json_encode(['error' => 'Název vozu a provedené práce jsou povinné.']);
        exit;
    }

    $id = uniqid('ref_', true);
    $images = [];

    // Handle file uploads
    if (!empty($_FILES['images'])) {
        $fileCount = is_array($_FILES['images']['name']) ? count($_FILES['images']['name']) : 1;
        $maxFiles = 20;
        $maxSize = 10 * 1024 * 1024; // 10 MB per file
        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

        for ($i = 0; $i < min($fileCount, $maxFiles); $i++) {
            $tmpName  = is_array($_FILES['images']['tmp_name']) ? $_FILES['images']['tmp_name'][$i] : $_FILES['images']['tmp_name'];
            $origName = is_array($_FILES['images']['name']) ? $_FILES['images']['name'][$i] : $_FILES['images']['name'];
            $size     = is_array($_FILES['images']['size']) ? $_FILES['images']['size'][$i] : $_FILES['images']['size'];
            $error    = is_array($_FILES['images']['error']) ? $_FILES['images']['error'][$i] : $_FILES['images']['error'];

            if ($error !== UPLOAD_ERR_OK || $size > $maxSize) {
                continue;
            }

            // Validate MIME type from file content
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime = $finfo->file($tmpName);
            if (!in_array($mime, $allowedTypes, true)) {
                continue;
            }

            $ext = match ($mime) {
                'image/jpeg' => '.jpg',
                'image/png'  => '.png',
                'image/webp' => '.webp',
                default      => '.jpg',
            };

            $fileName = $id . '_' . $i . $ext;
            $destPath = $uploadsDir . '/' . $fileName;

            if (move_uploaded_file($tmpName, $destPath)) {
                $images[] = '/api/uploads/references/' . $fileName;
            }
        }
    }

    $ref = [
        'id'      => $id,
        'car'     => $car,
        'service' => $service,
        'quote'   => $quote ?: null,
        'author'  => $author ?: null,
        'images'  => $images,
        'date'    => date('Y-m-d H:i:s'),
    ];

    $refs = loadReferences($dataFile);
    array_unshift($refs, $ref); // newest first
    saveReferences($dataFile, $refs);

    echo json_encode(['success' => true, 'reference' => $ref]);
    exit;
}

http_response_code(405);
echo json_encode(['error' => 'Metoda není povolena.']);
