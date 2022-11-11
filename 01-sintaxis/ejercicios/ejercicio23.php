<?php

    function divideCadena($cad){
        $arr;
        $i=0;
        $fila;
        $columna;
        
        while(isset($cad[$i])){
            $fila=$i/5;
            $columna=$i%5;
            $arr[$fila][$columna]=$cad[$i];
            $i++;
        }
        return $arr;
    }

    $cadena = "EN-LA-HABITACION-DEL-FONDO-HABIA-UN-BAUL-QUE ESCONDIA-GRANDES-SECRETOS";
    $array = divideCadena($cadena);

    for($i=0;$i<count($array);$i++){
        for($j=0;$j<5;$j++){
            echo $array[$i][$j]." ";
        }    
        echo "<br>";
    }
?>