# VeVůni - Detailingové služby

Webová stránka pro detailingové služby VeVůni. Postaveno na Vue 3 + Vite s Node.js backendem pro kontaktní formulář.

## Technologie

- **Frontend:** Vue 3 (Composition API), Vue Router 4, Vite
- **Backend:** Node.js, Express, Nodemailer
- **Design:** Responzivní, mobilní-first, vlastní CSS

## Spuštění (vývoj)

```bash
npm install
npm run dev
```

## Produkční build + server

```bash
npm run build
npm run server
```

Nebo vše najednou:

```bash
npm start
```

## Konfigurace e-mailu

1. Zkopírujte `.env.example` na `.env`
2. Vyplňte SMTP údaje (pro Gmail použijte App Password)

```
SMTP_HOST=smtp.gmail.com
SMTP_PORT=587
SMTP_USER=vas-email@gmail.com
SMTP_PASS=vase-app-heslo
```

## Struktura projektu

```
ve-vuni/
├── public/              # Statické soubory
├── server/
│   └── index.js         # Express backend (kontaktní formulář)
├── src/
│   ├── assets/
│   │   ├── images/      # Fotografie detailingu
│   │   └── main.css     # Globální styly
│   ├── components/
│   │   ├── AppHeader.vue      # Navigace s hamburger menu
│   │   ├── AppFooter.vue      # Patička
│   │   ├── HeroSection.vue    # Úvodní sekce
│   │   ├── ServicesSection.vue # Přehled služeb
│   │   ├── GiftSection.vue    # Dárkové poukazy
│   │   ├── PortfolioSection.vue # Galerie před/po
│   │   └── ContactSection.vue  # Kontaktní formulář
│   ├── views/
│   │   └── HomeView.vue # Hlavní stránka
│   ├── router/
│   │   └── index.js     # Vue Router konfigurace
│   ├── App.vue          # Kořenová komponenta
│   └── main.js          # Vstupní bod aplikace
├── .env.example         # Šablona konfigurace
├── index.html           # HTML šablona
└── package.json
```
