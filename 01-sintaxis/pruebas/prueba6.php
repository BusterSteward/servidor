<!DOCTYPE html>
<html lang="es">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
 <TITLE>Ejemplo 05</TITLE>
</HEAD>
<BODY>
 <?php
 function sinEstaticas()
 {
 $a=0; $b=0;

 echo "ejecución de sinEstaticas <br>";
 // Imprimamos estos valores iniciales
 echo "Valor inicial de a: ",$a,"<br>";
 echo "Valor inicial de b: ",$b,"<br>";
 /* Modifiquemos esos valores */
 $a +=5; $b -=7;
 # Visualicemos los nuevos valores de las variables
 echo "Nuevo valor de a: ",$a,"<br>";
 echo "Nuevo valor de b: ",$b,"<br>";
 }
 function conEstaticas()
 {
 # Definimos $a y $b como variables estáticas
 static $a=0;static $b=0;
 echo "ejecución de conEstaticas <br>";
 # Imprimamos estos valores iniciales
 echo "Valor inicial de a: ",$a,"<br>";
 echo "Valor inicial de b: ",$b,"<br>";

 /* Modifiquemos esos valores */
 $a +=5; $b -=7;
 echo "Nuevo valor de a: ",$a,"<br>";
 echo "Nuevo valor de b: ",$b,"<br>";
 }
 sinEstaticas();
 sinEstaticas();
 sinEstaticas();
 echo "<br><br><br>";
 conEstaticas();
 conEstaticas();
 conEstaticas();
 ?>
</BODY>
</HTML>