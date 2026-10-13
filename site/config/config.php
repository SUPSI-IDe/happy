<?php

return [
	// Sito in italiano. Il pannello è in italiano.
	'languages' => false,
	'panel' => [
		'language' => 'it',
	],
	// Sul computer di sviluppo (localhost) si vedono gli errori; online no
	'debug' => in_array($_SERVER['SERVER_NAME'] ?? '', ['localhost', '127.0.0.1'], true),
	// Le versioni ridotte delle immagini (snippet immagine): qualità 80, invisibile alla vista ma molto più leggera
	'thumbs' => [
		'quality' => 80,
	],
	'routes' => [
		// Le sezioni della home non sono pagine a sé: /home/ricerca (anche dall'anteprima del pannello) porta a /#ricerca
		[
			'pattern' => 'home/(:all)',
			'action'  => fn (string $percorso) => go(site()->url() . '/#' . explode('/', $percorso)[0]),
		],
	],
];
