<?php
	header('Content-Type: text/html; charset=utf-8');
	/////////////////////////////////////////////////////////////////////////////////////
	///    Script Que copia el archivo temporal subido al servidor en una carpeta    
	/////////////////////////////////////////////////////////////////////////////////////
	
	sleep(1);
	
	// al hacer un submit desde el formulario, todos los valores de los objetos html se suelen almacenar en $_POST
	// todos los archivos que se encuentren en el formulario html a través de un objeto html "FILE" se almacenan en $_FILES
	
	// OJO:
	// $_FILES, si sólo he subido un fichero-> $_FILES será una tabla uni-dimensional
	// $_FILES, si subo varios ficheros-> $_FILES será una tabla bi-dimensional
	
	// obtenemos el tipo de fichero subido (la extensión del fichero)
	// solo me interesan ficheros de tipo imagen
	// almaceno en $tipo el tipo de los ficheros (solo me interesa el trozo de cadena 'image')
	// cualquier fichero que no sea imagen lo voy a ignorar
	
	//$tipo =$_FILES['objetofile1']['type'];
	// si subo un fichero ".jpg" este es el valor que devuelve "type"
	//toma el valor "image/jpeg"
	
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
			//copiamos el archivo a la carpeta donde copiamos las imágenes subidas.
			//COPY
			//le pasamos 2 parámetros
			//1: el fichero que quiero copiar
			//2: el "nombre que le voy a poner a ese fichero" y "la ruta donde lo quiero copiar"
			//COPY: devuelve TRUE si realiza la copia
			//probar esto: (nombre temporal que el servidor asigna al fichero subido)
			//echo $_FILES['objetofile1']['tmp_name'];
			if (!copy($_FILES['objetofile1']['tmp_name'], $dir.$_FILES['objetofile1']['name']))
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
	 
	 echo '<script>parent.terminar();</script>';
?>
