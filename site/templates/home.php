<?php
/**
 * Home: la hero (snippet hero) e poi le sezioni pubblicate, nell'ordine del pannello.
 * Ogni sezione si disegna con lo snippet del suo tipo (sezioni/ricerca, sezioni/team…);
 * se non esiste ancora, con quello generico sezioni/sezione.
 */
?>
<?php snippet('layout', slots: true) ?>
	<?php snippet('hero') ?>

	<?php foreach ($page->children()->listed() as $sezione): ?>
		<?php snippet(['sezioni/' . $sezione->intendedTemplate()->name(), 'sezioni/sezione'], ['sezione' => $sezione]) ?>
	<?php endforeach ?>
<?php endsnippet() ?>
