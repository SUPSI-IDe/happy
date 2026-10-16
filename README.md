# HAPPY – HeAlthy Playing Practices for Young musicians

Il sito di **HAPPY**, progetto di ricerca partecipativa della SUPSI con il Conservatorio della Svizzera italiana (SUM-CSI), finanziato dal Fondo nazionale svizzero (FNS, programma Agora). Il progetto si occupa della salute muscoloscheletrica dei giovani musicisti e si rivolge a tre profili: insegnanti di musica, famiglie e professionisti della salute.

Il sito è online su [happy.supsi.ch](https://happy.supsi.ch).

## Com'è fatto

Il sito è costruito con [Kirby](https://getkirby.com), un CMS in PHP senza database: i contenuti sono file di testo nella cartella `content/`. È un one-pager: la home contiene tutte le sezioni, a parte ci sono solo le pagine dei tre profili.

Chi lavora sul progetto, persona o AI, parte da [`AGENTS.md`](AGENTS.md): contiene le regole d'oro (accessibilità WCAG 2.1 AA, solo token, mobile-first…) e l'indice della documentazione in [`docs/`](docs/).

## Avviarlo in locale

Serve PHP 8.2 o più recente e Composer (sul Mac: `brew install php composer`).

```bash
composer install   # scarica Kirby (kirby/ e vendor/ non sono nel repository)
composer dev       # avvia il sito su http://localhost:8000
```

Il pannello è su `http://localhost:8000/panel`: la prima volta chiede di creare un account amministratore, che vale solo sul tuo computer.

## Verifiche

Prima di ogni merge in `main`:

```bash
npm run check      # regole del CSS, contrasti e struttura delle pagine
```

Poi un controllo visivo su desktop e mobile e un controllo di accessibilità con Lighthouse e axe. Il metodo di lavoro è descritto in [`docs/workflow.md`](docs/workflow.md), la messa online in [`docs/kirby.md`](docs/kirby.md).

## Licenza e diritti

Il **codice** del sito è rilasciato con licenza [MIT](LICENSE).

Sono **esclusi dalla licenza MIT** e restano dei rispettivi autori:

- le illustrazioni, la mascotte, i personaggi, le decorazioni e i video di **Laura Bassi**, in `assets/images/` e `content/`;
- i **loghi** dei partner e dei finanziatori (`content/logo-*.png`), che appartengono ai rispettivi enti;
- i **testi** dei contenuti in `content/`, del progetto HAPPY.

Per riutilizzarli serve l'autorizzazione degli autori. Il core di Kirby non è in questo repository e ha una sua [licenza](https://getkirby.com/license).
