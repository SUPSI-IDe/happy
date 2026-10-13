// Carosello delle Fasi (snippet sezioni/fasi): mostra una fase alla volta, con le frecce (in giro: dopo
// l'ultima torna la prima) e i pallini. Nessun avanzamento automatico. Senza JavaScript le fasi restano
// un elenco, una sotto l'altra. Allo screen reader la fase nuova viene letta (aria-live) e il pallino
// della fase visibile è indicato con aria-current.
document.querySelectorAll('[data-fasi]').forEach((sezione) => {
	const controlli = sezione.querySelector('[data-fasi-controlli]');
	if (!controlli) return;

	const elenco = sezione.querySelector('.fasi-elenco');
	const fasi = [...elenco.children];
	const pallini = [...controlli.querySelectorAll('[data-fasi-vai]')];
	let attuale = 0;

	const mostra = (indice) => {
		attuale = (indice + fasi.length) % fasi.length;
		fasi.forEach((fase, i) => (fase.hidden = i !== attuale));
		// Le immagini si caricano solo quando servono: si preparano già quelle delle due fasi vicine
		[attuale - 1, attuale + 1].forEach((i) => {
			const immagine = fasi[(i + fasi.length) % fasi.length].querySelector('img');
			if (immagine) immagine.loading = 'eager';
		});
		pallini.forEach((pallino, i) => pallino.setAttribute('aria-current', String(i === attuale)));
	};

	controlli.addEventListener('click', (evento) => {
		const bottone = evento.target.closest('button');
		if (!bottone) return;
		mostra('fasiVai' in bottone.dataset ? Number(bottone.dataset.fasiVai) : attuale + Number(bottone.dataset.fasiPasso));
	});

	mostra(0);
	elenco.setAttribute('aria-live', 'polite');
	sezione.classList.add('fasi--carosello');
	controlli.hidden = false;
});
