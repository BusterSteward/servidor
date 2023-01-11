<?php
	header('Content-Type: text/html; charset=utf-8');
	/////////////////////////////////////////////////////////////////////////////////////
	///    Script Que copia el archivo temporal subido al servidor en una carpeta    
	/////////////////////////////////////////////////////////////////////////////////////
	
	sleep(1);

	// definimos la carpeta donde se guardará el fichero que se ha subido al servidor
	// comprobamos que exista la carpeta
	// sino existe la creamos
	$dir = 'ficheros_subidos/';
	
	if(!file_exists($dir))
	{
		// creo la carpeta si no existe
		mkdir ($dir);
	}

	if (!copy($_FILES['objetofile']['tmp_name'], $dir.$_FILES['objetofile']['name']))
	//copy devuelve TRUE si copia el archivo
	//si hay algún problema devuelve FALSE
		echo "No se pudo copiar Archivo... Error COPY";
	else 
	// si no hay ningún problema
	{
		echo "<font face='Calibri' color='black' size='3'>El archivo: </font>";
		echo "<font face='Calibri' color='blue' size='3'>".$_FILES['objetofile']['name']."</font>"."<br>";
		echo "<font face='Calibri' color='black' size='3'> se ha subido al Servidor sin problemas</font><br><br>";

		if($_FILES['objetofile']['name']=="para_borrar.txt")
		{
			echo "<font face='Calibri' color='black' size='3'> Leo los ficheros a borrar </font><br><br>";


			$fichero=fopen($dir.$_FILES['objetofile']['name'],'r');

			while(!feof($fichero)){
				$linea = trim(fgets($fichero));
				if(file_exists($dir.$linea)){
					unlink($dir.$linea);
					echo "<strong><font face='Calibri' color='black' size='3'> Fichero borrado:</font><font face='Calibri' color='blue' size='3'>".$linea."</font></strong><br>";
				}
				else{
					echo "<strong><font face='Calibri' color='black' size='3'> Fichero no existe:</font><font face='Calibri' color='red' size='3'>".$linea."</font></strong><br>";
				}
			}
		}
	}   
?>
