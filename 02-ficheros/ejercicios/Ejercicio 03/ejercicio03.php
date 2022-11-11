<?php
header('Content-Type: text/html; charset=UTF-8');

//compruebo que los ficheros existen y los abro para lectura
$existo1=file_exists("Texto-1.txt");
$fichero1=fopen('Texto-1.txt','r'); 
$existo2=file_exists('Texto-2.txt');
$fichero2=fopen('Texto-2.txt','r');

//creo el fichero en el que voy a guardar el resultado y lo abro para escribir en él
$result=fopen('Texto-3.txt','w');
if(!$existo1) //si hay error paro y lo muestro
   exit("ERROR: no se pudo abrir el archivo Texto-1.txt");
else if(!$existo2){
    exit("ERROR: no se pudo abrir el archivo Texto-2.txt");
}
else {
    
    while (!feof($fichero1)||!feof($fichero2)){ //compruebo si quedan lineas por leer en alguno de los ficheros

        //si quedan lineas en el fichero 1 la añado antes al fichero resultado
        if(!feof($fichero1)){
            $linea=trim(fgets($fichero1)); 
            //compruebo si es una linea vacía para no añadir la ultima linea del fichero
            if($linea!=""){
                $linea=$linea."\r\n";
                fwrite($result,$linea);
            }
            
        }
        if(!feof($fichero2)){
            $linea=trim(fgets($fichero2)); 
            
            if($linea!=""){
                $linea=$linea."\r\n";
                fwrite($result,$linea);
            }
        }
    }
    echo "TODO OK";
}

fclose($fichero1);
fclose($fichero2);
fclose($result);
?>
