// Menu su mobile: il pulsante apre e chiude il menu a tutto schermo; Esc chiude e riporta il focus
// sul pulsante. Senza JavaScript le voci restano sempre visibili (vedi components.css).
(() => {
	const navbar = document.querySelector('[data-navbar]');
	const bottone = navbar?.querySelector('[data-menu-bottone]');
	if (!navbar || !bottone) return;

	// Il resto della pagina (link "Vai al contenuto", main, footer): sotto il menu aperto non si vede,
	// quindi non deve essere raggiungibile né con la tastiera né con lo screen reader
	const resto = document.querySelectorAll('body > :not([data-navbar])');

	const imposta = (aperto) => {
		navbar.toggleAttribute('data-aperto', aperto);
		bottone.setAttribute('aria-expanded', String(aperto));
		resto.forEach((elemento) => (elemento.inert = aperto));
	};

	bottone.addEventListener('click', () => imposta(!navbar.hasAttribute('data-aperto')));

	// Le voci portano a una sezione della stessa pagina: il menu si chiude, altrimenti la coprirebbe
	navbar.querySelectorAll('.navbar-voce').forEach((voce) => voce.addEventListener('click', () => imposta(false)));

	// Se lo schermo si allarga fino al desktop con il menu aperto, il menu si chiude
	const desktop = matchMedia('(min-width: 64rem)');
	desktop.addEventListener('change', () => desktop.matches && imposta(false));

	navbar.addEventListener('keydown', (evento) => {
		if (evento.key === 'Escape' && navbar.hasAttribute('data-aperto')) {
			imposta(false);
			bottone.focus();
		}
	});
})();
