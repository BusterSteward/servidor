<?php    
	
	usleep(400000);
	
	session_start();
    
	//*********************************************************************************************
	// OJO: tenemos un parámetro de salida "result" donde tendremos almacenado un registro de la base de datos
	//*********************************************************************************************
	function verificar_login($user,$password,&$result)
    {
		require('conexion.php');
	
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
			$result = mysqli_fetch_object($resultado);
            return 1;
        }
		// registro no encontrado
        elseif ($nregistros==0)
        {
            return 0;
        }
		// cerramos la conexion 
		mysqli_close($conexion); 
	
    }
	//***************************************************************************************
    
	// para saber si la casilla de recordar sesión está marcada
	$marcada=$_POST['recordar'];	
	
	// hay que tener claro que a este script lo llama el USUARIO con el botón de LOGIN y NADIE MÁS
	// lo 1º que tenemos hacer
	// compruebo si los datos introducidos por el cliente SON CORRECTOS 
	if(verificar_login($_POST['tuser'],$_POST['tpassword'],$result) == 1)
	{
			// USUARIO EXISTE
			
			// AQUÍ ES CUANDO SE CREAN LAS VARIABLES DE SESIÓN (las que queramos)
			// observa como accedemos al registro que nos devuelve 'verificar_login'
			// $result[IDUSUARIO] así no funciona;
			$_SESSION['nif'] = $result->NIF;
			$_SESSION['username'] = $result->USUARIO;

			// si se ha marcado el checkbox "recordar" -> la opción de mantener sesión abierta
			if($marcada)
			{
				setcookie('PHPSESSID', $_COOKIE['PHPSESSID'], time()+999999);
			}
			// si No se ha marcado el checkbox "recordar" -> 
			else
			{
				setcookie('PHPSESSID', $_COOKIE['PHPSESSID']);
			}			
			
			echo trim($_SESSION['username']);
	}
	else
	{
			// USUARIO NO EXISTE
			echo 0;
	}
?>

 
 