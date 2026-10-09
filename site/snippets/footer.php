<?php
/**
 * Piè di pagina (wireframe v6, versione desktop): nome del progetto, contributo (testo e logo del
 * finanziatore), titolari, partner ("In collaborazione con"), link e copyright.
 * Tutto si modifica dal pannello: Sito → Piè di pagina (il nome esteso in Sito → Generale).
 * Mobile: in colonna, in quest'ordine. Desktop: griglia (components.css, "Footer").
 * Le etichette "Un progetto di" e "Contributo" non si vedono (come nel wireframe) ma danno il nome
 * agli elenchi di loghi per lo screen reader.
 * Fondo verde salvia: il testo è sempre bianco e bold (classe .su-colore, vedi base.css).
 */
$link = $site->piede_link()->toStructure();
?>
<footer class="piede su-colore fondo-verde-salvia">
	<div class="contenitore griglia piede-griglia">
		<div class="piede-marchio">
			<p class="piede-nome">Happy</p>
			<p class="piede-sottotitolo"><?= esc($site->nome_esteso()->value()) ?></p>
		</div>

		<div class="piede-gruppo piede-contributo">
			<p class="solo-screen-reader" id="piede-contributo"><?= esc($site->piede_contributo_etichetta()->value()) ?></p>
			<p><?= esc($site->piede_contributo_testo()->value()) ?></p>
			<?php snippet('loghi', ['loghi' => $site->piede_contributo_logo()->toFiles(), 'etichetta' => 'piede-contributo']) ?>
		</div>

		<div class="piede-titolari">
			<p class="solo-screen-reader" id="piede-titolari"><?= esc($site->piede_titolari_etichetta()->value()) ?></p>
			<?php snippet('loghi', ['loghi' => $site->piede_titolari()->toFiles(), 'etichetta' => 'piede-titolari']) ?>
		</div>

		<div class="piede-gruppo piede-partner">
			<p id="piede-partner"><?= esc($site->piede_partner_etichetta()->value()) ?></p>
			<?php snippet('loghi', ['loghi' => $site->piede_partner()->toFiles(), 'etichetta' => 'piede-partner']) ?>
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
			<p class="text-etichetta"><?= esc($site->piede_copyright()->value()) ?></p>
		</div>
	</div>
</footer>
