<?php
/**
 * Un'immagine caricata dal pannello, nella misura che serve allo schermo. Kirby ne crea versioni WebP
 * più piccole (in media/, la prima volta che servono) e il browser sceglie quella adatta, con srcset e
 * sizes: un telefono non scarica l'originale. Nel pannello si carica sempre l'originale.
 * Si scarica solo quando ci si avvicina (loading="lazy"), tranne con 'subito' => true (la hero).
 * Uso: snippet('immagine', ['file' => $file, 'sizes' => '(min-width: 64rem) 37vw, 70vw', 'attr' => ['class' => '…']])
 *   sizes: quanto è larga l'immagine sulla pagina (le media query di sizes non leggono i token: valori in rem e vw)
 *   attr:  altri attributi, o sostituti (per esempio 'alt' => '' per un'immagine decorativa)
 */
$larghezze = [320, 640, 960, 1280, 1920];
$webp = fn (int $larghezza) => $file->thumb(['width' => $larghezza, 'format' => 'webp'])->url();

$attributi = [
	'alt'     => $file->alt()->value() ?? '',
	'width'   => $file->width(),
	'height'  => $file->height(),
	'loading' => ($subito ?? false) ? null : 'lazy',
];

if ($file->isResizable()) {
	// Solo le misure più piccole dell'originale, poi l'originale stesso (in WebP)
	$misure = [...array_filter($larghezze, fn ($larghezza) => $larghezza < $file->width()), $file->width()];
	$attributi['srcset'] = implode(', ', array_map(fn ($larghezza) => $webp($larghezza) . ' ' . $larghezza . 'w', $misure));
	$attributi['sizes'] = $sizes;
}

echo Html::img($file->isResizable() ? $webp($file->width()) : $file->url(), [...$attributi, ...($attr ?? [])]);
