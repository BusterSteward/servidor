<?php

$existo = file_exists("fichero.txt");

if(!$existo){
    exit("No se ha encontrado el archivo 'fichero.txt'");
}
else{
    $fichero=fopen("fichero.txt","r");
    $resul=fopen("fichero2.txt","w");

    $lineas=array();
    $contenido="";
    while(!feof($fichero)){
          $linea=trim(fgets($fichero));
          $valor=substr($linea,0,2);
          $valor=intval($valor);
          $lineas[$valor]=$linea;
    }
    
    for($i=0;$i<=50;$i++){
        if(isset($lineas[$i]))
            fwrite($resul,$lineas[$i]."\r\n");
    }

    
    //fwrite($resul,$contenido);
    fclose($fichero);
    fclose($resul);
    echo "TODO OK";
}
?>