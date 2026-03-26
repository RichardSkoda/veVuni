<script setup>
import { ref, onMounted } from 'vue'
import { RouterLink } from 'vue-router'
</script>

<template>
  <div class="page-wrapper">
    <!-- Hero -->
    <section class="page-hero">
      <div class="container">
        <div class="page-hero-label">O nás</div>
        <h1 class="page-hero-title">Kompletní péče o exteriér<br>a interiér Vašeho vozu</h1>
        <p class="page-hero-sub">Ing. Michal Tauchman – certifikovaný detailer Meguiar's</p>
      </div>
    </section>

    <!-- Jak to začalo -->
    <section class="page-section">
      <div class="container">
        <div class="story-grid">
          <div class="story-content">
            <span class="section-eyebrow">Příběh</span>
            <h2>Jak to začalo</h2>
            <p>
              Jako většina dobrých podnikatelských nápadů vše vzešlo z mé vlastní potřeby pravidelně ošetřovat
              dva vozy naší rodiny. Postupně jsem testoval různé přípravky i techniky jejich nanášení, sledoval
              instruktážní videa zabývající se touto problematikou a dokupoval nutné vybavení.
            </p>
            <p>
              Když už jsem si byl v postupech dostatečně jistý, nabídl jsem detailingové služby svým kamarádům
              a širší rodině. V roce 2019 jsem absolvoval certifikované detailingové školení společnosti Meguiar's
              a spustil svůj projekt <strong>„VeVůni"</strong>, kde nabízím kompletní služby detailingové péče o vůz i Vám.
            </p>
          </div>
          <div class="story-quote">
            <blockquote>
              „Vzhled Vašeho vozu je Vaší vizitkou."
              <cite>Ing. Michal Tauchman</cite>
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
            <h3>Spolehlivě a rychle</h3>
            <p>
              Cílem je poskytnout Vám důkladnou péči o Váš vůz, aniž byste museli být omezeni odložením vozu
              na několik dní do detailingového studia. Všechny nabízené úkony je možné stihnout vždy v jednom dni.
              Práce menšího rozsahu je možné plánovat na odpoledne nebo večer po Vašem příchodu z práce.
            </p>
          </div>
          <div class="feature-card">
            <div class="feature-icon">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
              </svg>
            </div>
            <h3>U Vás doma</h3>
            <p>
              Vůz je možné vyzvednout u Vás doma a po dokončení prací Vám ho opět domů dovézt. Nemusíte nikam
              jezdit, nic organizovat. Kvalitním ošetřením vozu si uděláte nejen radost, ale také prodloužíte
              životnost ošetřených částí a zvýšíte zůstatkovou hodnotu vozu.
            </p>
          </div>
          <div class="feature-card">
            <div class="feature-icon">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <rect x="3" y="8" width="18" height="13" rx="2"/><path d="M8 8V6a4 4 0 018 0v2"/>
                <path d="M12 13v3"/><circle cx="12" cy="13" r="1"/>
              </svg>
            </div>
            <h3>Praktický dárek</h3>
            <p>
              Pokud budete chtít věnovat detailingové služby jako dárek — k narozeninám, výročí nebo jen tak
              pro radost — vystavím Vám dárkový certifikát na konkrétní službu, případně celkovou hodnotu.
              Dárek, který opravdu potěší.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Meguiars -->
    <section class="page-section">
      <div class="container">
        <div class="training-box">
          <div class="training-text">
            <span class="section-eyebrow">Certifikace</span>
            <h2>Je skvělé mít možnost učit se od těch nejlepších</h2>
            <p>
              V roce 2019 jsem absolvoval <strong>certifikované detailingové školení Meguiar's Individual Detailing Class</strong>.
              K péči o exteriér i interiér vozů je používána výhradně americká prémiová kosmetika Meguiar's řady Ultimate —
              ověřené produkty, které jsou standardem mezi profesionálními detailery po celém světě.
            </p>
          </div>
          <div class="training-badge">
            <div class="badge-inner">
              <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <circle cx="12" cy="8" r="6"/><path d="M9 11l3 3 3-3M12 21V14"/>
                <path d="M7 21h10"/>
              </svg>
              <strong>Meguiar's</strong>
              <span>Certified Detailer</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="page-cta">
      <div class="container">
        <h2>Připraveni svěřit nám Váš vůz?</h2>
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

.badge-inner {
  width: 160px;
  height: 160px;
  border-radius: 50%;
  background: var(--color-primary);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 0.25rem;
  color: var(--color-accent);
  text-align: center;
}

.badge-inner strong {
  font-size: 0.9rem;
  font-weight: 700;
  letter-spacing: 1px;
}

.badge-inner span {
  font-size: 0.7rem;
  color: rgba(255, 255, 255, 0.6);
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
    display: none;
  }
}
</style>
