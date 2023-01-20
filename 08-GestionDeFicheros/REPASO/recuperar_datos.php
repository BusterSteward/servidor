<?php
	// incluimos el fichero de conexión con la base de datos
	require('conexion.php');
	
	// consulta SQL para recuperar datos del servidor de Base de Datos
	$consulta = "SELECT * FROM empleados";

	// ejecuto la consulta SQL en el servidor de Base de Datos con "mysqli_query"
	// a "mysqli_query" le pasamos 2 parámetros
	// 1º la consulta SQL a ejecutar
	// 2º la conexión al servidor de Base de Datos

	// en $resultado tendremos almacenados todos los registros que me devuelva la consulta
	// estos datos->son inaccesibles
	// tendremos que utilizar "mysqli_fetch_array" para poder acceder a estos datos
	$resultado = mysqli_query($conexion,$consulta);	
		
	// me posiciono sobre el primer registro devuelto por el servidor de Base de Datos
	$registro = mysqli_fetch_array($resultado);
	while ($registro)
	{
		echo $registro["CODE"]."<br>";
		echo $registro["NOMBRE"]."<br>";
		echo $registro["EDAD"]."<br><br><br>";
		// me posiciono sobre el siguiente registro devuelto por el servidor de Base de Datos
		$registro = mysqli_fetch_array($resultado);
	}

//MUY IMPORTANTE
//siempre hay que hacer esto
//cerramos la conexion  con la base de datos
mysqli_close($conexion); 
exit();
 ?>