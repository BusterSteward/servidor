<!DOCTYPE html>
<html lang="es">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
 <TITLE>Ejemplo 05</TITLE>
</HEAD>
<BODY>
 <?php
 // variable definida fuera de la función
 // la función en principio (sin usar 'global') no puede acceder al valor de esta variable
 $variable_prueba = "esto es el valor";

 function ejemplo()
 {
 // con global la función puede acceder a la variable $variable_prueba, declarada fuera de la función
 // *****OJO!!***** prueba este script descomentando la siguiente línea
 global $variable_prueba;
 // con la línea de global comentada la siguiente línea no imprimirá el valor
 echo "El valor de la variable en la función antes del cambio es: ".$variable_prueba."<br><br>";
 // con la línea de global comentada esta variable sería distinta a la que se ha declarado fuera
 $variable_prueba="cambio el valor";
 echo "El valor de la variable en la función después del cambio es: ".$variable_prueba."<br><br>";
 }
 // visualizo el valor de la variable ANTES de llamar a la función ejemplo
 echo "El valor de la variable ANTES DE es: ".$variable_prueba."<br><br>";
 ejemplo();
 // Visualizo el valor de la variable DESPUÉS de llamar a la función ejemplo
 echo "El valor de la variable DESPUÉS DE es: ".$variable_prueba."<br><br>";
 ?>
</BODY>
</HTML>