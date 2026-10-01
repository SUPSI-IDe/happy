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
- Ogni sezione è una fascia a tutta larghezza (`.sezione`) con un container interno (`.contenitore`) e, dove serve, una `.griglia`. Margini e gutter sono in `tokens.css`, vedi `docs/design-tokens.md`.
- Le sezioni a colonne della home si impilano in verticale sotto il breakpoint.
- Testo corrente con larghezza massima di circa 36rem.

## Struttura di ogni pagina

`layouts/Base.astro` mette in ogni pagina: il link "Vai al contenuto" (per la tastiera), la `Navbar`, `<main id="contenuto">` con il contenuto della pagina (un solo `h1`) e il `Footer`. Le pagine passano solo il titolo e il contenuto.

## Componenti

| Componente | Uso |
|---|---|
| `Navbar` | Logo, Risorse, La Ricerca, Il team, Contatti e la linea sotto (unico divisore della pagina). Su mobile le voci stanno dietro un pulsante menu; senza JavaScript restano visibili. La pagina corrente ha `aria-current` e una sottolineatura provvisoria, da sostituire con il disegno a mano |
| `Hero` | Titolo e spazio configurabile per illustrazione e video |
| `Section` | Fascia di pagina con colonne |
| `Card` | Card dei profili, con varianti di forma "fatte a mano" |
| `Button` | Bottone o link con l'aspetto di un bottone. Varianti `pieno` e `contorno`; con `href` è un link |
| `VideoEmbed` | Video 16:9 con sottotitoli |
| `VideoGrid` | Elenco filtrabile dei video del Toolkit |
| `PhaseSlider` | Slider delle fasi; i pallini si riempiono da attivi senza cambiare dimensione |
| `Footer` | Partner (collezione `src/content/partner`) e contatto email |
