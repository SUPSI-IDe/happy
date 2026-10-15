<?php
/**
 * I membri di un gruppo del team (snippet sezioni/team), come elenco.
 * Se qualcuno ha un ruolo o un ente è un elenco di persone (nome in titolo-3, poi ruolo ed ente; su
 * desktop in due colonne). Altrimenti è un elenco di soli nomi (partner, scuole).
 * Il nome è un link se c'è il link. L'ente è solo testo, dal più piccolo al più grande (IDe, SUPSI DACD):
 * se un vecchio contenuto ha ancora dei link (prima era un campo writer), si tolgono. $id serve alla
 * tendina che apre e chiude l'elenco.
 */
$membri = $gruppo->membri()->toStructure();
$persone = $membri->filter(fn ($membro) => $membro->ruolo()->isNotEmpty() || $membro->ente()->isNotEmpty())->isNotEmpty();
?>
<ul <?= attr(['class' => $persone ? 'persone' : 'nomi', 'id' => $id ?? null]) ?>>
	<?php foreach ($membri as $membro): ?>
		<li>
			<?php $nome = $membro->nome()->esc() ?>
			<?php $classe = $persone ? 'text-titolo-3' : null ?>
			<?php if ($membro->link()->isNotEmpty()): ?>
				<a <?= attr(['class' => $classe, 'href' => $membro->link()->value()]) ?>><?= $nome ?></a>
			<?php else: ?>
				<span <?= attr(['class' => $classe]) ?>><?= $nome ?></span>
			<?php endif ?>
			<?php if ($persone && $dettagli = array_filter([$membro->ruolo()->esc(), esc(Str::unhtml($membro->ente()->value()))])): ?>
				<p><?= implode('<br>', $dettagli) ?></p>
			<?php endif ?>
		</li>
	<?php endforeach ?>
</ul>
