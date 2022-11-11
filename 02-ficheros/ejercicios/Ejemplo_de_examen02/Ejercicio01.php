<?php

$existo = file_exists("Texto-1.txt");

if(!$existo){
    exit("No se ha encontrado el archivo 'Texto-1.txt'");
}
else{
    $fichero=fopen("Texto-1.txt","r");
    $resul=fopen("Texto-2.txt","w");

    $lineasProhibidas=array();
    $contenido="";
    while(!feof($fichero)){
        $linea=trim(fgets($fichero));
        
        if(!isset($lineasProhibidas[$linea])){
            $lineasProhibidas[$linea]=1;
            $contenido=$linea."\r\n".$contenido;
        }   
    }
    fwrite($resul,$contenido);
    fclose($fichero);
    fclose($resul);
    echo "TODO OK";
}
?>