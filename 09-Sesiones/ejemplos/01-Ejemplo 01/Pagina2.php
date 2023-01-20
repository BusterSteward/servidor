<?php

	header('Content-Type: text/html; charset=UTF-8');
	
	// si no pusiera esto
	// no podría acceder en esta página a la información almacenada de la sesión
	session_start();
	
	echo ("<h2><font color='brown'>Estoy en la Página 2</font></h2><br>") ;
	echo "Visualizo todas las variables de sesión creadas<br>";
	echo "Creo una EVA nueva -> al final en la siguiente posición -> que no visualizo<br><br>";		
	
	// para contar el nº de registros con "count()" en una array bidimensional hay que poner el nombre de alguno de sus campos
	if (isset($_SESSION['idusuario']))
	{
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
	}
	
	// creamos una variable de sesión nueva en esta página nº2
	// calculamos la posición donde lo tenemos que insertar
	if (isset($_SESSION['idusuario']))
	{	
		$posicion=count($_SESSION['idusuario']);
	}
	else
	{
		$posicion=0;
	}
	
	$_SESSION['idusuario'][$posicion]="4000";
	$_SESSION['nombre'][$posicion]="EVA ".$posicion;
	$_SESSION['edad'][$posicion]=23;
	$_SESSION['provincia'][$posicion]="ALICANTE";
?>




	

