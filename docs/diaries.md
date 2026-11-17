# Diaries

Il modulo per raccogliere esperienze legate al dolore quando si suona. Non è un questionario: è un unico racconto in prima persona con degli spazi da completare (es. "Mi ricordo di una volta in cui stavo ___ con ___. A un certo punto ho sentito ___…"). Ogni spazio ha una piccola domanda come placeholder; alla fine c'è un "P.S." aperto. I dati servono a preparare i workshop con insegnanti e fisioterapisti.

Questo documento è la proposta di struttura approvata prima dello sviluppo (17 novembre 2026). Si legge insieme ad `AGENTS.md`, `docs/architecture.md` e `docs/ontology.md`. Quando un passo del percorso è fatto, i dettagli definitivi passano in quei documenti e qui si spunta il passo.

Design: Figma "HAPPY – Sito", pagina "Stories - v2" (frame Step 1, 1b, 2, 2b, 3).

## Vincoli

- **Minima manutenzione:** niente compiti manuali ricorrenti. Classificazione dei dati ed esportazione sono automatiche.
- **Testi nel pannello:** frasi, domande e testi dell'interfaccia sono contenuti modificabili, mai scritti nel codice. I testi definitivi arriveranno dopo (template Word della responsabile): il codice non deve dipendere da loro.
- **Anonimo:** niente nome, email, IP, cookie o analytics. I diari arrivano come bozze nel pannello; eventuali nomi o riferimenti li anonimizza il team.
- **I diari compilati non vanno mai su Git:** la repository è pubblica.
- **Accessibilità WCAG 2.1 AA:** niente autoplay (ogni ascolto parte da un gesto), bersagli tattili ≥ 44 px (in rem), alternativa al trascinamento, contrasto AA (anche dei placeholder), nomi accessibili neutri per i suoni, `prefers-reduced-motion`.
- **Barre indipendenti:** illustrazioni e motivi possono sparire, una o entrambe, senza rompere il resto.

## Struttura delle pagine

```
content/
├── diaries/                  pagina "Diaries": benvenuto, scelta del profilo, testi dell'interfaccia,
│   │                         libreria di illustrazioni e motivi (file caricati qui)
│   ├── 1_musicisti/          racconto
│   ├── 2_insegnanti/         racconto
│   └── 3_genitori-salute/    racconto
├── diari-ricevuti/           contenitore, mai visibile sul sito
│   └── _drafts/              ogni diario inviato è una bozza  ← in .gitignore
└── trattamento-dati/         pagina di testo, fuori dalla home e dalla navbar
```

- Ogni profilo ha il suo indirizzo (`/diaries/insegnanti`): si manda a ogni gruppo il link giusto e il profilo è già noto, senza chiederlo.
- I diari ricevuti stanno in un contenitore separato: si escludono da Git con una riga sola e nel pannello sono un'unica lista, filtrabile per profilo.
- La pagina Diaries usa la navbar normale del sito (da aggiungere alle voci di menu, oggi solo ancore della home).

## Tipi di contenuto

### Diaries (`diaries.yml`)

Schede del pannello:

- **Testi:** benvenuto, istruzioni, testo del bottone ("Condividi la tua storia"), spiegazione quando il bottone non è ancora attivo, frase privacy, avviso sull'anonimizzazione, messaggio di conferma. Il link della frase privacy è un campo **Pagina sul trattamento dati** che seleziona una pagina del sito (`pages`, massimo 1), non un URL.
- **Illustrazioni:** file con template `elemento`: **codice** (es. `corpo-polso`), categoria (corpo / luogo / persona), testo alternativo.
- **Motivi:** file audio con template `motivo`: **codice** (`motivo-01`…), nome accessibile neutro ("Motivo 1").

### Racconto (`racconto.yml`, uno per profilo)

- **Racconto:** campo `blocks` con due tipi di blocco, **Frase** (testo) e **Spazio**. Nel pannello il racconto è una sequenza frase, spazio, frase…
- Interruttori **Mostra la barra delle illustrazioni** e **Mostra la barra dei motivi**.
- Testo che introduce il P.S.

### Blocco Spazio

| Campo | Esempio | A cosa serve |
|---|---|---|
| Codice | `esperienza-attivita` | Identificativo fisso del dato. Unico nel racconto. **Non si cambia dopo l'inizio della raccolta** (lo ricorda l'aiuto del campo) |
| Blocco | esperienza / sensazione fisica / reazione / azione / conseguenze / oggi | Classificazione automatica. Opzioni in un solo file condiviso, `fields/blocco-racconto.yml` |
| Domanda | "Cosa stavi facendo?" | Placeholder e nome accessibile dello spazio |
| Lunghezza | breve / lungo | Lungo = area che si allarga |
| Accetta elementi | sì / no | Se lo spazio riceve illustrazioni o motivi |
| Obbligatorio | sì / no | Decide quando il bottone di invio è attivo (vedi "Decisioni aperte") |

### Diario ricevuto (`diario.yml`)

Campi in sola lettura, compilati in automatico all'invio:

| Campo | Contenuto |
|---|---|
| `profilo` | musicisti / insegnanti / genitori-salute |
| `data` | Solo il giorno, senza ora (meno identificabile) |
| `versione` | Data dell'ultima modifica del racconto al momento dell'invio |
| `racconto_leggibile` | Il testo intero con le risposte inserite, da leggere così com'è |
| `testi` | Struttura: spazio, blocco, domanda, testo |
| `elementi` | Struttura: spazio, blocco, tipo, codice, ordine |
| `ps` | Il P.S. |

Il titolo del diario è un codice casuale (`d-a7f3`), mai un dato personale.

### Pagina di testo (`testo.yml`)

Titolo e testo. Una pagina semplice e riusabile, fuori dalla home e dalla navbar. La prima è la pagina sul trattamento dati (`content/trattamento-dati/`): il testo lo scrive Cinzia, fino ad allora c'è un segnaposto.

## Dati

### Come si salva un diario

Una riga per ogni dato ("formato lungo"):

```yaml
Testi:
- spazio: esperienza-attivita
  blocco: esperienza
  domanda: Cosa stavi facendo?     # copiata al momento dell'invio
  testo: suonavo in orchestra
Elementi:
- spazio: sensazione-dove
  blocco: sensazione fisica
  tipo: illustrazione
  codice: corpo-polso
  ordine: 1
```

- **La domanda è copiata nel diario:** i testi cambieranno, e un diario deve sempre dire a quale domanda rispondeva.
- **Il server non si fida del browser:** ogni codice si confronta con la libreria, ogni spazio con il racconto; si controllano il massimo di 3 elementi per spazio e gli spazi obbligatori. La domanda si legge dal pannello, non dal modulo.

### Dataset ed esportazione

Nessun file del dataset viene salvato: il server lo genera al momento, leggendo i diari presenti. È quindi sempre aggiornato e identico al pannello (anche dopo anonimizzazione o cancellazione di un diario).

- `/diaries/esporta.csv`: il dataset, una riga per dato. Colonne: `diario · data · profilo · versione · spazio · blocco · domanda · tipo · codice · ordine · testo`. Il P.S. è una riga con spazio e tipo `ps`.
- `/diaries/dizionario.csv`: una riga per elemento della libreria: codice, categoria, descrizione, file. Senza, `motivo-04` tra un anno non dice più niente.
- Entrambi solo con l'accesso al pannello; chi non è collegato riceve un errore. Nel pannello, la pagina "Diari ricevuti" ha i due link.
- Niente link con chiave segreta per l'aggiornamento automatico in Excel: inoltrato per errore, darebbe accesso a tutti i diari.

Classificazione automatica: spazi, blocchi, illustrazioni e motivi. Il testo libero arriva al suo posto (spazio e blocco), ma il suo significato va letto e codificato da una persona, oppure lo spazio diventa a scelta (vedi "Decisioni aperte").

### Anonimato e spam

- Niente `csrf()` di Kirby: crea un cookie di sessione.
- Contro lo spam: campo trappola nascosto, controllo del tempo (invio troppo veloce = scartato), limiti di lunghezza. Lo spam che passa resta tra le bozze, mai pubblicato.
- Il diario non contiene IP. I log del server web (Apache, gestiti da SUPSI) registrano comunque gli IP delle visite: la pagina sul trattamento dati deve dirlo correttamente.

## Interfaccia e interazione

- **Desktop:** foglio del diario al centro, barra delle illustrazioni a sinistra, barra dei motivi a destra. Barre richiudibili e chiuse all'inizio (`aria-expanded="false"`), per non influenzare chi scrive.
- **Mobile:** le barre diventano pannelli che salgono dal basso, con `<dialog>` nativo (focus, Esc e resto della pagina bloccato già gestiti).
- **Inserire un elemento:** si tocca uno spazio, si sceglie l'elemento, si inserisce; su desktop anche trascinando. Fino a 3 elementi per spazio, ognuno rimovibile.
- **Bottone di invio:** `aria-disabled="true"` invece di `disabled`, così resta raggiungibile da tastiera; la spiegazione è collegata con `aria-describedby`; al clic porta al primo spazio obbligatorio vuoto. Sotto: frase privacy e avviso di anonimizzazione.
- **Senza JavaScript:** gli spazi restano campi di testo e il diario si invia (normale invio di form); illustrazioni e motivi richiedono JavaScript. Eccezione alla regola "senza JS il sito funziona", da riportare in `docs/architecture.md`.

### Barre modulari

Si tolgono a due livelli:

1. **Dal pannello, senza codice:** l'interruttore nel racconto (anche solo per alcuni profili).
2. **Dal codice, per sempre:** si cancellano lo snippet della barra, il suo JS e il suo blocco CSS. Il nucleo `diari.js` non conosce le barre: legge solo bottoni con `data-tipo` e `data-codice`.

## File

```
site/blueprints/pages/diaries.yml · racconto.yml · diari-ricevuti.yml · diario.yml · testo.yml
site/blueprints/blocks/frase.yml · spazio.yml
site/blueprints/fields/blocco-racconto.yml
site/blueprints/files/elemento.yml · motivo.yml
site/templates/diaries.php            benvenuto e scelta del profilo
site/templates/racconto.php           il diario da compilare
site/templates/testo.php              pagina di testo (trattamento dati)
site/controllers/racconto.php         riceve l'invio, controlla, salva, mostra la conferma
site/snippets/diari/foglio.php        il racconto: frasi e spazi
site/snippets/diari/spazio.php        un singolo spazio
site/snippets/diari/barra.php         contenitore richiudibile comune (laterale / pannello dal basso)
site/snippets/diari/barra-illustrazioni.php
site/snippets/diari/barra-motivi.php
site/snippets/diari/invio.php         bottone, spiegazione, privacy
site/plugins/diari/index.php          esportazione CSV e dizionario, funzione di salvataggio
assets/js/diari.js                    nucleo: spazio, inserimento, max 3, trascinamento
assets/js/diari-motivi.js             solo l'ascolto dei motivi
assets/css/diari.css                  caricato solo nelle pagine dei Diaries
```

Lo snippet `layout` oggi carica un elenco fisso di CSS: va aggiunto un modo per caricare `diari.css` solo dove serve.

## Percorso

Un passo = un ramo e una pull request, verificato prima del successivo.

### A. Fondamenta

- [x] **1. Documentazione e regole.** Nuovi tipi in `docs/ontology.md`; `docs/architecture.md`; regola d'oro sui form in `AGENTS.md` (i Diaries sono un modulo interno al sito) e questo documento nell'indice; `content/diari-ricevuti/_drafts/` nel `.gitignore`. *Verifica:* rilettura.
- [ ] **2. Blueprint e contenuti segnaposto.** Blueprint di pagine, blocchi, file; un racconto provvisorio (musicisti), 3–4 illustrazioni e 2 motivi segnaposto; il tipo Pagina di testo e la pagina sul trattamento dati con testo segnaposto, selezionata nel campo dei Diaries. *Verifica:* costruire un racconto nel pannello in locale (aggiungere, spostare, togliere spazi).

### B. Il diario funziona, solo testo

- [ ] **3. Pagina del racconto.** Template e snippet, CSS mobile-first, campi lunghi che si allargano. *Verifica:* confronto con Figma (Step 1 e 2), mobile e desktop.
- [ ] **4. Invio e salvataggio.** Controller, controlli lato server, campo trappola, controllo del tempo, bozza, conferma. *Verifica:* un diario inviato in locale compare nel pannello; `git status` non lo mostra.
- [ ] **5. Bottone e privacy.** Spazi minimi, `aria-disabled` con spiegazione, frase privacy. *Verifica:* da sola tastiera non si invia un diario incompleto e si capisce cosa manca.

### C. Barre e interazione

- [ ] **6. Barra delle illustrazioni e nucleo JS.** Prima tocco/clic e inserimento (max 3, rimozione), poi trascinamento. *Verifica:* tutto anche senza mouse.
- [ ] **7. Mobile.** Pannelli dal basso (`<dialog>`). *Verifica:* su un telefono vero.
- [ ] **8. Barra dei motivi.** Ascolto solo al gesto, nomi neutri, interruttore. *Verifica:* spenta dal pannello, il resto funziona.

### D. Dati e rilascio

- [ ] **9. Esportazione.** Dataset CSV, dizionario, eventuale `revisionato`. *Verifica:* tabella pivot in Excel con 3–4 diari di prova.
- [ ] **10. Accessibilità.** `npm run check`, axe, Lighthouse, tastiera, VoiceOver, `prefers-reduced-motion`, zoom 200%.
- [ ] **11. Messa online.** Caricare `site/`, `assets/` e solo le cartelle nuove `content/diaries/` (il resto di `content/` del server non si sovrascrive). Diario di prova online, controllo che la cartella sia scrivibile, poi cancellarlo. Mostrare al team come si modifica un racconto e quali campi non toccare (i codici). Online solo con la decisione sul backup.

## Decisioni aperte

| Decisione | Da chi | Blocca |
|---|---|---|
| Spazi minimi: spazi precisi obbligatori (interruttore per spazio, proposto) o "almeno N spazi"? | Nerea + responsabile | Passo 5 (fino ad allora segnaposto) |
| Profilo 3 (genitori + professionisti della salute): un profilo con uno spazio "ruolo", o due pagine con lo stesso racconto? Senza, nel dataset non si distinguono | Responsabile | Passo 2 |
| Un terzo tipo di spazio **a scelta** (es. fasce d'età, strumento) per dati classificabili? Cambia i template Word | Responsabile | Passo 2 |
| Esportare tutti i diari o solo quelli "revisionati" (anonimizzati)? | Responsabile | Passo 9 |
| Cosa mostra lo Step 3 dopo l'invio | Figma | Passo 4 |
| Testo della pagina sul trattamento dati | Cinzia | Passo 11 (fino ad allora testo segnaposto) |
| Link alla pagina sul trattamento dati nel piè di pagina? | Team | Nessun passo |
| Backup dei diari. A) nessun backup dedicato: il CSV scaricato per ogni analisi fa da copia; B) chiedere a SUPSI se il server ha già un backup; C) una copia di ogni diario per email (sconsigliata per la privacy) | Ginevra | Passo 11 |
| Testi definitivi, illustrazioni di Laura, suoni | Team | Nessun passo: si sostituiscono dal pannello |

Le due decisioni del passo 2 vanno prese presto: cambiano la struttura dei dati, e cambiarle a raccolta iniziata produce diari incompatibili tra loro.
