<?php
/**
 * Bottone o link con l'aspetto di un bottone. Con `href` diventa un <a>, senza un <button>.
 * Varianti: pieno (verde salvia, testo bianco) e contorno (colore del testo intorno; su un fondo
 * colorato .su-colore diventa bianco da solo). Vedi docs/design-tokens.md, "Bottoni, link e focus".
 *
 * Uso: snippet('bottone', ['href' => '/contatti', 'variante' => 'contorno'], slots: true) Testo endsnippet()
 */
$variante = $variante ?? 'pieno';
$classi = 'bottone bottone--' . $variante . (isset($class) ? ' ' . $class : '');
?>
<?php if (!empty($href)): ?>
	<a class="<?= esc($classi, 'attr') ?>" href="<?= esc($href, 'attr') ?>"><?= $slot ?></a>
<?php else: ?>
	<button class="<?= esc($classi, 'attr') ?>" type="button"><?= $slot ?></button>
<?php endif ?>
