<?php

//sleep(1);
usleep(200000);

// directorio donde están los ficheros 
$dir='ficheros_subidos/';

// fichero a borrar
$fichero=$_POST["elfichero"];

// borro el fichero
unlink($dir.$fichero);

require("conexion.php");
$consulta='DELETE FROM ficheros WHERE FICHERO="'.$fichero.'"';
mysqli_query($conexion,$consulta);
$consulta2='INSERT INTO historial (ACCION,FICHERO) VALUES ("BORRA","'.$fichero.'")';
mysqli_query($conexion,$consulta2);

?>
