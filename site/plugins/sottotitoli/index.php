<?php
/**
 * Kirby non conosce i file .vtt (sottotitoli) e li rifiuta al caricamento: qui li registriamo
 * come documenti di tipo text/vtt, così si caricano dal pannello come le immagini.
 */
Kirby::plugin('happy/sottotitoli', [
	'fileTypes' => [
		'vtt' => ['mime' => 'text/vtt', 'type' => 'document'],
	],
]);
