<?php
/**
 * Navigazione principale: logo a sinistra, voci a destra, una linea sotto (l'unico divisore della pagina).
 * Le voci sono le pagine "pubblicate" di primo livello: ordine e nomi si cambiano dal pannello.
 * Su mobile le voci stanno dietro il pulsante menu; senza JavaScript restano sempre visibili.
 * Il colore del testo segue il fondo: carbone su bianco, bianco dentro un .su-colore.
 */
?>
<header class="navbar" data-navbar>
	<div class="contenitore navbar-riga">
		<a class="navbar-logo" href="<?= $site->url() ?>" aria-label="HAPPY, pagina iniziale">Happy</a>

		<button class="navbar-menu" type="button" aria-expanded="false" aria-controls="voci-navbar" data-menu-bottone>
			<span class="navbar-menu-icona" aria-hidden="true"></span>
			<span class="solo-screen-reader">Menu</span>
		</button>

		<nav class="navbar-voci" id="voci-navbar" aria-label="Principale">
			<ul>
				<?php foreach ($site->children()->listed() as $voce): ?>
					<li>
						<a class="navbar-voce" href="<?= $voce->url() ?>"<?= $voce->isOpen() ? ' aria-current="page"' : '' ?>><?= esc($voce->title()) ?></a>
					</li>
				<?php endforeach ?>
			</ul>
		</nav>
	</div>
</header>
