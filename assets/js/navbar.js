// Menu su mobile: il pulsante apre e chiude le voci; Esc chiude e riporta il focus sul pulsante.
// Senza JavaScript le voci restano sempre visibili (vedi components.css).
(() => {
	const navbar = document.querySelector('[data-navbar]');
	const bottone = navbar?.querySelector('[data-menu-bottone]');
	if (!navbar || !bottone) return;

	const imposta = (aperto) => {
		navbar.toggleAttribute('data-aperto', aperto);
		bottone.setAttribute('aria-expanded', String(aperto));
	};

	bottone.addEventListener('click', () => imposta(!navbar.hasAttribute('data-aperto')));

	navbar.addEventListener('keydown', (evento) => {
		if (evento.key === 'Escape' && navbar.hasAttribute('data-aperto')) {
			imposta(false);
			bottone.focus();
		}
	});
})();
