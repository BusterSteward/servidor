<!DOCTYPE html>
<html lang="es">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
 <TITLE>Ejemplo 03</TITLE>
</HEAD>
<BODY>
 <?php
 /* Definiremos la constante C1 y le asignaremos el valor 100 */
 define("C1",100);
 /* Definiremos la constante C2 y le asignaremos el valor 200 */
 define("C2",200);
 // Visualizamos los valores:
 // Ojo!!
 // Observa las distintas formas en las que utilizamos echo

 echo "Valor de C1=".C1. " y Valor de C2=".C2."<br>";
 echo "Valor de C1*C2=".C1*C2."<br><br>";

 echo "Valor de C1=",C1," y Valor de C2=",C2,"<br>";
 echo "Valor de C1*C2=",C1*C2,"<br><br>";

 echo "La ruta completa de este fichero es: ".__FILE__."<br><br>";
 echo "Esta es la línea: ".__LINE__." del fichero <br><br>";

 echo "Estamos utilizando la versión: ".PHP_VERSION." de PHP <br>";
 ?>
</BODY>
</HTML>