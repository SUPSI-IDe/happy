# Architettura

## Stack

- **Kirby 5:** CMS in PHP, senza database. I contenuti sono file di testo in `content/`; i tipi di contenuto sono blueprint YAML in `site/blueprints/`; le pagine si costruiscono con template e snippet PHP. Dettagli, pannello e ruoli in `docs/kirby.md`.
- **CSS vanilla con custom properties:** nessun framework; tutti i valori grafici vengono dai design token.
- **JavaScript:** solo dove serve (il menu su mobile), sempre come miglioramento: senza, il sito funziona.
- **Video:** ospitati su una piattaforma esterna (da decidere, per esempio SWITCHtube o Vimeo) e incorporati nel sito.
- **Form:** link a Microsoft Forms.
- **Hosting:** SUPSI, `happy.supsi.ch` (da confermare: PHP 8.2 o più recente).

## Struttura delle cartelle

```
MAInD-HAPPY/
├── AGENTS.md              ← indice e regole d'oro
├── CLAUDE.md              ← rimanda ad AGENTS.md
├── docs/                  ← documentazione per argomento
├── index.php · composer.json  ← avvio di Kirby (la cartella kirby/ la scarica Composer)
├── assets/
│   ├── css/
│   │   ├── tokens.css     ← colori, font, spaziature (dalle variabili Figma)
│   │   ├── fonts.css      ← @font-face di Fraunces e Urbanist
│   │   ├── base.css       ← reset, tipografia, focus
│   │   ├── layout.css     ← griglia a colonne
│   │   └── components.css ← bottone, navbar, footer, pagina Contatti
│   ├── fonts/             ← Fraunces e Urbanist (woff2) e licenze
│   └── js/                ← menu su mobile
├── site/
│   ├── blueprints/        ← un file per tipo di contenuto (vedi ontology.md) e per ruolo
│   ├── templates/         ← una pagina intera; se manca vale default.php
│   ├── snippets/          ← layout, navbar, footer, bottone
│   └── config/
├── content/               ← una cartella per pagina: home, risorse, ricerca, team, contatti,
│                            toolkit (con i video), insegnanti · famiglie · professionisti
└── scripts/               ← controlli automatici (npm run check)
```

## Layout a colonne

- Griglia CSS Grid: **4 colonne su mobile, 12 su desktop**.
- Ogni sezione è una fascia a tutta larghezza (`.sezione`) con un container interno (`.contenitore`) e, dove serve, una `.griglia`. Margini e gutter sono in `tokens.css`, vedi `docs/design-tokens.md`.
- Le sezioni a colonne della home si impilano in verticale sotto il breakpoint.
- Testo corrente con larghezza massima di circa 36rem.

## Struttura di ogni pagina

Lo snippet `layout` mette in ogni pagina: il link "Vai al contenuto" (per la tastiera), la `Navbar` e `<main id="contenuto">` con il contenuto della pagina (un solo `h1`). Poi il `Footer`. I template lo usano con `snippet('layout', slots: true)` e scrivono solo il contenuto.

## Componenti

| Componente (snippet) | Uso |
|---|---|
| `Navbar` | Logo, voci (le pagine pubblicate di primo livello) e la linea sotto (unico divisore della pagina). Su mobile le voci stanno dietro un pulsante menu; senza JavaScript restano visibili. La pagina corrente ha `aria-current` e una sottolineatura provvisoria, da sostituire con il disegno a mano |
| `Footer` | Piè di pagina uguale in tutte le pagine, su fondo verde salvia con testo bianco: nome del progetto, chi c'è dietro, loghi (facoltativi), link (privacy, accessibilità) e copyright. Tutto modificabile dal pannello (Sito → Piè di pagina) |
| `Hero` | Titolo e spazio configurabile per illustrazione e video |
| `Section` | Fascia di pagina con colonne |
| `Card` | Card dei profili, con varianti di forma "fatte a mano" |
| `Button` (`bottone`) | Bottone o link con l'aspetto di un bottone. Varianti `pieno` e `contorno`; con `href` è un link |
| `VideoEmbed` | Video 16:9 con sottotitoli |
| `VideoGrid` | Elenco filtrabile dei video del Toolkit |
| `PhaseSlider` | Slider delle fasi; i pallini si riempiono da attivi senza cambiare dimensione |
