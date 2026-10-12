# Ontologia dei contenuti

I tipi di contenuto del sito. Ogni tipo ha campi fissi, è un *blueprint* di Kirby in `site/blueprints/` e i suoi contenuti stanno in `content/`.

## Struttura del sito

Il sito è un **one-pager**: la home contiene tutte le sezioni, una sotto l'altra. A parte ci sono solo le tre pagine dei profili.

```
Home (hero: logo, mascotte, video, "Cos'è Happy?")
├── Perché Happy?        sezione
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
| **Home** | titolo, voce di menu, illustrazione, video, immagine del video, titolo e testo della presentazione | Il titolo è il nome accessibile del logo SVG, l'unico `h1`. La presentazione è "Cos'è Happy?": sta nella hero perché su desktop condivide la schermata con il video. L'immagine del video prende il posto del video finché non c'è, poi diventa la sua copertina. Il nome esteso del progetto viene dal sito |
| **Sezione** | titolo, voce di menu, testo, illustrazione, bottone "Partecipa" | Sezione di testo: Perché Happy? |
| **Destinatari** | titolo, voce di menu, testo, testo del link delle card, illustrazione | A chi ci rivolgiamo. Le card si creano da sole dalle pagine dei profili pubblicate, nel loro ordine (Sito → Pagine); la card mostra il titolo del profilo. L'illustrazione si vede solo su mobile, sotto le card |
| **Fasi** | titolo, voce di menu | Contiene le fasi, nell'ordine del pannello |
| **Fase** | titolo, descrizione, video | Il numero della fase è la sua posizione, non un campo |
| **Ricerca** | titolo, voce di menu, testo | Contiene i temi |
| **Tema** | titolo, illustrazione, testo, riferimenti (autori e anno, titolo, link DOI, rivista) | Una tendina della Ricerca |
| **Team** | titolo, voce di menu | Contiene i gruppi. Il primo è sempre aperto, gli altri sono tendine |
| **Gruppo** | titolo, membri (nome, link, ruolo, ente) | Gruppo di progetto, Consulenti, Partner, Scuole. Per i partner e le scuole basta il nome |
| **Contatti** | titolo, voce di menu, testo, email, illustrazione | Chiude la home prima del piè di pagina: titolo piccolo senza segno, mascotte decorativa. È una sezione a sé (con la sua voce di menu e il suo `h2`) perché i contatti non riguardano solo il team |
| **Profilo** | titolo, colore, illustrazione, testi | Insegnanti di musica (rosa), Famiglie (arancione), Professionisti della salute (blu). Il colore sceglie anche la macchia della card |

Il **sito** contiene i dati comuni a tutte le pagine: il nome esteso del progetto, il bottone "Partecipa al progetto" (testo e link al modulo) e il piè di pagina.

## Regole

- I contenuti testuali sono definitivi: si inseriscono così come sono, senza riscriverli.
- Ogni nuovo tipo di contenuto va prima aggiunto qui, poi nel codice.
- Un dato sta in un solo posto. Se serve in più punti (il nome esteso, il bottone "Partecipa"), sta nel sito e i componenti lo leggono da lì.
- Le illustrazioni decorative (note, doodle) non sono contenuti: non hanno campi, le disegna lo snippet della sezione.
- Diaries, Risorse e Toolkit torneranno dopo il rilascio come nuove sezioni della home.
