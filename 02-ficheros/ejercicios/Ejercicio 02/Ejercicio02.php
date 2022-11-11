<?php
header('Content-Type: text/html; charset=UTF-8');

$ficheroAR=fopen('clientesAlreves.txt','w+b'); //CREO EL NUEVO FICHEROALREVES
$existo=file_exists('clientes.txt'); //COMPRUEBO SI EXISTE CLIENTES
$fichero=fopen('clientes.txt','rb');


if(!$existo){ //SI HAY ERROR, PARA Y ME AVISAS, SINO PA LANTE
   exit("ERROR: no se pudo abrir el archivo clientes.txt");
} else {
    while (!feof($fichero)){ //MIENTRAS QUEDE FICHERO DE TEXTO QUE NO PARE
        $linea=trim(fgets($fichero)); //METO LA LINEA Y APUNTO AL SIGUIENTE
        $linea2=strrev($linea)."\r\n";
		fwrite($ficheroAR,$linea2);
    }
}

fclose($fichero);
fclose($ficheroAR);
?>

