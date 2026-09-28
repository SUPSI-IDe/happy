# AGENTS.md – HAPPY

> Il punto di ingresso per chiunque, persona o AI, debba lavorare su questo repository. Si legge per primo, poi si apre il file di `docs/` che riguarda il compito. Questo file è l'indice: i dettagli stanno in `docs/`.

## Cos'è

Il sito di **HAPPY – HeAlthy Playing Practices for Young musicians**, progetto di ricerca partecipativa della SUPSI con il Conservatorio della Svizzera italiana (SUM-CSI), finanziato dal FNS (programma Agora). Si rivolge a tre profili: insegnanti di musica, famiglie e professionisti della salute.

Il sito è **100% statico**: è costruito con Astro e generato come file HTML/CSS. In una seconda fase si costruirà il CMS con **Kirby** partendo dall'ontologia definita qui.

## Regole d'oro (da non infrangere)

- **Accessibilità WCAG 2.1 AA non negoziabile:** mai rimuovere gli stati di focus, un solo `<h1>` per pagina, testo alternativo reale, sottotitoli su tutti i video.
- **Solo token:** colori, font e spaziature vengono sempre da `tokens.css`. Mai valori scritti a mano nei componenti.
- **Misure in rem**, mai in px, per rispettare lo zoom WCAG.
- **Testo corrente mai a tutta larghezza:** colonna massima circa 36rem.
- **Un solo divisore orizzontale per pagina**, sotto la navbar.
- **Video sempre 16:9**, su desktop e mobile.
- **Doodle solo vicino a illustrazioni o mascotte**, mai accanto al testo, e solo nei colori di sistema.
- **Testi nei file di contenuto**, mai scritti direttamente nei componenti.
- **Mobile-first:** ogni componente si scrive prima per mobile e si verifica su entrambi i formati.
- **Nessun server a runtime:** niente codice che presuppone un backend. I form sono link a Microsoft Forms.

## Indice della documentazione

| Documento | Contenuto |
|---|---|
| `docs/architecture.md` | Stack, struttura delle cartelle, layout a colonne, componenti |
| `docs/ontology.md` | Tipi di contenuto e relativi campi, base comune per il sito statico e per Kirby |
| `docs/design-tokens.md` | Palette, tipografia, spaziature, regole visive, asset di Laura |
| `docs/workflow.md` | Metodo di sviluppo con AI, Git, verifiche |
| `docs/roadmap.md` | Fasi, timeline, next steps |

## Dove andare per…

| Compito | Partire da |
|---|---|
| Aggiungere o modificare un contenuto (testo, video, risorsa) | `docs/ontology.md` → `src/content/` |
| Cambiare un colore, un font o una spaziatura | `docs/design-tokens.md` → `src/styles/tokens.css` |
| Creare o modificare un componente | `docs/architecture.md` → `src/components/` |
| Sostituire un placeholder con un asset di Laura | `docs/design-tokens.md` → `public/assets/` |
| Iniziare una sessione di lavoro con l'AI | `docs/workflow.md` |

## Verifica prima di ogni merge

```
npm run build     # genera il sito statico; deve completarsi senza errori
npm run preview   # controllo visivo su desktop e mobile
```

Poi un controllo di accessibilità con Lighthouse e axe sulle pagine modificate.
