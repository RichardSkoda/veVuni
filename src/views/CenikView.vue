<template>
  <div class="page-wrapper">
    <section class="page-hero">
      <div class="container">
        <div class="page-hero-label">{{ t.cenik.heroLabel }}</div>
        <h1 class="page-hero-title">{{ t.cenik.heroTitle }}</h1>
        <p class="page-hero-sub">{{ t.cenik.heroSub }}</p>
      </div>
    </section>

    <!-- Disclaimer -->
    <section class="disclaimer-section">
      <div class="container">
        <div class="disclaimer">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
          </svg>
          <p>
            {{ t.cenik.disclaimerText }}
            <strong>{{ t.cenik.disclaimerSmall }}</strong>
            <strong>{{ t.cenik.disclaimerLarge }}</strong>
            {{ t.cenik.disclaimerVat }}
            {{ t.cenik.disclaimerBonus }} <strong>{{ t.cenik.disclaimerFree }}</strong>.
          </p>
        </div>
      </div>
    </section>

    <!-- Packages -->
    <section class="page-section">
      <div class="container">
        <h2 class="section-heading">{{ t.cenik.packagesTitle }}</h2>
        <div class="packages-grid">
          <div v-for="(pkg, i) in packages" :key="i" class="pkg-card" :class="{ highlight: pkg.highlight }">
            <div class="pkg-header">
              <h3>{{ t.cenik.packages[i].name }}</h3>
              <div class="pkg-time">{{ t.cenik.packages[i].time }}</div>
            </div>
            <ul class="pkg-items">
              <li v-for="(item, j) in t.cenik.packages[i].items" :key="j">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                  <polyline points="20 6 9 17 4 12"/>
                </svg>
                {{ item }}
              </li>
            </ul>
            <div class="pkg-price">{{ t.cenik.packages[i].price }}</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Individual -->
    <section class="page-section page-section-alt">
      <div class="container">
        <h2 class="section-heading">{{ t.cenik.individualTitle }}</h2>
        <div class="price-table">
          <div v-for="(item, i) in t.cenik.individual" :key="i" class="price-row">
            <div class="price-name">{{ item.name }}</div>
            <div class="price-time">{{ item.time }}</div>
            <div class="price-val">{{ item.price }}</div>
          </div>
        </div>
      </div>
    </section>

    <section class="page-cta">
      <div class="container">
        <h2>{{ t.cenik.ctaTitle }}</h2>
        <p>{{ t.cenik.ctaText }}</p>
        <RouterLink to="/#contact" class="btn btn-primary btn-lg">{{ t.cenik.ctaBtn }}</RouterLink>
      </div>
    </section>
  </div>
</template>

<script setup>
import { RouterLink } from 'vue-router'
import { useI18n } from '../i18n'

const { t } = useI18n()

const packages = [
  { highlight: true },
  { highlight: false },
  { highlight: true },
  { highlight: false }
]
</script>

<style scoped>
.page-wrapper { padding-top: var(--header-height); }

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
  background: radial-gradient(ellipse at center, rgba(201,168,76,.12) 0%, transparent 70%);
}
.page-hero-label {
  display: inline-block;
  font-size: 0.75rem;
  font-weight: 700;
  letter-spacing: 3px;
  text-transform: uppercase;
  color: var(--color-accent);
  border: 1px solid rgba(201,168,76,.4);
  padding: 0.4rem 1rem;
  border-radius: 50px;
  margin-bottom: 1.5rem;
}
.page-hero-title { font-family: var(--font-heading); font-size: clamp(2rem,4vw,3rem); color: white; margin-bottom: 1rem; }
.page-hero-sub { color: rgba(255,255,255,0.6); }

/* Disclaimer */
.disclaimer-section { padding: 2rem 0; background: #fff8e7; }
.disclaimer {
  display: flex;
  gap: 1rem;
  align-items: flex-start;
  border-left: 4px solid var(--color-accent);
  padding-left: 1.5rem;
}
.disclaimer svg { color: var(--color-accent); flex-shrink: 0; margin-top: 2px; }
.disclaimer p { color: var(--color-text-light); line-height: 1.7; font-size: 0.95rem; }
.disclaimer strong { color: var(--color-text); }

.page-section { padding: 5rem 0; }
.page-section-alt { background: var(--color-bg-light); }

.section-heading {
  font-family: var(--font-heading);
  font-size: 2rem;
  color: var(--color-primary);
  margin-bottom: 2.5rem;
  text-align: center;
}

/* Packages */
.packages-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 1.5rem;
}

.pkg-card {
  background: white;
  border-radius: var(--radius-lg);
  padding: 2rem;
  box-shadow: var(--shadow-sm);
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
  border: 2px solid var(--color-border);
  transition: transform var(--transition-normal), box-shadow var(--transition-normal);
}
.pkg-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); }
.pkg-card.highlight { border-color: var(--color-accent); }

.pkg-header h3 { font-family: var(--font-heading); font-size: 1.2rem; color: var(--color-primary); }
.pkg-time { font-size: 0.8rem; color: var(--color-text-light); margin-top: 0.25rem; }

.pkg-items { display: flex; flex-direction: column; gap: 0.5rem; flex: 1; }
.pkg-items li { display: flex; gap: 0.5rem; align-items: flex-start; font-size: 0.875rem; color: var(--color-text-light); line-height: 1.5; }
.pkg-items li svg { color: var(--color-accent); flex-shrink: 0; margin-top: 2px; }

.pkg-price {
  font-family: var(--font-heading);
  font-size: 1.75rem;
  font-weight: 700;
  color: var(--color-accent);
  border-top: 1px solid var(--color-border);
  padding-top: 1rem;
}

/* Price table */
.price-table { display: flex; flex-direction: column; }
.price-row {
  display: grid;
  grid-template-columns: 1fr auto auto;
  gap: 1.5rem;
  align-items: center;
  padding: 1rem 1.5rem;
  background: white;
  border-bottom: 1px solid var(--color-border);
  transition: background var(--transition-fast);
}
.price-row:first-child { border-radius: var(--radius-md) var(--radius-md) 0 0; }
.price-row:last-child { border-radius: 0 0 var(--radius-md) var(--radius-md); border-bottom: none; }
.price-row:hover { background: #fafafa; }

.price-name { font-size: 0.9rem; color: var(--color-text); font-weight: 500; }
.price-time { font-size: 0.8rem; color: var(--color-text-light); white-space: nowrap; }
.price-val { font-weight: 700; color: var(--color-accent); white-space: nowrap; font-size: 0.95rem; }

/* CTA */
.page-cta {
  background: var(--color-primary);
  padding: 5rem 0;
  text-align: center;
  position: relative;
  overflow: hidden;
}
.page-cta::before { content: ''; position: absolute; inset: 0; background: radial-gradient(ellipse at center, rgba(201,168,76,.1) 0%, transparent 70%); }
.page-cta .container { position: relative; }
.page-cta h2 { font-family: var(--font-heading); font-size: 2.5rem; color: white; margin-bottom: 1rem; }
.page-cta p { color: rgba(255,255,255,0.6); margin-bottom: 2rem; font-size: 1.1rem; }

.btn {
  display: inline-block;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1px;
  border-radius: 50px;
  transition: all var(--transition-normal);
}
.btn-primary { background: var(--color-accent); color: white; padding: 1rem 2.5rem; }
.btn-primary:hover { background: var(--color-accent-light); transform: translateY(-2px); box-shadow: 0 8px 24px rgba(201,168,76,.4); }
.btn-lg { font-size: 1rem; padding: 1.1rem 3rem; }

@media (max-width: 700px) {
  .price-row { grid-template-columns: 1fr; gap: 0.25rem; }
  .price-val { color: var(--color-accent); }
}
</style>
