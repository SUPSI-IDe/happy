<?php
/**
 * Pagina Contatti: partner e email di contatto, modificabili dal pannello (pagina Contatti).
 */
$email = $page->email_contatto()->value();
?>
<?php snippet('layout', slots: true) ?>
	<section class="sezione">
		<div class="contenitore">
			<h1><?= esc($page->title()) ?></h1>
			<?= $page->intro()->kirbytext() ?>

			<div class="griglia">
				<div class="contatti-partner">
					<p class="text-etichetta">In collaborazione con</p>
					<ul>
						<?php foreach ($page->partner()->toStructure() as $partner): ?>
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
					<div class="contatti-email">
						<p>Per informazioni sul progetto HAPPY →</p>
						<p><a class="text-titolo-2" href="mailto:<?= esc($email, 'attr') ?>"><?= esc($email) ?></a></p>
					</div>
				<?php endif ?>
			</div>
		</div>
	</section>
<?php endsnippet() ?>
