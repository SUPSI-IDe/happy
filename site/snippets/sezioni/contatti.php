<?php
/**
 * Contatti: chiude la home prima del piè di pagina. Non usa lo snippet sezione, perché qui il titolo
 * è piccolo (aspetto titolo-2, senza segno) e a sinistra c'è la mascotte invece del titolo.
 * Desktop: mascotte centrata nelle colonne 1–5, testo nelle 7–12, centrati in altezza.
 * Mobile: titolo, testo, email e poi la mascotte, centrata.
 * L'email passa da Html::email(), che la codifica per renderla meno leggibile agli spammer.
 */
$id = $sezione->slug();
$illustrazione = $sezione->illustrazione()->toFile();
?>
<section class="sezione" id="<?= $id ?>" aria-labelledby="titolo-<?= $id ?>">
	<div class="contenitore griglia contatti">
		<div class="contatti-testo">
			<h2 class="text-titolo-2" id="titolo-<?= $id ?>"><?= esc($sezione->title()) ?></h2>
			<?= $sezione->testo()->kirbytext() ?>
			<?php if ($sezione->email()->isNotEmpty()): ?>
				<p><?= Html::email($sezione->email()->value()) ?></p>
			<?php endif ?>
		</div>
		<?php if ($illustrazione): ?>
			<img class="contatti-mascotte" src="<?= $illustrazione->url() ?>" alt="<?= esc($illustrazione->alt()->value(), 'attr') ?>" width="<?= $illustrazione->width() ?>" height="<?= $illustrazione->height() ?>">
		<?php endif ?>
	</div>
</section>
