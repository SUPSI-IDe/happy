// Tendine (snippet sezioni/ricerca e sezioni/team): il bottone nel titolo apre e chiude le parti che
// controlla (aria-controls) e dice allo screen reader se la tendina è aperta (aria-expanded).
// Senza JavaScript le tendine restano aperte: qui si chiudono all'avvio.
// Si carica come modulo (type="module"): lo caricano due sezioni, ma il browser esegue un modulo una
// volta sola. Come script normale girerebbe due volte e ogni clic aprirebbe e richiuderebbe la tendina.
document.querySelectorAll('[data-tendina]').forEach((bottone) => {
	const parti = bottone.getAttribute('aria-controls').split(' ').map((id) => document.getElementById(id));

	const imposta = (aperta) => {
		bottone.setAttribute('aria-expanded', String(aperta));
		parti.forEach((parte) => (parte.hidden = !aperta));
	};

	bottone.addEventListener('click', () => imposta(bottone.getAttribute('aria-expanded') !== 'true'));
	imposta(false);
});
