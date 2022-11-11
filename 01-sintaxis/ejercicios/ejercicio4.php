<?php
$contador=0;

while($contador<16){
    echo "48 x ";
    if($contador<10)
        echo "0";
    echo $contador." = ".($contador*48)."<br>";
    $contador++;
}

?>