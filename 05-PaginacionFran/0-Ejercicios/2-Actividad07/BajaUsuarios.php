<?php
	sleep(1);

	require('conexion.php');
	
	$dni=$_GET["DNI"];
	
	$consulta = "DELETE FROM tabla1 WHERE DNI='$dni'";
	$resultado = mysqli_query($conexion, $consulta);

	$registros_borrados=mysqli_affected_rows($conexion);
	
	echo $registros_borrados;

	
	mysqli_close($conexion); 
?>