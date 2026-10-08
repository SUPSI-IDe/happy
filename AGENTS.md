# AGENTS.md – HAPPY

> Il punto di ingresso per chiunque, persona o AI, debba lavorare su questo repository. Si legge per primo, poi si apre il file di `docs/` che riguarda il compito. Questo file è l'indice: i dettagli stanno in `docs/`.

## Cos'è

Il sito di **HAPPY – HeAlthy Playing Practices for Young musicians**, progetto di ricerca partecipativa della SUPSI con il Conservatorio della Svizzera italiana (SUM-CSI), finanziato dal FNS (programma Agora). Si rivolge a tre profili: insegnanti di musica, famiglie e professionisti della salute.

Il sito è costruito direttamente con **Kirby** (CMS in PHP, senza database) e va online su `happy.supsi.ch`. I partner possono gestire i video del Toolkit dal pannello; i contenuti seguono l'ontologia di `docs/ontology.md`.

## Regole d'oro (da non infrangere)

- **Accessibilità WCAG 2.1 AA non negoziabile:** mai rimuovere gli stati di focus, un solo `<h1>` per pagina, testo alternativo reale, sottotitoli su tutti i video.
- **Solo token:** colori, font e spaziature vengono sempre da `tokens.css`. Mai valori scritti a mano nei componenti.
- **Misure in rem**, mai in px, per rispettare lo zoom WCAG.
- **Testo corrente mai a tutta larghezza:** colonna massima 42.5rem (`--colonna-testo`).
- **Un solo divisore orizzontale per pagina**, sotto la navbar.
- **Video sempre 16:9**, su desktop e mobile.
- **Doodle solo vicino a illustrazioni o mascotte**, mai accanto al testo, e solo nei colori di sistema.
- **Testi nei file di contenuto**, mai scritti direttamente nei componenti.
- **Mobile-first:** ogni componente si scrive prima per mobile e si verifica su entrambi i formati.
- **Niente servizi esterni a runtime:** né font, né script, né tracciamento da altri siti. I form sono link a Microsoft Forms.

## Indice della documentazione

| Documento | Contenuto |
|---|---|
| `docs/architecture.md` | Stack, struttura delle cartelle, layout a colonne, componenti |
| `docs/kirby.md` | Lavorare in locale, pannello, ruoli, messa online |
| `docs/ontology.md` | Tipi di contenuto e relativi campi (diventano i blueprint di Kirby) |
| `docs/design-tokens.md` | Palette, tipografia, spaziature, regole visive, asset di Laura |
| `docs/workflow.md` | Metodo di sviluppo con AI, Git, verifiche |
| `docs/roadmap.md` | Fasi, timeline, next steps |

## Dove andare per…

| Compito | Partire da |
|---|---|
| Aggiungere o modificare un contenuto (testo, video, risorsa) | `docs/ontology.md` → `content/` e `site/blueprints/` |
| Cambiare un colore, un font o una spaziatura | `docs/design-tokens.md` → `assets/css/tokens.css` |
| Creare o modificare un componente | `docs/architecture.md` → `site/snippets/` e `assets/css/components.css` |
| Sostituire un placeholder con un asset di Laura | `docs/design-tokens.md` → `assets/` |
| Iniziare una sessione di lavoro con l'AI | `docs/workflow.md` |

## Verifica prima di ogni merge

```
npm run check     # regole del CSS, contrasti e pagine (un solo h1, lingua…); deve passare
composer dev      # avvia il sito su localhost:8000 per il controllo visivo su desktop e mobile
```

Poi un controllo di accessibilità con Lighthouse e axe sulle pagine modificate.
