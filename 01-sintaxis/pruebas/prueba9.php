<?php
$numero=1234;
echo gettype($numero)."<br><br>";

$aux=(string)$numero;
echo gettype($aux)."<br><br>";
echo $aux."<br><br>";
echo $aux*$numero;
?>