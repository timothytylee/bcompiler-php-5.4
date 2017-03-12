<?php

function compile($sname, $tname = '') {
  if ($tname == '') $tname = preg_replace("!\.php!", ".phb", $sname);
  echo " * source file: $sname\n * target file: $tname\n";
  ob_end_flush();
  $f = fopen($tname, "w");
  bcompiler_write_header($f);
  bcompiler_write_file($f, $sname);
  bcompiler_write_footer($f);
  fclose($f);
  echo " > compiled\n";
}

for ($i = 1; $i < $_SERVER['argc']; $i++) {
  $sname = $_SERVER['argv'][$i];
  compile($sname, '');
}

?>
