<?php

    function visualizarDatosLinea($l,$nL,$arr){
        echo "Línea nº".$nL.": ".$l."<br>";
        echo "La línea contiene ".count($arr)." palabras <br>";
        
        for($i=0;$i<count($arr);$i++){
            echo $arr[$i]."<br>";
        }
        echo "<br>";

    }
    
    $existo=file_exists("fichero.txt");

    if(!$existo){
        exit("No se ha encontrado el archivo");
    }
    else{
       
        $fichero=fopen('fichero.txt','r'); 
        
        $nLinea=1;
        while(!feof($fichero)){
          
            $linea = trim(fgets($fichero));

            $palabras = explode(" ",$linea);

            visualizarDatosLinea($linea,$nLinea,$palabras);
            $nLinea++;
        }
    }
    

?>