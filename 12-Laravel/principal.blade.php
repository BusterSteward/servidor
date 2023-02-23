<!DOCTYPE html>
<html lang="es">
<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		 
		<meta name="description" content="CRUD NodeJS 2ºDAW">
		<meta name="author" content="Jorge López">

		<link rel="shortcut icon" href="imagenes/icon.png"/>

		<title>Aplicación Estudiantes</title>

		<!-- estilo general de la página -->
		<link href="ficheros/estilo_pagina.css" rel="stylesheet">

		<!-- estilo barra de menú -->
		<link href="ficheros/barra_menu.css" rel="stylesheet">		
		
		<!-- estilo de formularios -->
		<link href="ficheros/formularios.css" rel="stylesheet">
		
		<!-- estilo de tablas -->
		<link href="ficheros/tablas.css" rel="stylesheet"
		>
		<!-- biblioteca de iconos -->
		<link href="ficheros/all.css" rel="stylesheet">		
</head>

<body onload="">
<!-- **************************** CABECERA ************************************************ -->
<!-- **************************** CABECERA ************************************************ -->
<!-- **************************** CABECERA ************************************************ -->
<header>

<div class="BarraNavegar">
		<!-- título de la barra -->
		<div class="Opcion_menu">
				<i class="fas fa-users fa-2x"></i>
				<label class="titulo" ></label>	
				<label  class="L1">Laravel Vista: Principal</label>		
				<label  class="L2"><b></b></label>		
				<label  class="L3"></label>					
		</div>
		<!-- icono -->
		<div class="Opcion_menu Opcion_menu_icono">
			<i class="fas fa-bars"></i>
		</div>			
		
		<!-- alineados a la izquierda -->
		<nav class="Grupo_opciones">
					<div class="Opcion_menu" onclick="">
							<label id="1" class="label_menu"
							onmousemove="document.getElementById('1').style.color = 'aqua';"
							onmouseout="document.getElementById('1').style.color = 'white';"							
							>Opción-1</label>
					</div>		
					<div class="Opcion_menu" onclick="">
							<label id="2" class="label_menu"
							onmousemove="document.getElementById('2').style.color = 'aqua';"
							onmouseout="document.getElementById('2').style.color = 'white';"							
							>Opción-2</label>
					</div>
		</nav>
		
</div>
</header>
<!-- **************************** CUERPO ************************************************ -->
<!-- **************************** CUERPO ************************************************ -->
<!-- **************************** CUERPO ************************************************ -->

<div class="contenedor1">
	<img id="imagenlogo" src="/imagenes/laravel.jpg" style="cursor:pointer;max-width: 90%;"></img>
</div>

<!-- **************************** FOOTER ************************************************ -->
<!-- **************************** FOOTER ************************************************ -->
<!-- **************************** FOOTER ************************************************ -->
<footer class="footer">
		<img  id="estrella" src="imagenes/estrella.gif"  height="40" width="40" style="visibility:hidden;"/>
		&nbspLaravel&nbsp&nbsp<i class="fas fa-bolt fa-2x" ></i>
		<label>&nbsp © 2022 Copyright</label>		
</footer>

</body>
</html>

<!-- ***************************************************************-->
<!-- este código se ejecuta después de cargar la página -->
<!-- ***************************************************************-->
<script type="text/javascript">
//**********************************************************************************
// función asociada al "click" del menú pequeñito de barras  
function visualizo_opciones()
{
	// navs->es un array compuesto por todos los elementos pertenecientes a la clase "'.Grupo_opciones"
	// este array tendrá 2 elementos
	const navs = document.querySelectorAll('.Grupo_opciones');
	const navs2 = document.querySelectorAll('.Grupo_opciones_derecha');
	//alert(navs.length);
	//alert(navs2.length);
	
	// con el método ".forEach" me recorro el array y a cada elemento del array le asocio la clase ".visualizo"
	navs.forEach(nav => {nav.classList.toggle('visualizo');});
	navs2.forEach(nav => {nav.classList.toggle('visualizo');});
}
//***********************************************************************************
// código
//***********************************************************************************
// asocio la función "visualizo_opciones()" al evento "click" sobre el menú de barra para móviles
document.querySelector('.Opcion_menu_icono').addEventListener('click', visualizo_opciones);

</script>



