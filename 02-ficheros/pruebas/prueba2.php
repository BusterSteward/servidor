<?php
 header('Content-Type: text/html; charset=UTF-8');

 // abrimos el fichero en modo lectura
 $fichero =@fopen('fichero1.txt', 'rb', true );
 // leemos de golpe todo el fichero
 $contenido = fread($fichero, filesize('fichero1.txt'));
 echo "el contenido del fichero es: ";
 echo $contenido;
 echo "<br><br><br>";
 //situamos el puntero del fichero al principio
 rewind($fichero);
 // ahora leemos 15 caracteres
 $contenido = fread($fichero, 15);
 echo "el contenido de los 15 caracteres son: ";
 echo $contenido;
 fclose($fichero);
?>