<?php
$files = array_map("basename", glob("resources/lang/en/*.php"));
foreach ($files as $f) {
$en = include "resources/lang/en/" . $f;
$ar = file_exists("resources/lang/ar/" . $f) ? include "resources/lang/ar/" . $f : [];
$rii = new RecursiveIteratorIterator(new RecursiveArrayIterator($en));
$miss = [];
foreach ($rii as $k => $v) {
$keys = [];
for ($d = 0; $d <= $rii->getDepth(); $d++) {
$keys[] = $rii->getSubIterator($d)->key();
}
$ref = $ar;
$ok = true;
foreach ($keys as $kk) {
if (!is_array($ref) || !array_key_exists($kk, $ref)) {
$ok = false; break;
}
$ref = $ref[$kk];
}
if (!$ok) { $miss[] = implode(".", $keys); }
}
if ($miss) {
echo $f, "\n";
foreach ($miss as $m) { echo "  - ", $m, "\n"; }
}
}
?>
