<?php
// Prepara la macchia a matita di una card dei profili perché il testo bianco abbia almeno 3:1.
// Uso: php scripts/prepara-card.php macchia.png assets/images/card-<colore>.webp <colore di sistema, es. e06a1a>
// La macchia è un PNG trasparente, orizzontale, al doppio della misura della card (672px di larghezza).
// Vedi docs/design-tokens.md, "Card dei profili".
//
// Il tratto è semitrasparente: sul bianco della pagina il colore risulta più chiaro di quello di sistema.
// Ogni punto della macchia in cui il bianco non arriva a 3:1 si avvicina al colore di sistema, solo quanto
// basta; gli altri restano com'erano. I buchi interni (quasi trasparenti ma chiusi dalla macchia) contano
// come macchia; il bordo esterno sfumato resta com'è.

[, $sorgente, $destinazione, $esadecimale] = $argv;
$sistema = sscanf($esadecimale, '%02x%02x%02x');
$obiettivo = 3.1;
$lineare = fn ($v) => ($v /= 255) <= 0.03928 ? $v / 12.92 : (($v + 0.055) / 1.055) ** 2.4;
$contrasto = fn ($c) => 1.05 / (0.2126 * $lineare($c[0]) + 0.7152 * $lineare($c[1]) + 0.0722 * $lineare($c[2]) + 0.05);

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

$uscita = imagecreatetruecolor($w, $h);
imagealphablending($uscita, false);
imagesavealpha($uscita, true);
for ($y = 0; $y < $h; $y++) {
	for ($x = 0; $x < $w; $x++) {
		$p = imagecolorat($img, $x, $y);
		if (isset($fuori[$y * $w + $x])) {
			imagesetpixel($uscita, $x, $y, $p);
			continue;
		}
		// Il colore che il punto ha sul bianco della pagina, poi verso il colore di sistema finché serve
		$a = $alfa($x, $y);
		$visto = array_map(fn ($c) => $c * $a + 255 * (1 - $a), [($p >> 16) & 255, ($p >> 8) & 255, $p & 255]);
		for ($t = 0; $contrasto($colore = array_map(fn ($c, $s) => $c + ($s - $c) * $t, $visto, $sistema)) < $obiettivo && $t < 1; $t += 0.05);
		// Opaco: l'aspetto non cambia (la card sta sempre sul bianco) e la compressione non sposta i colori
		imagesetpixel($uscita, $x, $y, imagecolorallocatealpha($uscita, ...[...array_map('round', $colore), 0]));
	}
}

// Senza perdite: la compressione con perdita riporterebbe sotto 3:1 i punti vicini alla soglia
imagewebp($uscita, $destinazione, IMG_WEBP_LOSSLESS);
echo $destinazione . ': ' . round(filesize($destinazione) / 1024) . " kB\n";
