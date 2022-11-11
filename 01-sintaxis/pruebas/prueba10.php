<?php
$Nombre = "Pepe López";
if (isset($Nombre))
{
echo ("El nombre existe!!! <BR>");
}
//Podemos comprobar qué pasa si liberamos la variable $Nombre
unset($Nombre);
if (isset($Nombre))
{
echo ("El nombre existe!!!");
}
else
{
echo ("El nombre ya no existe!!!");
}
?>