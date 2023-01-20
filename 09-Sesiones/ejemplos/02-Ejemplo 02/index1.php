<?php
	// En este ejemplo sólo se ejecuta a través del navegador "index1.php"
	
	// *****************************************************************
	// iniciamos una sesión
	// *****************************************************************	
	// una vez iniciada la sesión podremos utilizar la variable $_SESSION
	
	// Esta instrucción Inicia una sesión para el usuario
	//	o continúa la sesión que pudiera tener abierta en otras páginas
	
	// aunque no me identifique con 'usuario' y 'password' ->
	//*** la variable se sesión se crea en el servidor
	//*** la cookie se crea en el cliente
	
	// en este ejemplo (y en todos los demás...)
	// consideramos que la sesión no se ha iniciado hasta que no hay valores en $_SESSION
	// pero realmente
	// aunque no haya valores en $_SESSION
	// LA SESIÓN SE HA INICIADO
	
	session_start();
	
	// visualizamos el nombre de la sesión que hemos iniciado
	// el nombre por defecto es "PHPSESSID"
	
	//echo session_name();
	
	//****************************************************************************
	//****************************************************************************
	
	// ACLARACIÓN
	// MUY IMPORTANTE ENTENDER ESTO -> IMPORTANTÍSIMO
	// a "página2.php" se le puede llamar desde dos sitios:
	// 1) desde el botón submit
	// 2) desde el vínculo html que tengo en la página
?>

<HTML>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<HEAD>
<TITLE>Pagina nº1:</TITLE>
</HEAD>

<BODY onLoad="document.formulario1.nombredelusuario.focus();">
		<div id="cuadrado contenedor"
		        style="border:2px solid #04B404;width:540px;height:480px;padding-left:60px;padding-right:60px;padding-top:10px;position:absolute;
			               top:50%;margin-top:-250px;left:50%;margin-left:-330px">
				
				<br>
				<h1><font color="blue">Esta es la página PRINCIPAL(index1):</font></h1>	
				
				<?php
				//comprobamos si la variable $_SESSION está definida
				//es decir si la variable fué instanciada

				// SESIÓN INICIADA
				if(isset($_SESSION['nombre']))
				{
					echo "<br><br>";
					echo "Ya has iniciado una sesion: <h3><font color='blue'>".$_SESSION['nombre']."</font></h3>";
					echo "<p><a href='pagina3.php'>Cerrar Sesion</a></p>";
				}
				
				// SESIÓN NO INICIADA				
				else
				{
				?>
				<!-- *** LLAMADA Nº1 a "pagina2.php" *** -->
				<form id="formulario1" name="formulario1" action="pagina2.php" method="POST">
						<fieldset> <legend>Datos del Usuario:</legend>
						<!-- usamos "placeholder" (HTML5 y CSS3) -->
						<!-- valor por defecto que desaparece al escribir algo -->
						<p>Nombre:<input type="text" id="nombredelusuario" name="nombredelusuario" placeholder="Pon tu nombre aquí"  required></p>
						<br/>
						<input type="submit" value="Enviar" style="cursor:pointer"/>
						</fieldset>
				</form>
				<?php
				}
				?>
				
				<!-- *** LLAMADA Nº2 a "pagina2.php" *** -->
				<div id="enlace" style="position:absolute;top:380px;left:65px;width:160; height:40px;border:1px solid red;padding-left:10px";>
						<p><a href="pagina2.php">Ir a pagina 2</a></p>
				</div>
		</div>
</BODY>
</HTML>