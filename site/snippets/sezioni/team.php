<?php
/**
 * Il team: i gruppi pubblicati, nell'ordine del pannello (wireframe v6, frame "Il team" e "Team – tendine
 * aperte"). Il primo gruppo (il gruppo di progetto) è sempre visibile; gli altri sono tendine, come
 * quelle della Ricerca (components.css, "Tendine"; assets/js/tendine.js). I membri: snippet membri.
 */
$gruppi = $sezione->children()->listed();
$primo = $gruppi->first();
?>
<?php snippet('sezione', ['sezione' => $sezione], slots: true) ?>
	<?php slot() ?>
		<?php if ($primo): ?>
			<div class="gruppo">
				<h3 class="text-titolo-2"><?= $primo->title()->esc() ?></h3>
				<?php snippet('membri', ['gruppo' => $primo]) ?>
			</div>
		<?php endif ?>
		<?php if ($gruppi->count() > 1): ?>
			<div class="tendine">
				<?php foreach ($gruppi->not($primo) as $gruppo): ?>
					<?php $id = 'gruppo-' . $gruppo->slug() ?>
					<div class="tendina gruppo">
						<h3 class="text-titolo-2">
							<button class="tendina-bottone" type="button" aria-expanded="true" aria-controls="<?= $id ?>" data-tendina>
								<?= $gruppo->title()->esc() ?>
							</button>
						</h3>
						<?php snippet('membri', ['gruppo' => $gruppo, 'id' => $id]) ?>
					</div>
				<?php endforeach ?>
			</div>
		<?php endif ?>
	<?php endslot() ?>
<?php endsnippet() ?>
<?= js('assets/js/tendine.js', ['type' => 'module']) ?>
