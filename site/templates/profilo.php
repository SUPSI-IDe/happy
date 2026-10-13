<?php
/**
 * Pagina di un profilo (wireframe v6, frame 3.x desktop e 4.x mobile), tutta nel colore del profilo,
 * anche la navbar. Desktop: titolo | introduzione, poi illustrazione | come partecipare. Mobile: in colonna.
 * L'etichetta sopra il titolo è il nome della sezione da cui si arriva (A chi ci rivolgiamo).
 * L'illustrazione è il personaggio (dal pannello); le note intorno sono decorazioni del sito, disegnate
 * sopra nello stesso riquadro (components.css, "Pagine dei profili").
 * Senza link al sondaggio il bottone non compare; senza titolo la seconda parte non ha l'h2 (mai un titolo vuoto).
 */
$colore = $page->colore()->esc('attr');
$destinatari = $site->homePage()->childrenAndDrafts()->filterBy('intendedTemplate', 'destinatari')->first();
$illustrazione = $page->illustrazione()->toFile();
?>
<?php snippet('layout', ['main' => 'su-colore fondo-' . $colore], slots: true) ?>
	<div class="contenitore griglia profilo">
		<div class="profilo-apertura">
			<div class="profilo-titolo">
				<?php if ($destinatari): ?>
					<p class="text-etichetta"><?= $destinatari->title()->esc() ?></p>
				<?php endif ?>
				<h1><?= $page->title()->esc() ?></h1>
			</div>
			<div class="profilo-intro">
				<?= $page->intro()->kirbytext() ?>
			</div>
		</div>

		<?php if ($illustrazione): ?>
			<div class="profilo-illustrazione profilo-illustrazione--<?= $colore ?>">
				<?php snippet('immagine', ['file' => $illustrazione, 'sizes' => '(min-width: 64rem) 28rem, 19rem']) ?>
			</div>
		<?php endif ?>

		<section class="profilo-partecipa" <?= attr(['aria-labelledby' => $page->partecipa_titolo()->isNotEmpty() ? 'partecipa' : null]) ?>>
			<?php if ($page->partecipa_titolo()->isNotEmpty()): ?>
				<h2 class="text-titolo-2" id="partecipa"><?= $page->partecipa_titolo()->esc() ?></h2>
			<?php endif ?>
			<?= $page->partecipa_testo()->kirbytext() ?>
			<?php if ($page->sondaggio_link()->isNotEmpty()): ?>
				<?php snippet('bottone', ['href' => $page->sondaggio_link()->value(), 'variante' => 'contorno', 'class' => 'profilo-sondaggio'], slots: true) ?><?= $page->sondaggio_testo()->esc() ?><?php endsnippet() ?>
			<?php endif ?>
			<?= $page->partecipa_altro()->kirbytext() ?>
		</section>
	</div>
<?php endsnippet() ?>
