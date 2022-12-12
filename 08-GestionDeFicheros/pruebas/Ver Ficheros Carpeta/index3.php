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
		$listaficheros=scandir($d);
		echo "nº de ficheros=".count($listaficheros)."<br><br>";
		for($j=0;$j<count($listaficheros);$j++)
		{
			if (is_file($d.$listaficheros[$j]))
			{	
				echo "Fichero ".($j+1)."=<b>".$listaficheros[$j]."</b><br>";
				$i++;
			}
		}
		
		// informo del número de ficheros subidos
		echo "<br>Nº de Ficheros Subidos: <b>".$i."</b> ficheros";			
	}
	else
	// informo que la carpeta no existe
	{	
		echo "La carpeta <b>' ".$d." '</b>no existe";
	}	
?>