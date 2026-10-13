<?php
/**
 * Struttura comune a tutte le pagine: link "Vai al contenuto" (per la tastiera), navigazione,
 * <main id="contenuto"> con il contenuto della pagina (un solo h1) e piè di pagina.
 * Uso nei template: snippet('layout', slots: true) … endsnippet()
 * Con 'main' => 'classi' il <main> riceve delle classi, per esempio il fondo colorato di un profilo.
 * Nel <head>: titolo della scheda, descrizione e anteprima del link (Sito → Condivisione), favicon (la H
 * del logo su verde salvia: assets/images/favicon.svg, apple-touch-icon.png e favicon.ico nella radice).
 */
// Prima ciò che distingue la pagina: con molte schede aperte si legge quello, e lo screen reader lo dice per primo
$titolo = $page->isHomePage() ? $site->title() . ' – ' . $site->nome_esteso() : $page->title() . ' – ' . $site->title();
// Anteprima del link (Open Graph) e risultati di ricerca: la descrizione del profilo o quella del sito
$descrizione = $page->intro()->or($site->condivisione_testo())->excerpt(200);
$condivisione = $site->condivisione_immagine()->toFile();
?>
<!doctype html>
<html lang="it">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= esc($titolo) ?></title>
	<?php if ($descrizione): ?>
		<meta name="description" content="<?= esc($descrizione) ?>">
		<meta property="og:description" content="<?= esc($descrizione) ?>">
	<?php endif ?>
	<meta property="og:title" content="<?= esc($titolo) ?>">
	<meta property="og:type" content="website">
	<meta property="og:url" content="<?= $page->url() ?>">
	<meta property="og:locale" content="it_CH">
	<?php if ($condivisione): ?>
		<?php $anteprima = $condivisione->crop(1200, 630, ['format' => 'jpg']) ?>
		<meta property="og:image" content="<?= $anteprima->url() ?>">
		<meta property="og:image:width" content="1200">
		<meta property="og:image:height" content="630">
		<meta property="og:image:alt" content="<?= $condivisione->alt()->esc() ?>">
		<meta name="twitter:card" content="summary_large_image">
	<?php endif ?>
	<link rel="icon" href="<?= url('favicon.ico') ?>" sizes="32x32">
	<link rel="icon" href="<?= url('assets/images/favicon.svg') ?>" type="image/svg+xml">
	<link rel="apple-touch-icon" href="<?= url('assets/images/apple-touch-icon.png') ?>">
	<script>document.documentElement.classList.add('js');</script>
	<link rel="preload" href="<?= url('assets/fonts/urbanist.woff2') ?>" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="<?= url('assets/fonts/fraunces.woff2') ?>" as="font" type="font/woff2" crossorigin>
	<?= css(['assets/css/fonts.css', 'assets/css/tokens.css', 'assets/css/base.css', 'assets/css/layout.css', 'assets/css/components.css']) ?>
</head>
<body>
	<a class="salta-al-contenuto" href="#contenuto">Vai al contenuto</a>
	<?php snippet('navbar') ?>
	<main id="contenuto" <?= attr(['class' => $main ?? null]) ?>>
		<?= $slot ?>
	</main>
	<?php snippet('footer') ?>
	<?= js('assets/js/navbar.js', ['defer' => true]) ?>
</body>
</html>
