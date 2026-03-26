<script setup>
import { RouterLink } from 'vue-router'

const services = [
  {
    title: 'Luxování interiéru',
    desc: 'Stejně jako exteriér, tak i interiér vozu je potřeba před začátkem detailingových prací řádně připravit. Důkladné luxování je činnost, kterou je potřeba začít. Samozřejmostí je luxování průduchů klimatizace i kufru.'
  },
  {
    title: 'Tepování koberců a čalouněných sedaček',
    desc: 'Jedná se o hloubkové čištění látkových i velurových prvků interiéru. Do textilie se pod tlakem nanáší speciální kapalina, která je z vlákna vzápětí odsávána. Takto je textil vyčištěný do hloubky a přesto v něm po dokončení prací zůstává jen nízká zbytková vlhkost. K tepování je používán tepovač Kärcher 5.100.'
  },
  {
    title: 'Čištění a impregnace interiérových plastů',
    desc: 'Měkčené i tvrdé plasty v interiéru je důležité nejen čistit, ale také chránit před UV zářením, aby postupně nesvětlaly a nedeformovaly se. Aplikací speciálního přípravku pro profesionální čištění interiéru v kombinaci s interiérovým detailerem Meguiar\'s řady Ultimate budou plasty ve Vašem vozu opět vypadat jako nové.'
  },
  {
    title: 'Čištění a impregnace kožených povrchů',
    desc: 'Je možné čistit kůži hladkou i perforovanou. Rozdíl čištění obou typů je jak v technice, tak i množství použité čistící kapaliny. Čištění perforované kůže zabere cca dvojnásobek času. Zásadní částí péče o kůži je její vyživení. K této proceduře je používán špičkový přírodní balzám, který kůži vyživuje, chrání a zanechává ji voňavou a příjemnou na dotek.'
  },
  {
    title: 'Provonění interiéru, desinfekce klimatizace',
    desc: 'Případné pachy ve voze je důležité nepřekrývat, ale likvidovat. Po detekci a odstranění zdroje zápachu je možné kontaminovaná místa ošetřit speciálním přípravkem, který pachy eliminuje a vytváří v interiéru dlouhotrvající vůni. Klimatizaci je možné rychle desinfikovat pomocí jednorázového prostředku Air Re-Fresher.'
  }
]
</script>

<template>
  <div class="page-wrapper">
    <section class="page-hero">
      <div class="container">
        <div class="page-hero-label">Péče o vůz</div>
        <h1 class="page-hero-title">Interiér</h1>
        <p class="page-hero-sub">Hloubkové čištění a ochrana interiéru vašeho vozu</p>
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

.services-list { display: flex; flex-direction: column; gap: 1rem; }

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
.svc-card:hover { transform: translateX(6px); box-shadow: var(--shadow-md); }

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

.svc-body h3 { font-family: var(--font-heading); font-size: 1.2rem; color: var(--color-primary); margin-bottom: 0.5rem; }
.svc-body p { color: var(--color-text-light); line-height: 1.8; font-size: 0.95rem; }

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
