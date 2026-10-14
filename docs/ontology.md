# Ontologia dei contenuti

I tipi di contenuto del sito. Ogni tipo ha campi fissi, è un *blueprint* di Kirby in `site/blueprints/` e i suoi contenuti stanno in `content/`.

## Struttura del sito

Il sito è un **one-pager**: la home contiene tutte le sezioni, una sotto l'altra. A parte ci sono solo le tre pagine dei profili.

```
Home (hero: logo, mascotte, video, "Cos'è Happy?")
├── Perché Happy?        sezione
├── Vuoi partecipare?    sezione      → con il bottone "Partecipa al progetto"
├── A chi ci rivolgiamo  destinatari  → card verso le pagine dei profili
├── Le fasi del progetto fasi         → fase, fase, …
├── La Ricerca           ricerca      → tema, tema, …
├── Il team              team         → gruppo, gruppo, …
└── Contatti             contatti
Insegnanti · Famiglie · Professionisti   profilo (pubblicate e ordinate: sono le card)
```

Ogni sezione è una pagina figlia della home: l'ordine nel pannello è l'ordine sulla pagina, solo le sezioni pubblicate si vedono, e il nome della cartella diventa l'ancora (`#ricerca`). Le sezioni non hanno un indirizzo proprio: chi apre `/home/ricerca` viene mandato a `/#ricerca`.

## Tipi

| Tipo | Campi principali | Note |
|---|---|---|
| **Home** | titolo, voce di menu, illustrazione, video (MP4), sottotitoli (.vtt), immagine del video, crediti del video, titolo e testo della presentazione | Il titolo è il nome accessibile del logo SVG, l'unico `h1`. La presentazione è "Cos'è Happy?": sta nella hero perché su desktop condivide la schermata con il video. Il video compare solo insieme ai suoi sottotitoli; l'immagine del video è la sua copertina e, senza video, prende il suo posto. Il nome esteso del progetto viene dal sito |
| **Sezione** | titolo, voce di menu, testo, illustrazione, bottone "Partecipa" | Sezione di testo: Perché Happy?, Vuoi partecipare? (con il bottone). Un sottotitolo nel testo (### nel pannello) diventa un `h3` |
| **Destinatari** | titolo, voce di menu, testo, testo del link delle card, illustrazione | A chi ci rivolgiamo. Le card si creano da sole dalle pagine dei profili pubblicate, nel loro ordine (Sito → Pagine); la card mostra il titolo del profilo. L'illustrazione si vede solo su mobile, sotto le card |
| **Fasi** | titolo, voce di menu | Contiene le fasi, nell'ordine del pannello |
| **Fase** | titolo, illustrazione (16:9), descrizione | Il numero della fase è la sua posizione, non un campo. Si vedono solo le fasi pubblicate, nell'ordine del pannello |
| **Ricerca** | titolo, voce di menu, testo, titolo dei riferimenti | Contiene i temi, nell'ordine del pannello |
| **Tema** | titolo, strumento (illustrazione decorativa), anteprima, continuazione, riferimenti (autori e anno, titolo, link DOI, rivista) | Una tendina della Ricerca: strumento, titolo e anteprima sempre visibili; aprendola, la continuazione del testo e i riferimenti, con il link DOI sul titolo dell'articolo |
| **Team** | titolo, voce di menu | Contiene i gruppi. Il primo è sempre aperto, gli altri sono tendine |
| **Gruppo** | titolo, membri (nome, link, ruolo, ente dal più piccolo al più grande, senza link) | Gruppo di progetto, Consulenti, Partner, Scuole. Per i partner e le scuole basta il nome: se nessun membro ha ruolo o ente, il gruppo è un elenco di nomi |
| **Contatti** | titolo, voce di menu, testo, email, illustrazione | Chiude la home prima del piè di pagina: titolo piccolo senza segno, mascotte decorativa. È una sezione a sé (con la sua voce di menu e il suo `h2`) perché i contatti non riguardano solo il team |
| **Profilo** | titolo, colore, illustrazione (il personaggio), introduzione, titolo e testo di "Come partecipare", testo e link del bottone del sondaggio, testo dopo il bottone | Insegnanti di musica (rosa), Famiglie (arancione), Professionisti della salute (blu). Il colore colora la pagina e la navbar, sceglie la macchia della card e le note intorno al personaggio. L'etichetta sopra il titolo è il titolo della sezione A chi ci rivolgiamo |

Il **sito** contiene i dati comuni a tutte le pagine: il nome esteso del progetto, il bottone "Partecipa al progetto" (testo e link al modulo), la condivisione (descrizione e immagine dell'anteprima del link) e il piè di pagina.

## Regole

- I contenuti testuali sono definitivi: si inseriscono così come sono, senza riscriverli.
- Ogni nuovo tipo di contenuto va prima aggiunto qui, poi nel codice.
- Un dato sta in un solo posto. Se serve in più punti (il nome esteso, il bottone "Partecipa"), sta nel sito e i componenti lo leggono da lì.
- Le illustrazioni decorative (note, doodle) non sono contenuti: non hanno campi, le disegna lo snippet della sezione.
- Diaries, Risorse e Toolkit torneranno dopo il rilascio come nuove sezioni della home.
