<?php
/**
 * Elenco di loghi del piè di pagina. Ogni logo ha il nome dell'ente come testo alternativo e, se c'è,
 * il link al suo sito. La larghezza viene dal pannello ("Larghezza su desktop", in px) e diventa rem;
 * su mobile la riduce --scala-loghi (tokens.css).
 * Uso: snippet('loghi', ['loghi' => $files, 'etichetta' => 'id dell'elemento che dà il nome alla lista'])
 */
?>
<ul class="loghi" aria-labelledby="<?= $etichetta ?>">
	<?php foreach ($loghi as $logo): ?>
		<?php $immagine = Html::img($logo->url(), [
			'alt'    => $logo->alt()->value(),
			'width'  => $logo->width(),
			'height' => $logo->height(),
			'style'  => $logo->larghezza()->isNotEmpty() ? '--larghezza: ' . $logo->larghezza()->toInt() / 16 . 'rem' : null,
		]) ?>
		<li>
			<?php if ($logo->link()->isNotEmpty()): ?>
				<a href="<?= $logo->link()->esc('attr') ?>"><?= $immagine ?></a>
			<?php else: ?>
				<?= $immagine ?>
			<?php endif ?>
		</li>
	<?php endforeach ?>
</ul>
