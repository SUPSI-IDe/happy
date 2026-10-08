# Architettura

## Stack

- **Kirby 5:** CMS in PHP, senza database. I contenuti sono file di testo in `content/`; i tipi di contenuto sono blueprint YAML in `site/blueprints/`; le pagine si costruiscono con template e snippet PHP. Dettagli, pannello e ruoli in `docs/kirby.md`.
- **CSS vanilla con custom properties:** nessun framework; tutti i valori grafici vengono dai design token.
- **JavaScript:** solo dove serve (il menu su mobile), sempre come miglioramento: senza, il sito funziona.
- **Video:** ospitati su una piattaforma esterna (da decidere, per esempio SWITCHtube o Vimeo) e incorporati nel sito.
- **Form:** link a moduli esterni (Qualtrics della SUPSI); il link del bottone "Partecipa" sta in Sito → Generale.
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
│   │   └── components.css ← bottone, navbar, footer
│   ├── fonts/             ← Fraunces e Urbanist (woff2) e licenze
│   ├── images/            ← logo "Happy" in SVG (per l'h1 della home)
│   └── js/                ← menu su mobile
├── site/
│   ├── blueprints/        ← pages/ un file per tipo di contenuto (vedi ontology.md),
│   │                        fields/ campi riusati in più tipi, users/ i ruoli
│   ├── templates/         ← una pagina intera: home, e default.php per le altre
│   ├── snippets/          ← layout, navbar, hero, footer, bottone, sezione (struttura comune);
│   │                        sezioni/ uno per tipo di sezione
│   └── config/            ← impostazioni e redirect delle sezioni
├── content/               ← home/ con una cartella per sezione (1_perche, 2_a-chi…),
│                            insegnanti · famiglie · professionisti
└── scripts/               ← controlli automatici (npm run check)
```

## Layout a colonne

- Griglia CSS Grid: **4 colonne su mobile, 12 su desktop**.
- Ogni sezione è una fascia a tutta larghezza (`.sezione`) con un container interno (`.contenitore`) e, dove serve, una `.griglia`. Margini e gutter sono in `tokens.css`, vedi `docs/design-tokens.md`.
- Le sezioni a colonne della home si impilano in verticale sotto il breakpoint.
- Testo corrente con larghezza massima di 42.5rem (`--colonna-testo`, le colonne 7–12 del desktop).

## Il one-pager

La home è l'unica pagina lunga: il template `home` disegna la hero (l'unico `h1`) e poi, una sotto l'altra, le sezioni pubblicate, cioè le pagine figlie della home (vedi `docs/ontology.md`). Ogni sezione si disegna con lo snippet del suo tipo, `sezioni/<tipo>.php`; finché non esiste vale `sezioni/sezione.php`.

Gli snippet dei tipi non ripetono la struttura: usano lo snippet `sezione`, che crea il `<section>` (con `id` uguale al nome della cartella, l'ancora del menu), il titolo `h2` con il segno a pennello nelle colonne 1–5 e il contenuto nelle colonne 7–12. Il tipo fornisce solo il contenuto (slot predefinito) e, se serve, qualcosa sotto il titolo (slot `laterale`).

Le sezioni non hanno un indirizzo proprio: una regola in `site/config/config.php` manda `/home/ricerca` a `/#ricerca`, così anche l'anteprima del pannello porta al punto giusto.

## Struttura di ogni pagina

Lo snippet `layout` mette in ogni pagina: il link "Vai al contenuto" (per la tastiera), la `Navbar` e `<main id="contenuto">` con il contenuto della pagina (un solo `h1`). Poi il `Footer`. I template lo usano con `snippet('layout', slots: true)` e scrivono solo il contenuto.

## Componenti

| Componente (snippet) | Uso |
|---|---|
| `Navbar` | Logo, voci (la presentazione e le sezioni della home con una voce di menu, come link alle ancore) e la linea sotto (unico divisore della pagina). Su mobile le voci stanno dietro un pulsante menu (due linee che diventano una X), che apre un menu a tutto schermo con il bottone "Partecipa"; si chiude scegliendo una voce o con Esc, e intanto il resto della pagina non si raggiunge. Senza JavaScript le voci restano visibili |
| `Footer` | Piè di pagina uguale in tutte le pagine, su fondo verde salvia con testo bianco: nome del progetto, chi c'è dietro, loghi (facoltativi), link (privacy, accessibilità) e copyright. Tutto modificabile dal pannello (Sito → Piè di pagina) |
| `Hero` | Logo SVG (l'`h1`), nome esteso, mascotte, video e presentazione "Cos'è Happy?" |
| `Section` (`sezione`) | Struttura comune delle sezioni della home: titolo con segno a pennello nelle colonne 1–5 (fermo mentre si scorre), contenuto nelle 7–12, allineati sulla linea di base; su mobile in colonna |
| `Card` | Card dei profili, con varianti di forma "fatte a mano" |
| `Button` (`bottone`) | Bottone o link con l'aspetto di un bottone. Varianti `pieno` e `contorno`; con `href` è un link |
| `VideoEmbed` | Video 16:9 con sottotitoli |
| `PhaseSlider` | Slider delle fasi; i pallini si riempiono da attivi senza cambiare dimensione |
