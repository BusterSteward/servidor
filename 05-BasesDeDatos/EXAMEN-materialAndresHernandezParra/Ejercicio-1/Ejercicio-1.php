<?php
	header('Content-Type: text/html; charset=utf-8');

	//Compruebo si existe el fichero para leerlo
	$existo=file_exists('para_borrar.txt'); 
	if(!$existo){
		exit("No existe el archivo para_borrar.txt");
	}
	else{
		//abro el fichero y creo mi tabla
		$fichero=fopen('para_borrar.txt','rb');
		$miTabla=array();
		while(!feof($fichero)){//leo cada linea del fichero y separo los codigos con explode
			$linea=trim(fgets($fichero));
			$codigos=explode("-",$linea);

			//por cada codigo que encuentro, compruebo si ya tengo una celda en mi tabla con ese codigo como clave,
			//si no es asi, lo guardo
			foreach($codigos as $codigo){
				if(!isset($miTabla[$codigo])){
					$miTabla[$codigo]=$codigo;
				}
			}
		}
		//cierro el fichero
		fclose($fichero);
	}

	require("conexion.php");

	//por cada registro que he guardado en mi tabla realizo un delete en la BBDD
	foreach($miTabla as $registro){

		$consulta="DELETE FROM usuarios1 WHERE CODIGO='$registro'";

		mysqli_query($conexion,$consulta);

		
		$registros_borrados=mysqli_affected_rows($conexion);//recupero las filas afectadas

		echo "el registro con CÓDIGO=$registro se ha borrado $registros_borrados veces<br>";//muestro el resultado del delete
		
	}
	mysqli_close($conexion);//cierro la conexion

?>
