<?php
/**
 * Home: la hero e poi le sezioni pubblicate, nell'ordine del pannello.
 * La hero contiene il logo (l'unico h1: un SVG, perché Fraunces molto grande si deforma), la mascotte,
 * il video e la presentazione "Cos'è Happy?": su desktop stanno nella stessa schermata.
 * Ogni sezione si disegna con lo snippet del suo tipo (sezioni/ricerca, sezioni/team…);
 * se non esiste ancora, con quello generico sezioni/sezione.
 */
?>
<?php snippet('layout', slots: true) ?>
	<section class="sezione" id="<?= $page->slug() ?>">
		<div class="contenitore">
			<h1>
				<span class="solo-screen-reader"><?= esc($page->title()) ?></span>
				<?= svg('assets/images/logo-happy.svg') ?>
			</h1>
			<?php if ($site->nome_esteso()->isNotEmpty()): ?>
				<p><?= esc($site->nome_esteso()->value()) ?></p>
			<?php endif ?>

			<h2><?= esc($page->presentazione_titolo()) ?></h2>
			<?= $page->presentazione_testo()->kirbytext() ?>
		</div>
	</section>

	<?php foreach ($page->children()->listed() as $sezione): ?>
		<?php snippet(['sezioni/' . $sezione->intendedTemplate()->name(), 'sezioni/sezione'], ['sezione' => $sezione]) ?>
	<?php endforeach ?>
<?php endsnippet() ?>
