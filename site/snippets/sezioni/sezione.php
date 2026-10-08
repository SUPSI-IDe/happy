<?php
/**
 * Sezione della home: fascia con l'ancora per il menu (#nome-della-cartella) e il titolo h2.
 * È lo snippet del tipo "sezione" (solo testo) e quello di riserva per i tipi che non hanno ancora il loro.
 */
?>
<section class="sezione" id="<?= $sezione->slug() ?>" aria-labelledby="titolo-<?= $sezione->slug() ?>">
	<div class="contenitore">
		<h2 class="titolo-sezione" id="titolo-<?= $sezione->slug() ?>"><?= esc($sezione->title()) ?></h2>
		<?= $sezione->testo()->kirbytext() ?>
	</div>
</section>
