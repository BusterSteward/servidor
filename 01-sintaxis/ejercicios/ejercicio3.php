<?php
$contador=1;

while($contador<10){
    echo "LINEA Nº".$contador.": ";
    for($i=0;$i<$contador;$i++){
        echo 10-$contador;
    }
    echo "<br>";
    $contador++;
}

?>