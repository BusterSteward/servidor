<?php

$existo=file_exists('fichero1.txt'); 

if(!$existo){ 
   exit("ERROR: no se pudo abrir el archivo fichero1.txt");
} else {

    $fichero=fopen('fichero1.txt','rb');
    $palabras = array();
    while (!feof($fichero)){ 
        $linea=trim(fgets($fichero)); 
        if(isset($palabras[$linea])){
            $palabras[$linea]++;
        }
        else{
            $palabras[$linea]=1;
        }
    }

    foreach($palabras as $key => $value){
        echo "Palabra ".$key.": ".$value." veces";
    }
}

fclose($fichero);

?>