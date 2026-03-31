<template>
  <div class="page-wrapper">
    <!-- Hero -->
    <section class="page-hero">
      <div class="container">
        <div class="page-hero-label">{{ t.about.heroLabel }}</div>
        <h1 class="page-hero-title" v-html="t.about.heroTitle.replace('\n', '<br>')"></h1>
        <p class="page-hero-sub">{{ t.about.heroSub }}</p>
      </div>
    </section>

    <!-- Jak to začalo -->
    <section class="page-section">
      <div class="container">
        <div class="story-grid">
          <div class="story-content">
            <span class="section-eyebrow">{{ t.about.storyEyebrow }}</span>
            <h2>{{ t.about.storyTitle }}</h2>
            <p>{{ t.about.storyP1 }}</p>
            <p v-html="t.about.storyP2"></p>
          </div>
          <div class="story-quote">
            <blockquote>
              {{ t.about.quote }}
              <cite>{{ t.about.quoteAuthor }}</cite>
            </blockquote>
          </div>
        </div>
      </div>
    </section>

    <!-- Spolehlivě a rychle -->
    <section class="page-section page-section-alt">
      <div class="container">
        <div class="features-grid">
          <div class="feature-card">
            <div class="feature-icon">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
              </svg>
            </div>
            <h3>{{ t.about.feature1Title }}</h3>
            <p>{{ t.about.feature1Text }}</p>
          </div>
          <div class="feature-card">
            <div class="feature-icon">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
              </svg>
            </div>
            <h3>{{ t.about.feature2Title }}</h3>
            <p>{{ t.about.feature2Text }}</p>
          </div>
          <div class="feature-card">
            <div class="feature-icon">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <rect x="3" y="8" width="18" height="13" rx="2"/><path d="M8 8V6a4 4 0 018 0v2"/>
                <path d="M12 13v3"/><circle cx="12" cy="13" r="1"/>
              </svg>
            </div>
            <h3>{{ t.about.feature3Title }}</h3>
            <p>{{ t.about.feature3Text }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Meguiars -->
    <section class="page-section">
      <div class="container">
        <div class="training-box">
          <div class="training-text">
            <span class="section-eyebrow">{{ t.about.certEyebrow }}</span>
            <h2>{{ t.about.certTitle }}</h2>
            <p v-html="t.about.certText"></p>
          </div>
          <div class="training-badge">
            <img :src="certImg" :alt="t.about.certImgAlt" class="training-photo" />
          </div>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="page-cta">
      <div class="container">
        <h2>{{ t.about.ctaTitle }}</h2>
        <p>{{ t.about.ctaText }}</p>
        <RouterLink to="/#contact" class="btn btn-primary btn-lg">{{ t.about.ctaBtn }}</RouterLink>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { RouterLink } from 'vue-router'
import { useI18n } from '../i18n'
import certImg from '../assets/images/M.webp'

const { t } = useI18n()
</script>

<style scoped>
.page-wrapper {
  padding-top: var(--header-height);
}

/* Hero */
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
  line-height: 1.2;
}

.page-hero-sub {
  color: rgba(255, 255, 255, 0.6);
  font-size: 1rem;
}

/* Sections */
.page-section {
  padding: 5rem 0;
}

.page-section-alt {
  background: var(--color-bg-light);
}

.section-eyebrow {
  display: inline-block;
  font-size: 0.75rem;
  font-weight: 700;
  letter-spacing: 3px;
  text-transform: uppercase;
  color: var(--color-accent);
  margin-bottom: 0.75rem;
}

/* Story */
.story-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 4rem;
  align-items: center;
}

.story-content h2 {
  font-family: var(--font-heading);
  font-size: 2rem;
  margin-bottom: 1.5rem;
  color: var(--color-primary);
}

.story-content p {
  color: var(--color-text-light);
  line-height: 1.8;
  margin-bottom: 1rem;
}

.story-quote {
  background: var(--color-primary);
  border-radius: var(--radius-lg);
  padding: 3rem;
  text-align: center;
}

.story-quote blockquote {
  font-family: var(--font-heading);
  font-size: 1.5rem;
  color: white;
  line-height: 1.5;
  font-style: italic;
  margin-bottom: 1.5rem;
}

.story-quote cite {
  display: block;
  font-style: normal;
  font-size: 0.85rem;
  font-weight: 600;
  letter-spacing: 2px;
  text-transform: uppercase;
  color: var(--color-accent);
}

/* Features */
.features-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 2rem;
}

.feature-card {
  background: white;
  border-radius: var(--radius-lg);
  padding: 2.5rem 2rem;
  box-shadow: var(--shadow-sm);
  border-top: 3px solid var(--color-accent);
}

.feature-icon {
  width: 60px;
  height: 60px;
  background: rgba(201, 168, 76, 0.1);
  border-radius: var(--radius-md);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--color-accent);
  margin-bottom: 1.5rem;
}

.feature-card h3 {
  font-family: var(--font-heading);
  font-size: 1.25rem;
  margin-bottom: 0.75rem;
  color: var(--color-primary);
}

.feature-card p {
  color: var(--color-text-light);
  line-height: 1.8;
  font-size: 0.95rem;
}

/* Training */
.training-box {
  display: grid;
  grid-template-columns: 1fr auto;
  gap: 4rem;
  align-items: center;
  background: var(--color-bg-light);
  border-radius: var(--radius-xl);
  padding: 3rem 4rem;
}

.training-text h2 {
  font-family: var(--font-heading);
  font-size: 1.75rem;
  margin-bottom: 1rem;
  color: var(--color-primary);
}

.training-text p {
  color: var(--color-text-light);
  line-height: 1.8;
}

.training-badge {
  flex-shrink: 0;
}

.training-photo {
  width: 400px;
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-md);
  object-fit: cover;
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

/* Responsive */
@media (max-width: 900px) {
  .story-grid,
  .training-box {
    grid-template-columns: 1fr;
    gap: 2rem;
  }

  .training-box {
    padding: 2rem;
  }

  .features-grid {
    grid-template-columns: 1fr;
  }

  .training-badge {
    text-align: center;
  }

  .training-photo {
    width: 100%;
    max-width: 350px;
  }
}
</style>
