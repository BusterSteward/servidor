<!DOCTYPE html>
<html lang="es">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
 <TITLE>Ejemplo 04</TITLE>
</HEAD>
<BODY>
 <?php
 // Asignación de números enteros, de coma flotante y cadenas de caracteres
 $numero_entero = 12343;
 $numero_flotante = 12343.123;
 $cadena_caracter = "esto es una cadena";
 // Asignación de los tipos especiales boolean y NULL
 $verdadero = TRUE;
 $vacio = NULL;
 // Visualizamos por pantalla el valor de las variables
 // ojo!!
 // Observa las distintas formas en las que utilizamos echo
 echo "El valor de la variable numero_entero es: ",$numero_entero,"<br>";
 echo "El valor de la variable numero_flotante es: ".$numero_flotante."<br>";
 echo "El valor de la variable cadena_caracter es: $cadena_caracter"."<br>";
 echo "El valor de la variable verdadero es: ".$verdadero."<br>";
 echo "El valor de la variable vacio es: ".$vacio."<br>";
 ?>
</BODY>
</HTML>