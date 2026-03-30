<script setup>
import { RouterLink } from 'vue-router'

import imgProduct1 from '../assets/images/Produkty chemie/ImgW.webp'
import imgProduct2 from '../assets/images/Produkty chemie/ImgW (1).webp'
import imgProduct3 from '../assets/images/Produkty chemie/d0 (1).webp'
import imgProduct4 from '../assets/images/Produkty chemie/d0.jpg'
import imgProduct5 from '../assets/images/Produkty chemie/ImgW (2).webp'
import imgProduct6 from '../assets/images/Produkty chemie/209511_meguiar-s-ultimate-all-wheel-cleaner.webp'
import imgProduct7 from '../assets/images/Produkty chemie/ImgW (4).webp'
import imgProduct8 from '../assets/images/Produkty chemie/ImgW (6).webp'
import imgProduct9 from '../assets/images/Produkty chemie/G16216EU_2.webp'
import imgProduct10 from '../assets/images/Produkty chemie/g8504-meguiars-perfect-clarity-glass-sealant.jpg'

const services = [
  {
    title: 'Detailní čištění laku',
    desc: 'Před samotným procesem péče o lak je nutné jeho důkladné vyčištění. Kvalitní automatická či ruční myčka jsou dobrý začátek, nicméně hůře přístupná místa vozu je potřeba dočistit ručně. Nestihli jste svůj vůz před detailingem omýt? Nevadí, rád s Vaším vozem do myčky zajedu.',
    image: imgProduct1
  },
  {
    title: 'Dekontaminace laku – Clay',
    desc: 'Jakmile je lak na pohled čistý, je možné přistoupit k jeho dekontaminaci od nečistot, se kterými si běžná mycí technika neporadí (asfalt, rez, pryskyřice, hmyz…). K tomuto účelu se využívá tzv. Clay, který tyto nečistoty šetrně a přesto důkladně odstraňuje.',
    image: imgProduct2
  },
  {
    title: 'Leštění laku – Compound',
    desc: 'Je lak Vašeho vozu mírně až středně zašlý, obsahuje škrábance, oxidaci, hologramy a další poškození? Pak je ideální čas použít leštěnku s mikroabrazivním složením a velmi šetrně za pomocí strojní leštičky lak rozleštit. Směs leštících olejů lak navíc rozzáří a vyhladí.',
    image: imgProduct3
  },
  {
    title: 'Leštění laku – Polish',
    desc: 'Je lak Vašeho vozu stále jako nový? Byste rádi laku dodali lesk, hloubku a sytost barev? Pak je skvělou volbou použití neabrazivní leštěnky se směsí leštících olejů. Neabrazivní leštěnku je možné použít i jako druhý krok po leštění compoundem.',
    image: imgProduct4
  },
  {
    title: 'Voskování laku – syntetický vosk',
    desc: 'Voskování je posledním krokem v komplexní péči o lak. Špičkový vosk na bázi syntetických polymerů podpoří lesk a hloubku laku a především poskytne karoserii neviditelnou ochranu na několik měsíců. Vosk také výborně odpuzuje vodu – nečistoty na laku hůře ulpívají a čištění je snazší.',
    image: imgProduct5
  },
  {
    title: 'Ošetření disků a pneumatik',
    desc: 'Kola dělají auto, říká se. Jejich čistota a správná ochrana je neméně důležitá jako u zbylých částí vozu. Speciální přípravek z kol důkladně očistí brzdový prach či silniční nečistoty a zanechá je dokonale čistá pro případné další ošetření.',
    image: imgProduct6
  },
  {
    title: 'Odstranění lokálních defektů laku',
    desc: 'Pokud poškození laku zasahuje pouze do vrchní čiré vrstvy, je možné lokální škrábance a oděrky rozleštit speciálním přípravkem na lokální opravy. Opravy mírných poškození lze provádět lokálně, šetrně a bezpečně.',
    image: imgProduct7
  },
  {
    title: 'Oživení a ochrana nelakovaných plastů',
    desc: 'Blatníky, difuzory, lemy oken a další exteriérové části bývají vyvedeny v nelakovaném černém plastu. Postupem času ztrácí barvu a šednou. Aplikací vhodného prostředku dílům vrátíme jejich původní vzhled a ochráníme je proti UV záření.',
    image: imgProduct8
  },
  {
    title: 'Renovace světlometů',
    desc: 'Vypadají Vaše světlomety spíše jako mlhomety? S použitím správného přípravku je možné zmírnit jejich zažloutnutí, stopy oxidace a poškrábání. Dobře vidět a být viděn – jedno z hlavních pravidel v silničním provozu.',
    image: imgProduct9
  },
  {
    title: 'Leštění oken, zrcátek a nanášení tekutých stěračů',
    desc: 'Dobrý výhled z vozu je základní předpoklad bezpečné a spokojené jízdy. Aplikací „tekutých stěračů" nebudete muset v rychlostech nad 80 km/h běžné stěrače vůbec používat. Na skle se vytvoří ochranný nanopovlak s výbornými hydrofobními účinky.',
    image: imgProduct10
  }
]
</script>

<template>
  <div class="page-wrapper">
    <section class="page-hero">
      <div class="container">
        <div class="page-hero-label">Péče o vůz</div>
        <h1 class="page-hero-title">Exteriér</h1>
        <p class="page-hero-sub">Komplexní péče o lak, disky, světlomety a skla Vašeho vozu</p>
      </div>
    </section>

    <section class="page-section">
      <div class="container">
        <div class="services-list">
          <div v-for="(svc, i) in services" :key="i" class="svc-card">
            <div class="svc-number">{{ String(i + 1).padStart(2, '0') }}</div>
            <div class="svc-body">
              <h3>{{ svc.title }}</h3>
              <p>{{ svc.desc }}</p>
            </div>
            <div v-if="svc.image" class="svc-product">
              <img :src="svc.image" :alt="svc.title" loading="lazy" />
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="page-cta">
      <div class="container">
        <h2>Zajímá vás konkrétní služba?</h2>
        <p>Sestavíme Vám cenovou nabídku přímo na míru.</p>
        <div class="cta-btns">
          <RouterLink to="/#contact" class="btn btn-primary btn-lg">Poptat nezávazně</RouterLink>
          <RouterLink to="/cenik" class="btn btn-outline btn-lg">Zobrazit ceník</RouterLink>
        </div>
      </div>
    </section>
  </div>
</template>

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
.page-hero-sub { color: rgba(255,255,255,0.6); }

.page-section { padding: 5rem 0; background: var(--color-bg-light); }

.services-list {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.svc-card {
  background: white;
  border-radius: var(--radius-lg);
  padding: 2rem 2.5rem;
  display: flex;
  gap: 2rem;
  align-items: flex-start;
  box-shadow: var(--shadow-sm);
  transition: transform var(--transition-normal), box-shadow var(--transition-normal);
}
.svc-card:hover {
  transform: translateX(6px);
  box-shadow: var(--shadow-md);
}

.svc-number {
  font-family: var(--font-heading);
  font-size: 2.5rem;
  font-weight: 700;
  color: var(--color-accent);
  opacity: 0.3;
  line-height: 1;
  flex-shrink: 0;
  width: 4rem;
}

.svc-body h3 {
  font-family: var(--font-heading);
  font-size: 1.2rem;
  color: var(--color-primary);
  margin-bottom: 0.5rem;
}
.svc-body p {
  color: var(--color-text-light);
  line-height: 1.8;
  font-size: 0.95rem;
}

.svc-product {
  flex-shrink: 0;
  width: 225px;
  height: 225px;
  border-radius: var(--radius-md);
  overflow: hidden;
  background: var(--color-bg-light);
  display: flex;
  align-items: center;
  justify-content: center;
  align-self: center;
}

.svc-product img {
  width: 100%;
  height: 100%;
  object-fit: contain;
  padding: 0.25rem;
}

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
  background: radial-gradient(ellipse at center, rgba(201,168,76,.1) 0%, transparent 70%);
}
.page-cta .container { position: relative; }
.page-cta h2 { font-family: var(--font-heading); font-size: 2.5rem; color: white; margin-bottom: 1rem; }
.page-cta p { color: rgba(255,255,255,0.6); margin-bottom: 2rem; font-size: 1.1rem; }

.cta-btns { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }

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
.btn-outline { background: transparent; color: white; padding: 1rem 2.5rem; border: 2px solid rgba(255,255,255,0.4); }
.btn-outline:hover { border-color: var(--color-accent); color: var(--color-accent); transform: translateY(-2px); }
.btn-lg { font-size: 1rem; padding: 1.1rem 3rem; }

@media (max-width: 600px) {
  .svc-card { padding: 1.5rem; gap: 1rem; flex-wrap: wrap; }
  .svc-number { font-size: 1.5rem; width: 2.5rem; }
  .svc-product { width: 180px; height: 180px; }
}
</style>
