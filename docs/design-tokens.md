# Design token e regole visive

La fonte dei valori usati dal sito è **`assets/css/tokens.css`**: è un file di testo e lo può modificare anche chi non usa Figma. Le **variabili di Figma** hanno lo stesso schema e servono a chi disegna. Quando un valore cambia si aggiornano entrambi e questo documento (vedi "Cambiare un colore"). Un controllo automatico impedisce di rompere le regole di contrasto (vedi "Controlli automatici").

Dove stanno in Figma:

- **Collezione `Colori`:** i sei colori (`color/…`) e i colori semantici (`testo/…`, `sfondo/…`, `focus/…`).
- **Collezione `Tipografia`:** le dimensioni del testo, con due modalità, *Desktop* e *Mobile*.
- **Stili di testo `text/…`:** dieci stili, uno per token tipografico.
- **Pagina DS, frame `DS – v3 accessibile`:** la guida leggibile da chi non è del settore.

## Regole visive

1. **I colori non si toccano.** Mai scurirli, schiarirli o renderli trasparenti. Il nero puro (#000000) non si usa.
2. **Sopra un fondo colorato il testo è solo bianco**, in tutte le pagine: verde salvia, rosa Insegnanti, arancione Famiglie, blu Professionisti. Vale anche per card, bottoni e badge.
3. **Testo bianco su fondo colorato: almeno 1.25rem (20px) in grassetto 700, oppure 1.5rem (24px) o più** in un peso da 600. Serve perché il contrasto del bianco su salvia (3.40:1) e su Famiglie (3.36:1) è sotto il 4.5:1 richiesto al testo piccolo. La regola vale per tutti i fondi colorati, per coerenza, e su desktop e mobile.
4. **Nessun testo sotto 1rem (16px)**, e nessun testo sotto 1.25rem (20px) se sta su un fondo colorato.
5. **Niente grigi né trasparenze sul testo.** La gerarchia si fa con dimensione e peso, non con il colore.
6. **Il verde salvia come testo si usa solo su bianco**, a 1.25rem (20px) in grassetto e sottolineato: è il colore dei link.
7. **Un link è sempre sottolineato.** Il colore da solo non basta per riconoscerlo.
8. **Il focus è sempre visibile** e non si toglie mai.
9. **Misure in rem** (1rem = 16px). Testo corrente mai a tutta larghezza: colonna massima 42.5rem (le colonne 7–12 del desktop).

## Palette

| Token | Valore | Uso | Non si usa per |
|---|---|---|---|
| `--color-verde-salvia` | #4D997F | Contenuti trasversali: barra di navigazione e hero della home, bottone pieno (CTA), pillole delle fasi, badge "IN ARRIVO". Come testo: i link su bianco. Anello di focus su bianco. | Testo piccolo su bianco |
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
| `--color-focus-su-bianco` | verde salvia | Anello di focus su bianco (3.40:1, sopra il minimo di 3:1) |
| `--color-focus-su-colore` | bianco | Anello di focus su fondo colorato |

**Contrasto** (bianco sul colore, calcolato):

| Fondo | Contrasto | Cosa serve |
|---|---|---|
| Rosa Insegnanti | 4.63:1 | Passa anche come testo normale, ma vale la regola 3 |
| Blu Professionisti | 4.51:1 | Come sopra |
| Verde salvia | 3.40:1 | Solo testo grande (regola 3) |
| Arancione Famiglie | 3.36:1 | Solo testo grande (regola 3) |
| Carbone su bianco | 17.4:1 | Sempre a norma |
| Salvia su Carbone (link nel testo) | 5.1:1 | Il link si distingue dal testo che lo circonda |

Tutti i colori superano il 3:1 richiesto per bordi e anelli di focus.

Le illustrazioni e i video di Laura hanno i loro colori originali, separati dal sistema.

## Tipografia

Due famiglie: **Fraunces** (`--font-titoli`) per i titoli, **Urbanist** (`--font-testo`) per tutto il resto. Pesi ammessi: Fraunces 600 e 700, Urbanist 500 e 700. Non si usano Regular, Light, SemiBold in Urbanist, corsivo, Archivo.

| Token | Desktop | Mobile | Peso | Interlinea | Uso |
|---|---|---|---|---|---|
| `--text-display` | 6rem | 2.75rem | Fraunces 700 | 1.1 | Titolo delle pagine dei profili. Nella hero della home il titolo è il logo SVG (vedi "Hero della home") |
| `--text-titolo-1` | 3rem | 2rem | Fraunces 600 | 1.2 | Titoli di sezione |
| `--text-titolo-2` | 2rem | 1.5rem | Fraunces 600 | 1.2 | Sottosezioni, titoli delle card dei profili |
| `--text-titolo-3` | 1.5rem | 1.25rem | Fraunces 700 | 1.3 | Titoli di fase, citazioni, testo dei bottoni |
| `--text-logo` | 1.5rem | 1.5rem | Fraunces 700 | 1.2 | "Happy" nella navigazione |
| `--text-corpo` | 1.25rem | 1.25rem | Urbanist 500 | 1.5 | Paragrafi su bianco, colonna massima 42.5rem |
| `--text-corpo-colore` | 1.25rem | 1.25rem | Urbanist 700 | 1.5 | Paragrafi e voci di navigazione su fondo colorato |
| `--text-etichetta` | 1.25rem | 1.25rem | Urbanist 700, maiuscolo, spaziatura 0.05em | 1.5 | "A chi ci rivolgiamo", "IN ARRIVO", numero della fase, "Riferimenti" |
| `--text-link` | 1.25rem | 1.25rem | Urbanist 700, sottolineato | 1.5 | Link ("Scopri di più", "Leggi →", partner, contatti) |
| `--text-nota` | 1rem | 1rem | Urbanist 500 | 1.5 | Riferimenti e didascalie. Solo su bianco. |

- **Interlinea:** in Figma è impostata negli stili con questi stessi valori. Il testo corrente non scende mai sotto 1.5.
- **Mobile-first:** i valori mobile sono quelli di base; i valori desktop si applicano da `64rem` (1024px), scritto in `rem` per seguire lo zoom e la dimensione del testo scelta dall'utente. Nei frame Figma il mobile è a 390px e il desktop a 1512px.
- **Perché 64rem:** sotto questa larghezza (tablet in verticale, zoom al 200% su un monitor da 1512px) le colonne del desktop sarebbero troppo strette per il corpo a 20px, quindi resta il layout a una colonna. Da 64rem le sezioni si dispongono a colonne.
- **Titoli grandi fluidi:** `--text-display` e `--text-titolo-1` non saltano di colpo. Da 64rem a 94.5rem (1512px) crescono gradualmente da 4rem a 6rem (`display`) e da 2.25rem a 3rem (`titolo-1`), e da 94.5rem restano ai valori di Figma. Così non escono dalla colonna. Gli altri stili cambiano di colpo a 64rem.
- **Verifica:** una pagina va controllata a 390, 768, 1024, 1280 e 1512px di larghezza.
- **Le misure intermedie (15, 18, 19, 22, 26px…) non esistono più.**
- **Contatti:** titolo `h2` con l'aspetto di `--text-titolo-2` (senza segno a pennello), testo corrente, email in stile link (`--text-link`, verde salvia, sottolineata). Mascotte decorativa larga `--mascotte-contatti`: da 12.3125rem (197px) su mobile a 18.75rem (300px) da 1024px; su desktop centrata nelle colonne 1–5, con il testo nelle 7–12 centrato in altezza.

## Bottoni, link e focus

| Componente | Sfondo | Testo | Bordo |
|---|---|---|---|
| Bottone pieno | verde salvia | bianco, `--text-titolo-3` | nessuno |
| Bottone a contorno su colore | trasparente | bianco, `--text-titolo-3` | bianco, 0.125rem |
| Bottone a contorno su bianco | trasparente | carbone, `--text-titolo-3` | carbone, 0.125rem |
| Link su bianco | – | verde salvia, `--text-link` | – |
| Link su colore | – | bianco, `--text-link` | – |

- **Dimensioni del bottone:** alto almeno 2.75rem (44px), angoli completamente arrotondati, padding uguale su desktop e mobile.
- **Hover:** l'etichetta del bottone si sottolinea (spessore 3px); nel link la sottolineatura passa da 2px (`--sottolineatura-spessore`) a 4px (`--sottolineatura-spessore-hover`). Il colore del testo e lo sfondo non cambiano mai.
- **Focus (obbligatorio):** anello di 0.1875rem (3px) a 0.125rem (2px) di distanza (`outline` con `outline-offset`). Verde salvia su bianco (`--color-focus-su-bianco`), bianco su fondo colorato (`--color-focus-su-colore`). Il Carbone resta per testo corrente e titoli. L'anello è completamente arrotondato, come i bottoni.
- **Disabilitato:** non è previsto. Se serve, si nasconde il bottone.
- **Navigazione:** le voci usano `--text-corpo-colore` (senza sottolineatura automatica: la sottolineatura è disegnata a mano, vedi sotto).

## Forme e spazi

Collezione Figma `Forme e spazi`. In `tokens.css` entrano solo i valori già usati dal CSS:

| Token | Valore | Uso |
|---|---|---|
| `--raggio-pieno` | completamente arrotondato | Bottoni, pillole, badge, anello di focus |
| `--focus-spessore` | 0.1875rem (3px) | Spessore dell'anello di focus |
| `--focus-distanza` | 0.125rem (2px) | Distanza tra il componente e l'anello di focus (`outline-offset`) |
| `--sottolineatura-spessore` | 0.125rem (2px) | Sottolineatura dei link |
| `--sottolineatura-spessore-hover` | 0.25rem (4px) | Sottolineatura dei link al passaggio del mouse |
| `--bottone-altezza-min` | 2.75rem (44px) | Altezza minima del bottone |
| `--bottone-padding-inline` / `--bottone-padding-block` | 1.75rem / 0.75rem | Padding del bottone |
| `--bordo-contorno` | 0.125rem (2px) | Bordo dei bottoni a contorno |
| `--sottolineatura-bottone-hover` | 0.1875rem (3px) | Sottolineatura dell'etichetta del bottone al passaggio del mouse |

Solo in Figma, da aggiungere a `tokens.css` con il primo componente che li usa: spazio attorno al componente per il focus (0.3125rem), padding del badge (1rem / 0.25rem), lato della pillola (2.75rem). Il valore è in px nelle variabili Figma; nel CSS si scrive in rem.

Altri token in `tokens.css`: `--font-titoli`, `--font-testo`, i pesi (`--peso-medio` 500, `--peso-semibold` 600, `--peso-grassetto` 700), le interlinee (`--interlinea-display` 1.1, `--interlinea-titoli` 1.2, `--interlinea-titolo-3` 1.3, `--interlinea-testo` 1.5), `--spaziatura-etichetta` (0.05em) e `--colonna-testo` (42.5rem).

## Spaziature e layout

I valori vengono dai wireframe definitivi (Figma, pagina "wireframe - v5 - final") e stanno in `tokens.css` (usati da `layout.css`). Desktop: 12 colonne, margine 64px, gutter 24px. Mobile: 4 colonne, margine 20px, gutter 16px.

- **Scala delle spaziature:** `--spazio-1` … `--spazio-9`, multipli di 0.25rem: 0.25, 0.5, 0.75, 1, 1.5, 2, 3, 4, 6rem.
- **Griglia:** 4 colonne su mobile, 12 da 64rem. Spazio tra le colonne (`--gutter`): 1rem su mobile, 1.5rem su desktop.
- **Margine di pagina** (`--margine-pagina`): 1.25rem (20px) su mobile, 4rem (64px) su desktop, a ogni larghezza dello schermo. Non c'è una larghezza massima: come in Figma le colonne crescono con lo schermo. Il testo resta leggibile perché i paragrafi non superano `--colonna-testo`.
- **Distanza tra le sezioni** (`--spazio-sezione`): 4rem (64px) su mobile, 6rem (96px) su desktop, una volta sola: ogni sezione ce l'ha sopra, l'ultima anche sotto. Su mobile tra il titolo di sezione e il contenuto c'è `--spazio-5` (1.5rem, 24px), come tra i paragrafi.
- **Colonne delle sezioni (desktop):** il titolo sta nelle colonne 1–5, il contenuto nelle colonne 7–12 (larghe in tutto 42.5rem a 1512px, da qui `--colonna-testo`). La prima riga del testo è allineata alla linea di base del titolo. Il titolo resta fermo a sinistra mentre si scorre (`position: sticky`, `--spazio-6` sotto la navbar). Sotto il titolo può stare un'illustrazione, a `--spazio-4` dal titolo: su desktop riempie l'altezza fino al fondo del contenuto, cioè finisce allineata al fondo del bottone (almeno `--illustrazione-sezione`, 16.375rem, di altezza); su mobile è larga al massimo 262px. Il bottone sta a `--spazio-6` dal testo. Su mobile l'ordine è: titolo, testo, illustrazione, bottone (questi ultimi due centrati). Solo la hero e le card dei profili vanno a tutta larghezza.
- **Altezza della navbar** (`--navbar-altezza`): calcolata dai token del bottone. La usano le ancore (`scroll-padding` in `base.css`, così una sezione non finisce sotto la navbar sticky) e le sezioni alte uno schermo.
- **Titoli di sezione:** l'`h2` di ogni sezione ha la classe `.titolo-sezione`, che mette a sinistra il segno a pennello (`assets/images/segno-titolo.svg`, "Vector 38" in Figma). Il segno è una maschera colorata da `--color-decorazione`: verde sul bianco, bianco sul colore. È alto 0.95em, quindi segue il titolo (30px su mobile, 46px su desktop). In Figma "Cos'è Happy?" aveva un segno diverso su mobile e su desktop: si usa lo stesso degli altri titoli.
- **Classi:** `.sezione` (fascia a tutta larghezza), `.contenitore` (contenuto centrato), `.griglia` (colonne). Su mobile gli elementi della griglia occupano tutta la riga; da 64rem ogni componente sceglie quante colonne occupare con `grid-column`.

## Hero della home

- **Logo:** "Happy" è un SVG (`assets/images/logo-happy.svg`), non testo: Fraunces molto grande si deforma. Prende il colore del testo intorno (`currentColor`), quindi bianco sul verde. Larghezza `--hero-logo`: 13.125rem (210px) su uno schermo di 390px, cresce gradualmente fino a 26.5625rem (425px) a 1024px e poi resta ferma, così negli schermi intermedi non resta piccolo.
- **Sottotitolo** (il nome esteso): `--text-titolo-3` (Fraunces 700) su tutti i formati. Nel frame mobile di Figma è in Urbanist: è un errore del frame.
- **Mascotte:** sempre presente, anche su mobile, accanto al logo. `--hero-mascotte` è una proporzione del logo (197px accanto a 425px), quindi cresce con lui; su schermi molto stretti si restringe.
- **Bordo a pennello:** chiude il fondo verde (`assets/images/bordo-pennello.svg`, usato come maschera, alto `--bordo-pennello` 1.1875rem). È centrato sul bordo, metà sul verde e metà sotto, così il profilo irregolare non lascia fessure. Su mobile sta sotto il video, su desktop sotto la hero.
- **Video:** sempre il più grande possibile e sempre 16:9: su mobile da bordo a bordo, su desktop tutte le colonne 6–12 fino al margine. L'immagine del video (illustrazione di Laura, campo "Immagine del video" della Home) è la copertina finché non si preme play; senza video, o senza i suoi sottotitoli, prende il suo posto; senza immagine, un riquadro tratteggiato.
- **Desktop, altezza:** la hero è alta uno schermo sotto la navbar, con il contenuto centrato e almeno `--spazio-6` sopra e sotto.
- **Mobile:** logo con mascotte, sottotitolo e video (da bordo a bordo) sul verde; "Cos'è Happy?" sotto, sul bianco. **Desktop:** tutto sul verde in una schermata sotto la navbar; "Cos'è Happy?" nelle colonne 1–5, video nelle 6–12.

## Card dei profili (A chi ci rivolgiamo)

- **Forma:** la macchia a matita di Laura nel colore del profilo (`assets/images/card-<colore>.webp`), stirata sulla card: se il testo cresce, la card si allunga e il testo non esce mai dalla forma. Proporzioni 302 × 185, larga `--card-larghezza` (302px su mobile, 335px su desktop).
- **Contrasto:** il tratto a matita è semitrasparente, quindi sul bianco della pagina i colori risultano più chiari di quelli di sistema (arancione 2.9:1 in media). Le macchie sono state scurite verso il colore di sistema solo nei punti in cui il bianco non arrivava a 3:1, e solo quanto bastava: il bianco ha ovunque almeno 3:1, che basta perché tutto il testo della card è grande (regola 3). Una nuova macchia si prepara allo stesso modo con `php scripts/prepara-card.php macchia.png assets/images/card-<colore>.webp <esadecimale del colore>` (PNG trasparente e orizzontale, largo 672px).
- **Testo:** nome del profilo in `--text-titolo-2` (come nel frame mobile; nel frame desktop il gruppo era ingrandito a 28.8px), "Scopri di più" con l'aspetto di un link, in basso a destra. Tutta la card è un solo link; al passaggio del mouse la sottolineatura si ispessisce.
- **Mobile:** una sotto l'altra, sfalsate: la seconda rientra di `--spazio-7`, la terza di `--spazio-4`. Sotto, solo su mobile, l'illustrazione dei musicisti (`--illustrazione-destinatari`).
- **Desktop:** in fila a tutta larghezza, a `--spazio-8` l'una dall'altra, ruotate (−4°, 2°, 5°) e scese di `--spazio-7`, 0 e `--spazio-6`, come se fossero appoggiate a mano. Se non ci stanno in tre (da 1024 a circa 1280px), vanno a capo due e una, senza stringersi. Le varianti si ripetono ogni tre card.

## Pagine dei profili

- **Colore:** tutta la pagina, navbar compresa, è nel colore del profilo, con il testo bianco (`.su-colore`). Il piè di pagina resta verde salvia come nelle altre pagine.
- **Desktop:** etichetta "A chi ci rivolgiamo" e titolo (`--text-display`) nelle colonne 1–5, introduzione nelle 7–12, allineate in alto; sotto, a `--spazio-9`, il personaggio (1–5) e "Come partecipare" (7–12, titolo in `--text-titolo-2`, bottone a contorno a sinistra). **Mobile:** in colonna nello stesso ordine, personaggio e bottone centrati.
- **Personaggio:** riquadro largo `--illustrazione-profilo` (300px su mobile, 445px su desktop), con il personaggio dal pannello e sopra le sue note (vedi "Asset di Laura"). Su mobile le note scalano con il riquadro, invece di avere le posizioni del frame mobile: la differenza è di pochi pixel.

## Piè di pagina

Segue la versione desktop dei wireframe v6 (anche su mobile).

- **Desktop:** nome e nome esteso (colonne 1–5) | link e copyright (7–12); contributo, cioè testo e logo FNS (1–5) | "Un progetto di" e i loghi dei titolari (7–12); "In collaborazione con" e i loghi dei partner distribuiti su tutta la riga. **Mobile:** in colonna nello stesso ordine: i link restano sotto il nome a ogni larghezza; loghi dei partner centrati.
- Nome in `--text-logo`; nome esteso in Fraunces bold 1.25rem (in Figma 18px: sotto 1.25rem il bianco sul verde non raggiunge il contrasto AA); il resto in Urbanist bold 1.25rem. Copyright in stile etichetta (maiuscolo).
- Si vedono le etichette "Un progetto di" (senza, i loghi dei titolari si confondono con quello del finanziatore) e "In collaborazione con". "Contributo" resta nel pannello ma è solo per lo screen reader: il testo basta a chi vede. Ogni elenco di loghi ha come nome la sua etichetta (`aria-labelledby`).
- **Loghi:** bianchi su trasparente, caricati al doppio della misura. Larghezza su desktop dal pannello (SUPSI e Conservatorio alti circa 47px, FNS un po' più grande perché il suo segno è più sottile); su mobile ×`--scala-loghi` (0.73).
- Spazi: `--spazio-7` sopra e sotto, `--spazio-6` tra i gruppi (in Figma 40px, fuori dalla scala), `--spazio-4` tra testo e logo.

## Componenti in Figma

Le pillole delle fasi sono cerchi da 2.75rem con solo il numero.

Nella pagina `Components` di Figma: `Bottone su bianco`, `Bottone su colore`, `Link su bianco`, `Link su colore`, `Voce di navigazione`, `Pillola fase`, `Badge`. Ogni componente ha gli stati normale, hover e focus (la pillola: attiva e inattiva). In codice ognuno diventa uno snippet di Kirby con le stesse varianti.

## Come si usano nel CSS (`base.css`)

- **Titoli:** `h1`, `h2`, `h3`, `h4` hanno già display, titolo-1, titolo-2 e titolo-3. Se l'aspetto deve essere diverso dal livello (per esempio un `h2` con l'aspetto di un titolo-2) si usa la classe: `.text-display`, `.text-titolo-1`, `.text-titolo-2`, `.text-titolo-3`. Le altre classi sono `.text-etichetta` e `.text-nota`; il testo corrente è quello di base. Un solo `h1` per pagina.
- **Fondo colorato:** la classe `.su-colore` mette il testo bianco e in grassetto, i link bianchi e l'anello di focus bianco. Il colore si sceglie con `.fondo-verde-salvia`, `.fondo-rosa-insegnanti`, `.fondo-arancione-famiglie` o `.fondo-blu-professionisti`. Dentro `.su-colore` una nota o un testo corrente non scendono sotto la regola del testo bianco.
- **Link:** `a` è già verde salvia, in grassetto, sottolineato (2px, 4px al passaggio del mouse).
- **Focus:** `:focus-visible` disegna l'anello con `--color-focus`, che vale verde salvia su bianco e bianco dentro `.su-colore`. Su link e bottoni l'anello è arrotondato.
- **Testo corrente:** i paragrafi hanno larghezza massima `--colonna-testo`.

## Controlli prima di consegnare una pagina

- Ogni testo usa uno stile `--text-…` e un colore `--color-…`.
- Testo bianco su colore: almeno 1.25rem in grassetto, oppure 1.5rem o più.
- Nessun testo sotto 1rem; nessun grigio o trasparenza sul testo.
- I link sono sottolineati e hanno il focus visibile.
- La pagina si usa con la sola tastiera e resta leggibile con zoom al 200%.

## Cambiare un colore

I colori sono una scelta di marca *e* di accessibilità: non si cambiano a occhio. Chi cambia un colore (chiunque abbia accesso al repository, anche senza Figma):

1. Modifica il valore in `assets/css/tokens.css`.
2. Lancia `npm run check:contrast`. Se una coppia scende sotto la soglia, il controllo fallisce e dice quale (per esempio il testo bianco su un nuovo colore di sfondo).
3. Aggiorna lo stesso valore nella variabile Figma e nella tabella "Palette" di questo documento.

Il contenuto del sito (testi, video, risorse) non passa da qui: si modifica nel pannello di Kirby, senza toccare i token.

## Controlli automatici

- `npm run check:css` vieta misure in `px`, colori scritti a mano fuori da `tokens.css` e `var(--…)` non definite.
- `npm run check:contrast` verifica i contrasti dei colori di `tokens.css` (testo su bianco, testo bianco su ogni fondo colorato, link, anelli di focus). Controlla le coppie di token, non le pagine reali: quelle si controllano con axe e Lighthouse.
- Insieme a `npm run check:pagine` (ogni pagina ha un solo `h1`, `lang="it"`, `<main>`…) girano su ogni pull request (`.github/workflows/ci.yml`).

## Elementi disegnati a mano

Card, sottolineature della navbar e pallini dello slider devono sembrare fatti a mano: ne esistono più varianti, per non risultare identici. Quando il testo cresce, la forma si allunga in altezza; il contenuto non esce mai dalla forma.

## Asset di Laura

- Le illustrazioni (mascotte, personaggi dei profili, immagini delle fasi, strumenti della Ricerca) sono disegni a matita: arrivano in **PNG con sfondo trasparente**, perché la grana del tratto non si può rendere in SVG. Sono contenuti: si caricano dal pannello, nel campo dell'illustrazione della sezione o della pagina.
- **Cambiare un'illustrazione:** nel pannello si apre l'immagine e si sceglie *Sostituisci*: nome del file e testo alternativo restano, il layout non cambia. Il file si prepara al doppio della misura con cui compare in Figma su desktop.
- **Esportare da Figma:** in Figma le illustrazioni sono spesso un ritaglio di un foglio più grande. L'esportazione PNG di Figma può riempire di bianco lo sfondo: prima di caricarla, controllare che sia trasparente (per esempio aprendola sopra un fondo colorato).
- **Decorazioni dei profili** (note, chiave di violino, stelline): non sono contenuti, le disegna il sito. Per ogni profilo un file in `assets/images/decorazioni-<colore>`, grande quanto il riquadro del personaggio (445 × 361 in Figma, al doppio): le stelline di Famiglie, disegnate in Figma, sono un SVG; le note di Laura un WebP trasparente. Il sito le usa come maschera colorata da `--color-decorazione`, quindi sono sempre bianche sul colore.
- I doodle stanno solo vicino a illustrazioni o mascotte, mai accanto al testo, e solo nei colori di sistema.
