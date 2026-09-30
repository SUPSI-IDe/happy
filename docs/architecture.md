# Architettura

## Stack

- **Astro:** costruisce il sito a componenti e lo genera come HTML statico. I componenti corrispondono agli *snippet* di Kirby, le collezioni di contenuti ai *blueprint*.
- **CSS vanilla con custom properties:** nessun framework; tutti i valori grafici vengono dai design token.
- **Video:** ospitati su una piattaforma esterna (da decidere, per esempio SWITCHtube o Vimeo) e incorporati nel sito.
- **Form:** link a Microsoft Forms.

## Struttura delle cartelle

```
MAInD-HAPPY/
├── AGENTS.md              ← indice e regole d'oro
├── CLAUDE.md              ← rimanda ad AGENTS.md
├── docs/                  ← documentazione per argomento
├── src/
│   ├── styles/
│   │   ├── tokens.css     ← colori, font, spaziature (dalle variabili Figma)
│   │   ├── fonts.css      ← @font-face di Fraunces e Urbanist (file in public/fonts)
│   │   ├── base.css       ← reset, tipografia, focus
│   │   └── layout.css     ← griglia a colonne
│   ├── components/
│   ├── layouts/Base.astro ← struttura comune a tutte le pagine
│   ├── content/           ← una cartella per tipo di contenuto (vedi ontology.md)
│   └── pages/
│       ├── index
│       ├── insegnanti · famiglie · professionisti
│       ├── toolkit        ← archivio video con filtri + pagina singolo video
│       └── risorse · ricerca · team · contatti
└── public/assets/         ← SVG di Laura (placeholder finché non arrivano)
```

## Layout a colonne

- Griglia CSS Grid: **4 colonne su mobile, 12 su desktop**.
- Ogni sezione è una fascia a tutta larghezza con un container interno.
- Le sezioni a colonne della home si impilano in verticale sotto il breakpoint.
- Testo corrente con larghezza massima di circa 36rem.

## Componenti

| Componente | Uso |
|---|---|
| `Navbar` | Risorse, La Ricerca, Il team, Contatti; sottolineature disegnate a mano |
| `Hero` | Titolo e spazio configurabile per illustrazione e video |
| `Section` | Fascia di pagina con colonne |
| `Card` | Card dei profili, con varianti di forma "fatte a mano" |
| `Button` | Stili definiti nel foglio bottoni di Figma (CTA, link sezioni, link pagine, link esterni) |
| `VideoEmbed` | Video 16:9 con sottotitoli |
| `VideoGrid` | Elenco filtrabile dei video del Toolkit |
| `PhaseSlider` | Slider delle fasi; i pallini si riempiono da attivi senza cambiare dimensione |
| `Footer` | Partner, contatti |
