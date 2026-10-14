<?php
// Prepara la macchia a matita di una card dei profili: il testo bianco ha almeno 3:1 e la grana del tratto resta.
// Uso: php scripts/prepara-card.php macchia.png assets/images/card-<colore>.webp <colore di sistema, es. e06a1a> [chiaro] [scuro]
// La macchia è un PNG trasparente, orizzontale, al doppio della misura della card (672px di larghezza).
// Vedi docs/design-tokens.md, "Card dei profili".
//
// Il tratto è semitrasparente: sul bianco della pagina i punti più leggeri della matita sono molto più chiari
// del colore di sistema e il bianco sopra non si leggerebbe. Ogni punto della macchia prende il colore di
// sistema, più chiaro o più scuro secondo quanto è leggero il tratto in quel punto: il punto più leggero ha
// il contrasto "chiaro" (3.1 di default: 3:1 con un piccolo margine), il più pieno il contrasto "scuro".
// Così la grana della matita si vede su tutte le card allo stesso modo, invece di appiattirsi dove il colore
// andava scurito. Senza "scuro", la grana sta intorno al colore di sistema: ±8% di luminanza, come il blu.
// I buchi interni (quasi trasparenti ma chiusi dalla macchia) contano come macchia; il bordo esterno sfumato
// resta com'è.

[, $sorgente, $destinazione, $esadecimale] = $argv;
$sistema = sscanf($esadecimale, '%02x%02x%02x');
$lineare = fn ($v) => ($v /= 255) <= 0.03928 ? $v / 12.92 : (($v + 0.055) / 1.055) ** 2.4;
$luminanza = fn ($c) => 0.2126 * $lineare($c[0]) + 0.7152 * $lineare($c[1]) + 0.0722 * $lineare($c[2]);
$contrasto = fn ($c) => 1.05 / ($luminanza($c) + 0.05);
$mescola = fn ($a, $b, $t) => array_map(fn ($x, $y) => $x + ($y - $x) * $t, $a, $b);

// Il colore di sistema schiarito verso il bianco o scurito verso il nero fino al contrasto voluto (per bisezione)
$tinta = function (float $voluto) use ($sistema, $contrasto, $mescola): array {
	[$da, $a] = $voluto <= $contrasto($sistema) ? [[255, 255, 255], $sistema] : [$sistema, [0, 0, 0]];
	[$min, $max] = [0.0, 1.0];
	for ($i = 0; $i < 30; $i++) {
		$t = ($min + $max) / 2;
		$contrasto($mescola($da, $a, $t)) < $voluto ? $min = $t : $max = $t;
	}
	return $mescola($da, $a, $max);
};

$luce = 1.05 / $contrasto($sistema) - 0.05;
$chiaro = (float)($argv[4] ?? max(3.1, 1.05 / ($luce * 1.08 + 0.05)));
$scuro = (float)($argv[5] ?? max($chiaro, 1.05 / ($luce / 1.08 + 0.05)));

$img = imagecreatefrompng($sorgente);
$w = imagesx($img);
$h = imagesy($img);
$alfa = fn ($x, $y) => 1 - ((imagecolorat($img, $x, $y) >> 24) & 0x7F) / 127;

// Fuori dalla macchia: i punti quasi trasparenti raggiungibili dal bordo dell'immagine
$fuori = [];
$coda = [];
for ($x = 0; $x < $w; $x++) array_push($coda, [$x, 0], [$x, $h - 1]);
for ($y = 0; $y < $h; $y++) array_push($coda, [0, $y], [$w - 1, $y]);
while ($coda) {
	[$x, $y] = array_pop($coda);
	if (isset($fuori[$y * $w + $x]) || $alfa($x, $y) >= 0.2) continue;
	$fuori[$y * $w + $x] = true;
	foreach ([[1, 0], [-1, 0], [0, 1], [0, -1]] as [$dx, $dy]) {
		if ($x + $dx >= 0 && $y + $dy >= 0 && $x + $dx < $w && $y + $dy < $h) $coda[] = [$x + $dx, $y + $dy];
	}
}

// Quanto è pieno il tratto in ogni punto: la luminanza che il punto ha sul bianco della pagina
$pieno = [];
for ($y = 0; $y < $h; $y++) {
	for ($x = 0; $x < $w; $x++) {
		if (isset($fuori[$y * $w + $x])) continue;
		$p = imagecolorat($img, $x, $y);
		$a = $alfa($x, $y);
		$pieno[$y * $w + $x] = -$luminanza(array_map(fn ($c) => $c * $a + 255 * (1 - $a), [($p >> 16) & 255, ($p >> 8) & 255, $p & 255]));
	}
}
// Ogni punto prende il tono secondo la sua posizione tra tutti (il 30% più leggero, il 70%…), non secondo
// la distanza dagli estremi: quasi tutto il tratto è pieno, e così la grana si distribuisce su tutta la card
$ordinati = array_values($pieno);
sort($ordinati);
$quanti = count($ordinati);
$posizione = function (float $valore) use ($ordinati, $quanti): float {
	[$min, $max] = [0, $quanti];
	while ($min < $max) {
		$meta = intdiv($min + $max, 2);
		$ordinati[$meta] < $valore ? $min = $meta + 1 : $max = $meta;
	}
	return $min / $quanti;
};

// Una tavolozza di 256 toni tra chiaro e scuro, poi ogni punto prende il suo
$toni = array_map(fn ($i) => array_map('round', $tinta($chiaro + ($scuro - $chiaro) * $i / 255)), range(0, 255));

$uscita = imagecreatetruecolor($w, $h);
imagealphablending($uscita, false);
imagesavealpha($uscita, true);
for ($y = 0; $y < $h; $y++) {
	for ($x = 0; $x < $w; $x++) {
		if (!isset($pieno[$y * $w + $x])) {
			imagesetpixel($uscita, $x, $y, imagecolorat($img, $x, $y));
			continue;
		}
		$t = $posizione($pieno[$y * $w + $x]);
		// Opaco: l'aspetto non cambia (la card sta sempre sul bianco) e la compressione non sposta i colori
		imagesetpixel($uscita, $x, $y, imagecolorallocatealpha($uscita, ...[...$toni[(int)round($t * 255)], 0]));
	}
}

// Senza perdite: la compressione con perdita riporterebbe sotto 3:1 i punti vicini alla soglia
imagewebp($uscita, $destinazione, IMG_WEBP_LOSSLESS);
printf("%s: %d kB, contrasto da %.2f a %.2f\n", $destinazione, round(filesize($destinazione) / 1024), $chiaro, $scuro);
