<?php snippet('layout', slots: true) ?>
	<section class="sezione">
		<div class="contenitore">
			<h1><?= esc($page->title()) ?></h1>
			<?php if ($page->intro()->isNotEmpty()): ?>
				<?= $page->intro()->kirbytext() ?>
			<?php endif ?>
			<?= $page->testo()->kirbytext() ?>
		</div>
	</section>
<?php endsnippet() ?>
