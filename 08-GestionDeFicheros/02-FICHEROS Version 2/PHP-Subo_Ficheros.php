<?php
	header('Content-Type: text/html; charset=utf-8');
	/////////////////////////////////////////////////////////////////////////////////////
	///    Script Que copia el archivo temporal subido al servidor en una carpeta    
	///    comprueba si ya existe
	/////////////////////////////////////////////////////////////////////////////////////
	
	sleep(1);

	// con esta función comprobaremos si existe el fichero en la carpeta
	/*	
	//****************************************************************************************
	function existefichero2($nombrefichero)
	{
	// seleccionamos el directorio donde están las imágenes
	$directorio = opendir('ficheros_subidos/');
	// vamos leyendo todos los ficheros
	while ($archivo = readdir($directorio))
	//obtenemos un archivo y luego otro sucesivamente
	{
			// solo leemos ficheros, los directorios o carpetas no nos interesan
			if (!(is_dir($archivo)))
			{
				if ($archivo ==$nombrefichero) return true;
			}
	}
	return false;
	};	
	//****************************************************************************************
	*/
	//****************************************************************************************
	function existefichero($nombrefichero)
	{
	// seleccionamos el directorio donde están las imágenes
	$directorio = 'ficheros_subidos/';
	
	// comprobamos si el fichero existe en la carpeta
	if (file_exists($directorio.$nombrefichero))
		{
			return true;
		}
	else
		{
			return false;
		}
	}	
	//****************************************************************************************

	//$tipo coge el valor de 'image' si el fichero que he seleccionado es una imagen
	//si no selecciono una imagen $tipo cogerá otro valor
	$tipo = substr($_FILES['objetofile1']['type'], 0, 5);
	
	// definimos la carpeta donde se guardará el fichero que se ha subido al servidor
	// puede ser otra carpeta o incluso puedo subir los ficheros a la raíz
	// comprobamos que exista la carpeta
	// sino existe la creamos
	$dir = 'ficheros_subidos/';
	
	if(!file_exists($dir))
	{
		// creoo la carpeta si no existe
		mkdir ($dir);
	}
	
     // comprobamos que se trata de un archivo de imagen
	 if ($tipo == 'image')
	 {
		 
			if (existefichero($_FILES['objetofile1']['name']))
			// el fichero ya existe y no se copia
			{
					echo "<font face='Calibri' color='black' size='3'>No se copió el fichero: </font>";
					echo "<font face='Calibri' color='red' size='3'>".$_FILES['objetofile1']['name']."</font>"."<br>";
					echo "<font face='Calibri' color='blue' size='3'> (el fichero ya existe)</font>";
			}
			// copiamos el archivo la carpeta donde copiamos las imágenes subidas.
			elseif (!copy($_FILES['objetofile1']['tmp_name'], $dir.$_FILES['objetofile1']['name']))
					//copy devuelve TRUE si copia el archivo
					//si hay algún problema devuelve FALSE
					echo "No se pudo copiar Archivo... Error COPY";
			else 
			// si no hay ningún problema
			{
				echo "<font face='Calibri' color='black' size='3'>El archivo: </font>";
				echo "<font face='Calibri' color='blue' size='3'>".$_FILES['objetofile1']['name']."</font>"."<br>";
				echo "<font face='Calibri' color='black' size='3'> se ha subido al Servidor sin problemas</font>";
				$_FILES=null;
			}   
	 }
	 //si el fichero no es de tipo imagen devolvemos un Error
	 else 
	 {	 
		echo "<b><font face='Calibri' color='red' size='3'>Error: </font></b>";
		echo "<font face='Calibri' color='blue' size='3'>".$_FILES['objetofile1']['name']."</font><br>";
		echo "<font face='Calibri' color='black' size='3'>Sólo se permiten Ficheros de tipo Imagen</font>";
	 }	
?>
