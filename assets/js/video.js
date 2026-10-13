// Video della home (snippet hero): un grande tasto play sopra la copertina, più facile da vedere e da
// toccare del play del browser. Lo si mostra solo qui: senza JavaScript restano i controlli del browser.
// Premuto, il video parte e il focus passa al video, così la tastiera trova subito i suoi controlli.
// Il tasto torna alla fine del video.
const video = document.querySelector('[data-video]');
const play = document.querySelector('[data-play]');

if (video && play) {
	play.hidden = false;
	play.addEventListener('click', () => {
		video.play();
		video.focus();
	});
	video.addEventListener('play', () => (play.hidden = true));
	video.addEventListener('ended', () => (play.hidden = false));
}
