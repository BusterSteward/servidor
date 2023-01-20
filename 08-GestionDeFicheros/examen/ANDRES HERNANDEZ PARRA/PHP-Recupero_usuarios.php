<?php
	header('Content-Type: text/html; charset=utf-8');

	//conexión con la base de datos
	require('conexion.php');

	$consulta = "SELECT * FROM USUARIOS ORDER BY ELUSUARIO";
	$resultado = mysqli_query($conexion,$consulta);

	//obtengo el nº de registros devueltos en la consulta
	$nregistros=mysqli_num_rows($resultado);

	if ($nregistros==0)
	{
		echo 0;
	}
	else
	{
		while($fila = mysqli_fetch_array($resultado))
		{
			// en este array iremos almacenando los datos de los socios 1 por 1
			$json_data_usuario = array();
			
			$json_data_usuario["usuario"] = $fila["ELUSUARIO"];
			$json_data_usuario["carpeta"] = $fila["CARPETA"];

			$jsondataLista[]=$json_data_usuario;
		}	
		
		$jsondatos["lista"] = array_values($jsondataLista);
		header("Content-type:application/json; charset = utf-8"); 
		echo json_encode($jsondatos);
	}

	//MUY IMPORTANTE
	//siempre hay que hacer esto
	//cerramos la conexion  con la base de datos
	 mysqli_close($conexion); 	
?>