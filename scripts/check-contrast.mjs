// Controlla che i colori di tokens.css rispettino le regole di contrasto WCAG 2.1 AA. Uso: npm run check:contrast
// Se cambi un colore e una coppia scende sotto la soglia, il controllo fallisce.
// Verifica le coppie di token, non le pagine reali: quelle si controllano con axe/Lighthouse.

import { readFileSync } from 'node:fs';

const css = readFileSync(new URL('../assets/css/tokens.css', import.meta.url), 'utf8');
const primoBlocco = css.split('@media')[0];
const variabili = Object.fromEntries([...primoBlocco.matchAll(/(--[\w-]+)\s*:\s*([^;]+);/g)].map((m) => [m[1], m[2].trim()]));

function risolvi(nome, visti = []) {
	if (visti.includes(nome)) throw new Error(`Riferimento circolare: ${[...visti, nome].join(' → ')}`);
	const valore = variabili[nome];
	if (valore === undefined) throw new Error(`Token mancante: ${nome}`);
	const alias = valore.match(/^var\((--[\w-]+)\)$/);
	return alias ? risolvi(alias[1], [...visti, nome]) : valore;
}

function luminanza(esadecimale) {
	const n = parseInt(esadecimale.slice(1), 16);
	return [(n >> 16) & 255, (n >> 8) & 255, n & 255]
		.map((v) => v / 255)
		.map((v) => (v <= 0.03928 ? v / 12.92 : ((v + 0.055) / 1.055) ** 2.4))
		.reduce((somma, v, i) => somma + v * [0.2126, 0.7152, 0.0722][i], 0);
}

function contrasto(a, b) {
	const [chiaro, scuro] = [luminanza(risolvi(a)), luminanza(risolvi(b))].sort((x, y) => y - x);
	return (chiaro + 0.05) / (scuro + 0.05);
}

const fondiColorati = ['--color-verde-salvia', '--color-rosa-insegnanti', '--color-arancione-famiglie', '--color-blu-professionisti'];

// [primo colore, secondo colore, minimo, perché]
const coppie = [
	['--color-testo', '--color-sfondo', 4.5, 'testo corrente su bianco'],
	['--color-link', '--color-sfondo', 3, 'link su bianco (solo 1.25rem in grassetto o più)'],
	['--color-link', '--color-testo', 3, 'il link si distingue dal testo che lo circonda'],
	['--color-focus-su-bianco', '--color-sfondo', 3, 'anello di focus su bianco'],
	...fondiColorati.map((fondo) => ['--color-testo-su-colore', fondo, 3, `testo su ${fondo.replace('--color-', '')} (solo testo grande)`]),
	...fondiColorati.map((fondo) => ['--color-focus-su-colore', fondo, 3, `anello di focus su ${fondo.replace('--color-', '')}`]),
];

let falliti = 0;
for (const [a, b, minimo, perche] of coppie) {
	const valore = contrasto(a, b);
	const ok = valore >= minimo;
	if (!ok) falliti++;
	console.log(`${ok ? 'ok    ' : 'FALLITO'} ${valore.toFixed(2).padStart(5)}:1 (minimo ${minimo})  ${perche}`);
}

if (falliti) {
	console.error(`\n${falliti} coppia/e sotto la soglia. Vedi docs/design-tokens.md, sezione "Cambiare un colore".`);
	process.exit(1);
}
console.log('\nContrasti ok.');
