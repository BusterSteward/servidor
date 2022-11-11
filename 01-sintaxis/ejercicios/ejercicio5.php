<?php
header('Content-Type: text/html; charset=UTF-8');
function tabla ($n)
{
    $suma=0;
    for($i=0;$i<6;$i++){
        $result=$i*$n;
        echo $n." x ".$i." = ".$result."<br>";
        $suma+=$result;
    }
    echo "<br>";
    return $suma;
}
$resultado=tabla(2);
echo "la suma de todas las multiplicaciones es: ".$resultado;

?>