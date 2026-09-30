// Controlla le regole d'oro del CSS. Uso: npm run check:css
//  - nessun valore in px (le misure sono in rem)
//  - nessun colore scritto a mano fuori da tokens.css
//  - ogni var(--…) usata deve essere definita da qualche parte
// Legge i file .css e i blocchi <style> dei file .astro in src/.

import { readdirSync, readFileSync } from 'node:fs';
import { join, relative } from 'node:path';

const RADICE = new URL('../src/', import.meta.url).pathname;
const FILE_TOKEN = 'styles/tokens.css';
const COLORI_CON_NOME = /\b(white|black|red|green|blue|gray|grey|yellow|orange|purple|pink|brown|silver|gold|navy|teal)\b/i;

function elencaFile(cartella) {
	return readdirSync(cartella, { withFileTypes: true }).flatMap((voce) => {
		const percorso = join(cartella, voce.name);
		if (voce.isDirectory()) return elencaFile(percorso);
		return /\.(css|astro)$/.test(voce.name) ? [percorso] : [];
	});
}

// Sostituisce i commenti con spazi, così i numeri di riga restano giusti
const senzaCommenti = (testo) => testo.replace(/\/\*[\s\S]*?\*\//g, (c) => c.replace(/[^\n]/g, ' '));

// Per i file .astro tiene solo il contenuto dei blocchi <style>
function estraiCss(percorso, testo) {
	if (percorso.endsWith('.css')) return testo;
	const righe = testo.split('\n').map(() => '');
	for (const blocco of testo.matchAll(/<style[^>]*>([\s\S]*?)<\/style>/g)) {
		const inizio = testo.slice(0, blocco.index).split('\n').length - 1;
		blocco[1].split('\n').forEach((riga, i) => {
			righe[inizio + i] = (righe[inizio + i] ?? '') + riga;
		});
	}
	return righe.join('\n');
}

const file = elencaFile(RADICE).map((percorso) => {
	const nome = relative(RADICE, percorso);
	return { nome, css: senzaCommenti(estraiCss(percorso, readFileSync(percorso, 'utf8'))) };
});

const definite = new Set(file.flatMap(({ css }) => [...css.matchAll(/(--[\w-]+)\s*:/g)].map((m) => m[1])));
const errori = [];

for (const { nome, css } of file) {
	const eToken = nome === FILE_TOKEN;
	css.split('\n').forEach((riga, i) => {
		const dove = `src/${nome}:${i + 1}`;
		if (/(?<![\w.-])-?\d*\.?\d+px\b/.test(riga)) errori.push(`${dove}  misura in px: usa rem`);
		if (!eToken) {
			if (riga.includes(';') && /#[0-9a-f]{3,8}\b/i.test(riga))
				errori.push(`${dove}  colore esadecimale: usa un token di tokens.css`);
			if (/\b(rgb|rgba|hsl|hsla)\(/i.test(riga)) errori.push(`${dove}  colore rgb/hsl: usa un token di tokens.css`);
			for (const m of riga.matchAll(/(?:color|background|border|outline|fill|stroke)[\w-]*\s*:\s*([^;]*)/gi)) {
				if (COLORI_CON_NOME.test(m[1].replace(/var\([^)]*\)/g, ''))) errori.push(`${dove}  colore con nome: usa un token di tokens.css`);
			}
		}
		for (const m of riga.matchAll(/var\((--[\w-]+)/g)) {
			if (!definite.has(m[1])) errori.push(`${dove}  variabile non definita: ${m[1]}`);
		}
	});
}

if (errori.length) {
	console.error(errori.join('\n'));
	console.error(`\n${errori.length} problema/i trovati in ${file.length} file.`);
	process.exit(1);
}
console.log(`CSS ok: ${file.length} file controllati (px, colori scritti a mano, variabili non definite).`);
