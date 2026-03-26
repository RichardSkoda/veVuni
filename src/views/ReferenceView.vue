<script setup>
import { RouterLink } from 'vue-router'

const references = [
  {
    car: 'Volvo V90',
    service: 'Dočištění exteriéru, voskování, leštění oken + „tekuté stěrače"',
    quote: 'Děkuji, na jaře se zase ozvu.',
    author: 'David F.'
  },
  {
    car: 'Volvo XC60',
    service: 'Dočištění, voskování, vyživení nelakovaných plastů, „tekuté stěrače"',
    quote: 'Vypadá to skvěle a prokouklo to fest.',
    author: 'Dominik K.'
  },
  {
    car: 'Audi Q7',
    service: 'Ruční mytí, dekontaminace, voskování',
    quote: 'Děkuji za super službu a super přístup.',
    author: 'Tomáš R.'
  },
  {
    car: 'Škoda Felicia',
    service: 'Program Exteriér komplet',
    quote: 'Jako když vyjela z Mototechny. To jsem měl nechat udělat už dávno.',
    author: 'Milan T.'
  },
  {
    car: 'BMW 535i',
    service: 'Ruční mytí, dekontaminace, leštění a voskování + balíček Interiér komplet',
    quote: 'Děkuji, myslím, že spolupráce bude pokračovat, kolegové již obdivovali Vaší práci.',
    author: 'Vít M.'
  },
  {
    car: 'Škoda Octavia RS',
    service: 'Balíček Exteriér komplet + Interiér základ',
    quote: 'Díky, takhle jsem si výsledek představoval. Jsem spokojený.',
    author: 'Tomáš R.'
  },
  {
    car: 'Peugeot 407',
    service: 'Dekontaminace, leštění a ochrana laku + tepování a čištění interiéru',
    quote: 'Skvěle odvedená práce se zaměřením na detail. Perfektně umyté auto zvenku i zevnitř, provoněné, naleštěné. Myslím, že takto vyblýskané auto nebylo ani při koupi.',
    author: 'Jana M.'
  },
  {
    car: 'Škoda Fabia',
    service: 'Ruční čištění exteriéru a interiéru, voskování',
    quote: 'Perfektně odvedená práce. Vše bylo pečlivě umyté, jak uvnitř, tak zvenku. Auto krásně vonělo, bylo vyblýskané.',
    author: 'Hana J.'
  },
  {
    car: 'Škoda Superb',
    service: 'Ruční čištění exteriéru a interiéru, odstranění kontaminantů a mírných defektů laku',
    quote: '... ty jsi ďábel, takhle čisté bylo naposledy v autosalonu...',
    author: 'Tomáš K.'
  },
  {
    car: 'Toyota Auris',
    service: 'Balíčky Exteriér základ + Interiér základ',
    quote: 'Je to krása, teď to bude úplně jiná jízda.',
    author: 'Kamila M.'
  },
  {
    car: 'Rover 75',
    service: 'Balíček Interiér komplet',
    quote: 'Indeed, I am really satisfied with the service. The car is much more comfortable inside now. Also it\'s looking amazing compare to how it was before.',
    author: 'Salomon C.'
  },
  {
    car: 'Audi A3',
    service: 'Ruční mytí, dekontaminace laku, voskování',
    quote: 'Krásné, děkuji.',
    author: 'Jan S.'
  },
  {
    car: 'Mazda 5',
    service: 'Renovace světlometů',
    quote: 'Super, jako nové!',
    author: 'Richard Š.'
  }
]
</script>

<template>
  <div class="page-wrapper">
    <!-- Hero -->
    <section class="page-hero">
      <div class="container">
        <div class="page-hero-label">Spokojení zákazníci</div>
        <h1 class="page-hero-title">Reference</h1>
        <p class="page-hero-sub">{{ references.length }} realizovaných zakázek a stovky spokojených zákazníků</p>
      </div>
    </section>

    <!-- References grid -->
    <section class="page-section">
      <div class="container">
        <div class="ref-grid">
          <div v-for="(ref, i) in references" :key="i" class="ref-card">
            <div class="ref-car">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M5 17H3a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v9a2 2 0 01-2 2h-2"/>
                <circle cx="7.5" cy="17.5" r="2.5"/><circle cx="17.5" cy="17.5" r="2.5"/>
              </svg>
              {{ ref.car }}
            </div>
            <p class="ref-service">{{ ref.service }}</p>
            <blockquote class="ref-quote">„{{ ref.quote }}"</blockquote>
            <cite class="ref-author">— {{ ref.author }}</cite>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="page-cta">
      <div class="container">
        <h2>Buďte dalším spokojeným zákazníkem</h2>
        <p>Nezávazná poptávka zdarma – odpovíme do 24 hodin.</p>
        <RouterLink to="/#contact" class="btn btn-primary btn-lg">Poptat služby</RouterLink>
      </div>
    </section>
  </div>
</template>

<style scoped>
.page-wrapper {
  padding-top: var(--header-height);
}

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

.page-hero-sub {
  color: rgba(255, 255, 255, 0.6);
  font-size: 1rem;
}

.page-section {
  padding: 5rem 0;
  background: var(--color-bg-light);
}

/* References grid */
.ref-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
  gap: 1.5rem;
}

.ref-card {
  background: white;
  border-radius: var(--radius-lg);
  padding: 2rem;
  box-shadow: var(--shadow-sm);
  border-left: 4px solid var(--color-accent);
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
  transition: transform var(--transition-normal), box-shadow var(--transition-normal);
}

.ref-card:hover {
  transform: translateY(-4px);
  box-shadow: var(--shadow-md);
}

.ref-car {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-weight: 700;
  font-size: 1rem;
  color: var(--color-primary);
}

.ref-car svg {
  color: var(--color-accent);
  flex-shrink: 0;
}

.ref-service {
  font-size: 0.85rem;
  color: var(--color-text-light);
  line-height: 1.6;
  padding-bottom: 0.75rem;
  border-bottom: 1px solid var(--color-border);
}

.ref-quote {
  font-family: var(--font-heading);
  font-size: 1rem;
  color: var(--color-text);
  line-height: 1.7;
  font-style: italic;
  flex: 1;
}

.ref-author {
  font-style: normal;
  font-size: 0.8rem;
  font-weight: 600;
  color: var(--color-accent);
  text-transform: uppercase;
  letter-spacing: 1px;
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
</style>
