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
| Componenti | `site/snippets/` (`navbar`, `hero`, `sezione`, `footer`, `bottone`); le sezioni della home in `site/snippets/sezioni/` |
| Template delle pagine | `site/templates/` (se un template manca vale `default.php`) |
| Campi e pannello di ogni tipo di contenuto | `site/blueprints/pages/` (vedi `docs/ontology.md`); i campi usati in più tipi in `site/blueprints/fields/` |
| Contenuti | `content/` (una cartella per pagina; le sezioni sono in `content/home/`, il prefisso `1_` è l'ordine) |
| Impostazioni | `site/config/config.php` |

## Contenuti e pannello

- **Sezioni della home:** sono le pagine figlie della home. Si riordinano trascinandole, si nascondono rimettendole in bozza.
- **Menu:** le voci sono le sezioni pubblicate con una "Voce di menu"; senza, la sezione non va nel menu. L'ordine è quello delle sezioni.
- **Dati comuni:** nome esteso del progetto e bottone "Partecipa al progetto" (testo e link al modulo) in Sito → Generale.
- **Piè di pagina:** etichette, testo del contributo, loghi (titolari, finanziatore, partner) e link si modificano in Sito → Piè di pagina. Ogni logo, aperto, ha il nome dell'ente (testo alternativo, obbligatorio), il link al suo sito e la larghezza su desktop in px: su mobile si riduce da sola. Un link senza indirizzo resta semplice testo.

## Ruoli

C'è un solo ruolo, **Amministratore**, che può fare tutto. Il ruolo Partner (per i video del Toolkit) tornerà con il Toolkit, dopo il rilascio.

## Cosa non va su Git

`kirby/` e `vendor/` (li scarica Composer), `media/` (miniature generate), `site/accounts/` (utenti e password), `site/cache/`, `site/logs/`, `site/sessions/`, `site/config/.license` (licenza). Sono tutti in `.gitignore`.

## Messa online

Il sito si carica con FileZilla in SFTP su `web1.supsi.ch`, con l'account SUPSI. La cartella del sito sul server è `/supsi_happy/docs`.

**Cosa caricare:** `assets/`, `content/`, `kirby/`, `site/` e `index.php` (il `.htaccess` è già sul server, creato con Luca). `vendor/` non serve: `index.php` carica Kirby direttamente da `kirby/`. Nient'altro: `docs/`, `scripts/`, `node_modules/`, i file di configurazione (`composer.json`, `package.json`, `AGENTS.md`…) e simili non servono al sito e potrebbero essere leggibili da chiunque. Il `content/` del server non si sovrascrive mai, perché contiene le modifiche fatte dal pannello online.

**Permessi:** sul server PHP gira con un utente diverso da quello SFTP, quindi le cartelle in cui Kirby scrive vanno messe a `777`. In FileZilla: tasto destro → *File permissions…* → `777`, *Recurse into subdirectories*, *Apply to all files and directories*. Le cartelle sono `content/`, `media/`, `site/accounts/`, `site/sessions/` e `site/cache/` (se mancano, si creano vuote). Errori come «The media directory could not be created» o «… is not writable» vogliono dire che una di queste manca o non ha i permessi.

**Account amministratore:** online il pannello non si installa (Kirby blocca l'installazione sui server pubblici). Si carica invece la cartella dell'account creata in locale, da `site/accounts/` a `/supsi_happy/docs/site/accounts/`, e poi si rimette `777` su `site/accounts/`. La password è quella del pannello in locale.

**Password dimenticata:** la password è salvata solo come hash in `site/accounts/<id>/.htpasswd`. Per verificarla in locale, senza limiti di tentativi (il pannello blocca l'accesso per un'ora dopo 10 tentativi sbagliati):

```bash
php -r '$p = readline("Password: "); echo password_verify($p, trim(file_get_contents("site/accounts/<id>/.htpasswd"))) ? "OK\n" : "NO\n";'
```

Per impostarne una nuova, si genera un nuovo `.htpasswd` e lo si carica nella stessa cartella sul server (sovrascrivendo). FileZilla nasconde i file che iniziano col punto: *Server → Force showing hidden files*.

```bash
php -r '$p = readline("Nuova password: "); file_put_contents("site/accounts/<id>/.htpasswd", password_hash($p, PASSWORD_DEFAULT));'
```

Ancora da chiarire con SUPSI: la licenza Kirby per `happy.supsi.ch`, chi fa backup e aggiornamenti di sicurezza.

## Controlli

`npm run check` esegue i controlli del CSS, dei contrasti e delle pagine (`scripts/`); serve PHP. Sulla pull request la CI controlla anche `composer.json` e la sintassi dei file PHP.
