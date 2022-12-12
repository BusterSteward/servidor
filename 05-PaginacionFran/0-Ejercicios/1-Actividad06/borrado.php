<?php
	require('conexion.php');
	//sleep(1);
	usleep(100000);
	//recupero el dni
	$dni=$_GET["DNI"];

	$query = "DELETE FROM tabla1 WHERE DNI='$dni'";
	mysqli_query($conexion, $query);
	
	mysqli_close($conexion); 
	exit();
?>