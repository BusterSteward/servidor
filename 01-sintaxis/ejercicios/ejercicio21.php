<?php

    function listoArray($arr){
        for($i=0;$i<3;$i++){
            for($j=0;$j<4;$j++){
                echo $arr[$i][$j][0]."*".$arr[$i][$j][1];
                if($j<3)
                echo "----";
            }
            echo "<br>";
        }

        echo "FILAS en el array: ".count($arr)."<br>";
        echo "COLUMNAS en el array: ".count($arr[0])."<br>";
        echo "CAPAS en el array: ".count($arr[0][0])."<br>";
    }
    $valor= array(
        array( // fila [0]
        array(1,10), // columna [0]
        array(14,20), // columna [1]
        array(8,30), // columna [2]
        array(3,40), // columna [3]
        ),
        array( // fila [1]
        array(6,50), // columna [0]
        array(19,60), // columna [1]
        array(7,70), // columna [2]
        array(2,80), // columna [3]
        ),
        array( // fila [2]
        array(3,90), // columna [0]
        array(13,91), // columna [1]
        array(4,92), // columna [2]
        array(1,93), // columna [3]
        ),
       );

    listoArray($valor);
       
    
?>