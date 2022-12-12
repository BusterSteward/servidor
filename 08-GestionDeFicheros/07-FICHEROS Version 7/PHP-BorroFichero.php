<?php

//sleep(1);
usleep(200000);

// directorio donde están los ficheros 
$dir='ficheros_subidos/';

// fichero a borrar
$fichero=$_POST["elfichero"];

if (file_exists($dir.$fichero))
{	
	// borro el fichero
	unlink($dir.$fichero);
	echo "<b><font face='Calibri' color='black' size='3'>Fichero borrado: </font></b>";
	echo "<b><font face='Calibri' color='blue' size='3'>".$fichero."</font></b>";
}
else
{
	echo "<b><font face='Calibri' color='black' size='3'>Fichero: </font></b>";
	echo "<b><font face='Calibri' color='red' size='3'>".$fichero."</font></b>";
	echo "<b><font face='Calibri' color='black' size='3'> No existe!! </font></b>";
}
?>
