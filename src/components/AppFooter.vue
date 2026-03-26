<script setup>
import { RouterLink, useRouter } from 'vue-router'
import { useRoute } from 'vue-router'
import { useI18n } from '../i18n'
import logoImg from '../assets/images/logo.png'

const { t } = useI18n()
const router = useRouter()
const route = useRoute()
const currentYear = new Date().getFullYear()

function goToSection(hash) {
  if (route.path === '/') {
    const el = document.querySelector(hash)
    if (el) el.scrollIntoView({ behavior: 'smooth' })
  } else {
    router.push({ path: '/', hash })
  }
}
</script>

<template>
  <footer class="footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-brand">
          <div class="footer-logo">
            <img :src="logoImg" alt="VeVůni" class="footer-logo-img" />
          </div>
          <p class="footer-desc">
            {{ t.footer.description }}
          </p>
        </div>

        <div class="footer-links">
          <h4>{{ t.footer.navTitle }}</h4>
          <ul>
            <li><button class="footer-link-btn" @click="goToSection('#hero')">{{ t.nav.home }}</button></li>
            <li><button class="footer-link-btn" @click="goToSection('#services')">{{ t.nav.services }}</button></li>
            <li><button class="footer-link-btn" @click="goToSection('#portfolio')">{{ t.nav.portfolio }}</button></li>
            <li><button class="footer-link-btn" @click="goToSection('#contact')">{{ t.nav.contact }}</button></li>
          </ul>
        </div>

        <div class="footer-pages">
          <h4>{{ t.footer.pagesTitle }}</h4>
          <ul>
            <li><RouterLink to="/o-projektu">{{ t.nav.about }}</RouterLink></li>
            <li><RouterLink to="/reference">{{ t.nav.references }}</RouterLink></li>
            <li><RouterLink to="/exterier">{{ t.nav.exterier }}</RouterLink></li>
            <li><RouterLink to="/interier">{{ t.nav.interier }}</RouterLink></li>
            <li><RouterLink to="/cenik">{{ t.nav.cenik }}</RouterLink></li>
            <li><RouterLink to="/predprodejni-priprava">{{ t.nav.predprodejni }}</RouterLink></li>
          </ul>
        </div>

        <div class="footer-contact">
          <h4>{{ t.footer.contactTitle }}</h4>
          <ul>
            <li>
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
              Slunéčkova 1982, Lysá nad Labem, 289 22
            </li>
            <li>
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
              michal.tauchman86@gmail.com
            </li>
            <li>
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/></svg>
              IČ: 86757351
            </li>
            <li>
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/></svg>
              DIČ: CZ8602112794
            </li>
          </ul>
        </div>
      </div>

      <div class="footer-bottom">
        <p>&copy; {{ currentYear }} {{ t.footer.copyright }}</p>
      </div>
    </div>
  </footer>
</template>

<style scoped>
.footer {
  background: var(--color-bg-dark);
  color: rgba(255, 255, 255, 0.8);
  padding: 4rem 0 0;
}

.footer-grid {
  display: grid;
  grid-template-columns: 1.5fr 0.8fr 1fr 1.5fr;
  gap: 2.5rem;
  padding-bottom: 3rem;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.footer-logo {
  display: flex;
  align-items: center;
  margin-bottom: 1rem;
}

.footer-logo-img {
  height: 48px;
  width: auto;
}

.footer-desc {
  font-size: 0.9rem;
  line-height: 1.7;
  color: rgba(255, 255, 255, 0.6);
}

.footer-links h4,
.footer-pages h4,
.footer-contact h4 {
  font-family: var(--font-body);
  font-size: 1rem;
  font-weight: 600;
  color: var(--color-accent);
  text-transform: uppercase;
  letter-spacing: 1px;
  margin-bottom: 1.25rem;
}

.footer-links ul,
.footer-pages ul,
.footer-contact ul {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}

.footer-link-btn {
  background: none;
  border: none;
  padding: 0;
  cursor: pointer;
  font-size: 0.9rem;
  color: rgba(255, 255, 255, 0.6);
  font-family: inherit;
  transition: color var(--transition-fast);
  text-align: left;
}

.footer-link-btn:hover {
  color: var(--color-accent);
}

.footer-links a,
.footer-pages a {
  font-size: 0.9rem;
  color: rgba(255, 255, 255, 0.6);
  transition: color var(--transition-fast);
}

.footer-links a:hover,
.footer-pages a:hover {
  color: var(--color-accent);
}

.footer-contact li {
  display: flex;
  align-items: flex-start;
  gap: 0.75rem;
  font-size: 0.85rem;
  color: rgba(255, 255, 255, 0.6);
}

.footer-contact svg {
  flex-shrink: 0;
  margin-top: 3px;
  color: var(--color-accent);
}

.footer-bottom {
  padding: 1.5rem 0;
  text-align: center;
  font-size: 0.8rem;
  color: rgba(255, 255, 255, 0.4);
}

@media (max-width: 768px) {
  .footer-grid {
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    text-align: center;
  }

  .footer-logo {
    justify-content: center;
  }

  .footer-contact li {
    justify-content: center;
  }
}
</style>
