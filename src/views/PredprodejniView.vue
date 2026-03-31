<template>
  <div class="page-wrapper">
    <section class="page-hero">
      <div class="container">
        <div class="page-hero-label">Prodejte výhodněji</div>
        <h1 class="page-hero-title">Předprodejní příprava</h1>
        <p class="page-hero-sub">Získejte za svůj vůz vyšší cenu díky profesionální přípravě</p>
      </div>
    </section>

    <!-- Factors -->
    <section class="page-section">
      <div class="container">
        <h2 class="section-heading">Co ovlivňuje prodejní cenu vozu?</h2>
        <div class="factors-grid">
          <div class="factor-card factor-yes">
            <div class="factor-header">
              <span class="factor-emoji">🫧</span>
              <h3>Co zvyšuje cenu</h3>
            </div>
            <ul>
              <li v-for="item in pros" :key="item">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                  <polyline points="20 6 9 17 4 12"/>
                </svg>
                {{ item }}
              </li>
            </ul>
          </div>
          <div class="factor-card factor-no">
            <div class="factor-header">
              <span class="factor-emoji">🤢</span>
              <h3>Co snižuje cenu</h3>
            </div>
            <ul>
              <li v-for="item in cons" :key="item">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                  <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
                {{ item }}
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- Before/After showcase -->
    <section class="showcase-section">
      <div class="container">
        <img :src="feliciaSideBySide" alt="Škoda Felicia – před a po předprodejní přípravě" class="showcase-img" />
      </div>
    </section>

    <!-- Packages -->
    <section class="page-section page-section-alt">
      <div class="container">
        <h2 class="section-heading">Balíčky předprodejní přípravy</h2>
        <p class="section-sub">Ceny pro vůz střední třídy. SUV / MPV příplatek 20 %, malé vozy sleva 20 %.</p>
        <div class="pkg-grid">
          <div v-for="pkg in packages" :key="pkg.name" class="pkg-card" :class="{ highlight: pkg.highlight }">
            <div v-if="pkg.highlight" class="pkg-badge">Nejoblíbenější</div>
            <h3>{{ pkg.name }}</h3>
            <ul class="pkg-items">
              <li v-for="item in pkg.items" :key="item">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                  <polyline points="20 6 9 17 4 12"/>
                </svg>
                {{ item }}
              </li>
            </ul>
            <div class="pkg-price">{{ pkg.price }}</div>
            <RouterLink to="/#contact" class="btn btn-primary">Poptat balíček</RouterLink>
          </div>
        </div>
      </div>
    </section>

    <section class="page-cta">
      <div class="container">
        <h2>Prodáváte vůz?</h2>
        <p>Napište mi — připravíme Váš vůz tak, aby zaujal na první pohled.</p>
        <RouterLink to="/#contact" class="btn btn-primary btn-lg">Poptat předprodejní přípravu</RouterLink>
      </div>
    </section>
  </div>
</template>

<script setup>
import { RouterLink } from 'vue-router'
import feliciaSideBySide from '../assets/images/Škoda Felicia/pred prodejem/side_by_side.webp'

const pros = [
  'Vizuální stav (první dojem) → až +15 % hodnoty',
  'Perfektně vyčištěný interiér → kupující vnímá, že auto je „jako nové"',
  'Odstranění skvrn a opotřebení → důležitý psychologický efekt',
  'Odstranění drobných vad (škrábance, zažloutlá světla, zašlý lak)'
]

const cons = [
  'Zápach (kouř, zvířata) → až -10 % hodnoty',
  'Špinavý interiér → automatický tlak na slevu',
  'Matný lak / škrábance → auto vypadá starší, než ve skutečnosti je',
  'Špatné fotky → nedojde ani na osobní prohlídku vozu'
]

const packages = [
  {
    name: 'Kompletní příprava exteriér / interiér + focení',
    price: '7 000 Kč',
    items: [
      'Detailní ruční mytí',
      'Dekontaminace / leštění / voskování laku',
      'Oživení nelakovaných plastů',
      'Leštění světel a skel',
      'Luxování, čištění a impregnace plastů',
      'Tepování látkových / čištění a vyživení kožených sedaček',
      'Provonění interiéru',
      'Nafocení vozu pro inzerci'
    ],
    highlight: true
  },
  {
    name: 'Základní příprava exteriér / interiér',
    price: '4 000 Kč',
    items: [
      'Detailní ruční mytí',
      'Rozleštění drobných defektů laku',
      'Voskování laku',
      'Oživení plastů',
      'Leštění skel',
      'Luxování',
      'Čištění a impregnace plastů',
      'Provonění interiéru'
    ],
    highlight: false
  }
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
.page-hero-sub { color: rgba(255,255,255,.6); }

.page-section { padding: 5rem 0; }
.page-section-alt { background: var(--color-bg-light); }

.section-heading { font-family: var(--font-heading); font-size: 2rem; color: var(--color-primary); margin-bottom: 0.75rem; text-align: center; }
.section-sub { text-align: center; color: var(--color-text-light); margin-bottom: 2.5rem; }

/* Factors */
.factors-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; max-width: 900px; margin: 0 auto; }

.factor-card {
  border-radius: var(--radius-lg);
  padding: 2.5rem;
  box-shadow: var(--shadow-sm);
}
.factor-yes { background: #f0fdf4; border-left: 4px solid #22c55e; }
.factor-no { background: #fff1f2; border-left: 4px solid #f43f5e; }

.factor-header { display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.5rem; }
.factor-emoji { font-size: 1.5rem; }
.factor-header h3 { font-family: var(--font-heading); font-size: 1.25rem; color: var(--color-primary); }

.factor-card ul { display: flex; flex-direction: column; gap: 0.75rem; }
.factor-card li { display: flex; gap: 0.5rem; align-items: flex-start; font-size: 0.9rem; color: var(--color-text); line-height: 1.5; }
.factor-yes li svg { color: #22c55e; flex-shrink: 0; margin-top: 2px; }
.factor-no li svg { color: #f43f5e; flex-shrink: 0; margin-top: 2px; }

/* Showcase */
.showcase-section {
  padding: 3rem 0;
  background: var(--color-bg-light);
  text-align: center;
}

.showcase-img {
  max-width: 100%;
  width: 900px;
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-md);
  display: block;
  margin: 0 auto;
}

/* Packages */
.pkg-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; }

.pkg-card {
  background: white;
  border-radius: var(--radius-xl);
  padding: 2.5rem;
  box-shadow: var(--shadow-md);
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
  border: 2px solid var(--color-border);
  position: relative;
  transition: transform var(--transition-normal);
}
.pkg-card:hover { transform: translateY(-4px); }
.pkg-card.highlight { border-color: var(--color-accent); }

.pkg-badge {
  position: absolute;
  top: -14px;
  left: 50%;
  transform: translateX(-50%);
  background: var(--color-accent);
  color: white;
  font-size: 0.75rem;
  font-weight: 700;
  letter-spacing: 1px;
  text-transform: uppercase;
  padding: 0.3rem 1.25rem;
  border-radius: 50px;
  white-space: nowrap;
}

.pkg-card h3 { font-family: var(--font-heading); font-size: 1.2rem; color: var(--color-primary); }

.pkg-items { display: flex; flex-direction: column; gap: 0.6rem; flex: 1; }
.pkg-items li { display: flex; gap: 0.5rem; align-items: flex-start; font-size: 0.875rem; color: var(--color-text-light); }
.pkg-items li svg { color: var(--color-accent); flex-shrink: 0; margin-top: 2px; }

.pkg-price { font-family: var(--font-heading); font-size: 2rem; font-weight: 700; color: var(--color-accent); }

.btn {
  display: inline-block;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1px;
  border-radius: 50px;
  transition: all var(--transition-normal);
  text-align: center;
}
.btn-primary { background: var(--color-accent); color: white; padding: 0.9rem 2rem; }
.btn-primary:hover { background: var(--color-accent-light); transform: translateY(-2px); box-shadow: 0 8px 24px rgba(201,168,76,.4); }
.btn-lg { font-size: 1rem; padding: 1.1rem 3rem; }

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
.page-cta p { color: rgba(255,255,255,.6); margin-bottom: 2rem; font-size: 1.1rem; }

@media (max-width: 700px) {
  .factors-grid { grid-template-columns: 1fr; }
}
</style>
