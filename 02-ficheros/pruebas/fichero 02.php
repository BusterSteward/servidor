<?php
header('Content-Type: text/html; charset=UTF-8');

$fichero=fopen('clientes.txt', 'rb');

if(!$fichero)
{
   exit("ERROR: no se pudo abrir el archivo");
}

$num=1;

while (!feof($fichero))
{
     $linea = fgets ($fichero) ;
     echo 'Linea '.$num.': '.$linea." esta línea tiene: ".strlen($linea)." caracteres <br>";
	 // trim() elimina los caracteres de control \r\n 
	 echo 'Linea '.$num.': '.$linea." esta línea tiene: ".strlen(trim($linea))." caracteres <br><br>";
     $num++;
}

fclose($fichero);
?>