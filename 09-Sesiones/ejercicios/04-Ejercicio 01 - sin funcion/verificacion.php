<?php    
	
	usleep(400000);
	require('conexion.php');
	session_start();
    
	$user=$_POST['tuser'];
	$password=$_POST['tpassword'];
	
	// hago la consulta para saber si los datos del usuario son correctos
	$sql = "SELECT * FROM usuarios WHERE USUARIO = '$user' and PASSWORD = '$password'";
        
	//echo $sql;
		
	$resultado = mysqli_query($conexion,$sql);
        
	// calculo el nº de registros devueltos
	$nregistros=0;
	$nregistros=mysqli_num_rows($resultado);
		
	// registro encontrado
        if($nregistros==1)
		{
			$result = mysqli_fetch_array($resultado);
			//**********************
			// USUARIO EXISTE
			//**********************
			// AQUÍ ES CUANDO SE CREAN LAS VARIABLES DE SESIÓN (las que queramos)
			$_SESSION['userid'] = $result['IDUSUARIO'];
			$_SESSION['username'] = $result['USUARIO'];

			echo 0;
		}
		else
		{
			//**********************			
			// USUARIO NO EXISTE
			//**********************			
			echo "<font face='Calibri' color='red' size='3'>Error Validación !!</font>";
	}

	// cerramos la conexion 
	mysqli_close($conexion); 
?>