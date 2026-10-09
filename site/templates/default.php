<?php snippet('layout', slots: true) ?>
	<section class="sezione">
		<div class="contenitore">
			<h1><?= $page->title()->esc() ?></h1>
			<?php if ($page->intro()->isNotEmpty()): ?>
				<?= $page->intro()->kirbytext() ?>
			<?php endif ?>
			<?= $page->testo()->kirbytext() ?>
		</div>
	</section>
<?php endsnippet() ?>
