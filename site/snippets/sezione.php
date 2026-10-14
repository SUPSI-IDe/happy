<?php
/**
 * Struttura comune delle sezioni della home (docs/design-tokens.md, "Spaziature e layout").
 * Desktop: titolo con il segno a pennello nelle colonne 1–5 (resta fermo mentre si scorre), contenuto
 * nelle colonne 7–12, allineati sulla linea di base. Mobile: tutto in colonna.
 * Una sottosezione ("Parte della sezione precedente" nel pannello, per esempio Vuoi partecipare? dentro
 * Perché Happy?) ha il titolo di un livello sotto: un h3 con l'aspetto titolo-2, senza segno a pennello,
 * e sta più vicina alla sezione sopra (layout.css, .sezione--sotto).
 * Uso negli snippet di sezioni/:
 *   snippet('sezione', ['sezione' => $sezione], slots: true)
 *     slot('laterale') … endslot()   facoltativo: sotto il titolo, per esempio un'illustrazione
 *     slot() … endslot()             il contenuto
 *     slot('sotto') … endslot()      facoltativo: sotto titolo e contenuto, a tutta larghezza (le card dei profili)
 *   endsnippet()
 */
$id = $sezione->slug();
$sottosezione = $sezione->sottosezione()->toBool();
?>
<section <?= attr(['class' => $sottosezione ? 'sezione sezione--sotto' : 'sezione']) ?> id="<?= $id ?>" aria-labelledby="titolo-<?= $id ?>">
	<div class="contenitore griglia sezione-griglia">
		<div class="sezione-testata">
			<?php if ($sottosezione): ?>
				<h3 class="text-titolo-2" id="titolo-<?= $id ?>"><?= $sezione->title()->esc() ?></h3>
			<?php else: ?>
				<h2 class="titolo-sezione" id="titolo-<?= $id ?>"><?= $sezione->title()->esc() ?></h2>
			<?php endif ?>
			<?= $slots->laterale() ?>
		</div>
		<div class="sezione-contenuto">
			<?= $slot ?>
		</div>
		<?php if ($sotto = $slots->sotto()): ?>
			<div class="sezione-sotto"><?= $sotto ?></div>
		<?php endif ?>
	</div>
</section>
