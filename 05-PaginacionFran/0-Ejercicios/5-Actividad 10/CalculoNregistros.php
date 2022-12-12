<?php
	// conexión con la base de datos
	require('conexion.php');

	$consulta = "SELECT * FROM ARTICULOS";
	$resultado = mysqli_query($conexion,$consulta);
	$registros_borrados=mysqli_affected_rows($conexion);
	
	echo $registros_borrados;
	
	// cerramos la conexión 
	 mysqli_close($conexion); 
?>