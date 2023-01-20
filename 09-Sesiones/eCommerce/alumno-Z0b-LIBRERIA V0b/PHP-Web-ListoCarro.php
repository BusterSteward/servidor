<!DOCTYPE html>
<html lang="es">
<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<meta http-equiv="Pragma" content="no-cache">
		 
		<meta name="description" content="Plataforma Comercio Electrónico">
		<meta name="author" content="Jorge López">

		<link rel="shortcut icon" href="imagenes/icon.png"/>

		<title>e-Commerce</title>

		<!-- estilo general de la página -->
		<link href="ficheros/estilo_pagina.css" rel="stylesheet">
		
		<!-- estilo barra de menú -->
		<link href="ficheros/barra_menu.css" rel="stylesheet">		
		
		<!-- estilo de tablas -->
		<link href="ficheros/tablas2.css" rel="stylesheet">
		
		<!-- estilo barra de Navegar -->
		<link href="ficheros/navegacion.css" rel="stylesheet">

		<!-- librería jQuery -->
		<script type="text/javascript" src="ficheros/jquery.js"></script>		
		
		<!-- biblioteca de iconos -->
		<link href="ficheros/all.css" rel="stylesheet">
		
 </head>

<script language='javascript'>
//************************************************************************************************
//***************************************** INICIO ************************************************
//******************************** Llamo a "PHP-ListoCarro2-V1.php" **********************************
//************************************************************************************************
//************************************************************************************************
function inicio()
{
	// visualizo estrella
	document.getElementById('estrella').style.visibility='visible';	
	// deshabilito botones
	document.getElementById('B1').disabled=true;
	document.getElementById('B2').disabled=true;
	document.getElementById('B3').disabled=true;
			
	var url = "PHP-ListoCarro2-V1.php";
	// hago la llamada
	// utilizamos método "$.load" de jQuery

	$("#latabla").load(url,{}, llegadaDatos1);
}

// callback
function llegadaDatos1(datos)
{
	// oculto estrella
	document.getElementById('estrella').style.visibility='hidden';
	// habilito botones
	document.getElementById('B1').disabled=false;		
	document.getElementById('B2').disabled=false;		
	document.getElementById('B3').disabled=false;		
}

</script>

<body onload="inicio();">
<!-- **************************** CABECERA ************************************************ -->
<!-- **************************** CABECERA ************************************************ -->
<!-- **************************** CABECERA ************************************************ -->
<header>
<div class="BarraNavegar2">
		<img id='logo' src="imagenes/logo.jpg" >	
		<img id='logo2' src="imagenes/logo2.jpg" >
		
		<!-- alineados a la derecha -->
		<nav id="01" class="Opcion_menu_right2" style="border:0px solid blue;">
			<button class="boton2" id="B1" type="button"
			onclick="location.href='index1.php';">
			<i class="far fa-arrow-alt-circle-left fa-lg"></i> Volver
			</button>				
			
			<button class="boton2" id="B2" type="button"
			onclick="">
			<i class="fas fa-desktop fa-lg"></i> Pdf
			</button>				
			
			<button class="boton2" id="B3" type="button"
			onclick="">
			<i class="far fa-envelope fa-lg"></i> E-mail
			</button>										
		</nav>		
</header>

<!-- **************************** CUERPO ************************************************ -->
<!-- **************************** CUERPO ************************************************ -->
<!-- **************************** CUERPO ************************************************ -->
<div class="contenedor1">
<div id="latabla" class="contenedor2" style="padding-top:15px;"> 
		<!-- donde se visualiza la tabla -->
</div>
</div>
<!-- **************************** FOOTER ************************************************ -->
<!-- **************************** FOOTER ************************************************ -->
<!-- **************************** FOOTER ************************************************ -->
<footer class="footer">
		<img  id="estrella" src="imagenes/estrella.gif"  height="40" width="40" style="visibility:hidden;"/>
		&nbsp&nbsp<img id='logo' src="imagenes/logo.jpg">	
		<label>&nbsp © 2022 Fnac Madrid</label>		
</footer>
</body>
</html>