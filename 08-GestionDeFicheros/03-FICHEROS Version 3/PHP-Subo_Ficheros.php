<?php
	header('Content-Type: text/html; charset=utf-8');
	/////////////////////////////////////////////////////////////////////////////////////
	///    Script Que copia los ficheros temporales subidos al servidor en una carpeta    
	///    OJO: posibilidad de subir varios ficheros
	///    NO comprueba si los ficheros ya existen
	/////////////////////////////////////////////////////////////////////////////////////
	
	sleep(1);

	// en este array voy a almacenar los ficheros que se copien
	$copiados=array();
	$auxcopiados=0;

	// definimos la carpeta donde se guardarán los ficheros que se han subido al servidor
	// puede ser otra carpeta o incluso puedo subir los ficheros a la raíz
	// comprobamos que exista la carpeta
	// sino existe la creamos
	$dir = 'ficheros_subidos/';
	
	if(!file_exists($dir))
	{
		// creoo la carpeta si no existe
		mkdir ($dir);
	}

	// calculamos el nº de ficheros subidos
	$nelementos=count($_FILES['objetofile1']['name']);
	// OJO: ahora tenemos una 2ª dimensión en $_FILES
	// Ahora $_FILES -> es bidimensional
	// recorremos todo el array donde están los ficheros
	for ($i = 0; $i < $nelementos; $i++) 
	{	
			//$tipo coge el valor de 'image' si el fichero que he seleccionado es una imagen
			//si no selecciono una imagen $tipo cogerá otro valor
			$tipo = substr($_FILES['objetofile1']['type'][$i], 0, 5);
			
			 // comprobamos que se trata de un archivo de imagen
			 if ($tipo == 'image')
			 {
					// copiamos el archivo la carpeta donde copiamos las imágenes subidas.
					if (!copy($_FILES['objetofile1']['tmp_name'][$i], $dir.$_FILES['objetofile1']['name'][$i]))
							//copy devuelve TRUE si copia el archivo
							//si hay algún problema devuelve FALSE
							echo "No se pudo copiar Archivo... Error COPY";
					else 
					// si no hay ningún problema
					{
						// copiamos al array el nombre del fichero copiado
						$copiados[$auxcopiados]=$_FILES['objetofile1']['name'][$i];
						$auxcopiados++;
					}   
			 }
	}
	
	// una ver terminado el bucle de copia visualizamos los ficheros que han sido copiados
	if (count($copiados)>0)
	{
		echo "<b><font face='Calibri' color='black' size='3'>Ficheros que han sido copiados: </font></b>"."<br>";
		for ($auxcopiados = 0; $auxcopiados < count($copiados); $auxcopiados++) 
		{	
			echo "<font face='Calibri' color='blue' size='3'>".$copiados[$auxcopiados]."</font>"."<br>";
		}
	}
?>