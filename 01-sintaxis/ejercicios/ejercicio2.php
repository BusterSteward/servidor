<?php
$contador=1;

while($contador<10){
    echo "LINEA Nº".$contador.": ";
    for($i=0;$i<$contador;$i++){
        echo $contador;
    }
    echo "<br>";
    $contador++;
}

?>