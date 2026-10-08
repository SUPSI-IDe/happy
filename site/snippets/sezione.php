<?php
/**
 * Struttura comune delle sezioni della home (docs/design-tokens.md, "Spaziature e layout").
 * Desktop: titolo con il segno a pennello nelle colonne 1–5 (resta fermo mentre si scorre), contenuto
 * nelle colonne 7–12, allineati sulla linea di base. Mobile: tutto in colonna.
 * Uso negli snippet di sezioni/:
 *   snippet('sezione', ['sezione' => $sezione], slots: true)
 *     slot('laterale') … endslot()   facoltativo: sotto il titolo, per esempio un'illustrazione
 *     slot() … endslot()             il contenuto
 *   endsnippet()
 */
$id = $sezione->slug();
?>
<section class="sezione" id="<?= $id ?>" aria-labelledby="titolo-<?= $id ?>">
	<div class="contenitore griglia sezione-griglia">
		<div class="sezione-testata">
			<h2 class="titolo-sezione" id="titolo-<?= $id ?>"><?= esc($sezione->title()) ?></h2>
			<?= $slots->laterale() ?>
		</div>
		<div class="sezione-contenuto">
			<?= $slot ?>
		</div>
	</div>
</section>
