<?php
	 header('Content-Type: text/html; charset=UTF-8');

	// *****************************************************************
	// iniciamos una sesión
	// *****************************************************************	
	// una vez iniciada la sesión podremos utilizar la variable $_SESSION
	
	// Esta instrucción Inicia una sesión para el usuario
	//	o continúa la sesión que pudiera tener abierta en otras páginas

	// una vez iniciada la sesión podremos utilizar la variable "$_SESSION"
	
	session_start();
	
	// visualizamos el nombre de la sesión que hemos iniciado
	// el nombre por defecto es "PHPSESSID"
	
	//echo session_name();
?>
<HTML>
<HEAD>
<TITLE>Pagina nº2:</TITLE>
</HEAD>

<BODY>
		<div id="cuadrado contenedor"
		        style="border:2px solid #04B404;width:540px;height:480px;padding-left:60px;padding-right:60px;padding-top:10px;position:absolute;
			               top:50%;margin-top:-250px;left:50%;margin-left:-330px">
				<br>
				<h1><font color="red">Esta es la PÁGINA2:</font></h1>	
				<h3><font color="green">Siempre es llamada desde página PRINCIPAL(index1):</font></h3>	
				
				<?php
				
					// MUY IMPORTANTE ENTENDER ESTO -> IMPORTANTÍSIMO
				
					// lo primero que tenemos que hacer es saber:
					// quien llama a este script??
					// 1) o lo llama: el formulario de index1.php cuando el usuario pulsa el botón submit
					// 2) o lo llama: el vínculo a pagina2.php de index1.php
					
					// comprobamos si el usuario está iniciando sesión
					// si existe algo en "$_POST['nombre']" es porque el usuario habrá
					// escrito algo en la caja de texto "nombre" y habrá pulsado el botón submit de Login
					
					if(isset($_POST['nombredelusuario']))
					// *** PAGINA2.PHP se llama desde botón submit ***
					{
							// almacenamos su nombre en "$_SESSION"
							// Y AQUÍ REALMENTE ES DONDE SE CREA LA SESIÓN
							
							// esto sólo se ejecuta una vez
							// aquí entro solamente una vez
							$_SESSION['nombre'] = $_POST['nombredelusuario'];
							
							// ahora lo que podríamos hacer es MODIFICAR LA COOKIE
							// ahora le alargamos la vida a la COOKIE QUE YA TENEMOS CREADA
							// VIVIRÁ aunque CERREMOS el navegador
							// ¿ y eso que supone ?
							// que si cierro el navegador, después lo abro y vuelvo a ejecutar index1.php
							// no me pedirá que me identifique
							
							
							// probar este ejercicio comentando esta línea
							// y sin comentarla
							// con esto lo que estamos haciendo es modificar la cookie 'PHPSESSID'
							// que fue la que creó el servidor cuando iniciamos sesión con 'session_start()'
							setcookie('PHPSESSID', $_COOKIE['PHPSESSID'], time()+999999);
							
							// tendremos 2 cookis
							// una que muere cuando cierro el navegador
							// y la otra que no morirá hasta que no le llegue su hora
							
							echo "<br><br>";
							echo "Bienvenido!!:";
							echo "<h3><font color='blue'>".$_SESSION['nombre']."</font></h3>";
							// cuantas veces va a salir esto ???
							// solamente 1 vez
							echo "has iniciado en este momento (ahora mismo) una sesion con éxito.";
					}
					else // (comprobamos (2 cosas) si el usuario había iniciado sesión anteriormente o no ha iniciado nada)
					{
							// *** PAGINA2.PHP se llama desde el enlace ***
							// si no existe algo en "$_POST['nombre']" comprobamos si el usuario había
							// iniciado sesión anteriormente
							if(isset($_SESSION['nombre']))
							{
								echo "<br><br>";
								echo "Bienvenido!!:";
								echo "<h3><font color='blue'>".$_SESSION['nombre']."</font></h3>";
								echo "tienes una sesión iniciada.";
								echo session_name();
							}
							else
							{
								// deniego el acceso
								echo "<br><br>";
								echo "<h3>Acceso Restringido!! <br> Lárgate de este sitio que no tienes autorización!!<br>No has iniciado SESIÓN !!<br>Pirata !!! <br>Bandarra !!! </h3>";
							}
					}
				?>
				<div id="enlace" style="position:absolute;top:380px;left:65px;width:160; height:40px;border:1px solid red;padding-left:10px";>
						<p><a href="index1.php">Ir a pagina 1</a></p>
				</div>
		</div>
</BODY>
</HTML>
