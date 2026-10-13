<?php
/**
 * La Ricerca: testo e i temi pubblicati come tendine (wireframe v6, frame "La Ricerca" e "tendine aperte").
 * Di ogni tema si vedono sempre lo strumento, il titolo e l'anteprima; aprendo la tendina, il resto del
 * testo (nello stesso paragrafo) e i riferimenti, con il link al DOI sul titolo dell'articolo.
 * Il titolo è un bottone dentro l'h3 (schema "accordion" delle WAI-ARIA Authoring Practices).
 * Senza JavaScript le tendine restano aperte: le chiude assets/js/tendine.js (components.css, "Tendine").
 */
$temi = $sezione->children()->listed();
?>
<?php snippet('sezione', ['sezione' => $sezione], slots: true) ?>
	<?php slot() ?>
		<?= $sezione->testo()->kirbytext() ?>
		<div class="tendine">
			<?php foreach ($temi as $tema): ?>
				<?php
				$id = 'tema-' . $tema->slug();
				$strumento = $tema->illustrazione()->toFile();
				$riferimenti = $tema->riferimenti()->toStructure();
				// Le parti che la tendina apre e chiude: la continuazione del testo e i riferimenti, se ci sono
				$parti = array_filter([
					$tema->testo()->isNotEmpty() ? $id . '-testo' : null,
					$riferimenti->isNotEmpty() ? $id . '-riferimenti' : null,
				]);
				?>
				<div class="tendina">
					<h3 class="text-titolo-3">
						<button class="tendina-bottone" type="button" <?= attr(['aria-expanded' => $parti ? 'true' : null, 'aria-controls' => implode(' ', $parti) ?: null, 'data-tendina' => $parti ? true : null]) ?>>
							<span class="tendina-titolo">
								<?php if ($strumento): ?>
									<img src="<?= $strumento->url() ?>" alt="" width="<?= round($strumento->width() / 2) ?>" height="<?= round($strumento->height() / 2) ?>">
								<?php endif ?>
								<?= $tema->title()->esc() ?>
							</span>
						</button>
					</h3>
					<p>
						<?= $tema->anteprima()->kirbytextinline() ?>
						<?php if ($tema->testo()->isNotEmpty()): ?>
							<span id="<?= $id ?>-testo"><?= $tema->testo()->kirbytextinline() ?></span>
						<?php endif ?>
					</p>
					<?php if ($riferimenti->isNotEmpty()): ?>
						<div class="tendina-riferimenti" id="<?= $id ?>-riferimenti">
							<h4 class="text-etichetta"><?= $sezione->riferimenti_titolo()->or('Riferimenti')->esc() ?></h4>
							<ul>
								<?php foreach ($riferimenti as $riferimento): ?>
									<li>
										<?= $riferimento->autori()->esc() ?>
										<?php if ($riferimento->link()->isNotEmpty()): ?>
											<a href="<?= $riferimento->link()->esc('attr') ?>"><?= $riferimento->titolo()->esc() ?></a>
										<?php else: ?>
											<?= $riferimento->titolo()->esc() ?>
										<?php endif ?>
										<?= $riferimento->fonte()->esc() ?>
									</li>
								<?php endforeach ?>
							</ul>
						</div>
					<?php endif ?>
				</div>
			<?php endforeach ?>
		</div>
	<?php endslot() ?>
<?php endsnippet() ?>
<?= js('assets/js/tendine.js', ['defer' => true]) ?>
