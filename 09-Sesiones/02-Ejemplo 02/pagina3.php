<?php
	// *****************************************************************
	// iniciamos una sesión
	// *****************************************************************	
	// una vez iniciada la sesión podremos utilizar la variable $_SESSION
	
	// Esta instrucción Inicia una sesión para el usuario
	//	o continúa la sesión que pudiera tener abierta en otras páginas
	session_start();
	
	// almacenamos el nombre de sesión (antes de borrarla) para luego informar al usuario
	$nombre_sesion=session_name();
	
	
	// luego borramos la cookie que almacena la sesión
	// si no borramos la cookie se borrará sola al cerrar el navegador	
	if(isset($_COOKIE[session_name()]))
	{
	// eliminamos la cookie del CLIENTE
	// se eliminará la cookie que tenemos almacenada en el cliente
	//************************************************************
	// si ejecuto esta línea la cookie la borro
	// aunque no haya cerrado el navegador la cookie ya no existe
	setcookie(session_name(), '', time() - 42000); 
	//************************************************************
	} 
	
	// finalmente, destruimos la sesión EN EL SERVIDOR
	// se eliminará la variable de sesión que tenemos almacenada en el servidor en /tmp
	$_SESSION = array();
	session_destroy();
?>

<HTML>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<HEAD>
<TITLE>Pagina nº3:</TITLE>
</HEAD>

<BODY>
		<div id="cuadrado contenedor"
		        style="border:2px solid #04B404;width:540px;height:480px;padding-left:60px;padding-right:60px;padding-top:10px;position:absolute;
			               top:50%;margin-top:-250px;left:50%;margin-left:-330px">

				<br>
				<h1><font color="red">Esta es la PÁGINA3:</font></h1>
				<h3><font color="green">Siempre es llamada desde INDEX1:</font></h3>					

			   <?php
				echo "<br><br>";
				echo "Has cerrado la sesión con nombre: <br>";
				echo "(no confundir NOMBRE DE SESIÓN con el NOMBRE del que ha iniciado la sesión)"; 
				echo "<h3><font color='blue'>".$nombre_sesion."</font></h3>";
				?>
				
				<div id="enlace" style="position:absolute;top:380px;left:65px;width:160; height:40px;border:1px solid blue;padding-left:10px";>
						<p><a href="index1.php">Ir a página INDEX1</a></p>
				</div>
		</div>
</BODY>
</HTML>