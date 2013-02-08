<?php

$myFile = "testFile.txt";
$fh = fopen($myFile, 'a') or die("can't open file");
$stringData = $_POST["name"]. "\n";
fwrite($fh, $stringData);
fclose($fh);

?>
