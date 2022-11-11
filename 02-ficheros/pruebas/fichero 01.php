<?php
header('Content-Type: text/html; charset=UTF-8');

// significado \r -> RETORNO DE CARRO
// significado \n -> NUEVA LINEA

// creamos el fichero 'clientes.txt'
$fichero=fopen('clientes.txt', 'w+b');

$cadena="PEPE\r\n";
fwrite($fichero, $cadena, strlen($cadena));
$cadena="26\r\n";
fwrite($fichero, $cadena, strlen($cadena));
$cadena="ALBACETE\r\n";
fwrite($fichero, $cadena, strlen($cadena));
$cadena="\r\n";
fwrite($fichero, $cadena, strlen($cadena));

$cadena="JUAN\r\n";
fwrite($fichero, $cadena, strlen($cadena));
$cadena="34\r\n";
fwrite($fichero, $cadena, strlen($cadena));
$cadena="MADRID\r\n";
fwrite($fichero, $cadena, strlen($cadena));
// línea en blanco
$cadena="\r\n";
fwrite($fichero, $cadena, strlen($cadena));

$cadena="MARTA\r\n";
fwrite($fichero, $cadena, strlen($cadena));
$cadena="24\r\n";
fwrite($fichero, $cadena, strlen($cadena));
$cadena="CUENCA\r\n";
fwrite($fichero, $cadena, strlen($cadena));
// línea en blanco
$cadena="\r\n";
fwrite($fichero, $cadena, strlen($cadena));

$cadena="PABLO\r\n";
fwrite($fichero, $cadena, strlen($cadena));
$cadena="45\r\n";
fwrite($fichero, $cadena, strlen($cadena));
$cadena="ZAMORA\r\n";
fwrite($fichero, $cadena, strlen($cadena));
// línea en blanco
$cadena="\r\n";
fwrite($fichero, $cadena, strlen($cadena));

$cadena="MARIA\r\n";
fwrite($fichero, $cadena, strlen($cadena));
$cadena="46\r\n";
fwrite($fichero, $cadena, strlen($cadena));

// fíjate que después de ALBACETE no se crea un retorno de carro ni línea nueva
$cadena="ALBACETE";
fwrite($fichero, $cadena, strlen($cadena));

echo "El fichero ha sido creado";
fclose($fichero);
?>

