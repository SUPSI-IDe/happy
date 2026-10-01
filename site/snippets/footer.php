<?php
/**
 * Piè di pagina: partner e contatto. Partner ed email si modificano dal pannello (Sito → Piè di pagina).
 */
$email = $site->email_contatto()->value();
?>
<footer class="footer sezione">
	<div class="contenitore griglia">
		<div class="footer-partner">
			<p class="text-etichetta">In collaborazione con</p>
			<ul>
				<?php foreach ($site->partner()->toStructure() as $partner): ?>
					<li>
						<?php if ($partner->link()->isNotEmpty()): ?>
							<a href="<?= esc($partner->link()->value(), 'attr') ?>"><?= esc($partner->nome()->value()) ?></a>
						<?php else: ?>
							<?= esc($partner->nome()->value()) ?>
						<?php endif ?>
					</li>
				<?php endforeach ?>
			</ul>
		</div>

		<?php if ($email !== ''): ?>
			<div class="footer-contatto">
				<p>Per informazioni sul progetto HAPPY →</p>
				<p><a class="text-titolo-2" href="mailto:<?= esc($email, 'attr') ?>"><?= esc($email) ?></a></p>
			</div>
		<?php endif ?>
	</div>
</footer>
