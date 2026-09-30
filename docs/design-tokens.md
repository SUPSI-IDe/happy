# Design token e regole visive

I valori vengono dalle **variabili di Figma** e si riportano in `src/styles/tokens.css`. Se un valore cambia, si cambia prima in Figma e poi qui.

Dove stanno in Figma:

- **Collezione `Colori`:** i sei colori (`color/…`) e i colori semantici (`testo/…`, `sfondo/…`, `focus/…`).
- **Collezione `Tipografia`:** le dimensioni del testo, con due modalità, *Desktop* e *Mobile*.
- **Stili di testo `text/…`:** dieci stili, uno per token tipografico.
- **Pagina DS, frame `DS – v3 accessibile`:** la guida leggibile da chi non è del settore.

## Regole visive

1. **I colori non si toccano.** Mai scurirli, schiarirli o renderli trasparenti. Il nero puro (#000000) non si usa.
2. **Sopra un fondo colorato il testo è solo bianco**, in tutte le pagine: verde salvia, rosa Insegnanti, arancione Famiglie, blu Professionisti. Vale anche per card, bottoni e badge.
3. **Testo bianco su fondo colorato: almeno 1.25rem (20px) in grassetto 700, oppure 1.5rem (24px) o più** in un peso da 600. Serve perché il contrasto del bianco su salvia (3.41:1) e su Famiglie (3.36:1) è sotto il 4.5:1 richiesto al testo piccolo. La regola vale per tutti i fondi colorati, per coerenza, e su desktop e mobile.
4. **Nessun testo sotto 1rem (16px)**, e nessun testo sotto 1.25rem (20px) se sta su un fondo colorato.
5. **Niente grigi né trasparenze sul testo.** La gerarchia si fa con dimensione e peso, non con il colore.
6. **Il verde salvia come testo si usa solo su bianco**, a 1.25rem (20px) in grassetto e sottolineato: è il colore dei link.
7. **Un link è sempre sottolineato.** Il colore da solo non basta per riconoscerlo.
8. **Il focus è sempre visibile** e non si toglie mai.
9. **Misure in rem** (1rem = 16px). Testo corrente mai a tutta larghezza: colonna massima circa 36rem.

## Palette

| Token | Valore | Uso | Non si usa per |
|---|---|---|---|
| `--color-verde-salvia` | #4D997F | Contenuti trasversali: barra di navigazione e hero della home, bottone pieno (CTA), pillole delle fasi, badge "IN ARRIVO", card Diaries. Come testo: i link su bianco. Anello di focus su bianco. | Testo piccolo su bianco |
| `--color-rosa-insegnanti` | #D6278D | Pagina Insegnanti e card dedicate agli insegnanti | Testo |
| `--color-arancione-famiglie` | #E06A1A | Pagina Famiglie e card dedicate alle famiglie | Testo |
| `--color-blu-professionisti` | #0081A1 | Pagina Professionisti e card dedicate ai professionisti della salute | Testo |
| `--color-carbone` | #1A1A1A | Testo corrente e titoli su sfondo bianco; bordo dei bottoni a contorno su bianco | Sopra un colore; mai #000000 |
| `--color-bianco` | #FFFFFF | Sfondo del sito; unico testo sopra i colori; bordo e focus su colore | Testo su sfondo bianco |

**Colori semantici** (alias dei precedenti; nei componenti si usano questi):

| Token | Vale | Uso |
|---|---|---|
| `--color-sfondo` | bianco | Sfondo della pagina |
| `--color-testo` | carbone | Testo su bianco |
| `--color-testo-su-colore` | bianco | Testo su qualsiasi fondo colorato |
| `--color-link` | verde salvia | Link su bianco |
| `--color-focus-su-bianco` | verde salvia | Anello di focus su bianco (3.41:1, sopra il minimo di 3:1) |
| `--color-focus-su-colore` | bianco | Anello di focus su fondo colorato |

**Contrasto** (bianco sul colore, calcolato):

| Fondo | Contrasto | Cosa serve |
|---|---|---|
| Rosa Insegnanti | 4.63:1 | Passa anche come testo normale, ma vale la regola 3 |
| Blu Professionisti | 4.51:1 | Come sopra |
| Verde salvia | 3.41:1 | Solo testo grande (regola 3) |
| Arancione Famiglie | 3.36:1 | Solo testo grande (regola 3) |
| Carbone su bianco | 17.4:1 | Sempre a norma |
| Salvia su Carbone (link nel testo) | 5.1:1 | Il link si distingue dal testo che lo circonda |

Tutti i colori superano il 3:1 richiesto per bordi e anelli di focus.

Le illustrazioni e i video di Laura hanno i loro colori originali, separati dal sistema.

## Tipografia

Due famiglie: **Fraunces** (`--font-titoli`) per i titoli, **Urbanist** (`--font-testo`) per tutto il resto. Pesi ammessi: Fraunces 600 e 700, Urbanist 500 e 700. Non si usano Regular, Light, SemiBold in Urbanist, corsivo, Archivo.

| Token | Desktop | Mobile | Peso | Interlinea | Uso |
|---|---|---|---|---|---|
| `--text-display` | 6rem | 2.75rem | Fraunces 700 | 1.1 | Titolo hero: solo pagine principali (Risorse, Contatti, La Ricerca) e pagine dei profili |
| `--text-titolo-1` | 3rem | 2rem | Fraunces 600 | 1.2 | Titoli di sezione |
| `--text-titolo-2` | 2rem | 1.5rem | Fraunces 600 | 1.2 | Sottosezioni |
| `--text-titolo-3` | 1.5rem | 1.25rem | Fraunces 700 | 1.3 | Titoli di card e di fase, citazioni, testo dei bottoni |
| `--text-logo` | 1.5rem | 1.5rem | Fraunces 700 | 1.2 | "Happy" nella navigazione |
| `--text-corpo` | 1.25rem | 1.25rem | Urbanist 500 | 1.5 | Paragrafi su bianco, colonna massima 36rem |
| `--text-corpo-colore` | 1.25rem | 1.25rem | Urbanist 700 | 1.5 | Paragrafi e voci di navigazione su fondo colorato |
| `--text-etichetta` | 1.25rem | 1.25rem | Urbanist 700, maiuscolo, spaziatura 0.05em | 1.5 | "A chi ci rivolgiamo", "IN ARRIVO", numero della fase, "Riferimenti" |
| `--text-link` | 1.25rem | 1.25rem | Urbanist 700, sottolineato | 1.5 | Link ("Scopri di più", "Leggi →", partner, contatti) |
| `--text-nota` | 1rem | 1rem | Urbanist 500 | 1.5 | Riferimenti e didascalie. Solo su bianco. |

- **Interlinea:** in Figma è impostata negli stili con questi stessi valori. Il testo corrente non scende mai sotto 1.5.
- **Mobile-first:** i valori mobile sono quelli di base; i valori desktop si applicano da un breakpoint (proposta: `48rem`, da confermare). Nei frame Figma il mobile è a 390px e il desktop a 1512px.
- **Le misure intermedie (15, 18, 19, 22, 26px…) non esistono più.**
- **Email nei Contatti:** `--text-titolo-2`, colore `--color-link`, sottolineata.

## Bottoni, link e focus

| Componente | Sfondo | Testo | Bordo |
|---|---|---|---|
| Bottone pieno | verde salvia | bianco, `--text-titolo-3` | nessuno |
| Bottone a contorno su colore | trasparente | bianco, `--text-titolo-3` | bianco, 0.125rem |
| Bottone a contorno su bianco | trasparente | carbone, `--text-titolo-3` | carbone, 0.125rem |
| Link su bianco | – | verde salvia, `--text-link` | – |
| Link su colore | – | bianco, `--text-link` | – |

- **Dimensioni del bottone:** alto almeno 2.75rem (44px), angoli completamente arrotondati, padding uguale su desktop e mobile.
- **Hover:** l'etichetta del bottone si sottolinea (spessore 3px); nel link la sottolineatura passa da 2px a 4px. Il colore del testo e lo sfondo non cambiano mai.
- **Focus (obbligatorio):** anello di 0.1875rem (3px) a 0.125rem (2px) di distanza (`outline` con `outline-offset`). Verde salvia su bianco (`--color-focus-su-bianco`), bianco su fondo colorato (`--color-focus-su-colore`). Il Carbone resta per testo corrente e titoli. L'anello è completamente arrotondato, come i bottoni.
- **Disabilitato:** non è previsto. Se serve, si nasconde il bottone.
- **Navigazione:** le voci usano `--text-corpo-colore` (senza sottolineatura automatica: la sottolineatura è disegnata a mano, vedi sotto).

## Forme e spazi dei componenti

Collezione Figma `Forme e spazi`. Sono i valori usati dai componenti della pagina Components di Figma.

| Token | Valore | Uso |
|---|---|---|
| `--raggio-pieno` | 999 (completamente arrotondato) | Bottoni, pillole, badge |
| `--bordo-contorno` | 0.125rem (2px) | Bordo dei bottoni a contorno e della pillola inattiva |
| `--focus-spessore` | 0.1875rem (3px) | Spessore dell'anello di focus |
| `--focus-margine` | 0.3125rem (5px) | Spazio attorno al componente: 3px di anello + 2px di distanza |
| `--bottone-padding-x` / `--bottone-padding-y` | 1.75rem / 0.75rem (28px / 12px) | Spazio interno del bottone |
| `--etichetta-padding-x` / `--etichetta-padding-y` | 1rem / 0.25rem (16px / 4px) | Spazio interno del badge |
| `--pillola-lato` | 2.75rem (44px) | Lato della pillola delle fasi |

Il valore è in px nelle variabili Figma; nel CSS si scrive in rem.

## Componenti in Figma

Le pillole delle fasi sono cerchi da 2.75rem con solo il numero.

Nella pagina `Components` di Figma: `Bottone su bianco`, `Bottone su colore`, `Link su bianco`, `Link su colore`, `Voce di navigazione`, `Pillola fase`, `Badge`. Ogni componente ha gli stati normale, hover e focus (la pillola: attiva e inattiva). In codice ognuno diventa un componente Astro con le stesse varianti.

## Controlli prima di consegnare una pagina

- Ogni testo usa uno stile `--text-…` e un colore `--color-…`.
- Testo bianco su colore: almeno 1.25rem in grassetto, oppure 1.5rem o più.
- Nessun testo sotto 1rem; nessun grigio o trasparenza sul testo.
- I link sono sottolineati e hanno il focus visibile.
- La pagina si usa con la sola tastiera e resta leggibile con zoom al 200%.

## Elementi disegnati a mano

Card, sottolineature della navbar e pallini dello slider devono sembrare fatti a mano: ne esistono più varianti, per non risultare identici. Quando il testo cresce, la forma si allunga in altezza; il contenuto non esce mai dalla forma.

## Asset di Laura

- Illustrazioni (mascotte, personaggi per profilo, doodle) in **SVG con sfondo trasparente**.
- Finché non arrivano si usano placeholder con proporzioni fisse: all'arrivo si sostituisce il file, il layout non cambia.
- I placeholder grigi non sono scelte di design.
- I doodle stanno solo vicino a illustrazioni o mascotte, mai accanto al testo, e solo nei colori di sistema.
