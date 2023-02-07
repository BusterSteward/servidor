<?php 
	// si la sesión no fue cerrada->la borramos
	session_start();
	
	// la siguiente línea la tendrás que personalizar con tu $_SESSION[??][??]
	// si existe la variable de sesión -> eso significa que sigue existiendo la sesión
	// si existe la borro
	if(isset($_SESSION['fila1'][0])) {header('location: PHP-logout.php');}
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

		<title>Juego</title>

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

function inicio()
{

}

//***********************************************************************************************
//***************************** FUNCIONALIDAD-1: CREAR $_SESSION **********************************
//******************************* Llamo a "PHP-crear_SESSION.php" ***********************************
//***********************************************************************************************
//***********************************************************************************************

function crear_session()
{
	// visualizo estrella
	document.getElementById('estrella').style.visibility='visible';	
	// deshabilito botón
	document.getElementById('boton1').disabled=true;
			
	// hago la llamada utilizando AJAX jQuery
	// el callback obligatoriamente se llamará "llegadaDatos1()"
	
	var url = "PHP-crear_SESSION.php";
	// aquí la llamada
	$.post(url,{},llegadaDatos1);
}
// callback
function llegadaDatos1()
{
	// oculto estrella
	document.getElementById('estrella').style.visibility='hidden';

	// habilito botón VER NUMEROS
	document.getElementById('boton3').disabled=false;	
	// habilito botón VER FRUTAS
	document.getElementById('boton4').disabled=false;			
	// habilito botón ELIMINO CELDA
	document.getElementById('boton5').disabled=false;				
	// habilito botón CIERRO SESIÓN
	document.getElementById('boton2').disabled=false;					
}

//***********************************************************************************************
//************************************** VER NUMEROS ********************************************
//****************************** Llamo a "PHP-ver_NUMEROS.php" ************************************
//***********************************************************************************************
//***********************************************************************************************

function ver_numeros()
{
	// visualizo estrella
	document.getElementById('estrella').style.visibility='visible';	

	// deshabilito botones
	document.getElementById('boton3').disabled=true;	
	document.getElementById('boton4').disabled=true;
	document.getElementById('boton5').disabled=true;
	
	document.getElementById('jugadas').innerHTML="";
	
	// hago la llamada utilizando AJAX jQuery
	// el callback obligatoriamente se llamará "llegadaDatos2()"
	
	var url = "PHP-ver_NUMEROS.php";
	// aquí la llamada
	$("#jugadas").load(url,{},llegadaDatos2);
	
}
// callback
function llegadaDatos2()
{
	// oculto estrella
	document.getElementById('estrella').style.visibility='hidden';
	
	// habilito botones
	document.getElementById('boton3').disabled=false;
	document.getElementById('boton4').disabled=false;
	document.getElementById('boton5').disabled=false;	
}

//***********************************************************************************************
//**************************************** VER FRUTAS ********************************************
//******************************** Llamo a "PHP-ver_FRUTAS.php" ************************************
//***********************************************************************************************
//***********************************************************************************************

function ver_frutas()
{
	// visualizo estrella
	document.getElementById('estrella').style.visibility='visible';	

	// deshabilito botones
	document.getElementById('boton3').disabled=true;	
	document.getElementById('boton4').disabled=true;
	document.getElementById('boton5').disabled=true;
	
	document.getElementById('jugadas').innerHTML="";
	
	// hago la llamada utilizando AJAX jQuery
	// el callback obligatoriamente se llamará "llegadaDatos3()"
	
	var url = "PHP-ver_FRUTAS.php";
	// aquí la llamada
	$("#jugadas").load(url,{},llegadaDatos3);
}
// callback
function llegadaDatos3()
{
	// oculto estrella
	document.getElementById('estrella').style.visibility='hidden';
	
	// habilito botones
	document.getElementById('boton3').disabled=false;
	document.getElementById('boton4').disabled=false;
	document.getElementById('boton5').disabled=false;	
}

//***********************************************************************************************
//**************************************** BORRO CELDA ******************************************
//********************************* Llamo a "PHP-borro_CELDA.php" **********************************
//***********************************************************************************************
//***********************************************************************************************
function borrar_celda()
{
	// generamos un nº aleatorio comprendido entre 1-5
	var fila=Math.floor(Math.random() * (5)) + 1;
	
	// generamos un nº aleatorio comprendido entre 0-3
	var columna=Math.floor(Math.random() * (4)) + 0;

	// avisamos por pantalla la celda que se va a borrar
	// es decir, en esa posición pondremos un 0
	alert('La celda anulada es: FILA: '+fila+'  COLUMNA: '+columna);
	
	// hago la llamada utilizando AJAX jQuery
	// el callback obligatoriamente se llamará "llegadaDatos4()"	
	
	// OJO: no poner .trim() en los parámetros que sean valores numéricos
	var url = "PHP-borro_CELDA.php";
	
	// aquí la llamada
	$.post(url,{f:fila,c:columna},llegadaDatos4);
}
// callback
function llegadaDatos4(datos)
{
	// oculto estrella
	document.getElementById('estrella').style.visibility='hidden';
	
	// habilito botones
	document.getElementById('boton3').disabled=false;
	document.getElementById('boton4').disabled=false;
	document.getElementById('boton5').disabled=false;	
}

//************************************************************************************************
//************************************************************************************************
//***************************************** BORRO SESIÓN ******************************************
//************************************************************************************************
//************************************************************************************************
function termino()
{
	location.href = "PHP-logout.php";	
}

</script>

<body onload="inicio();">
<!-- **************************** CABECERA ************************************************ -->
<!-- **************************** CABECERA ************************************************ -->
<!-- **************************** CABECERA ************************************************ -->
<header>
<div class="BarraNavegar">
				<i class="fas fa-tv fa-2x" ></i>
				<label  class="L1">Servidor 2º DAW</label>		
				<label  class="L2"><b>Gestión de Sesiones</b></label>		
				<label  class="L3">Examen</label>	
</div>
</header>

<!-- **************************** CUERPO ************************************************ -->
<!-- **************************** CUERPO ************************************************ -->
<!-- **************************** CUERPO ************************************************ -->
<div class="contenedor1">
		<!-- AZUL -->
		<div class="contenedor2">
				<!-- NARANJA-4 -->
				<div class="contenedor4">
								<button class="boton" id="boton1" type="button" 
								onclick="crear_session();">
								<i class="fas fa-sign-in-alt"></i>&nbspCrear $_SESSION
								</button>
								<button class="boton" id="boton2" type="button" disabled
								onclick="termino();">
								<i class="fas fa-trash-alt"></i>&nbspBorrar $_SESSION
								</button>												
				</div>						
		</div>

		<!-- AZUL -->			
		<div class="contenedor3">
				<!-- NARANJA-5 -->
				<div class="contenedor5" id="jugadas" style="overflow-y: scroll;">
	
				</div>							
				<div class="contenedor6">
						<button class="boton" id="boton3" type="button" style="width: 120px;" disabled
						onclick="ver_numeros();">
						<i class="far fa-play-circle fa-1x"></i>&nbspNúmeros
						</button>
						<button class="boton" id="boton4" type="button" style="width: 120px;" disabled
						onclick="ver_frutas();">
						<i class="far fa-play-circle fa-1x"></i>&nbspFrutas
						</button>			
						<button class="boton" id="boton5" type="button" style="width: 120px;" disabled
						onclick="borrar_celda();">
						<i class="fas fa-trash-alt"></i>&nbspBorro
						</button>
															
				</div>											
		</div>			
</div>
<!-- **************************** FOOTER ************************************************ -->
<!-- **************************** FOOTER ************************************************ -->
<!-- **************************** FOOTER ************************************************ -->
<footer class="footer">
		<img  id="estrella" src="imagenes/estrella.gif"  height="40" width="40" style="visibility:hidden;"/>
		&nbsp&nbsp<i class="fas fa-building fa-2x" ></i>
		<label>&nbsp © 2020 IES Escultor</label>		
</footer>

<audio id="musica1" src="imagenes/1.mp3" autobuffer></audio>
<audio id="musica2" src="imagenes/2.mp3" autobuffer></audio>
<audio id="musica3" src="imagenes/3.mp3" autobuffer></audio>

</body>
</html>