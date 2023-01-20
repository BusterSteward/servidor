<?php
	header('Content-Type: text/html; charset=UTF-8'); 
	session_start();
	
	// cuando refresquemos la página tenemos que comprobar si la sesión sigue activa
	
	if (!isset($_SESSION['username']))
	{
		header('location: index1.php');		
	}	 	
?>
<!DOCTYPE html>
<html lang="es">
<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<meta http-equiv="Pragma" content="no-cache">
		 
		<meta name="description" content="Prácticas con la Gestión de Sesiones-Login en Servidor">
		<meta name="author" content="Jorge López">

		<link rel="shortcut icon" href="imagenes/icon.png"/>

		<title>Correo</title>

		<!-- estilo general de la página -->
		<link href="ficheros/estilo_pagina.css" rel="stylesheet">
		
		<!-- estilo barra de menú -->
		<link href="ficheros/barra_menu.css" rel="stylesheet">		

		<!-- estilo formularios-botones -->
		<link href="ficheros/formularios.css" rel="stylesheet">		
		
		<!-- biblioteca de iconos -->
		<link href="ficheros/all.css" rel="stylesheet">
		
		<!-- librería jQuery -->
		<script type="text/javascript" src="ficheros/jquery.js"></script>		
</head>

<script type="text/javascript">

</script>

<body onload="inicio();">
<!-- **************************** CABECERA ************************************************ -->
<!-- **************************** CABECERA ************************************************ -->
<!-- **************************** CABECERA ************************************************ -->
<header>
<div class="BarraNavegar">
				<img id='correo' src="imagenes/logo.jpg" >	
				<label  class="L1">Correo</label>		
</div>
</header>

<!-- **************************** CUERPO ************************************************ -->
<!-- **************************** CUERPO ************************************************ -->
<!-- **************************** CUERPO ************************************************ -->
<div class="contenedor1">
		<!-- AZUL -->
		<div class="contenedor2">
				<!-- NARANJA -->
				<div class="contenedor3">
							<div id="logout">
							<?php    
								 echo "(".$_SESSION['username'].") "."<a href='logout.php'>Logout</a>"."&nbsp";
							?>
							</div>
						<img id='correo' src="imagenes/imagencorreo.jpg" >		
				</div>						
		</div>
</div>
<!-- **************************** FOOTER ************************************************ -->
<!-- **************************** FOOTER ************************************************ -->
<!-- **************************** FOOTER ************************************************ -->
<footer class="footer">
		<img  id="estrella" src="imagenes/estrella.gif"  height="40" width="40" style="visibility:hidden;"/>
		&nbsp&nbsp<i class="fas fa-building fa-2x" ></i>
		<label>&nbsp © 2022 IES Escultor</label>		
</footer>

</body>
</html>