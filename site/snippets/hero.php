<?php
/**
 * Hero della home: logo (l'unico h1), nome esteso, mascotte, video e presentazione "Cos'è Happy?".
 * Un solo HTML nell'ordine logo → video → presentazione; il CSS lo dispone (components.css, "Hero"):
 * - mobile: logo e video sul verde, la presentazione sotto, sul bianco;
 * - desktop: tutto sul verde in una schermata, presentazione nelle colonne 1–5 e video nelle 6–12.
 * Il logo è un SVG perché Fraunces molto grande si deforma; "Happy" resta leggibile dallo screen reader.
 */
$mascotte = $page->illustrazione()->toFile();
$copertina = $page->copertina()->toFile();
?>
<section class="hero su-colore fondo-verde-salvia" id="<?= $page->slug() ?>">
	<div class="contenitore griglia hero-griglia">
		<div class="hero-titolo">
			<h1 class="hero-logo">
				<span class="solo-screen-reader"><?= $page->title()->esc() ?></span>
				<?= svg('assets/images/logo-happy.svg') ?>
			</h1>
			<?php if ($site->nome_esteso()->isNotEmpty()): ?>
				<p class="text-titolo-3 hero-sottotitolo"><?= $site->nome_esteso()->esc() ?></p>
			<?php endif ?>
			<?php if ($mascotte): ?>
				<img class="hero-mascotte" src="<?= $mascotte->url() ?>" alt="<?= $mascotte->alt()->esc('attr') ?>" width="<?= $mascotte->width() ?>" height="<?= $mascotte->height() ?>">
			<?php endif ?>
		</div>

		<?php // Il video si incorpora quando sarà scelta la piattaforma (docs/architecture.md): fino ad allora
		      // al suo posto c'è l'immagine del video, poi diventerà la sua copertina ?>
		<?php if ($copertina): ?>
			<img class="hero-video" src="<?= $copertina->url() ?>" alt="<?= $copertina->alt()->esc('attr') ?>" width="<?= $copertina->width() ?>" height="<?= $copertina->height() ?>">
		<?php else: ?>
			<div class="hero-video hero-video--vuoto" aria-hidden="true"></div>
		<?php endif ?>

		<div class="hero-presentazione">
			<h2 class="titolo-sezione"><?= $page->presentazione_titolo()->esc() ?></h2>
			<?= $page->presentazione_testo()->kirbytext() ?>
		</div>
	</div>
</section>
