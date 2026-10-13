// Tendine (snippet sezioni/ricerca): il bottone nel titolo apre e chiude le parti che controlla
// (aria-controls) e dice allo screen reader se la tendina è aperta (aria-expanded).
// Senza JavaScript le tendine restano aperte: qui si chiudono all'avvio.
document.querySelectorAll('[data-tendina]').forEach((bottone) => {
	const parti = bottone.getAttribute('aria-controls').split(' ').map((id) => document.getElementById(id));

	const imposta = (aperta) => {
		bottone.setAttribute('aria-expanded', String(aperta));
		parti.forEach((parte) => (parte.hidden = !aperta));
	};

	bottone.addEventListener('click', () => imposta(bottone.getAttribute('aria-expanded') !== 'true'));
	imposta(false);
});
