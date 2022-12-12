<?php
	// https://www.w3schools.com/php/func_filesystem_glob.asp
	header('Content-Type: text/html; charset=utf-8');
	
	echo "<b>Ficheros en la carpeta ficheros:</b><br><br>";
		
	// esta carpeta es donde están los ficheros que queremos ver
	$d ='ficheros/';
	
	// nº de ficheros 
	$i=0;
	// si existe el directorio visualizo los ficheros
	// si no existe no hago nada->aviso de que la carpeta no existe
	if (file_exists($d))
	{
		//$listaficheros=glob($d."*");
		$listaficheros=glob($d."*.jpg");
		foreach ($listaficheros as $ruta_fichero)
		{
			if (is_file($ruta_fichero))
			{	
				echo "Tamaño de <b>".$ruta_fichero."</b> ".filesize($ruta_fichero). "<br><br>";
				$i++;
			}
		}
		
		// informo del número de ficheros subidos
		echo "<br>Nº de Ficheros en la carpeta: <b>".$i."</b> ficheros";			
	}
	else
	// informo que la carpeta no existe
	{	
		echo "La carpeta <b>' ".$d." '</b>no existe";
	}	
?>