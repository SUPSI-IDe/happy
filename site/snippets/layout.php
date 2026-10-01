<?php
/**
 * Struttura comune a tutte le pagine: link "Vai al contenuto" (per la tastiera), navigazione,
 * <main id="contenuto"> con il contenuto della pagina (un solo h1) e piè di pagina.
 * Uso nei template: snippet('layout', slots: true) … endsnippet()
 */
$titolo = $page->isHomePage() ? 'HAPPY' : 'HAPPY – ' . $page->title();
?>
<!doctype html>
<html lang="it">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= esc($titolo) ?></title>
	<script>document.documentElement.classList.add('js');</script>
	<link rel="preload" href="<?= url('assets/fonts/urbanist.woff2') ?>" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="<?= url('assets/fonts/fraunces.woff2') ?>" as="font" type="font/woff2" crossorigin>
	<?= css(['assets/css/fonts.css', 'assets/css/tokens.css', 'assets/css/base.css', 'assets/css/layout.css', 'assets/css/components.css']) ?>
</head>
<body>
	<a class="salta-al-contenuto" href="#contenuto">Vai al contenuto</a>
	<?php snippet('navbar') ?>
	<main id="contenuto">
		<?= $slot ?>
	</main>
	<?php snippet('footer') ?>
	<?= js('assets/js/navbar.js', ['defer' => true]) ?>
</body>
</html>
