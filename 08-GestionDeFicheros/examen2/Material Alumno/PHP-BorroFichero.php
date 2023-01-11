<?php

//sleep(1);
usleep(200000);

// directorio donde están los ficheros 
$dir='ficheros_subidos/';

// fichero a borrar
$fichero=$_POST["elfichero"];

// borro el fichero
unlink($dir.$fichero);

?>
