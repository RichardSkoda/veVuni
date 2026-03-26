<script setup>
import { ref, onMounted, computed } from 'vue'
import { RouterLink } from 'vue-router'
import { useI18n } from '../i18n'

const { t } = useI18n()

import before1 from '../assets/images/before1.jpg'
import before2 from '../assets/images/before2.jpg'
import before3 from '../assets/images/before3.jpg'
import after1 from '../assets/images/after1.jpg'
import after2 from '../assets/images/after2.jpg'
import after3 from '../assets/images/after3.jpg'

const activeTab = ref('before')

const beforeImages = computed(() => [
  { src: before1, alt: t.value.portfolio.beforeAlt + ' 1' },
  { src: before2, alt: t.value.portfolio.beforeAlt + ' 2' },
  { src: before3, alt: t.value.portfolio.beforeAlt + ' 3' }
])

const afterImages = computed(() => [
  { src: after1, alt: t.value.portfolio.afterAlt + ' 1' },
  { src: after2, alt: t.value.portfolio.afterAlt + ' 2' },
  { src: after3, alt: t.value.portfolio.afterAlt + ' 3' }
])

const currentImages = computed(() =>
  activeTab.value === 'before' ? beforeImages.value : afterImages.value
)

const lightboxOpen = ref(false)
const lightboxIndex = ref(0)

function openLightbox(index) {
  lightboxIndex.value = index
  lightboxOpen.value = true
  document.body.style.overflow = 'hidden'
}

function closeLightbox() {
  lightboxOpen.value = false
  document.body.style.overflow = ''
}

function nextImage() {
  lightboxIndex.value = (lightboxIndex.value + 1) % currentImages.value.length
}

function prevImage() {
  lightboxIndex.value = (lightboxIndex.value - 1 + currentImages.value.length) % currentImages.value.length
}

const sectionRef = ref(null)
const isVisible = ref(false)

onMounted(() => {
  const observer = new IntersectionObserver(
    ([entry]) => {
      if (entry.isIntersecting) {
        isVisible.value = true
        observer.disconnect()
      }
    },
    { threshold: 0.1 }
  )
  if (sectionRef.value) {
    observer.observe(sectionRef.value)
  }
})
</script>

<template>
  <section id="portfolio" class="section" ref="sectionRef">
    <div class="container">
      <h2 class="section-title">{{ t.portfolio.title }}</h2>
      <p class="section-subtitle">
        {{ t.portfolio.subtitle }}<br>
        {{ t.portfolio.subtitleLine2 }}
      </p>

      <div class="tabs">
        <button
          class="tab"
          :class="{ active: activeTab === 'before' }"
          @click="activeTab = 'before'"
        >
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/></svg>
          {{ t.portfolio.tabBefore }}
        </button>
        <button
          class="tab"
          :class="{ active: activeTab === 'after' }"
          @click="activeTab = 'after'"
        >
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M8 12h8M12 8v8"/></svg>
          {{ t.portfolio.tabAfter }}
        </button>
      </div>

      <Transition name="fade" mode="out-in">
        <div class="gallery" :key="activeTab">
          <div
            v-for="(image, index) in currentImages"
            :key="index"
            class="gallery-item"
            :class="{ visible: isVisible }"
            :style="{ transitionDelay: (index * 0.1) + 's' }"
            @click="openLightbox(index)"
          >
            <img :src="image.src" :alt="image.alt" loading="lazy" />
            <div class="gallery-overlay">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/><path d="M11 8v6M8 11h6"/></svg>
            </div>
          </div>
        </div>
      </Transition>

      <div class="portfolio-cta">
        <RouterLink to="/reference" class="btn-more">
          {{ t.portfolio.moreReferences }}
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M5 12h14M12 5l7 7-7 7"/>
          </svg>
        </RouterLink>
      </div>
    </div>

    <!-- Lightbox -->
    <Teleport to="body">
      <Transition name="lightbox">
        <div v-if="lightboxOpen" class="lightbox" @click.self="closeLightbox">
          <button class="lightbox-close" @click="closeLightbox" :aria-label="t.portfolio.closeLabel">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
          </button>
          <button class="lightbox-nav lightbox-prev" @click="prevImage" :aria-label="t.portfolio.prevLabel">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
          </button>
          <img :src="currentImages[lightboxIndex].src" :alt="currentImages[lightboxIndex].alt" class="lightbox-image" />
          <button class="lightbox-nav lightbox-next" @click="nextImage" :aria-label="t.portfolio.nextLabel">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
          </button>
        </div>
      </Transition>
    </Teleport>
  </section>
</template>

<style scoped>
.tabs {
  display: flex;
  justify-content: center;
  gap: 1rem;
  margin-bottom: 2.5rem;
}

.tab {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.75rem 1.75rem;
  font-size: 0.9rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  border-radius: 50px;
  border: 2px solid var(--color-border);
  color: var(--color-text-light);
  background: white;
  transition: all var(--transition-normal);
}

.tab:hover {
  border-color: var(--color-accent);
  color: var(--color-accent);
}

.tab.active {
  background: var(--color-accent);
  border-color: var(--color-accent);
  color: var(--color-primary);
}

.gallery {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1.5rem;
}

.gallery-item {
  position: relative;
  border-radius: var(--radius-md);
  overflow: hidden;
  cursor: pointer;
  opacity: 0;
  transform: scale(0.95);
  transition: all 0.5s ease;
  aspect-ratio: 4/3;
}

.gallery-item.visible {
  opacity: 1;
  transform: scale(1);
}

.gallery-item img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform var(--transition-slow);
}

.gallery-item:hover img {
  transform: scale(1.08);
}

.gallery-overlay {
  position: absolute;
  inset: 0;
  background: rgba(26, 26, 46, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity var(--transition-normal);
}

.gallery-item:hover .gallery-overlay {
  opacity: 1;
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

/* Transitions */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

.lightbox-enter-active,
.lightbox-leave-active {
  transition: opacity 0.3s ease;
}

.lightbox-enter-from,
.lightbox-leave-to {
  opacity: 0;
}

@media (max-width: 768px) {
  .gallery {
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
  }

  .tabs {
    flex-direction: column;
    align-items: center;
  }

  .tab {
    width: 100%;
    max-width: 300px;
    justify-content: center;
  }
}

@media (max-width: 480px) {
  .gallery {
    grid-template-columns: 1fr;
  }
}

.portfolio-cta {
  margin-top: 3rem;
  text-align: center;
}

.btn-more {
  display: inline-flex;
  align-items: center;
  gap: 0.6rem;
  font-size: 0.9rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1px;
  color: var(--color-accent);
  border: 2px solid var(--color-accent);
  padding: 0.85rem 2rem;
  border-radius: 50px;
  transition: all var(--transition-normal);
}

.btn-more:hover {
  background: var(--color-accent);
  color: white;
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(201, 168, 76, 0.3);
}
</style>
