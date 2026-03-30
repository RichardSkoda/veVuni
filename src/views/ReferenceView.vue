<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { RouterLink } from 'vue-router'

// Load all images from car subfolders
const imageModules = import.meta.glob(
  '../assets/images/**/*.{jpg,jpeg,webp,png,JPG,JPEG,PNG}',
  { eager: true, import: 'default' }
)

// Known car image folders
const carFolderSet = new Set([
  'Audi A3', 'Audi Q7', 'BMW 5', 'Jaguar XF', 'Mazda5',
  'Peugeot 407', 'Rover 75', 'Škoda Felicia', 'Škoda Octavia',
  'Toyota Yaris', 'Volvo V60', 'Volvo V90', 'Volvo XC60', 'VW Passat'
])

// Group images by car folder name
const carImages = {}
for (const [path, url] of Object.entries(imageModules)) {
  const match = path.match(/\/images\/(.+?)\/[^/]+$/)
  if (match && carFolderSet.has(match[1])) {
    if (!carImages[match[1]]) carImages[match[1]] = []
    carImages[match[1]].push(url)
  }
}

function getImages(folder) {
  return folder ? (carImages[folder] || []) : []
}

const references = [
  {
    car: 'Volvo V90',
    imageFolder: 'Volvo V90',
    service: 'Dočištění exteriéru, voskování, leštění oken + „tekuté stěrače"',
    quote: 'Děkuji, na jaře se zase ozvu.',
    author: 'David F.'
  },
  {
    car: 'Volvo XC60',
    imageFolder: 'Volvo XC60',
    service: 'Dočištění, voskování, vyživení nelakovaných plastů, „tekuté stěrače"',
    quote: 'Vypadá to skvěle a prokouklo to fest.',
    author: 'Dominik K.'
  },
  {
    car: 'Audi Q7',
    imageFolder: 'Audi Q7',
    service: 'Ruční mytí, dekontaminace, voskování',
    quote: 'Děkuji za super službu a super přístup.',
    author: 'Tomáš R.'
  },
  {
    car: 'Škoda Felicia',
    imageFolder: 'Škoda Felicia',
    service: 'Program Exteriér komplet',
    quote: 'Jako když vyjela z Mototechny. To jsem měl nechat udělat už dávno.',
    author: 'Milan T.'
  },
  {
    car: 'BMW 535i',
    imageFolder: 'BMW 5',
    service: 'Ruční mytí, dekontaminace, leštění a voskování + balíček Interiér komplet',
    quote: 'Děkuji, myslím, že spolupráce bude pokračovat, kolegové již obdivovali Vaší práci.',
    author: 'Vít M.'
  },
  {
    car: 'Škoda Octavia RS',
    imageFolder: 'Škoda Octavia',
    service: 'Balíček Exteriér komplet + Interiér základ',
    quote: 'Díky, takhle jsem si výsledek představoval. Jsem spokojený.',
    author: 'Tomáš R.'
  },
  {
    car: 'Jaguar XF',
    imageFolder: 'Jaguar XF',
    service: 'Kompletní exteriér a interiér – leštění, voskování, tepování',
    quote: null,
    author: null
  },
  {
    car: 'VW Passat',
    imageFolder: 'VW Passat',
    service: 'Kompletní exteriér – ruční mytí, dekontaminace, leštění a voskování',
    quote: null,
    author: null
  },
  {
    car: 'Peugeot 407',
    imageFolder: 'Peugeot 407',
    service: 'Dekontaminace, leštění a ochrana laku + tepování a čištění interiéru',
    quote: 'Skvěle odvedená práce se zaměřením na detail. Perfektně umyté auto zvenku i zevnitř, provoněné, naleštěné. Myslím, že takto vyblýskané auto nebylo ani při koupi.',
    author: 'Jana M.'
  },
  {
    car: 'Škoda Fabia',
    imageFolder: null,
    service: 'Ruční čištění exteriéru a interiéru, voskování',
    quote: 'Perfektně odvedená práce. Vše bylo pečlivě umyté, jak uvnitř, tak zvenku. Auto krásně vonělo, bylo vyblýskané.',
    author: 'Hana J.'
  },
  {
    car: 'Škoda Superb',
    imageFolder: null,
    service: 'Ruční čištění exteriéru a interiéru, odstranění kontaminantů a mírných defektů laku',
    quote: '... ty jsi ďábel, takhle čisté bylo naposledy v autosalonu...',
    author: 'Tomáš K.'
  },
  {
    car: 'Toyota Auris',
    imageFolder: null,
    service: 'Balíčky Exteriér základ + Interiér základ',
    quote: 'Je to krása, teď to bude úplně jiná jízda.',
    author: 'Kamila M.'
  },
  {
    car: 'Volvo V60',
    imageFolder: 'Volvo V60',
    service: 'Dočištění exteriéru, voskování',
    quote: null,
    author: null
  },
  {
    car: 'Toyota Yaris',
    imageFolder: 'Toyota Yaris',
    service: 'Čištění exteriéru a interiéru',
    quote: null,
    author: null
  },
  {
    car: 'Rover 75',
    imageFolder: 'Rover 75',
    service: 'Balíček Interiér komplet',
    quote: 'Indeed, I am really satisfied with the service. The car is much more comfortable inside now. Also it\'s looking amazing compare to how it was before.',
    author: 'Salomon C.'
  },
  {
    car: 'Audi A3',
    imageFolder: 'Audi A3',
    service: 'Ruční mytí, dekontaminace laku, voskování',
    quote: 'Krásné, děkuji.',
    author: 'Jan S.'
  },
  {
    car: 'Mazda 5',
    imageFolder: 'Mazda5',
    service: 'Renovace světlometů',
    quote: 'Super, jako nové!',
    author: 'Richard Š.'
  }
]

// Lightbox state
const lightboxOpen = ref(false)
const lightboxImages = ref([])
const lightboxIndex = ref(0)
const lightboxCar = ref('')

function openLightbox(folder, index) {
  const images = getImages(folder)
  if (!images.length) return
  lightboxImages.value = images
  lightboxIndex.value = index
  lightboxCar.value = folder
  lightboxOpen.value = true
  document.body.style.overflow = 'hidden'
}

function closeLightbox() {
  lightboxOpen.value = false
  document.body.style.overflow = ''
}

function nextImage() {
  lightboxIndex.value = (lightboxIndex.value + 1) % lightboxImages.value.length
}

function prevImage() {
  lightboxIndex.value = (lightboxIndex.value - 1 + lightboxImages.value.length) % lightboxImages.value.length
}

function onKeydown(e) {
  if (!lightboxOpen.value) return
  if (e.key === 'Escape') closeLightbox()
  else if (e.key === 'ArrowRight') nextImage()
  else if (e.key === 'ArrowLeft') prevImage()
}

onMounted(() => document.addEventListener('keydown', onKeydown))
onUnmounted(() => document.removeEventListener('keydown', onKeydown))
</script>

<template>
  <div class="page-wrapper">
    <!-- Hero -->
    <section class="page-hero">
      <div class="container">
        <div class="page-hero-label">Spokojení zákazníci</div>
        <h1 class="page-hero-title">Reference</h1>
        <p class="page-hero-sub">{{ references.length }}+ realizovaných zakázek a stovky spokojených zákazníků</p>
      </div>
    </section>

    <!-- References grid -->
    <section class="page-section">
      <div class="container">
        <div class="ref-grid">
          <div v-for="(r, i) in references" :key="i" class="ref-card" :class="{ 'has-gallery': getImages(r.imageFolder).length }">

            <!-- Image gallery -->
            <div v-if="getImages(r.imageFolder).length" class="ref-gallery">
              <div class="ref-gallery-main" @click="openLightbox(r.imageFolder, 0)">
                <img :src="getImages(r.imageFolder)[0]" :alt="r.car" loading="lazy" />
                <div class="ref-gallery-overlay">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/><path d="M11 8v6M8 11h6"/></svg>
                  <span>{{ getImages(r.imageFolder).length }} fotek</span>
                </div>
              </div>
              <div v-if="getImages(r.imageFolder).length > 1" class="ref-gallery-thumbs">
                <div
                  v-for="(img, j) in getImages(r.imageFolder).slice(1, 4)"
                  :key="j"
                  class="ref-thumb"
                  @click="openLightbox(r.imageFolder, j + 1)"
                >
                  <img :src="img" :alt="r.car" loading="lazy" />
                </div>
                <div
                  v-if="getImages(r.imageFolder).length > 4"
                  class="ref-thumb ref-thumb-more"
                  @click="openLightbox(r.imageFolder, 4)"
                >
                  +{{ getImages(r.imageFolder).length - 4 }}
                </div>
              </div>
            </div>

            <!-- Card text content -->
            <div class="ref-car">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M5 17H3a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v9a2 2 0 01-2 2h-2"/>
                <circle cx="7.5" cy="17.5" r="2.5"/><circle cx="17.5" cy="17.5" r="2.5"/>
              </svg>
              {{ r.car }}
            </div>
            <p class="ref-service">{{ r.service }}</p>
            <blockquote v-if="r.quote" class="ref-quote">„{{ r.quote }}"</blockquote>
            <cite v-if="r.author" class="ref-author">— {{ r.author }}</cite>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="page-cta">
      <div class="container">
        <h2>Buďte dalším spokojeným zákazníkem</h2>
        <p>Nezávazná poptávka zdarma – odpovíme do 24 hodin.</p>
        <RouterLink to="/#contact" class="btn btn-primary btn-lg">Poptat služby</RouterLink>
      </div>
    </section>

    <!-- Lightbox -->
    <Teleport to="body">
      <Transition name="lightbox">
        <div v-if="lightboxOpen" class="lightbox" @click.self="closeLightbox">
          <button class="lightbox-close" @click="closeLightbox" aria-label="Zavřít">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
          </button>
          <button class="lightbox-nav lightbox-prev" @click="prevImage" aria-label="Předchozí">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
          </button>
          <img :src="lightboxImages[lightboxIndex]" :alt="lightboxCar" class="lightbox-image" />
          <button class="lightbox-nav lightbox-next" @click="nextImage" aria-label="Další">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
          </button>
          <div class="lightbox-counter">{{ lightboxIndex + 1 }} / {{ lightboxImages.length }}</div>
        </div>
      </Transition>
    </Teleport>
  </div>
</template>

<style scoped>
.page-wrapper {
  padding-top: var(--header-height);
}

.page-hero {
  background: var(--color-primary);
  padding: 5rem 0 4rem;
  text-align: center;
  position: relative;
  overflow: hidden;
}

.page-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(ellipse at center, rgba(201, 168, 76, 0.12) 0%, transparent 70%);
}

.page-hero-label {
  display: inline-block;
  font-size: 0.75rem;
  font-weight: 700;
  letter-spacing: 3px;
  text-transform: uppercase;
  color: var(--color-accent);
  border: 1px solid rgba(201, 168, 76, 0.4);
  padding: 0.4rem 1rem;
  border-radius: 50px;
  margin-bottom: 1.5rem;
}

.page-hero-title {
  font-family: var(--font-heading);
  font-size: clamp(2rem, 4vw, 3rem);
  color: white;
  margin-bottom: 1rem;
}

.page-hero-sub {
  color: rgba(255, 255, 255, 0.6);
  font-size: 1rem;
}

.page-section {
  padding: 5rem 0;
  background: var(--color-bg-light);
}

/* References grid */
.ref-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
  gap: 1.5rem;
}

.ref-card {
  background: white;
  border-radius: var(--radius-lg);
  padding: 2rem;
  box-shadow: var(--shadow-sm);
  border-left: 4px solid var(--color-accent);
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
  transition: transform var(--transition-normal), box-shadow var(--transition-normal);
}

.ref-card.has-gallery {
  padding-top: 0;
  overflow: hidden;
}

.ref-card:hover {
  transform: translateY(-4px);
  box-shadow: var(--shadow-md);
}

/* Gallery in card */
.ref-gallery {
  margin: 0 -2rem;
  margin-bottom: 0.5rem;
}

.ref-card.has-gallery .ref-gallery {
  margin-top: 0;
}

.ref-gallery-main {
  position: relative;
  aspect-ratio: 16 / 10;
  overflow: hidden;
  cursor: pointer;
}

.ref-gallery-main img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform var(--transition-slow);
}

.ref-gallery-main:hover img {
  transform: scale(1.05);
}

.ref-gallery-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to top, rgba(15, 19, 24, 0.7) 0%, transparent 50%);
  display: flex;
  align-items: flex-end;
  justify-content: flex-end;
  padding: 1rem;
  gap: 0.5rem;
  opacity: 0;
  transition: opacity var(--transition-normal);
}

.ref-gallery-main:hover .ref-gallery-overlay {
  opacity: 1;
}

.ref-gallery-overlay span {
  color: white;
  font-size: 0.8rem;
  font-weight: 600;
  letter-spacing: 0.5px;
}

.ref-gallery-thumbs {
  display: flex;
  gap: 3px;
  padding: 3px 0 0;
}

.ref-thumb {
  flex: 1;
  aspect-ratio: 4 / 3;
  overflow: hidden;
  cursor: pointer;
}

.ref-thumb img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform var(--transition-normal);
}

.ref-thumb:hover img {
  transform: scale(1.1);
}

.ref-thumb-more {
  display: flex;
  align-items: center;
  justify-content: center;
  background: var(--color-primary);
  color: var(--color-accent);
  font-weight: 700;
  font-size: 0.9rem;
  cursor: pointer;
  transition: background var(--transition-normal);
}

.ref-thumb-more:hover {
  background: var(--color-primary-light);
}

/* Card text content — keep original styles */
.ref-car {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-weight: 700;
  font-size: 1rem;
  color: var(--color-primary);
}

.ref-card.has-gallery .ref-car {
  padding: 0 2rem;
}

.ref-car svg {
  color: var(--color-accent);
  flex-shrink: 0;
}

.ref-service {
  font-size: 0.85rem;
  color: var(--color-text-light);
  line-height: 1.6;
  padding-bottom: 0.75rem;
  border-bottom: 1px solid var(--color-border);
}

.ref-card.has-gallery .ref-service {
  padding-left: 2rem;
  padding-right: 2rem;
}

.ref-quote {
  font-family: var(--font-heading);
  font-size: 1rem;
  color: var(--color-text);
  line-height: 1.7;
  font-style: italic;
  flex: 1;
}

.ref-card.has-gallery .ref-quote {
  padding-left: 2rem;
  padding-right: 2rem;
}

.ref-author {
  font-style: normal;
  font-size: 0.8rem;
  font-weight: 600;
  color: var(--color-accent);
  text-transform: uppercase;
  letter-spacing: 1px;
}

.ref-card.has-gallery .ref-author {
  padding: 0 2rem 1rem;
}

/* Lightbox */
.lightbox {
  position: fixed;
  inset: 0;
  z-index: 2000;
  background: rgba(0, 0, 0, 0.95);
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 2rem;
}

.lightbox-image {
  max-width: 90vw;
  max-height: 85vh;
  object-fit: contain;
  border-radius: var(--radius-md);
}

.lightbox-close {
  position: absolute;
  top: 1.5rem;
  right: 1.5rem;
  z-index: 10;
  color: white;
  opacity: 0.7;
  transition: opacity var(--transition-fast);
}

.lightbox-close:hover {
  opacity: 1;
}

.lightbox-nav {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  color: white;
  opacity: 0.7;
  transition: opacity var(--transition-fast);
  padding: 1rem;
}

.lightbox-nav:hover {
  opacity: 1;
}

.lightbox-prev {
  left: 1rem;
}

.lightbox-next {
  right: 1rem;
}

.lightbox-counter {
  position: absolute;
  bottom: 1.5rem;
  left: 50%;
  transform: translateX(-50%);
  color: rgba(255, 255, 255, 0.6);
  font-size: 0.85rem;
  font-weight: 600;
  letter-spacing: 1px;
}

.lightbox-enter-active,
.lightbox-leave-active {
  transition: opacity 0.3s ease;
}

.lightbox-enter-from,
.lightbox-leave-to {
  opacity: 0;
}

/* CTA */
.page-cta {
  background: var(--color-primary);
  padding: 5rem 0;
  text-align: center;
  position: relative;
  overflow: hidden;
}

.page-cta::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(ellipse at center, rgba(201, 168, 76, 0.1) 0%, transparent 70%);
}

.page-cta .container {
  position: relative;
}

.page-cta h2 {
  font-family: var(--font-heading);
  font-size: 2.5rem;
  color: white;
  margin-bottom: 1rem;
}

.page-cta p {
  color: rgba(255, 255, 255, 0.6);
  margin-bottom: 2rem;
  font-size: 1.1rem;
}

.btn {
  display: inline-block;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1px;
  border-radius: 50px;
  transition: all var(--transition-normal);
}

.btn-primary {
  background: var(--color-accent);
  color: white;
  padding: 1rem 2.5rem;
}

.btn-primary:hover {
  background: var(--color-accent-light);
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(201, 168, 76, 0.4);
}

.btn-lg {
  font-size: 1rem;
  padding: 1.1rem 3rem;
}

@media (max-width: 768px) {
  .ref-grid {
    grid-template-columns: 1fr;
  }

  .lightbox-image {
    max-width: 95vw;
    max-height: 80vh;
  }

  .page-cta h2 {
    font-size: 1.8rem;
  }
}
</style>
