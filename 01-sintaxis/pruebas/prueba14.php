<?php
function capitales($datos)
{
    if(isset($datos['Pais']))
        echo "hola";
// isset determina si una variable está definida y no es NULL.
$A = isset ($datos['Pais'] ) ? $datos ['Pais'] : "España";
$B = isset ($datos['Capital'] ) ? $datos ['Capital'] : "Madrid";
$C = isset ($datos['Habitantes'] ) ? $datos['Habitantes'] : "muchos";
return ("La capital de $A es $B y tiene $C habitantes.<br>");
}
// Introducimos en el array los datos uno por uno para que sea más fácil de entender
$datos=array();
echo capitales($datos);
$datos ['Pais'] = "España";
echo capitales($datos);
$datos ['Pais'] = "Portugal";
$datos ['Capital'] = "Lisboa";
echo capitales($datos);
$datos ['Pais'] = "Francia";
$datos ['Capital'] = "Paris";
$datos ['Habitantes'] = "muchísimos";
echo capitales($datos);
?>