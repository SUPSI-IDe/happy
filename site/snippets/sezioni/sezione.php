<?php
/**
 * Sezione di testo (tipo "sezione", per esempio Perché Happy?): testo, illustrazione sotto il titolo
 * e bottone "Partecipa" (testo e link in Sito → Generale). È anche lo snippet di riserva per i tipi
 * che non hanno ancora il loro: per loro mostra titolo e testo.
 */
$illustrazione = $sezione->illustrazione()->toFile();
$partecipa = $sezione->partecipa()->toBool() && $site->partecipa_link()->isNotEmpty();
?>
<?php snippet('sezione', ['sezione' => $sezione], slots: true) ?>
	<?php if ($illustrazione): ?>
		<?php slot('laterale') ?>
			<?php snippet('immagine', ['file' => $illustrazione, 'sizes' => '(min-width: 64rem) 37vw, 70vw', 'attr' => ['class' => 'sezione-illustrazione']]) ?>
		<?php endslot() ?>
	<?php endif ?>

	<?php slot() ?>
		<?= $sezione->testo()->kirbytext() ?>
		<?php if ($partecipa): ?>
			<?php snippet('bottone', ['href' => $site->partecipa_link()->value(), 'class' => 'sezione-azione'], slots: true) ?><?= $site->partecipa_testo()->esc() ?><?php endsnippet() ?>
		<?php endif ?>
	<?php endslot() ?>
<?php endsnippet() ?>
