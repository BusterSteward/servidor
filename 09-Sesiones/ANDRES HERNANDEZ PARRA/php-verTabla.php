<?php
session_start();

    
        echo "Valores de la tabla:<br>";
        echo count($_SESSION["TABLA"]);
        echo "<br>";
        echo count($_SESSION["TABLA"]["FILA1"]);
        for($i=1;$i<=5;$i++){
            echo "<br>FILA".$i.":<br>";
            for($j=0;$j<=3;$j++){
                echo "[".$_SESSION['TABLA']['FILA'.$i][$j]."]";
            }
        }
    
?>