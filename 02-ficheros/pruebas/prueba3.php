<?php
 header('Content-Type: text/html; charset=UTF-8');
 // abrimos el fichero en modo lectura
 $fichero =@fopen('fichero1.txt', 'rb', true );

 if(!$fichero)
 {
 echo 'No se puede abrir el fichero.';
 }
 else
 {
 $num=1;
 // leemos líneas hasta que lleguemos al final del fichero
 while (!feof($fichero))
 {
 $linea = fgets ($fichero) ;
 echo 'Linea '.$num.': '.$linea.' '.strlen($linea).'<br>';
 echo 'Linea '.$num.': '.$linea.' '.strlen(trim($linea)).'<br>';
 $num++;
 }
 }
?>
