<?php
	header('Content-Type: text/html; charset=utf-8');

	/////////////////////////////////////////////////////////////////////////////////////
	///    Script Que copia los ficheros temporales subidos al servidor en una carpeta    
	///    OJO: posibilidad de subir varios ficheros
	///    Si los ficheros existen -> NO COPIO -> visualizo aviso
	///	 Si los ficheros NO existen -> COPIO -> visualizo aviso
	///	
	///	 NO realizo validación por TIPO de fichero
	/////////////////////////////////////////////////////////////////////////////////////
	
	/////////////////////////////////////////////////////////////////////////////////////
	///    
	///    OJO: en la tabla "HISTORIAL" solo registrarás los archivos subidos -> los que se copien
	///    OJO: los ficheros subidos que finalmente no se copien en el servidor -> no se registran en "HISTORIAL"
	///	
	/////////////////////////////////////////////////////////////////////////////////////
	
	$dir = $_GET['lacarpeta']."/";	
	$el_usuario=$_GET['elusuario'];
	
	//sleep(1);
	usleep(200000);
	
	//****************************************************************************************
	function existefichero($nombrefichero)
	{		
		$dir = $_GET['lacarpeta']."/";
		// comprobamos si el fichero existe en la carpeta
		if (file_exists($dir.$nombrefichero))
			{
				return true;
			}
		else
			{
				return false;
			}
	}	
	//****************************************************************************************

	// en este array voy a almacenar los ficheros que se copien
	$copiados=array();
	$auxcopiados=0;

	// en este array voy a almacenar los ficheros que subo que no
	// son copiados porque ya existían en el servidor
	$repetidos=array();
	$auxrepetidos=0;
	
	$dir = $_GET['lacarpeta']."/";
	
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
	require("conexion.php");

	for ($i = 0; $i < $nelementos; $i++) 
	{	
			// consultamos si ya existe el fichero
			if (existefichero($_FILES['objetofile1']['name'][$i]))
					// el fichero ya existe y no se copia
					{
						$repetidos[$auxrepetidos]=$_FILES['objetofile1']['name'][$i];
						$auxrepetidos++;
					}					
			// copiamos el archivo la carpeta donde copiamos las imágenes subidas.
			elseif (!copy($_FILES['objetofile1']['tmp_name'][$i], $dir.$_FILES['objetofile1']['name'][$i]))
					//copy devuelve TRUE si copia el archivo
					//si hay algún problema devuelve FALSE
					echo "No se pudo copiar Archivo... Error COPY";
			else 
			// si no hay ningún problema
			{
				// copiamos al array el nombre del fichero copiado
				$copiados[$auxcopiados]=$_FILES['objetofile1']['name'][$i];
				$auxcopiados++;

				

				$consulta='INSERT INTO historial (USUARIO,ACTIVIDAD) VALUES ("'.$el_usuario.'","Sube Fichero: '.$_FILES['objetofile1']['name'][$i].'")';

				mysqli_query($conexion,$consulta);
			}   
	}
	
	// una ver terminado el bucle de copia visualizamos los correspondientes mensajes
	if (count($copiados)>0)
	{
		echo "<b><font face='Calibri' color='black' size='3'>Ficheros que han sido copiados: </font></b>"."<br>";
		for ($auxcopiados = 0; $auxcopiados < count($copiados); $auxcopiados++) 
		{	
			echo "<font face='Calibri' color='blue' size='3'>".$copiados[$auxcopiados]."</font>"."<br>";
		}
	}
	echo "<br>";
	if (count($repetidos)>0)
	{
		echo "<b><font face='Calibri' color='black' size='3'>Ficheros que NO han sido copiados (repetidos): </font></b>"."<br>";
		for ($auxrepetidos = 0; $auxrepetidos < count($repetidos); $auxrepetidos++) 
		{	
			echo "<font face='Calibri' color='red' size='3'>".$repetidos[$auxrepetidos]."</font>"."<br>";
		}
	}	
?>