<?php

# recogemos en una variable el nombre de BASE DE DATOS (esquema)
$base="ejercicioexamen04"; 
# recogemos en una variable el nombre de la TABLA
# en ningún sitio en este script utilizo esta variable ($tabla)
# esta variable la utilizaré en el script donde se tenga que utilizar la tabla 
$tabla="usuarios"; 
#--------------------------------------------------------------------------
# establecemos la conexion con el servidor 
# gestionamos posible error
#--------------------------------------------------------------------------
// MI SERVIDOR LOCAL
//**********************************************************************
$conexion=@new mysqli("127.0.0.1","jorge","666666", $base);
//**********************************************************************


if (!$conexion)
 {
   //echo "<font color='blue' size='4' font-weight: extra-bold>
   //ERROR: No se pudo realizar la conexión al servidor !!</font>";
   // la función #die muestra el mensaje indicado por pantalla y
   // finaliza el script actual en el punto en el que se encuentre. No devuelve valor alguno.
   #die("ERROR:No se pudo realizar la conexión al servidor !!");
   #die("ERROR:No se pudo realizar la conexión al servidor !!".mysql_error());
   exit;
 }

 #para evitar problemas con acentos y ñ configuramos las querys de esta manera 
 //**********************************************************************
$conexion->query("SET NAMES 'utf8'");
//**********************************************************************

//esta línea la quitaremos cuando usemos este script en PHP para conectarnos a una base de datos
//echo "<font color='blue' size='4' font-weight: extra-bold>
//MENSAJE: La conexión con los datos se ha establecido correctamente !!</font>";
?>