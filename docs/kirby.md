# Kirby: sito e pannello

Il sito è costruito direttamente con **Kirby** (CMS in PHP, senza database: i contenuti sono file di testo in `content/`). Va online su `happy.supsi.ch`. Non c'è un passaggio intermedio: i template, gli snippet e i blueprint di questo repository sono quelli del sito vero.

## Lavorare in locale

Serve una volta sola (sul Mac): Homebrew, poi PHP e Composer.

```bash
brew install php composer
composer install        # scarica Kirby (cartelle kirby/ e vendor/, non sono nel repository)
composer dev            # avvia il sito su http://localhost:8000
```

La prima volta apri `http://localhost:8000/panel`: Kirby chiede di creare l'account amministratore. L'account vale solo sul tuo computer (`site/accounts/` non va su Git).

Per fermare il sito: `Ctrl+C` nel Terminale.

## Dove sta cosa

| Cosa | Dove |
|---|---|
| Stile (token, base, layout, componenti, font) | `assets/css/`, `assets/fonts/` |
| Script (menu su mobile) | `assets/js/` |
| Struttura comune delle pagine | `site/snippets/layout.php` |
| Componenti | `site/snippets/` (`navbar`, `footer`, `bottone`) |
| Template delle pagine | `site/templates/` (se un template manca vale `default.php`) |
| Campi e pannello di ogni tipo di contenuto | `site/blueprints/` (vedi `docs/ontology.md`) |
| Contenuti | `content/` (una cartella per pagina; il prefisso `1_` è l'ordine nel menu) |
| Impostazioni | `site/config/config.php` |

## Contenuti e pannello

- **Menu:** le voci di navigazione sono le pagine di primo livello *pubblicate* (cartelle con prefisso numerico). Nome e ordine si cambiano dal pannello.
- **Piè di pagina:** testi, loghi e link si modificano in Sito → Piè di pagina. Un link senza indirizzo resta semplice testo.
- **Contatti:** email di contatto e partner ("In collaborazione con") si modificano nella pagina Contatti.
- **Video del Toolkit:** sono pagine figlie di `toolkit`, con il blueprint `video` (strumento, parte del corpo, profilo, durata, link, trascrizione).

## Ruoli

| Ruolo | Cosa può fare |
|---|---|
| **Amministratore** | Tutto |
| **Partner** | Aggiungere, modificare ed eliminare i video del Toolkit. Non può modificare le altre pagine, gli utenti e le impostazioni |

Come funziona: ogni blueprint, tranne `video` e `toolkit`, estende `pages/solo-admin`, che toglie al partner i permessi sulla pagina. Un nuovo tipo di pagina va quindi creato con `extends: pages/solo-admin`, altrimenti i partner potrebbero modificarla.

## Cosa non va su Git

`kirby/` e `vendor/` (li scarica Composer), `media/` (miniature generate), `site/accounts/` (utenti e password), `site/cache/`, `site/logs/`, `site/sessions/`, `site/config/.license` (licenza). Sono tutti in `.gitignore`.

## Messa online (da definire con SUPSI)

Servono: PHP 8.2 o più recente, la licenza Kirby registrata per `happy.supsi.ch`, e un modo per caricare i file (SSH, FTP o Git). Online vanno anche `kirby/` e `vendor/`, quindi si caricano dopo `composer install --no-dev`. Da chiarire con SUPSI: chi crea gli account dei partner, chi fa backup e aggiornamenti di sicurezza.

## Controlli

`npm run check` esegue i controlli del CSS, dei contrasti e delle pagine (`scripts/`); serve PHP. Sulla pull request la CI controlla anche `composer.json` e la sintassi dei file PHP.
