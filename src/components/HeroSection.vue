<template>
  <section id="hero" class="hero">
    <div class="hero-bg" :style="{ backgroundImage: `url(${heroBg})` }"></div>
    <div class="hero-overlay"></div>
    <div class="hero-particles">
      <div v-for="i in 20" :key="i" class="particle" :style="{
        left: Math.random() * 100 + '%',
        animationDelay: Math.random() * 5 + 's',
        animationDuration: 3 + Math.random() * 4 + 's'
      }"></div>
    </div>
    <div class="container hero-content">
      <div class="hero-top">
        <div class="hero-left">
          <div class="hero-badge">{{ t.hero.badge }}</div>
          <h1 class="hero-title">
            <span class="hero-title-line">{{ t.hero.titleLine1 }}</span>
            <span class="hero-title-accent">{{ t.hero.titleLine2 }}</span>
          </h1>
        </div>
        <div class="hero-right">
          <p class="hero-description">
            {{ t.hero.description }}
          </p>
          <div class="hero-actions">
            <button class="btn btn-primary btn-lg" @click="scrollToContact">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
              {{ t.hero.ctaPrimary }}
            </button>
            <button class="btn btn-outline btn-lg" @click="scrollToServices">
              {{ t.hero.ctaSecondary }}
            </button>
          </div>
          <div class="hero-stats">
            <div class="stat">
              <span class="stat-number">{{ t.hero.stat2Number }}</span>
              <span class="stat-label">{{ t.hero.stat2Label }}</span>
            </div>
            <div class="stat-divider"></div>
            <div class="stat">
              <span class="stat-number">{{ t.hero.stat3Number }}</span>
              <span class="stat-label">{{ t.hero.stat3Label }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="hero-scroll-indicator">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M19 12l-7 7-7-7"/></svg>
    </div>
  </section>
</template>

<script setup>
import { useI18n } from '../i18n'
import heroBg from '../assets/images/main_jag.webp'

const { t } = useI18n()

const scrollToContact = () => {
  document.getElementById('contact')?.scrollIntoView({ behavior: 'smooth' })
}

const scrollToServices = () => {
  document.getElementById('services')?.scrollIntoView({ behavior: 'smooth' })
}
</script>

<style scoped>
.hero {
  position: relative;
  min-height: 100vh;
  display: flex;
  align-items: flex-start;
  overflow: hidden;
  background-color: #0b0f14;
}

.hero-bg {
  position: absolute;
  inset: 0;
  background-size: cover;
  background-position: center right;
  background-repeat: no-repeat;
  z-index: 0;
}

/* Gradient overlay – dark on top, fading to transparent at bottom */
.hero-overlay {
  position: absolute;
  inset: 0;
  background:
    linear-gradient(
      to bottom,
      rgba(11, 15, 20, 0.93) 0%,
      rgba(11, 15, 20, 0.85) 25%,
      rgba(11, 15, 20, 0.55) 45%,
      rgba(11, 15, 20, 0.2) 65%,
      transparent 80%
    );
  z-index: 1;
}

/* Subtle accent glow */
.hero-overlay::after {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(ellipse at 50% 20%, rgba(201, 168, 76, 0.06) 0%, transparent 50%);
  pointer-events: none;
}

/* Floating particles */
.hero-particles {
  position: absolute;
  inset: 0;
  pointer-events: none;
  z-index: 1;
}

.particle {
  position: absolute;
  width: 3px;
  height: 3px;
  background: var(--color-accent);
  border-radius: 50%;
  opacity: 0;
  animation: float-up linear infinite;
}

@keyframes float-up {
  0% {
    bottom: -5%;
    opacity: 0;
  }
  10% {
    opacity: 0.6;
  }
  90% {
    opacity: 0.2;
  }
  100% {
    bottom: 105%;
    opacity: 0;
  }
}

/* Content */
.hero-content {
  position: relative;
  z-index: 2;
  padding-top: calc(var(--header-height) + 2rem);
  padding-bottom: 0;
  width: 100%;
}

.hero-top {
  display: flex;
  gap: 3rem;
  align-items: flex-start;
}

.hero-left {
  flex: 1;
  min-width: 0;
}

.hero-right {
  flex: 1;
  min-width: 0;
  padding-top: 0.5rem;
}

.hero-badge {
  display: inline-block;
  padding: 0.5rem 1.25rem;
  background: rgba(201, 168, 76, 0.15);
  border: 1px solid rgba(201, 168, 76, 0.3);
  border-radius: 50px;
  color: var(--color-accent);
  font-size: 0.85rem;
  font-weight: 500;
  letter-spacing: 1px;
  margin-bottom: 2rem;
  animation: fadeInDown 0.8s ease;
}

.hero-title {
  margin-bottom: 1.5rem;
  animation: fadeInUp 0.8s ease 0.2s both;
}

.hero-title-line {
  display: block;
  font-size: clamp(2.25rem, 4.5vw, 3.5rem);
  color: white;
  font-weight: 700;
  margin-bottom: 0.25rem;
  text-shadow: 0 2px 20px rgba(0, 0, 0, 0.5);
}

.hero-title-accent {
  display: block;
  font-size: clamp(1.5rem, 3vw, 2.5rem);
  color: var(--color-accent);
  font-weight: 400;
  font-style: italic;
  text-shadow: 0 2px 15px rgba(0, 0, 0, 0.4);
}

.hero-description {
  font-size: clamp(0.95rem, 1.5vw, 1.1rem);
  color: rgba(255, 255, 255, 0.8);
  max-width: 480px;
  margin-bottom: 2.5rem;
  line-height: 1.8;
  font-weight: 300;
  text-shadow: 0 1px 8px rgba(0, 0, 0, 0.4);
  animation: fadeInUp 0.8s ease 0.4s both;
}

.hero-actions {
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
  margin-bottom: 3rem;
  animation: fadeInUp 0.8s ease 0.6s both;
}

.btn-lg {
  padding: 1rem 2.25rem;
  font-size: 1rem;
}

.hero-stats {
  display: flex;
  align-items: center;
  gap: 2rem;
  animation: fadeInUp 0.8s ease 0.8s both;
}

.stat {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.25rem;
}

.stat-number {
  font-family: var(--font-heading);
  font-size: 1.75rem;
  font-weight: 700;
  color: var(--color-accent);
  text-shadow: 0 2px 10px rgba(0, 0, 0, 0.4);
}

.stat-label {
  font-size: 0.75rem;
  color: rgba(255, 255, 255, 0.6);
  text-transform: uppercase;
  letter-spacing: 1px;
}

.stat-divider {
  width: 1px;
  height: 40px;
  background: rgba(255, 255, 255, 0.2);
}

.hero-scroll-indicator {
  position: absolute;
  bottom: 2rem;
  left: 50%;
  transform: translateX(-50%);
  color: rgba(255, 255, 255, 0.4);
  animation: bounce 2s infinite;
  z-index: 2;
}

@keyframes bounce {
  0%, 100% { transform: translateX(-50%) translateY(0); }
  50% { transform: translateX(-50%) translateY(10px); }
}

@keyframes fadeInDown {
  from { opacity: 0; transform: translateY(-20px); }
  to { opacity: 1; transform: translateY(0); }
}

@keyframes fadeInUp {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}

@media (max-width: 1920px) {
  .hero-stats {
    justify-content: flex-end;
  }
}

@media (max-width: 768px) {
  .hero-bg {
    background-position: center;
  }

  .hero-overlay {
    background:
      linear-gradient(
        to bottom,
        rgba(11, 15, 20, 0.85) 0%,
        rgba(11, 15, 20, 0.7) 40%,
        rgba(11, 15, 20, 0.3) 70%,
        transparent 100%
      );
  }

  .hero-top {
    flex-direction: column;
    gap: 1.5rem;
    text-align: center;
  }

  .hero-description {
    margin-left: auto;
    margin-right: auto;
  }

  .hero-actions {
    justify-content: center;
  }

  .hero-stats {
    justify-content: center;
  }
}

@media (max-width: 480px) {
  .hero-stats {
    flex-direction: column;
    gap: 1.5rem;
  }

  .stat-divider {
    width: 40px;
    height: 1px;
  }

  .hero-actions {
    flex-direction: column;
    align-items: center;
  }

  .btn-lg {
    width: 100%;
    max-width: 300px;
  }
}
</style>
