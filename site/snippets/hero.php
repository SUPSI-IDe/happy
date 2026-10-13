<?php
/**
 * Hero della home: logo (l'unico h1), nome esteso, mascotte, video e presentazione "Cos'è Happy?".
 * Un solo HTML nell'ordine logo → video → presentazione; il CSS lo dispone (components.css, "Hero"):
 * - mobile: logo e video sul verde, la presentazione sotto, sul bianco;
 * - desktop: tutto sul verde in una schermata, presentazione nelle colonne 1–5 e video nelle 6–12.
 * Il logo è un SVG perché Fraunces molto grande si deforma; "Happy" resta leggibile dallo screen reader.
 * Il video compare solo con i suoi sottotitoli (regola d'oro). Non parte da solo e si scarica solo quando
 * si preme play (preload="none"): fino ad allora si vede la copertina. Senza video resta la copertina.
 */
$mascotte = $page->illustrazione()->toFile();
$copertina = $page->copertina()->toFile();
$video = $page->video()->toFile();
$sottotitoli = $page->sottotitoli()->toFile();
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
				<?php snippet('immagine', ['file' => $mascotte, 'sizes' => '(min-width: 64rem) 12.5rem, 6.25rem', 'subito' => true, 'attr' => ['class' => 'hero-mascotte']]) ?>
			<?php endif ?>
		</div>

		<?php if ($video && $sottotitoli): ?>
			<video class="hero-video" controls preload="none" playsinline <?= attr(['poster' => $copertina?->thumb(['width' => 1280, 'format' => 'webp'])->url()]) ?>>
				<source src="<?= $video->url() ?>" type="<?= $video->mime() ?>">
				<track kind="captions" src="<?= $sottotitoli->url() ?>" srclang="it" label="Italiano" default>
			</video>
		<?php elseif ($copertina): ?>
			<?php snippet('immagine', ['file' => $copertina, 'sizes' => '(min-width: 64rem) 53vw, 100vw', 'subito' => true, 'attr' => ['class' => 'hero-video']]) ?>
		<?php else: ?>
			<div class="hero-video hero-video--vuoto" aria-hidden="true"></div>
		<?php endif ?>

		<div class="hero-presentazione">
			<h2 class="titolo-sezione"><?= $page->presentazione_titolo()->esc() ?></h2>
			<?= $page->presentazione_testo()->kirbytext() ?>
		</div>
	</div>
</section>
