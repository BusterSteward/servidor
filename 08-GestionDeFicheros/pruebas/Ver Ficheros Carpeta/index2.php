<?php
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
		// creamos una lista de los ficheros del directorio
		if ($handle=opendir($d))
		{
			// vamos leyendo los ficheros del directorio
			// mientras lea ficheros y vaya avanzando readdir($handle) retorna TRUE
			// cuando haya leído el último fichero y no pueda seguir leyendo más ficheros
			// readdir($handle) retorna FALSE
			
			
			// en $file tenemos el nombre del fichero que hemos leído
			while($file=readdir($handle))
			{
				 // comprobamos que sea un fichero y no una carpeta
				 // dentro de las carpetas hay ficheros y carpetas especiales
				 
				 // si lo que leo es una carpeta->no hago nada
				if (is_file($d.$file))
				{
					  $i++;
					  echo $file."<br>";
				}
			}	
			// importante: tengo que cerrar la carpeta que he abierto antes
			closedir($handle);
			
			// informo del número de ficheros subidos
			echo "<br>Nº de Ficheros en la carpeta: <b>".$i."</b> ficheros";			
		}
	}
	else
	// informo que la carpeta no existe
	{	
		echo "La carpeta <b>' ".$d." '</b>no existe";
	}	
?>