<?php
/**
 * A chi ci rivolgiamo: testo e, sotto, le card dei profili a tutta larghezza (components.css, "Card dei profili").
 * Le card sono le pagine "profilo" pubblicate, nell'ordine di Sito → Pagine. Ogni card è un solo link:
 * il nome del profilo e "Scopri di più" (testo nel pannello), e si apre in una nuova scheda (plugin
 * nuova-scheda). La macchia a matita del colore del profilo è decorativa e sta nel CSS. L'illustrazione chiude la sezione solo su mobile, come nel wireframe.
 */
$profili = $site->children()->listed()->filterBy('intendedTemplate', 'profilo');
$illustrazione = $sezione->illustrazione()->toFile();
?>
<?php snippet('sezione', ['sezione' => $sezione], slots: true) ?>
	<?php slot() ?>
		<?= $sezione->testo()->kirbytext() ?>
	<?php endslot() ?>

	<?php slot('sotto') ?>
		<?php if ($profili->isNotEmpty()): ?>
			<ul class="card-profili">
				<?php foreach ($profili as $profilo): ?>
					<li>
						<a class="card-profilo card-profilo--<?= $profilo->colore()->esc('attr') ?>" href="<?= $profilo->url() ?>" target="_blank">
							<span class="text-titolo-2"><?= $profilo->title()->esc() ?></span>
							<?php if ($sezione->scopri()->isNotEmpty()): ?>
								<span class="card-profilo-azione"><?= $sezione->scopri()->esc() ?></span>
							<?php endif ?>
						</a>
					</li>
				<?php endforeach ?>
			</ul>
		<?php endif ?>
		<?php if ($illustrazione): ?>
			<?php snippet('immagine', ['file' => $illustrazione, 'sizes' => '80vw', 'attr' => ['class' => 'destinatari-illustrazione']]) ?>
		<?php endif ?>
	<?php endslot() ?>
<?php endsnippet() ?>
