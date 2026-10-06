<?php
/**
 * Piè di pagina: nome del progetto, chi c'è dietro, loghi, link e copyright.
 * Tutti i testi si modificano dal pannello (Sito → Piè di pagina).
 * Fondo verde salvia: il testo è sempre bianco e bold (classe .su-colore, vedi base.css).
 */
$link = $site->piede_link()->toStructure();
?>
<footer class="piede su-colore fondo-verde-salvia">
	<div class="contenitore griglia">
		<div class="piede-progetto">
			<div>
				<p class="piede-nome">Happy</p>
				<?php if ($site->piede_nome_esteso()->isNotEmpty()): ?>
					<p><?= esc($site->piede_nome_esteso()->value()) ?></p>
				<?php endif ?>
			</div>

			<?php if ($site->piede_testo()->isNotEmpty()): ?>
				<p><?= esc($site->piede_testo()->value()) ?></p>
			<?php endif ?>

			<?php if ($site->piede_loghi()->toFiles()->isNotEmpty()): ?>
				<ul class="piede-loghi">
					<?php foreach ($site->piede_loghi()->toFiles() as $logo): ?>
						<li><img src="<?= $logo->url() ?>" alt="<?= esc($logo->alt()->value(), 'attr') ?>"></li>
					<?php endforeach ?>
				</ul>
			<?php endif ?>
		</div>

		<div class="piede-info">
			<?php if ($link->isNotEmpty()): ?>
				<ul>
					<?php foreach ($link as $voce): ?>
						<li>
							<?php if ($voce->link()->isNotEmpty()): ?>
								<a href="<?= esc($voce->link()->toUrl(), 'attr') ?>"><?= esc($voce->testo()->value()) ?></a>
							<?php else: ?>
								<?= esc($voce->testo()->value()) ?>
							<?php endif ?>
						</li>
					<?php endforeach ?>
				</ul>
			<?php endif ?>
			<?php if ($site->piede_copyright()->isNotEmpty()): ?>
				<p><?= esc($site->piede_copyright()->value()) ?></p>
			<?php endif ?>
		</div>
	</div>
</footer>
