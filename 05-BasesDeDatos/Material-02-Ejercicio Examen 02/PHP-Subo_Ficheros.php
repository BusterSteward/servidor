<?php
	header('Content-Type: text/html; charset=utf-8');
	/////////////////////////////////////////////////////////////////////////////////////
	///    Script Que copia los 2 archivos temporales subidos al servidor en la carpeta especificada    
	/////////////////////////////////////////////////////////////////////////////////////
	
	sleep(1);

	// seleccionamos el directorio donde se copian los ficheros subidos
	$dir = 'ficheros_subidos/';

	// copiamos los archivos subidos en la carpeta de trabajo
	if ((!copy($_FILES['objetofile1']['tmp_name'][0],$dir.$_FILES['objetofile1']['name'][0])) or
		(!copy($_FILES['objetofile1']['tmp_name'][1],$dir.$_FILES['objetofile1']['name'][1])))
	{
			//copy devuelve TRUE si copia el archivo
			//si hay algún problema devuelve FALSE
			echo "No se pudo copiar Archivo... Error COPY";
	}	
	else 
	// si no hay ningún problema
	{
			echo "<font face='Calibri' color='black' size='3'>Los archivos: </font>";
			echo "<font face='Calibri' color='blue' size='3'>".$_FILES['objetofile1']['name'][0]." y ".$_FILES['objetofile1']['name'][1]."</font>"."<br>";
			echo "<font face='Calibri' color='black' size='3'> se han subido al Servidor sin problemas</font>";
			$_FILES=null;
	}   
?>
