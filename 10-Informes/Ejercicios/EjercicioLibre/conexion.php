<?php
# recogemos en una variable el nombre de BASE DE DATOS (esquema)
$base="listadozapatos"; 

#--------------------------------------------------------------------------
# establecemos la conexion con el servidor 
# gestionamos posible error
#--------------------------------------------------------------------------
// a mysqli le paso el servidor al que me quiero conectar, el usuario y su password, el esquema que quiero utilizar

// MI SERVIDOR LOCAL
//**********************************************************************
$conexion=@new mysqli("127.0.0.1","jorge","666666", $base);
//**********************************************************************


if (!$conexion)
 {
   //echo "<font color='blue' size='4' font-weight: extra-bold>
   //ERROR: No se pudo realizar la conexi�n al servidor !!</font>";
   // la funci�n #die muestra el mensaje indicado por pantalla y
   // finaliza el script actual en el punto en el que se encuentre. No devuelve valor alguno.
   #die("ERROR:No se pudo realizar la conexi�n al servidor !!");
   #die("ERROR:No se pudo realizar la conexi�n al servidor !!".mysql_error());
   exit;
 }

 #para evitar problemas con acentos y � configuramos las querys de esta manera 
 //**********************************************************************
 mysqli_set_charset($conexion, "utf8");
 //**********************************************************************

//esta l�nea la quitaremos cuando usemos este script en PHP para conectarnos a una base de datos
//echo "<font color='blue' size='4' font-weight: extra-bold>
//MENSAJE: La conexi�n con los datos se ha establecido correctamente !!</font>";
?>