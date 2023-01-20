<?php    
	
	usleep(400000);
	
	session_start();
	
	// la conexión hay que ponerla aquí
	require('conexion.php');
	
	// stripslashes(): quita las barras de un string con comillas escapadas
	// https://www.php.net/manual/es/function.stripslashes.php

	// mysqli.real-escape-string(): escapa los caracteres especiales de una cadena para usarla en una sentencia SQL
	// https://www.php.net/manual/es/mysqli.real-escape-string.php
	
	// quito caracteres peligrosos
	$el_usuario=stripslashes($_POST['tuser']);
	$el_usuario=mysqli_real_escape_string($conexion,$el_usuario);
	
	$la_contrasenia=stripslashes($_POST['tpassword']);
	// a nivel general del script también habría que poner -> require('conexion.php');
	$la_contrasenia=mysqli_real_escape_string($conexion,$la_contrasenia);
	

	// hago la consulta para saber si los datos del usuario son correctos
	// recupero toda la información
		
	// el campo por el que se busque tiene que ser clave
	// en este caso se supone que el campo "USUARIO" es clave
	$sql = "SELECT * FROM usuarios WHERE USUARIO = '$el_usuario'";
				
	$resultado = mysqli_query($conexion,$sql);
        
	// calculo el nº de registros devueltos
	$nregistros=0;
	$nregistros=mysqli_num_rows($resultado);
	
	// registro encontrado
	if($nregistros==1)
	{
		$result = mysqli_fetch_array($resultado);
		// recupero la contraseña encriptada
		$contrasenia_encriptada=$result["PASSWORD"];
		
		// https://www.php.net/manual/es/function.password-verify.php
		// password_verify(): comprueba que la contraseña coincida con un hash
		
		// compruebo si la contraseña es válida
		// OJO: observa que nunca podremos saber el valor real de la contraseña -> NUNCA
		if (password_verify($la_contrasenia, $contrasenia_encriptada))
		{
				// ********************************************
				// USUARIO EXISTE -> usuario y contraseña válidas
				// ********************************************
				$_SESSION['userid'] = $result['IDUSUARIO'];
				$_SESSION['username'] = $result['USUARIO'];
				
				// visualizo el mensaje de éxito 
				echo "<font face='Calibri' color='green' size='3'>ÉXITO: Login correcto !!</font>";
		} 
		else
		{
			echo "<font face='Calibri' color='red' size='3'>ERROR: Contraseña Inválida !!</font>";
		}	
	}
	// registro no encontrado
	elseif ($nregistros==0)
	{
		// *****************************
		// USUARIO NO EXISTE
		// *****************************
		// visualizo el mensaje de error 
		{echo "<font face='Calibri' color='red' size='3'>ERROR: Usuario NO existe !!</font>";}	
	}
	// cerramos la conexion 
	mysqli_close($conexion); 	

?>
 
 
 