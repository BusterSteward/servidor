<?php
	header('Content-Type: text/html; charset=UTF-8');
	session_start();
	
	echo ("<h2><font color='brown'>Estoy en la Página 3</font></h2><br>") ;
	echo "Visualizo todas las variables de sesión creadas<br>";
	echo "Elimino TODO<br><br>";	
		
	// compruebo si se ha creado alguna variable de sesión
	if (isset($_SESSION['idusuario']))
	{
		// EXISTE->variable de sesión
		$nregistros=count($_SESSION['idusuario']);	
		
		// visualizamos el contenido de $_SESSION
		for ($i = 0; $i < $nregistros; $i++)
		  {
		   echo ("La variable  de sesión <font color='blue'>"."idusuario"."(".$i.")"."</font>"." tiene el valor: <font color='red'>".$_SESSION['idusuario'][$i]."</font><br>") ;
		   echo ("La variable  de sesión <font color='blue'>"."nombre"."(".$i.")"."</font>"." tiene el valor: <font color='red'>".$_SESSION['nombre'][$i]."</font><br>") ;
		   echo ("La variable  de sesión <font color='blue'>"."edad"."(".$i.")"."</font>"." tiene el valor: <font color='red'>".$_SESSION['edad'][$i]."</font><br>") ;
		   echo ("La variable  de sesión <font color='blue'>"."provincia"."(".$i.")"."</font>"." tiene el valor: <font color='red'>".$_SESSION['provincia'][$i]."</font><br>") ;
		   echo"<br>";
		  }
		echo "<br><br>";

		// de esta forma las elimino todas las variables de SESIÓN
		$_SESSION = array(); 

		// finalmente, destruimos la sesión
		// si elimino la sesión lo anterior no tiene mucho sentido
		session_destroy();
		
		// La cookie del ordenador CLIENTE que almacena la sesión 
		// se borrará cuando cerremos el navegador
		
		// en este ejemplo no la borramos nosotros		
	}
	else
	{
		// NO EXISTE->variable de sesión
		echo "No se ha creado ninguna variable de sesión";
	}	
?>




	

