<?php
header('Content-Type: text/html; charset=UTF-8');
function suma($datos)
{

    $i=0;
    $suma=0;
    while(isset($datos[$i])){
        $suma+=$datos[$i];
        $i++;
    }
    return $suma;
}
// Introducimos en el array los parámetros (números a sumar)
$datos [0] =4;
$datos [1] =2;
$datos [2] =3;
$resultado=suma($datos);
echo "el resultado es: ".$resultado;
?>