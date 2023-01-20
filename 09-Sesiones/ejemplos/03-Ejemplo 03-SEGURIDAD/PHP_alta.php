<?php 

	usleep(400000);
		
	require('conexion.php');

	# recogemos los datos del array $POST
	$v1=$_POST['tuser'];
	$v2=$_POST['tpassword'];

	// https://www.php.net/manual/es/function.password-hash.php
	// password_hash(): crea un nuevo hash de contraseña usando un algoritmo de hash fuerte de único sentido.

	$contrasenia_segura=password_hash($v2, PASSWORD_BCRYPT);

	$consulta="INSERT $tabla (USUARIO, PASSWORD) VALUES ('$v1','$contrasenia_segura')";

	mysqli_query($conexion,$consulta); 

	//MUY IMPORTANTE
	//siempre hay que hacer esto
	//cerramos la conexion  con la base de datos
	mysqli_close($conexion); 
?>