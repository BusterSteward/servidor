<?php
	header('Content-Type: text/html; charset=UTF-8');

	require("conexion.php");
	//compruebo que el fichero existe para leerlo
	$existo=file_exists('fichero.txt'); 
	if(!$existo){
		exit("No existe el archivo fichero.txt");
	}
	else{
		//abro el fichero de lectura y el fichero en el que quiero guardar el resultado
		$fichero=fopen('fichero.txt','rb');
		$result=fopen('fichero2.txt','wb');
		
		while(!feof($fichero)){//por cada linea que leo del fichero hago un insert en la BBDD
			
			$linea=trim(fgets($fichero));
			
			$consulta="INSERT INTO fichero (LINEA) VALUES ('$linea')";

			mysqli_query($conexion,$consulta);
			
		}
		fclose($fichero);//Cierro el fichero de lectura

		//recupero todos los registros que he introducido en la base de datos y los ordeno por linea
		$consulta="SELECT LINEA FROM fichero ORDER BY LINEA";

		$resultado=mysqli_query($conexion,$consulta);

		$nregistros=mysqli_num_rows($resultado);//recupero el numero de filas de la consulta
		$contador=0;

		
		while($contador<$nregistros){//por cada fila escribo en el fichero la linea
			$registro=mysqli_fetch_array($resultado);
			fwrite($result,$registro["LINEA"]."\r\n");
			$contador++;
		}
		//cierro la conexion y el fichero de escritura
		mysqli_close($conexion);
		fclose($result);
	}


	
?>