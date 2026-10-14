<?php
/**
 * I link che portano fuori dal sito (siti degli enti, DOI, questionario, crediti del video…) si aprono in
 * una nuova scheda, così chi legge non perde la pagina di HAPPY. Vale per tutti i link, anche quelli
 * scritti nei testi del pannello: la pagina finita passa di qui prima di essere inviata al browser.
 * Un link interno si apre in una nuova scheda solo se il componente lo chiede (target="_blank", per
 * esempio le card dei profili).
 * Chi usa lo screen reader non vede la nuova scheda aprirsi: ogni link così lo dice, con un testo nascosto
 * (WCAG 3.2.5, tecnica G201). rel="noopener": la pagina aperta non può toccare quella di HAPPY.
 */
use Kirby\Cms\Page;

const NUOVA_SCHEDA_AVVISO = '<span class="solo-screen-reader"> (si apre in una nuova scheda)</span>';

Kirby::plugin('happy/nuova-scheda', [
	'hooks' => [
		'page.render:after' => function (string $contentType, array $data, string $html, Page $page): string {
			if ($contentType !== 'html') {
				return $html;
			}

			$sito = parse_url(site()->url(), PHP_URL_HOST);

			return preg_replace_callback('/<a\b([^>]*)>(.*?)<\/a>/is', function (array $link) use ($sito): string {
				[$intero, $attributi, $testo] = $link;

				// Kirby scrive gli attributi con le entità (https&#x3A;&#x2F;&#x2F;…): si leggono decodificati
				preg_match('/\bhref="([^"]*)"/i', $attributi, $href);
				$indirizzo = html_entity_decode($href[1] ?? '', ENT_QUOTES | ENT_HTML5);
				$host = parse_url($indirizzo, PHP_URL_HOST);
				$esterno = in_array(parse_url($indirizzo, PHP_URL_SCHEME), ['http', 'https'], true) && $host !== $sito;
				$nuovaScheda = (bool)preg_match('/\btarget="_blank"/i', $attributi);

				if (!$esterno && !$nuovaScheda) {
					return $intero;
				}

				if (!$nuovaScheda) {
					$attributi .= ' target="_blank"';
				}
				if (!preg_match('/\brel="/i', $attributi)) {
					$attributi .= ' rel="noopener"';
				}

				return '<a' . $attributi . '>' . $testo . NUOVA_SCHEDA_AVVISO . '</a>';
			}, $html);
		},
	],
]);
