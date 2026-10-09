<?php
/**
 * Piè di pagina (wireframe v6, versione desktop): nome del progetto, link e copyright, contributo
 * (testo e logo del finanziatore), titolari ("Un progetto di"), partner ("In collaborazione con").
 * Tutto si modifica dal pannello: Sito → Piè di pagina (il nome esteso in Sito → Generale).
 * Mobile: in colonna, in quest'ordine (i link restano sotto il nome a ogni larghezza).
 * Desktop: griglia (components.css, "Footer").
 * L'etichetta "Contributo" non si vede (il testo basta) ma dà il nome al logo per lo screen reader.
 * Fondo verde salvia: il testo è sempre bianco e bold (classe .su-colore, vedi base.css).
 */
$link = $site->piede_link()->toStructure();
?>
<footer class="piede su-colore fondo-verde-salvia">
	<div class="contenitore griglia piede-griglia">
		<div class="piede-marchio">
			<p class="piede-nome">Happy</p>
			<p class="piede-sottotitolo"><?= $site->nome_esteso()->esc() ?></p>
		</div>

		<div class="piede-info">
			<?php if ($link->isNotEmpty()): ?>
				<ul>
					<?php foreach ($link as $voce): ?>
						<li>
							<?php if ($voce->link()->isNotEmpty()): ?>
								<a href="<?= esc($voce->link()->toUrl(), 'attr') ?>"><?= $voce->testo()->esc() ?></a>
							<?php else: ?>
								<?= $voce->testo()->esc() ?>
							<?php endif ?>
						</li>
					<?php endforeach ?>
				</ul>
			<?php endif ?>
			<p class="text-etichetta"><?= $site->piede_copyright()->esc() ?></p>
		</div>

		<div class="piede-gruppo piede-contributo">
			<p class="solo-screen-reader" id="piede-contributo"><?= $site->piede_contributo_etichetta()->esc() ?></p>
			<p><?= $site->piede_contributo_testo()->esc() ?></p>
			<?php snippet('loghi', ['loghi' => $site->piede_contributo_logo()->toFiles(), 'etichetta' => 'piede-contributo']) ?>
		</div>

		<div class="piede-gruppo piede-titolari">
			<p id="piede-titolari"><?= $site->piede_titolari_etichetta()->esc() ?></p>
			<?php snippet('loghi', ['loghi' => $site->piede_titolari()->toFiles(), 'etichetta' => 'piede-titolari']) ?>
		</div>

		<div class="piede-gruppo piede-partner">
			<p id="piede-partner"><?= $site->piede_partner_etichetta()->esc() ?></p>
			<?php snippet('loghi', ['loghi' => $site->piede_partner()->toFiles(), 'etichetta' => 'piede-partner']) ?>
		</div>
	</div>
</footer>
