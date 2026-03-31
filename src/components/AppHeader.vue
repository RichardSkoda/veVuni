<template>
  <header class="header" :class="{ scrolled: headerDark, 'menu-open': isMobileMenuOpen, 'animated': allowTrans }">
    <div class="container header-inner">
      <a href="/" class="logo" @click.prevent="goToSection('#hero')">
        <img :src="logoImg" alt="VeVůni" class="logo-img" />
      </a>

      <nav class="nav-desktop">
        <button
          v-for="link in navSections"
          :key="link.hash"
          class="nav-link"
          @click="goToSection(link.hash)"
        >
          {{ link.label }}
        </button>
        <div class="nav-divider"></div>
        <RouterLink v-for="link in pageLinks" :key="link.to" :to="link.to" class="nav-link nav-link-page">
          {{ link.label }}
        </RouterLink>
        <button class="btn btn-primary btn-nav" @click="goToSection('#contact')">{{ t.nav.cta }}</button>
        <button class="lang-switch" @click="toggleLocale" :title="locale === 'cs' ? 'Switch to English' : 'Přepnout do češtiny'">
          {{ locale === 'cs' ? 'EN' : 'CZ' }}
        </button>
      </nav>

      <button
        class="hamburger"
        :class="{ active: isMobileMenuOpen }"
        @click="toggleMobileMenu"
        aria-label="Menu"
      >
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>
  </header>

  <!-- Teleport mimo header — backdrop-filter na headeru by rozbil
       position:fixed u nav-mobile (vytváří nový containing block) -->
  <Teleport to="body">
    <Transition name="slide">
      <nav v-if="isMobileMenuOpen" class="nav-mobile">
        <button
          v-for="link in navSections"
          :key="link.hash"
          class="nav-link-mobile"
          @click="goToSection(link.hash)"
        >
          {{ link.label }}
        </button>
        <div class="nav-mobile-divider"></div>
        <RouterLink
          v-for="link in pageLinks"
          :key="link.to"
          :to="link.to"
          class="nav-link-mobile nav-link-mobile-page"
          @click="closeMobileMenu"
        >
          {{ link.label }}
        </RouterLink>
        <button class="btn btn-primary" @click="goToSection('#contact')" style="margin-top: 1rem; width: 100%;">
          {{ t.nav.cta }}
        </button>
        <button class="lang-switch lang-switch-mobile" @click="toggleLocale" :title="locale === 'cs' ? 'Switch to English' : 'Přepnout do češtiny'">
          {{ locale === 'cs' ? 'EN' : 'CZ' }}
        </button>
      </nav>
    </Transition>
  </Teleport>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { RouterLink, useRouter, useRoute } from 'vue-router'
import { useI18n } from '../i18n'
import logoImg from '../assets/images/Loga/Logo-ve-vuni_Bile.png'

const { t, locale, toggleLocale } = useI18n()
const router = useRouter()
const route = useRoute()

// --- Stav ---
const isScrolled     = ref(false)  // uživatel scrolloval
const forceScrolled  = ref(false)  // zamčeno tmavé během navigace
const allowTrans     = ref(false)  // CSS transition povolena jen mimo navigaci
const isMobileMenuOpen = ref(false)

const isHomePage = computed(() => route.path === '/')

// Header je tmavý pokud: scrolled NEBO zamčeno NEBO není home
const headerDark = computed(() =>
  forceScrolled.value || isScrolled.value || !isHomePage.value
)

// --- Nav ---
const navSections = computed(() => [
  { label: t.value.nav.home,      hash: '#hero' },
  { label: t.value.nav.services,  hash: '#services' },
  { label: t.value.nav.portfolio, hash: '#portfolio' },
  { label: t.value.nav.contact,   hash: '#contact' }
])

const pageLinks = computed(() => [
  { label: t.value.nav.about,        to: '/o-projektu' },
  { label: t.value.nav.references,   to: '/reference' },
  { label: t.value.nav.exterier,     to: '/exterier' },
  { label: t.value.nav.interier,     to: '/interier' },
  { label: t.value.nav.predprodejni, to: '/predprodejni-priprava' },
  { label: t.value.nav.cenik,        to: '/cenik' }
])

// --- Scroll ---
// forceScrolled.value je čitelné synchronně — takže handleScroll
// okamžitě uvidí true a přeskočí scroll reset z routeru
function handleScroll() {
  if (forceScrolled.value) return
  isScrolled.value = window.scrollY > 50
}

// --- Router guards ---
let _unfreezeTimer = null
let _transTimer    = null

const removeBeforeEach = router.beforeEach(() => {
  clearTimeout(_unfreezeTimer)
  clearTimeout(_transTimer)
  forceScrolled.value = true   // drží header tmavý
  allowTrans.value    = false  // zakáže CSS transition okamžitě
})

const removeAfterEach = router.afterEach(() => {
  _unfreezeTimer = setTimeout(() => {
    isScrolled.value    = window.scrollY > 50
    forceScrolled.value = false
    _transTimer = setTimeout(() => { allowTrans.value = true }, 60)
  }, 60)
})

// --- Sekce na home ---
function goToSection(hash) {
  closeMobileMenu()
  if (route.path === '/') {
    const el = document.querySelector(hash)
    if (el) el.scrollIntoView({ behavior: 'smooth' })
  } else {
    router.push({ path: '/', hash })
  }
}

// --- Mobile ---
function toggleMobileMenu() {
  isMobileMenuOpen.value = !isMobileMenuOpen.value
  document.body.style.overflow = isMobileMenuOpen.value ? 'hidden' : ''
}
function closeMobileMenu() {
  isMobileMenuOpen.value = false
  document.body.style.overflow = ''
}

onMounted(() => {
  isScrolled.value = window.scrollY > 50
  window.addEventListener('scroll', handleScroll, { passive: true })
  setTimeout(() => { allowTrans.value = true }, 300)
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
  clearTimeout(_unfreezeTimer)
  clearTimeout(_transTimer)
  removeBeforeEach()
  removeAfterEach()
})
</script>

<style scoped>
.header {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 1000;
  height: var(--header-height);
  /* Bez transition — povolena až přes .animated třídu */
  background: transparent;
}

/* CSS transition zapnuta pouze když je to bezpečné (mimo navigaci, po mountu) */
.header.animated {
  transition: background 0.3s ease, box-shadow 0.3s ease;
}

.header.scrolled {
  background: rgba(15, 19, 24, 0.95);
  backdrop-filter: blur(10px);
  box-shadow: var(--shadow-md);
}

.header.menu-open {
  background: var(--color-primary);
}

.header-inner {
  display: flex;
  align-items: center;
  justify-content: space-between;
  height: 100%;
}

/* Logo */
.logo {
  display: flex;
  align-items: center;
  position: relative;
  z-index: 20;
  flex-shrink: 0;
}

.logo-img {
  height: 48px;
  width: auto;
  display: block;
  filter: drop-shadow(0 1px 3px rgba(0, 0, 0, 0.6));
  margin-right: 1.5rem;
}

/* Desktop Nav */
.nav-desktop {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  min-width: 0;
}

.nav-link {
  color: rgba(255, 255, 255, 0.85);
  font-size: 0.72rem;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  white-space: nowrap;
  position: relative;
  padding: 0.25rem 0;
  background: none;
  border: none;
  cursor: pointer;
  font-family: inherit;
}

.nav-link::after {
  content: '';
  position: absolute;
  bottom: -2px;
  left: 0;
  width: 0;
  height: 2px;
  background: var(--color-accent);
  transition: width var(--transition-normal);
}

.nav-link:hover {
  color: var(--color-accent);
}

.nav-link:hover::after {
  width: 100%;
}

.btn-nav {
  padding: 0.5rem 1rem;
  font-size: 0.72rem;
  white-space: nowrap;
}

/* Nav divider between single-page links and page links */
.nav-divider {
  width: 1px;
  height: 20px;
  background: rgba(255, 255, 255, 0.2);
  flex-shrink: 0;
}

/* Smaller style for sub-page links */
.nav-link-page {
  font-size: 0.64rem;
  opacity: 0.75;
  white-space: nowrap;
}

.nav-link-page:hover {
  opacity: 1;
}

/* Hamburger */
.hamburger {
  display: none;
  flex-direction: column;
  gap: 6px;
  z-index: 10;
  width: 30px;
  padding: 4px 0;
}

.hamburger span {
  display: block;
  width: 100%;
  height: 2px;
  background: white;
  border-radius: 2px;
  transition: all var(--transition-normal);
  transform-origin: center;
}

.hamburger.active span:nth-child(1) {
  transform: rotate(45deg) translate(6px, 6px);
}

.hamburger.active span:nth-child(2) {
  opacity: 0;
}

.hamburger.active span:nth-child(3) {
  transform: rotate(-45deg) translate(6px, -6px);
}

/* Mobile Nav — teleportováno do body, z-index musí být explicitní */
.nav-mobile {
  position: fixed;
  top: var(--header-height);
  left: 0;
  right: 0;
  bottom: 0;
  z-index: 999;
  background: var(--color-primary);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 1.5rem;
  padding: 2rem;
}

.nav-link-mobile {
  color: white;
  font-size: 1.25rem;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: 2px;
  padding: 0.75rem;
  transition: color var(--transition-fast);
}

.nav-link-mobile:hover {
  color: var(--color-accent);
}

.nav-link-mobile-page {
  font-size: 1rem;
  opacity: 0.75;
}

.nav-mobile-divider {
  width: 40px;
  height: 1px;
  background: rgba(255, 255, 255, 0.2);
  margin: 0.25rem 0;
}

/* Slide transition */
.slide-enter-active,
.slide-leave-active {
  transition: transform 0.3s ease, opacity 0.3s ease;
}

.slide-enter-from,
.slide-leave-to {
  transform: translateY(-20px);
  opacity: 0;
}

/* Language switch */
.lang-switch {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  border: 1.5px solid rgba(255, 255, 255, 0.4);
  color: rgba(255, 255, 255, 0.85);
  font-size: 0.7rem;
  font-weight: 700;
  letter-spacing: 0.5px;
  cursor: pointer;
  background: transparent;
  transition: all var(--transition-normal);
  text-transform: uppercase;
}

.lang-switch:hover {
  border-color: var(--color-accent);
  color: var(--color-accent);
  background: rgba(201, 168, 76, 0.1);
}

.lang-switch-mobile {
  margin-top: 1rem;
  width: 48px;
  height: 48px;
  font-size: 0.85rem;
}

/* Responsive */
@media (max-width: 768px) {
  .nav-desktop {
    display: none;
  }

  .hamburger {
    display: flex;
  }

  .logo-img {
    height: 40px;
    margin-right: 0;
  }
}
</style>
