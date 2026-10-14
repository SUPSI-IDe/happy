<?php
/**
 * CSS e JavaScript del sito con la data dell'ultima modifica nell'indirizzo (assets/css/base.css?v=…).
 * Il browser tiene questi file in memoria (cache): senza la data, dopo un aggiornamento chi ha già
 * visitato il sito userebbe ancora quelli vecchi, con il nuovo HTML, e la pagina si romperebbe. Quando
 * un file cambia, cambia il suo indirizzo e il browser lo scarica di nuovo. Vale per tutti i css() e js().
 */
use Kirby\Cms\App;

$versione = function (App $kirby, string $url): string {
	$file = $kirby->root('index') . '/' . ltrim($url, '/');
	return is_file($file) ? $url . '?v=' . filemtime($file) : $url;
};

Kirby::plugin('happy/versioni', [
	'components' => [
		'css' => $versione,
		'js'  => $versione,
	],
]);
