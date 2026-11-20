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

## Campi vuoti

Ogni campo del pannello può essere vuoto (un'etichetta cancellata, un'immagine senza testo alternativo, un campo nuovo che il `content/` del server non ha ancora). Negli snippet un campo si stampa con il suo metodo `->esc()` (`$site->nome_esteso()->esc()`, `$file->alt()->esc('attr')`), che con un campo vuoto restituisce testo vuoto. Mai `esc($campo->value())`: con un campo vuoto `value()` è `null` e la pagina si blocca con un errore.

## Ruoli

C'è un solo ruolo, **Amministratore**, che può fare tutto. Il ruolo Partner (per i video del Toolkit) tornerà con il Toolkit, dopo il rilascio.

## Cosa non va su Git

`kirby/` e `vendor/` (li scarica Composer), `media/` (miniature generate), `site/accounts/` (utenti e password), `site/cache/`, `site/logs/`, `site/sessions/`, `site/config/.license` (licenza). Sono tutti in `.gitignore`.

## Messa online

Il sito si carica con FileZilla in SFTP su `web1.supsi.ch`, con l'account SUPSI. La cartella del sito sul server è `/supsi_happy/docs`.

**Cosa caricare:** `assets/`, `content/` (solo la prima volta, o per una pagina nuova: vedi sotto), `kirby/`, `site/` e `index.php` (il `.htaccess` è già sul server, creato con Luca). `vendor/` non serve: `index.php` carica Kirby direttamente da `kirby/`. Nient'altro: `docs/`, `scripts/`, `node_modules/`, i file di configurazione (`composer.json`, `package.json`, `AGENTS.md`…) e simili non servono al sito e potrebbero essere leggibili da chiunque. Il `content/` del server non si sovrascrive mai, perché contiene le modifiche fatte dal pannello online.

**Permessi:** sul server PHP gira con un utente diverso da quello SFTP, quindi le cartelle in cui Kirby scrive vanno messe a `777`. In FileZilla: tasto destro → *File permissions…* → `777`, *Recurse into subdirectories*, *Apply to all files and directories*. Le cartelle sono `content/`, `media/`, `site/accounts/`, `site/sessions/` e `site/cache/` (se mancano, si creano vuote).

Attenzione: le cartelle create da PHP risultano di proprietà di `nobody` (permessi `dr-xrwsr-x`) e l'utente SFTP **non può cambiarne i permessi**: FileZilla accetta il `777` ma non succede nulla. In quel caso la cartella va **rinominata (`nome_old`) e ricreata** da FileZilla (così diventa dell'utente SFTP) e poi messa a `777`. Vedi «Se qualcosa si rompe online».

**Account amministratore:** online il pannello non si installa (Kirby blocca l'installazione sui server pubblici). Si carica invece la cartella dell'account creata in locale, da `site/accounts/` a `/supsi_happy/docs/site/accounts/`, e poi si rimette `777` su `site/accounts/`. La password è quella del pannello in locale.

**Password dimenticata:** la password è salvata solo come hash in `site/accounts/<id>/.htpasswd`. Per verificarla in locale, senza limiti di tentativi (il pannello blocca l'accesso per un'ora dopo 10 tentativi sbagliati):

```bash
php -r '$p = readline("Password: "); echo password_verify($p, trim(file_get_contents("site/accounts/<id>/.htpasswd"))) ? "OK\n" : "NO\n";'
```

Per impostarne una nuova, si genera un nuovo `.htpasswd` e lo si carica nella stessa cartella sul server (sovrascrivendo). FileZilla nasconde i file che iniziano col punto: *Server → Force showing hidden files*.

```bash
php -r '$p = readline("Nuova password: "); file_put_contents("site/accounts/<id>/.htpasswd", password_hash($p, PASSWORD_DEFAULT));'
```

Ancora da chiarire con SUPSI: la licenza Kirby per `happy.supsi.ch`, i proprietari delle cartelle scritte da PHP (oggi `777`, cioè scrivibili da chiunque sul server: meglio dare la proprietà all'utente di PHP), chi fa gli aggiornamenti di sicurezza e il backup del server, compreso `content/` (vedi «Contenuti: il server è la fonte»).

## Contenuti: il server è la fonte

Da quando i testi si modificano dal pannello online, la versione vera di `content/` è **quella sul server**. Il `content/` di Git è il **contenuto di partenza**: serve ad avviare il sito in locale e a sviluppare, e non si aggiorna con le modifiche fatte dal pannello. Per questo può essere diverso dai testi del sito, ed è normale: per i testi attuali fanno fede il sito e il pannello.

**Backup:** non si fa da Git. Il backup di `content/` è quello del server SUPSI (da confermare con Kenan: vedi sotto).

**Sviluppare con i testi aggiornati (facoltativo):** scarica `/supsi_happy/docs/content/` dal server con FileZilla nella cartella `content/` locale. Non serve fare il commit di questi file.

**Mai al contrario:** il `content/` locale non si carica sul server, se non per una pagina nuova che online non esiste ancora. Così non si cancellano le modifiche fatte dal pannello.

## Se qualcosa si rompe online

Prima di tutto si guarda quali cartelle Kirby non riesce a scrivere: `https://happy.supsi.ch/api/system` (in `requirements`, `false` = non scrivibile). La cache non compare lì. Anche la pagina `/panel/installation`, quando il pannello ci rimanda, elenca le cartelle non scrivibili. In FileZilla si attivano le colonne *Permissions* e *Owner/Group* (tasto destro sull'intestazione): le cartelle in cui Kirby scrive devono essere `drwxrwxrwx`.

**Prima di toccare qualsiasi cartella:** scaricare `content/` e `site/accounts/` sul computer (con *Server → Force showing hidden files* attivo) e controllare che la scheda *Failed transfers* sia vuota.

| Sintomo | Cartella | Rimedio |
|---|---|---|
| Immagini mancanti (errore 500 sui file di `/media/…`) | `media` | Svuotarla o cancellarla, ricrearla vuota, `777` |
| Pannello che rimanda a `/panel/installation` | `site/sessions`, `site/accounts` | `sessions`: ricrearla vuota, `777`. `accounts`: **prima scaricarla** (contiene l'account e il file nascosto `.htpasswd`), ricrearla, ricaricarne il contenuto, `777` ricorsivo |
| Login che fallisce con «Cannot read properties of null (reading 'error')» | `site/cache` | Ricrearla vuota, `777` |
| Il pannello non salva («not writable») | `content` | ⚠️ Contiene i testi: prima scaricarne una copia, poi ricrearla, ricaricare la copia, `777` ricorsivo |

**«Ricrearla» in pratica:** se FileZilla risponde `Permission denied` al `777`, la cartella è di `nobody`. Non si cancella (anche la cancellazione può fallire): la si **rinomina** in `nome_old`, si crea una cartella nuova con il nome originale (risulta dell'utente SFTP) e la si mette a `777`. Per `accounts` e `content` si ricarica dentro il contenuto della copia appena scaricata (in FileZilla prima *Server → Force showing hidden files*, per non perdere `.htpasswd`) e si mette `777` ricorsivo. Le cartelle `_old` si tengono finché pannello e sito non sono verificati (login, salvataggio di un testo, caricamento di un'immagine, pagine del sito); `sessions`, `cache` e `media` non hanno bisogno di copia.

**Log degli errori:** il server tiene i log in `/supsi_happy/logs/` (fuori da `docs/`). `error.log` è il mese in corso, `error.log.1` il precedente, i `.gz` quelli più vecchi; gli `access.log` (le visite) non servono. Gli errori di Kirby riportano data, ora e cartella (es. `The session storage directory ".../site/sessions" is not writable`). Un errore compare solo quando qualcuno apre il pannello, quindi il log dice quando ci si è accorti del problema, non sempre quando è nato: per stringere si guardano le date dei file dentro la cartella (l'ultimo file scritto da Kirby è l'ultima volta che funzionava).

**Le altre cartelle in `/supsi_happy/`** (`conf`, `lib`, `site-data`, `docs-archive`, `tmp`) sono dell'hosting SUPSI, create con lo spazio il 4 settembre 2026: non si toccano.

### Episodio di novembre 2026

Il pannello rimandava a `/panel/installation`. Il 2 novembre alle 14:57 Kirby scriveva ancora in `site/sessions` (ultimi file di sessione); il 18 novembre `sessions`, `cache`, `accounts`, `content` e `media` erano tutte di `nobody` con permessi `575`/`2575` (non scrivibili da PHP). Nessuno del progetto le aveva toccate e Kirby non cambia i permessi delle cartelle esistenti: la causa probabile è un'operazione lato server, non confermata. Il sito pubblico funzionava, perché leggere non richiede permessi di scrittura. Il 20 novembre si è fatto il backup di `content` e `accounts` e si sono ricreate tutte e cinque le cartelle come descritto sopra.

**Se ricapita:** è la conferma che qualcosa sul server reimposta i permessi. Si annotano le date (cartelle e `error.log`), si ripete il rimedio e si chiede a SUPSI di dare le cartelle all'utente con cui gira PHP, invece del `777`. Per capire se è un problema del server o solo di questo sito, conviene chiedere anche ad altri progetti Kirby sullo stesso server.

Per leggere l'errore vero: in `site/config/config.php` **sul server** si mette per qualche minuto `'debug' => true`, si ricarica la pagina, e poi si ricarica il `config.php` del repository, che lo rispegne. Il debug mostra a tutti percorsi e dettagli del server: mai lasciarlo acceso.

Dopo un nuovo caricamento, se il sito sembra «scomposto», è il browser che usa ancora il CSS vecchio: si ricarica con `Cmd + Maiusc + R`.

## Controlli

`npm run check` esegue i controlli del CSS, dei contrasti e delle pagine (`scripts/`); serve PHP. Sulla pull request la CI controlla anche `composer.json` e la sintassi dei file PHP.
