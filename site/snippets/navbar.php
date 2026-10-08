<?php
/**
 * Navigazione principale: logo a sinistra, voci a destra, una linea sotto (l'unico divisore della pagina).
 * Le voci sono la home (la presentazione) e le sezioni pubblicate che hanno una "Voce di menu"
 * (vedi docs/kirby.md): portano all'ancora, cioè al nome della cartella, anche dalle pagine dei profili.
 * Anche il logo porta a un'ancora (#home, la cima della pagina): così non ricarica la pagina e nessun
 * browser rimette lo scorrimento dov'era.
 * Su mobile le voci stanno dietro il pulsante menu; senza JavaScript restano sempre visibili.
 * Resta in alto mentre si scorre (sticky), su fondo verde salvia con testo bianco.
 */
$home = $site->homePage();
$voci = $home->children()->listed()->prepend($home)->filter(fn ($voce) => $voce->voce_menu()->isNotEmpty());
?>
<header class="navbar su-colore fondo-verde-salvia" data-navbar>
	<div class="contenitore navbar-riga">
		<a class="navbar-logo" href="<?= $site->url() ?>/#<?= $home->slug() ?>" aria-label="HAPPY, pagina iniziale">Happy</a>

		<button class="navbar-menu" type="button" aria-expanded="false" aria-controls="voci-navbar" data-menu-bottone>
			<span class="navbar-menu-icona" aria-hidden="true"></span>
			<span class="solo-screen-reader">Menu</span>
		</button>

		<nav class="navbar-voci" id="voci-navbar" aria-label="Principale">
			<ul>
				<?php foreach ($voci as $voce): ?>
					<li>
						<a class="navbar-voce" href="<?= $site->url() ?>/#<?= $voce->slug() ?>"><?= esc($voce->voce_menu()->value()) ?></a>
					</li>
				<?php endforeach ?>
			</ul>
		</nav>
	</div>
</header>
