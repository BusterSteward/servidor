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
        $linea="";
        $lineaf1="";
        $lineaf2="";
        //leo las lineas de ambos ficheros
        if(!feof($fichero1)){
            
            $lineaf1=trim(fgets($fichero1)); 
           
            
        }
        if(!feof($fichero2)){
            
            $lineaf2=trim(fgets($fichero2)); 
             
        }
        //calculo el tamaño de la linea del nuevo fichero
        $tam=max(strlen($lineaf1),strlen($lineaf2));
        
        //voy concatenando caracteres hasta que la linea más larga se queda sin ellos
        for($i=0;$i<$tam;$i++){
            if(isset($lineaf1[$i]))
                $linea.=$lineaf1[$i];
            if(isset($lineaf2[$i]))
                $linea.=$lineaf2[$i];
        }
        fwrite($result,$linea."\r\n");
    }
    echo "TODO OK";
}

fclose($fichero1);
fclose($fichero2);
fclose($result);
?>