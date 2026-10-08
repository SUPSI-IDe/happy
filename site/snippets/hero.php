<?php
/**
 * Hero della home: logo (l'unico h1), nome esteso, mascotte, video e presentazione "Cos'è Happy?".
 * Un solo HTML nell'ordine logo → video → presentazione; il CSS lo dispone (components.css, "Hero"):
 * - mobile: logo e video sul verde, la presentazione sotto, sul bianco;
 * - desktop: tutto sul verde in una schermata, presentazione nelle colonne 1–5 e video nelle 6–12.
 * Il logo è un SVG perché Fraunces molto grande si deforma; "Happy" resta leggibile dallo screen reader.
 */
$mascotte = $page->illustrazione()->toFile();
?>
<section class="hero su-colore fondo-verde-salvia" id="<?= $page->slug() ?>">
	<div class="contenitore griglia hero-griglia">
		<div class="hero-titolo">
			<h1 class="hero-logo">
				<span class="solo-screen-reader"><?= esc($page->title()) ?></span>
				<?= svg('assets/images/logo-happy.svg') ?>
			</h1>
			<?php if ($site->nome_esteso()->isNotEmpty()): ?>
				<p class="text-titolo-3 hero-sottotitolo"><?= esc($site->nome_esteso()->value()) ?></p>
			<?php endif ?>
			<?php if ($mascotte): ?>
				<img class="hero-mascotte" src="<?= $mascotte->url() ?>" alt="<?= esc($mascotte->alt()->value(), 'attr') ?>" width="<?= $mascotte->width() ?>" height="<?= $mascotte->height() ?>">
			<?php endif ?>
		</div>

		<?php // Segnaposto 16:9: il video si incorpora quando sarà scelta la piattaforma (docs/architecture.md) ?>
		<div class="hero-video" aria-hidden="true"></div>

		<div class="hero-presentazione">
			<h2 class="titolo-sezione"><?= esc($page->presentazione_titolo()) ?></h2>
			<?= $page->presentazione_testo()->kirbytext() ?>
		</div>
	</div>
</section>
