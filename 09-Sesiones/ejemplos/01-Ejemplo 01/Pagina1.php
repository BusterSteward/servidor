<?php
	header('Content-Type: text/html; charset=UTF-8');
	// *****************************************************************
	// iniciamos una sesión
	// *****************************************************************	
	// una vez iniciada la sesión podremos utilizar la variable $_SESSION
	
	// Esta instrucción Inicia una sesión para el usuario
	//	o continúa la sesión que pudiera tener abierta en otras páginas
	
	//****************************************************************
	//Prueba por partes - PARTE 1
	//****************************************************************
	/*
	session_start();
	
	// visualizamos el nombre de la sesión que hemos iniciado
	// el nombre por defecto es "PHPSESSID"
	
	echo session_name();
	echo "<br><br>";
	
	// creamos variables de sesión
	$_SESSION['idusuario']="1004";
	$_SESSION['nombre']="PEPE";
	$_SESSION['edad']=23;
	$_SESSION['provincia']="CUENCA";

	// visualizamos el contenido de $_SESSION
	// directamente
	echo $_SESSION['idusuario']."<br>";
	echo $_SESSION['nombre']."<br>";
	echo $_SESSION['edad']."<br>";
	echo $_SESSION['provincia']."<br>";
	echo "<br>";
	
	// visualizamos el contenido de $_SESSION
	// a través de un bucle
	foreach ($_SESSION as $indice => $valor)
	  {
	   echo ("La variable de sesión  <font color='blue'>".$indice."</font>"." tiene el valor: <font color='red'>".$valor."</font><br>") ;
	  }
	echo "<br><br>";
	 
	 // eliminamos la sesión
	 $_SESSION=array();
	 session_destroy(); 
	 
	 */
	//****************************************************************
	//Prueba por partes - PARTE 2
	//****************************************************************
	 
	 // iniciamos una nueva sesión
	 session_start();
	 
	 // creamos variables de sesión
	$_SESSION['idusuario'][0]="1004";
	$_SESSION['nombre'][0]="PEPE";
	$_SESSION['edad'][0]=23;
	$_SESSION['provincia'][0]="CUENCA";
	
	 // creamos variables de sesión
	$_SESSION['idusuario'][1]="2000";
	$_SESSION['nombre'][1]="MARTA";
	$_SESSION['edad'][1]=34;
	$_SESSION['provincia'][1]="MADRID";
	
	 // creamos variables de sesión
	$_SESSION['idusuario'][2]="3002";
	$_SESSION['nombre'][2]="LUIS";
	$_SESSION['edad'][2]=48;
	$_SESSION['provincia'][2]="ALBACETE";
	
	// para contar el nº de registros con "count()" en una array bidimensional hay que poner el nombre de alguno de sus campos
	$nregistros=count($_SESSION['idusuario']);
	
	echo ("<h2><font color='brown'>Estoy en la Página 1</font></h2>") ;
	echo "Creo estas variables de sesión (PEPE-MARTA.LUIS)-> siempre las mismas y en la misma posición<br>";
	echo "Si hay alguna más la visualizo (las EVA)<br><br>";
	echo session_name()."<br><br>";

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
	  
?>