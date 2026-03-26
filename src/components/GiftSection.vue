<script setup>
import { useI18n } from '../i18n'
import giftImg from '../assets/images/gift.png'

const { t } = useI18n()
</script>

<template>
  <section class="section section-dark gift-section">
    <div class="container">
      <div class="gift-layout">
        <div class="gift-image-wrap">
          <img :src="giftImg" alt="Gift voucher" class="gift-image" />
        </div>
        <div class="gift-content">
          <h2 class="gift-title">{{ t.gift.title }}</h2>
          <p class="gift-text">
            {{ t.gift.text }}
          </p>
          <p class="gift-subtext">
            {{ t.gift.subtext }}
          </p>
          <a href="#contact" class="btn btn-primary">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
            {{ t.gift.cta }}
          </a>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.gift-section {
  text-align: center;
  background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-bg-dark) 100%);
  position: relative;
  overflow: hidden;
}

.gift-section::before,
.gift-section::after {
  content: '';
  position: absolute;
  width: 300px;
  height: 300px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(201, 168, 76, 0.08), transparent 70%);
}

.gift-section::before {
  top: -100px;
  left: -100px;
}

.gift-section::after {
  bottom: -100px;
  right: -100px;
}

.gift-layout {
  position: relative;
  z-index: 1;
  display: flex;
  align-items: center;
  gap: 3rem;
  max-width: 900px;
  margin: 0 auto;
}

.gift-image-wrap {
  flex: 0 0 340px;
  border-radius: var(--radius-lg);
  overflow: hidden;
  box-shadow: 0 8px 40px rgba(201, 168, 76, 0.15);
}

.gift-image {
  width: 100%;
  height: auto;
  display: block;
  transition: transform var(--transition-slow);
}

.gift-image-wrap:hover .gift-image {
  transform: scale(1.04);
}

.gift-content {
  flex: 1;
  text-align: left;
}

.gift-title {
  font-size: clamp(1.75rem, 4vw, 2.5rem);
  color: var(--color-accent);
  margin-bottom: 1rem;
}

.gift-text {
  font-size: 1.15rem;
  color: rgba(255, 255, 255, 0.85);
  margin-bottom: 0.75rem;
  font-weight: 400;
}

.gift-subtext {
  font-size: 0.95rem;
  color: rgba(255, 255, 255, 0.55);
  margin-bottom: 2rem;
  line-height: 1.7;
}

@media (max-width: 768px) {
  .gift-layout {
    flex-direction: column;
    text-align: center;
  }

  .gift-image-wrap {
    flex: none;
    width: 100%;
    max-width: 320px;
  }

  .gift-content {
    text-align: center;
  }
}
</style>
