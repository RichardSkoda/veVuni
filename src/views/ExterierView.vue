<script setup>
import { RouterLink } from 'vue-router'

const services = [
  {
    title: 'Detailní čištění laku',
    desc: 'Před samotným procesem péče o lak je nutné jeho důkladné vyčištění. Kvalitní automatická či ruční myčka jsou dobrý začátek, nicméně hůře přístupná místa vozu je potřeba dočistit ručně. Nestihli jste svůj vůz před detailingem omýt? Nevadí, rád s Vaším vozem do myčky zajedu.',
    icon: 'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z'
  },
  {
    title: 'Dekontaminace laku – Clay',
    desc: 'Jakmile je lak na pohled čistý, je možné přistoupit k jeho dekontaminaci od nečistot, se kterými si běžná mycí technika neporadí (asfalt, rez, pryskyřice, hmyz…). K tomuto účelu se využívá tzv. Clay, který tyto nečistoty šetrně a přesto důkladně odstraňuje.',
    icon: 'M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18'
  },
  {
    title: 'Leštění laku – Compound',
    desc: 'Je lak vašeho vozu mírně až středně zašlý, obsahuje škrábance, oxidaci, hologramy a další poškození? Pak je ideální čas použít leštěnku s mikroabrazivním složením a velmi šetrně za pomocí strojní leštičky lak rozleštit. Směs leštících olejů lak navíc rozzáří a vyhladí.',
    icon: 'M5 3l14 9-14 9V3z'
  },
  {
    title: 'Leštění laku – Polish',
    desc: 'Je lak Vašeho vozu stále jako nový? Byste rádi laku dodali lesk, hloubku a sytost barev? Pak je skvělou volbou použití neabrazivní leštěnky se směsí leštících olejů. Neabrazivní leštěnku je možné použít i jako druhý krok po leštění compoundem.',
    icon: 'M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z'
  },
  {
    title: 'Voskování laku – syntetický vosk',
    desc: 'Voskování je posledním krokem v komplexní péči o lak. Špičkový vosk na bázi syntetických polymerů podpoří lesk a hloubku laku a především poskytne karoserii neviditelnou ochranu na několik měsíců. Vosk také výborně odpuzuje vodu – nečistoty na laku hůře ulpívají a čištění je snazší.',
    icon: 'M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z'
  },
  {
    title: 'Ošetření disků a pneumatik',
    desc: 'Kola dělají auto, říká se. Jejich čistota a správná ochrana je neméně důležitá jako u zbylých částí vozu. Speciální přípravek z kol důkladně očistí brzdový prach či silniční nečistoty a zanechá je dokonale čistá pro případné další ošetření.',
    icon: 'M12 12m-10 0a10 10 0 1 0 20 0a10 10 0 1 0-20 0'
  },
  {
    title: 'Odstranění lokálních defektů laku',
    desc: 'Pokud poškození laku zasahuje pouze do vrchní čiré vrstvy, je možné lokální škrábance a oděrky rozleštit speciálním přípravkem na lokální opravy. Opravy mírných poškození lze provádět lokálně, šetrně a bezpečně.',
    icon: 'M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z'
  },
  {
    title: 'Oživení a ochrana nelakovaných plastů',
    desc: 'Blatníky, difuzory, lemy oken a další exteriérové části bývají vyvedeny v nelakovaném černém plastu. Postupem času ztrácí barvu a šednou. Aplikací vhodného prostředku dílům vrátíme jejich původní vzhled a ochráníme je proti UV záření.',
    icon: 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'
  },
  {
    title: 'Renovace světlometů',
    desc: 'Vypadají Vaše světlomety spíše jako mlhomety? S použitím správného přípravku je možné zmírnit jejich zažloutnutí, stopy oxidace a poškrábání. Dobře vidět a být viděn – jedno z hlavních pravidel v silničním provozu.',
    icon: 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z'
  },
  {
    title: 'Leštění oken, zrcátek a nanášení tekutých stěračů',
    desc: 'Dobrý výhled z vozu je základní předpoklad bezpečné a spokojené jízdy. Aplikací „tekutých stěračů" nebudete muset v rychlostech nad 80 km/h běžné stěrače vůbec používat. Na skle se vytvoří ochranný nanopovlak s výbornými hydrofobními účinky.',
    icon: 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z'
  }
]
</script>

<template>
  <div class="page-wrapper">
    <section class="page-hero">
      <div class="container">
        <div class="page-hero-label">Péče o vůz</div>
        <h1 class="page-hero-title">Exteriér</h1>
        <p class="page-hero-sub">Komplexní péče o lak, disky, světlomety a skla vašeho vozu</p>
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
  .svc-card { padding: 1.5rem; gap: 1rem; }
  .svc-number { font-size: 1.5rem; width: 2.5rem; }
}
</style>
