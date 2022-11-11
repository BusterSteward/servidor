<?php
//Conversión de un tipo string a un integer
$cadena = "232pepe";
echo "El tipo de la variable cadena es ".gettype($cadena)."<br>";
$numero = intval($cadena) ;
echo ("el numero es $numero"."<br>");
echo "El tipo de la variable $numero es ".gettype($numero)."<br>";
echo ("el valor de la variable cadena es $cadena"."<br>");
?>
