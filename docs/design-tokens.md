# Design token e regole visive

I valori vengono dalle **variabili di Figma** e si riportano in `src/styles/tokens.css`. Se un valore cambia, si cambia prima in Figma e poi qui.

## Palette

| Token | Valore | Uso |
|---|---|---|
| `--color-verde` | #4EA185 | Contenuti trasversali |
| `--color-arancione` | #EB7121 | Famiglie |
| `--color-rosa` | #E25EAB (da scurire per AA) | Insegnanti |
| `--color-blu` | #0081A1 | Professionisti della salute |
| `--color-testo` | #1A1A1A | Testo |
| `--color-sfondo` | #FFFFFF | Sfondo |

Le tonalità UI possono essere leggermente più scure di quelle originali per rispettare l'accessibilità. Le tonalità originali restano per illustrazioni e video di Laura. Nelle pagine profilo il testo è sempre bianco.

## Tipografia

- Titoli hero solo per le pagine principali (Risorse, Contatti, La Ricerca); le sottosezioni usano titoli più piccoli.
- Paragrafi introduttivi a 20px (1.25rem).
- Font e scala completa: da riportare dalle variabili Figma.

## Elementi disegnati a mano

Card, sottolineature della navbar e pallini dello slider devono sembrare fatti a mano: ne esistono più varianti, per non risultare identici.

## Asset di Laura

- Illustrazioni (mascotte, personaggi per profilo, doodle) in **SVG con sfondo trasparente**.
- Finché non arrivano si usano placeholder con proporzioni fisse: all'arrivo si sostituisce il file, il layout non cambia.
- I placeholder grigi non sono scelte di design.
