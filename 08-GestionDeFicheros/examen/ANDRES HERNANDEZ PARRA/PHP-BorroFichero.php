<?php

//sleep(1);
usleep(200000);

// directorio donde están los ficheros 
$dir=$_POST['directorio']."/";

// fichero a borrar
$fichero=$_POST["elfichero"];

// el usuario
$usuario=$_POST["elusuario"];

if (file_exists($dir.$fichero))
{	
	// borro el fichero
	unlink($dir.$fichero);
	echo "<b><font face='Calibri' color='black' size='3'>Fichero borrado: </font></b>";
	echo "<b><font face='Calibri' color='blue' size='3'>".$fichero."</font></b>";

	require("conexion.php");

	$consulta='INSERT INTO historial (USUARIO,ACTIVIDAD) VALUES ("'.$usuario.'","Borra Fichero: '.$fichero.'")';

   	mysqli_query($conexion,$consulta);
}
else
{
	echo "<b><font face='Calibri' color='black' size='3'>Fichero: </font></b>";
	echo "<b><font face='Calibri' color='red' size='3'>".$fichero."</font></b>";
	echo "<b><font face='Calibri' color='black' size='3'> No existe!! </font></b>";
}
?>
