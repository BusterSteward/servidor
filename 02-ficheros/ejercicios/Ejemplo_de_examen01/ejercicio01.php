<?php

$existo1 = file_exists("Texto-1.txt");

if(!$existo1){
    exit("No se ha encontrado el archivo 'Texto-1.txt'");
}
else{
    $existo2 = file_exists("Texto-2.txt");
    $lineasProhibidas=array();
    if($existo2){
        $fichero2=fopen("Texto-2.txt","r");

        while(!feof($fichero2)){
            $linea=trim(fgets($fichero2));
            $lineasProhibidas[$linea]=1;
        }
        fclose($fichero2);
    }

    $fichero1 = fopen("Texto-1.txt","r");
    $resul = fopen("Texto-3.txt","w");

    while(!feof($fichero1)){
        $linea=trim(fgets($fichero1));
        if(!isset($lineasProhibidas[$linea])){
            fwrite($resul,$linea."\r\n");
        }
    }
    fclose($fichero1);
    fclose($resul);
    echo "TODO OK";
}
?>