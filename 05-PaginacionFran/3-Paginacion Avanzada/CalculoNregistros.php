<?php
	// conexión con la base de datos
	require('conexion.php');

	// filtro de edad
	$v2=(int) $_GET['criterio2'];

	$consulta = "SELECT * FROM $tabla WHERE EDAD>$v2";
	$resultado = mysqli_query($conexion,$consulta);
	$nregistros = mysqli_num_rows($resultado);
	
	echo $nregistros;
	
	// cerramos la conexión 
	 mysqli_close($conexion); 
?>