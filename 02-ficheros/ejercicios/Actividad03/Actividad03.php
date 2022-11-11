<?php

    $existo1=file_exists("Texto-1.txt");
    if(!$existo1) //si hay error paro y lo muestro
        exit("ERROR: no se pudo abrir el archivo Texto-1.txt");
    else{
        $fichero1=fopen('Texto-1.txt','r'); 
        $lineas;
        $i=0;
        $maxLength=-1;
        while(!feof($fichero1)){
            $lineas[$i] = trim(fgets($fichero1));
            $lenght = strlen($lineas[$i]);
            if($maxLength<$lenght){
                $maxLength=$lenght;
            }
            $i++;
        }
        $fichero2=fopen("Texto-2.txt","w");
        for($i=0;$i<count($lineas);$i++){
            while(strlen($lineas[$i])<$maxLength)
                $lineas[$i].="*";
            fwrite($fichero2,$lineas[$i]."\r\n");
        }
        echo "TODO OK";
    }
    

?>