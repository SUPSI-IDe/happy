<?php

return [
	// Sito in italiano. Il pannello è in italiano.
	'languages' => false,
	'panel' => [
		'language' => 'it',
	],
	// Sul computer di sviluppo (localhost) si vedono gli errori; online no
	'debug' => in_array($_SERVER['SERVER_NAME'] ?? '', ['localhost', '127.0.0.1'], true),
];
