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
			<img class="sezione-illustrazione" src="<?= $illustrazione->url() ?>" alt="<?= esc($illustrazione->alt()->value(), 'attr') ?>" width="<?= $illustrazione->width() ?>" height="<?= $illustrazione->height() ?>">
		<?php endslot() ?>
	<?php endif ?>

	<?php slot() ?>
		<?= $sezione->testo()->kirbytext() ?>
		<?php if ($partecipa): ?>
			<?php snippet('bottone', ['href' => $site->partecipa_link()->value(), 'class' => 'sezione-azione'], slots: true) ?><?= esc($site->partecipa_testo()->value()) ?><?php endsnippet() ?>
		<?php endif ?>
	<?php endslot() ?>
<?php endsnippet() ?>
