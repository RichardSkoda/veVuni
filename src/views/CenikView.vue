<template>
  <div class="page-wrapper">
    <section class="page-hero">
      <div class="container">
        <div class="page-hero-label">Transparentní ceny</div>
        <h1 class="page-hero-title">Ceník služeb</h1>
        <p class="page-hero-sub">Ceny jsou počítány na vůz střední třídy</p>
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
            Ceny jsou počítány na vůz střední třídy.
            <strong>Malé vozy – sleva 20 %.</strong>
            <strong>Vozy vyšší třídy, SUV, MPV – příplatek 20 %.</strong>
            Všechny ceny jsou uvedeny včetně 21 % DPH. Jsem plátce DPH.
            Při spojení programů „komplet" — čištění a provonění klimatizace Air Re-Fresher <strong>zdarma</strong>.
          </p>
        </div>
      </div>
    </section>

    <!-- Packages -->
    <section class="page-section">
      <div class="container">
        <h2 class="section-heading">Zvýhodněné balíčky</h2>
        <div class="packages-grid">
          <div v-for="pkg in packages" :key="pkg.name" class="pkg-card" :class="{ highlight: pkg.highlight }">
            <div class="pkg-header">
              <h3>{{ pkg.name }}</h3>
              <div class="pkg-time">{{ pkg.time }}</div>
            </div>
            <ul class="pkg-items">
              <li v-for="item in pkg.items" :key="item">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                  <polyline points="20 6 9 17 4 12"/>
                </svg>
                {{ item }}
              </li>
            </ul>
            <div class="pkg-price">{{ pkg.price }}</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Individual -->
    <section class="page-section page-section-alt">
      <div class="container">
        <h2 class="section-heading">Jednotlivé úkony</h2>
        <div class="price-table">
          <div v-for="item in individual" :key="item.name" class="price-row">
            <div class="price-name">{{ item.name }}</div>
            <div class="price-time">{{ item.time }}</div>
            <div class="price-val">{{ item.price }}</div>
          </div>
        </div>
      </div>
    </section>

    <section class="page-cta">
      <div class="container">
        <h2>Chcete přesnou nabídku?</h2>
        <p>Napište mi, popište Váš vůz a zájem – připravím nabídku přímo pro Vás.</p>
        <RouterLink to="/#contact" class="btn btn-primary btn-lg">Poptat nezávazně</RouterLink>
      </div>
    </section>
  </div>
</template>

<script setup>
import { RouterLink } from 'vue-router'

const packages = [
  {
    name: 'Exteriér komplet',
    time: 'cca 6 hodin',
    price: '4 000 Kč',
    items: [
      'Dočištění exteriéru včetně rámů dveří a prahů',
      'Dekontaminace laku – Clay',
      'Rozleštění lokálních defektů laku',
      'Voskování laku',
      'Vyživení nelakovaných plastů',
      'Očištění a ošetření disků kol',
      'Vyleštění skel, aplikace tekutých stěračů'
    ],
    highlight: true
  },
  {
    name: 'Exteriér základ',
    time: 'cca 3 hodiny',
    price: '2 200 Kč',
    items: [
      'Dočištění exteriéru včetně rámů dveří a prahů',
      'Voskování laku',
      'Vyživení nelakovaných plastů',
      'Očištění a ošetření disků kol',
      'Vyleštění skel, aplikace tekutých stěračů'
    ],
    highlight: false
  },
  {
    name: 'Interiér komplet',
    time: 'cca 4 hodiny',
    price: '2 500 Kč',
    items: [
      'Čištění rámů dveří a prahů',
      'Luxování',
      'Tepování koberečků',
      'Tepování látkových / čištění a impregnace kožených sedaček',
      'Čištění a ošetření plastů včetně palubní desky',
      'Vyleštění skel z vnitřní strany',
      'Provonění interiéru'
    ],
    highlight: true
  },
  {
    name: 'Interiér základ',
    time: 'cca 2 hodiny',
    price: '1 400 Kč',
    items: [
      'Čištění rámů dveří a prahů',
      'Luxování',
      'Čištění a ošetření plastů včetně palubní desky',
      'Vyleštění skel z vnitřní strany',
      'Provonění interiéru'
    ],
    highlight: false
  }
]

const individual = [
  { name: 'Ruční dočištění exteriéru detailerem, včetně rámů dveří a prahů', time: 'cca 60 min', price: '800 Kč' },
  { name: 'Dekontaminace laku – Clay', time: 'cca 90 min', price: '1 000 Kč' },
  { name: 'Rozleštění lokálních defektů laku mikroabrazivní leštěnkou', time: 'cca 20–60 min', price: '300–1 000 Kč' },
  { name: 'Jednokrokové leštění laku neabrazivní / mikroabrazivní leštěnkou', time: 'cca 150 min', price: '2 000 Kč' },
  { name: 'Voskování laku – technologie syntetických polymerů', time: 'cca 60 min', price: '1 000 Kč' },
  { name: 'Leštění světlometů', time: 'cca 30 min', price: '400 Kč' },
  { name: 'Vyživení nelakovaných exteriérových plastů', time: 'cca 20–40 min', price: '200–450 Kč' },
  { name: 'Dočištění a ošetření disků kol', time: 'cca 30 min', price: '350 Kč' },
  { name: 'Luxování vozu, včetně kufru', time: 'cca 30 min', price: '400 Kč' },
  { name: 'Tepování podlahy a koberečků', time: 'cca 45 min', price: '600 Kč' },
  { name: 'Tepování čalouněných sedaček', time: 'cca 90 min', price: '1 400 Kč' },
  { name: 'Čištění a impregnace kožených / alcantarových sedaček', time: 'cca 120 min', price: '1 700 Kč' },
  { name: 'Čištění a impregnace vnitřních plastů včetně palubní desky', time: 'cca 60 min', price: '800 Kč' },
  { name: 'Leštění skel vozu + nanesení „tekutých stěračů"', time: 'cca 30 min', price: '400 Kč' },
  { name: 'Čištění a provonění klimatizace Air Re-Fresher', time: 'cca 20 min', price: '500 Kč' }
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
