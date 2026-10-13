<?php
/**
 * Le fasi del progetto: un carosello delle fasi pubblicate, nell'ordine del pannello (wireframe v6,
 * frame 4-fase e 5.x). Il numero di ogni fase è la sua posizione. Non usa lo snippet sezione: qui
 * l'illustrazione della fase sta a destra del titolo della sezione, non sotto.
 * Senza JavaScript le fasi sono un elenco, una sotto l'altra; assets/js/fasi.js ne mostra una alla volta,
 * con le frecce e i pallini (components.css, "Fasi"). Nessun avanzamento automatico.
 * Le note accanto al titolo sono decorative (note su desktop, stelline su mobile, come nei wireframe).
 * La sezione è alta almeno uno schermo, con il contenuto al centro (layout.css, .sezione--schermo).
 */
$id = $sezione->slug();
$fasi = $sezione->children()->listed();
?>
<section class="sezione sezione--schermo" id="<?= $id ?>" aria-labelledby="titolo-<?= $id ?>">
	<div class="contenitore griglia fasi" data-fasi>
		<h2 class="titolo-sezione fasi-titolo" id="titolo-<?= $id ?>"><?= $sezione->title()->esc() ?></h2>

		<ol class="fasi-elenco">
			<?php foreach ($fasi as $fase): ?>
				<?php $numero = $fasi->indexOf($fase) + 1 ?>
				<?php $illustrazione = $fase->illustrazione()->toFile() ?>
				<li class="fase">
					<?php if ($illustrazione): ?>
						<img class="fase-immagine" src="<?= $illustrazione->url() ?>" alt="<?= $illustrazione->alt()->esc('attr') ?>" width="<?= $illustrazione->width() ?>" height="<?= $illustrazione->height() ?>" loading="lazy">
					<?php endif ?>
					<div class="fase-testo">
						<span class="fase-numero" aria-hidden="true"><?= $numero ?></span>
						<h3 class="text-titolo-2"><?= $fase->title()->esc() ?></h3>
						<?= $fase->descrizione()->kirbytext() ?>
					</div>
				</li>
			<?php endforeach ?>
		</ol>

		<?php if ($fasi->count() > 1): ?>
			<div class="fasi-controlli" hidden data-fasi-controlli>
				<button class="fasi-freccia" type="button" data-fasi-passo="-1">
					<span class="solo-screen-reader">Fase precedente</span>
				</button>
				<div class="fasi-pallini">
					<?php foreach ($fasi as $fase): ?>
						<?php $numero = $fasi->indexOf($fase) + 1 ?>
						<button class="fasi-pallino" type="button" data-fasi-vai="<?= $numero - 1 ?>">
							<span class="solo-screen-reader">Fase <?= $numero ?>: <?= $fase->title()->esc() ?></span>
						</button>
					<?php endforeach ?>
				</div>
				<button class="fasi-freccia fasi-freccia--avanti" type="button" data-fasi-passo="1">
					<span class="solo-screen-reader">Fase successiva</span>
				</button>
			</div>
		<?php endif ?>
	</div>
</section>
<?= js('assets/js/fasi.js', ['defer' => true]) ?>
