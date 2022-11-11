<?php
 header('Content-Type: text/html; charset=UTF-8');

 // abrimos el fichero en modo escritura
 $fichero=fopen('fichero1.txt', 'wb');
 $cadena="Hola esto es un ejemplo";
 // los caracteres "\r\n" se utilizan para especificar fin de línea y línea nueva
 $cadena=$cadena."\r\n";
 $cadena=$cadena."Esto es otra frase";
 $nescritos=fwrite($fichero, $cadena, strlen($cadena));
 fclose($fichero);
 echo "se han escrito en el fichero: ".$nescritos." caracteres";
?>