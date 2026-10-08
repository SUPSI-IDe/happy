// Avvia il sito in locale e controlla ogni pagina in content/. Uso: npm run check:pagine
// Per ogni pagina: risponde 200, lingua italiana, un solo <h1>, un solo <main>, titolo, link "Vai al contenuto".
// Serve PHP e `composer install` già fatto (vedi docs/kirby.md).

import { spawn } from 'node:child_process';
import { readdirSync } from 'node:fs';
import { join, relative } from 'node:path';

const RADICE = new URL('../', import.meta.url).pathname;
const PORTA = 8765;
const BASE = `http://localhost:${PORTA}`;

// Ogni cartella di content/ con un file .txt è una pagina. Il prefisso "1_" dell'ordine non è nell'indirizzo.
// Le cartelle dentro home/ sono sezioni della home, non pagine: si controllano con la home.
function elencaPagine(cartella) {
	const voci = readdirSync(cartella, { withFileTypes: true });
	const eUnaPagina = voci.some((v) => v.isFile() && v.name.endsWith('.txt'));
	if (cartella === join(RADICE, 'content', 'home')) return [cartella];
	const figlie = voci.filter((v) => v.isDirectory()).flatMap((v) => elencaPagine(join(cartella, v.name)));
	return eUnaPagina ? [cartella, ...figlie] : figlie;
}

const indirizzi = elencaPagine(join(RADICE, 'content')).filter((cartella) => cartella !== join(RADICE, 'content')).map((cartella) => {
	const percorso = relative(join(RADICE, 'content'), cartella).split('/').map((p) => p.replace(/^\d+_/, '')).join('/');
	return percorso === '' || percorso === 'home' ? '/' : `/${percorso}`;
});

const server = spawn('php', ['-S', `localhost:${PORTA}`, 'kirby/router.php'], { cwd: RADICE, stdio: 'ignore' });
let avviato = true;
server.on('error', () => (avviato = false));

const attendi = (ms) => new Promise((r) => setTimeout(r, ms));
async function pronto() {
	for (let i = 0; i < 40 && avviato; i++) {
		try {
			await fetch(BASE);
			return true;
		} catch {
			await attendi(250);
		}
	}
	return false;
}

const errori = [];
try {
	if (!(await pronto())) {
		console.error('Non riesco ad avviare PHP. Serve PHP 8.2 o più recente e `composer install` (vedi docs/kirby.md).');
		process.exit(1);
	}
	for (const indirizzo of indirizzi) {
		const risposta = await fetch(BASE + indirizzo);
		const html = await risposta.text();
		const conta = (regex) => (html.match(regex) ?? []).length;
		if (risposta.status !== 200) errori.push(`${indirizzo}  risposta ${risposta.status}`);
		if (!/<html lang="it"/.test(html)) errori.push(`${indirizzo}  manca lang="it"`);
		if (conta(/<h1[\s>]/g) !== 1) errori.push(`${indirizzo}  deve avere un solo <h1> (ne ha ${conta(/<h1[\s>]/g)})`);
		if (conta(/<main[\s>]/g) !== 1) errori.push(`${indirizzo}  deve avere un solo <main>`);
		if (!/<title>[^<]+<\/title>/.test(html)) errori.push(`${indirizzo}  manca il <title>`);
		if (!html.includes('class="salta-al-contenuto"')) errori.push(`${indirizzo}  manca il link "Vai al contenuto"`);
	}
} finally {
	server.kill();
}

if (errori.length) {
	console.error(errori.join('\n') + `\n\n${errori.length} problema/i in ${indirizzi.length} pagine.`);
	process.exit(1);
}
console.log(`Pagine ok: ${indirizzi.length} controllate (${indirizzi.join(', ')}).`);
