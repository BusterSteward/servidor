<?php
	//esta funcion inserta en nuestra base de datos los registros que se le pasamos por parámetro en un array
	function insertarDatos($r){
		require("conexion.php");


		$consulta="INSERT INTO $tabla VALUES ";
		//por cada registro, escribimos sus valores en la consulta
		foreach($r as $v){
			$consulta.="(".$v[0].", ".$v[1].",".$v[2]."),";
		}
		//eliminamos la última coma que nos escribe el bucle con trim
		$consulta=trim($consulta,",");

		//ejecutamos la consulta
		@mysqli_query($conexion,$consulta);

		if (mysqli_errno($conexion)==0)
			{
			return 1;
			}
		else 
			{
			// aquí tratamos el error que se supone que será la clave duplicada	
			$numerror=mysqli_errno($conexion); 
			//$descrerror=mysqli_error($conexion); 
			
			// aquí podríamos devolver el nº de error
			return $numerror;
			}	
		mysqli_close($conexion);

	}
	//esta funcion devuelve los registros sin repetir, contenidos en el archivo guardado en la direccion pasada por parametro
	function obtenerRegistros($dir){
		$registros=array();
		
		$fichero1=@fopen($dir, 'rb');
		if(!$fichero1)
			{
				echo "ERROR: no se pudo abrir el archivo clientes.txt";
				exit();
			}
		else
		{
			
			while (!feof($fichero1))
			{
				//cada registro en el fichero tiene 3 lineas separadas por una linea en blanco, y la primera línea contiene el código del registro
				$lineaFile = trim(fgets($fichero1));//si todavia quedan lineas por leer, leemos una linea

				//si la linea leida es un espacio en blanco no hacemos nada, y pasamos a la siguiente iteración
				if($lineaFile!=""){

					//si la linea que leemos contiene algo, significa que hemos leido el código del registro
					if(!isset($registros[$lineaFile])){//comprobamos si es la primera vez que leemos este registro
						//si es así, leemos las siguientes 2 lineas y guardamos su valor en la posicion de la tabla con el registro
						$registros[$lineaFile][0]=$lineaFile;
						$registros[$lineaFile][1]=trim(fgets($fichero1));
						$registros[$lineaFile][2]=trim(fgets($fichero1));
						
					}
					//en caso de que no sea la primera vez que lo leamos, simplemente nos saltamos las siguientes 2 lineas, ya que son los datos del registro repetido
					else{
						fgets($fichero1);
						fgets($fichero1);
					}
				}
			}
		}	

		// cerramos
		fclose($fichero1);
		return $registros;
	}  
	header('Content-Type: text/html; charset=utf-8');
	/////////////////////////////////////////////////////////////////////////////////////
	///    Script Que copia el archivo temporal subido al servidor en la carpeta especificada    
	/////////////////////////////////////////////////////////////////////////////////////
	
	sleep(1);

	// seleccionamos el directorio donde se copian los ficheros subidos
	$dir = 'ficheros_subidos/';

	// copiamos el archivo subido en la carpeta de trabajo
	if (!copy($_FILES['objetofile1']['tmp_name'],$dir.$_FILES['objetofile1']['name']))
	{
			//copy devuelve TRUE si copia el archivo
			//si hay algún problema devuelve FALSE
			echo "No se pudo copiar Archivo... Error COPY";
	}	
	else 
	// si no hay ningún problema
	{
			$registros = obtenerRegistros($dir);
			insertarDatos($registros);
			echo "<font face='Calibri' color='black' size='3'>El archivo: </font>";
			echo "<font face='Calibri' color='blue' size='3'>".$_FILES['objetofile1']['name']."</font>"."<br>";
			echo "<font face='Calibri' color='black' size='3'> se ha subido al Servidor sin problemas</font>";
			$_FILES=null;
	}
	
?>
