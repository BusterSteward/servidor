<?php

//sleep(1);
usleep(200000);

// directorio donde están los ficheros 
$dir='ficheros_subidos/';

$handle=opendir($dir);

while ($elemento = readdir($handle))
{
	// borro los ficheros que hay en la carpeta
	// las carpetas las ignoro
	 if( is_file($dir.$elemento))
	{
			// borro fichero
			// en este punto: podríamos realizar un filtro para eliminar un tipo determinado de ficheros
			unlink($dir.$elemento);
	}
}
?>
