<?php 
	// si la sesión no fue cerrada->la borramos
	session_start();
	session_destroy();
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
//************************************
// variables tragaperras
//************************************

// temporizador
var contador=0;

// el nº de Jugada
var contador1=0;

// resultado de cada jugada
var imagen_fruta1=0;
var imagen_fruta2=0;
var imagen_fruta3=0;

function inicio()
{
	//document.getElementById('user').focus();	
	document.getElementById('user').select();	
}
//************************************************************************************************
//****************************** FUNCIONALIDAD-1: VERIFICACIÓN *************************************
//******************************** Llamo a "PHP-verificacion.php" *************************************
//************************************************************************************************
//************************************************************************************************
function envio_datos()
{
		// compruebo que las cajas de texto no estén vacías	
		if ((document.getElementById('user').value==""))
		{
			document.getElementById('user').focus();	
			document.getElementById('info').innerHTML="&nbsp";
		}
		else if ((document.getElementById('password').value==""))
		{
			document.getElementById('password').focus();	
			document.getElementById('info').innerHTML="&nbsp";
		}		
		else
		{
			// visualizo estrella
			document.getElementById('estrella').style.visibility='visible';	
			// deshabilito botón
			document.getElementById('boton1').disabled=true;
			// borro mensaje etiqueta
			document.getElementById('info').innerHTML="&nbsp";
					
			elusuario=document.getElementById('user').value;
			lacontrasenia=document.getElementById('password').value;
			
			// hago la llamada utilizando AJAX jQuery
			// el callback obligatoriamente se llamará "llegadaDatos1()"
			// el script PHP obligatoriamente se llamará "PHP-verificacion.php"
			
			var url = "PHP-verificacion.php";
			$.post(url,{tuser:elusuario.trim(), tpassword: lacontrasenia.trim()}, llegadaDatos1);
		}	
}
// callback
function llegadaDatos1(datos)
{
	//alert('llego:'+datos);
	// oculto estrella
	document.getElementById('estrella').style.visibility='hidden';

	// trato ERROR de VALIDACIÓN
	if (datos!=0)
	{
		document.getElementById('info').innerHTML="<font face='Calibri' color='red' size='3'>Error Validación !!</font>";
		document.getElementById('user').select();	
		document.getElementById('boton1').disabled=false;	
	}
	// o habilito JUEGO si el usuario se ha VALIDADO bien
	else
	{
		// aviso validación
		document.getElementById('info').innerHTML="<font face='Calibri' color='green' size='3'>Validación Correcta !!</font>";
		// habilito botón VER JUGADAS
		document.getElementById('botonj').disabled=false;	
		// deshabilito CAJAS DE TEXTO
		document.getElementById('user').disabled=true;	
		document.getElementById('password').disabled=true;	
		// habilito botón JUGAR
		document.getElementById('botonr').disabled=false;			
		// habilito botón LOGOUT
		document.getElementById('boton2').disabled=false;					
		// habilito botón PDF
		document.getElementById('boton_pdf').disabled=false;		
		// habilito botón CORREO
		document.getElementById('boton_correo').disabled=false;		
	}
}
//************************************************************************************************
//**************************************** VER JUGADAS ********************************************
//********************************** Llamo a "PHP-Ver_jugadas.php" ***********************************
//************************************************************************************************
//************************************************************************************************
function ver_jugadas()
{
	
	// visualizo estrella
	document.getElementById('estrella').style.visibility='visible';	
	// borro si hay algo en el div donde se ven las imágenes subidas
	document.getElementById('jugadas').innerHTML="";	
	
	// hago la llamada
	$("#jugadas").load("PHP-ver_jugadas.php",{},llegadaDatos2);	
}

// callback
function llegadaDatos2()
{
	// oculto estrella
	document.getElementById('estrella').style.visibility='hidden';	
}

//************************************************************************************************
//****************************************** LOGOUT **********************************************
//*********************************** Llamo a "PHP-logout.php" **************************************
//************************************************************************************************
//************************************************************************************************
function termino()
{
	location.href = "PHP-logout.php";	
}
//************************************************************************************************
//************************************************************************************************
//***************************************** JUEGO ************************************************
//************************************************************************************************
//************************************************************************************************
function jugar()
{
	var numero;
	
	// a este if entramos la 1ª vez que ejecutamos esta función y nunca más
	if (contador==0)
	{
		// inhabilitamos algunos botones
		document.getElementById("botonr").disabled=true;
		document.getElementById("boton_pdf").disabled=true;
		document.getElementById("boton2").disabled=true;
		document.getElementById("botonj").disabled=true;
		// modo bucle activado
		document.getElementById("musica1").loop=true;
		// reproducimos sonido
		//document.getElementById("musica1").preload;
		document.getElementById("musica1").play();
	}
	
	// llevamos la cuenta de los cambios
	contador++;
	
	if (contador1<10) {document.getElementById("njugadas").innerHTML="0"+contador1;}
	else {document.getElementById("njugadas").innerHTML=contador1;}
	
	if (contador<20) 
	{
		//generamos un nº aleatorio comprendido entre 1-8
		numero=Math.floor(Math.random() * (8)) + 1;
		
		// si el número aleatorio generado es igual a la fruta que tenemos visualizada lo tengo que cambiar
		if (numero==imagen_fruta1)
		{
			numero++;
			if (numero>8) {numero=1;}
		}
		// almacenamos en imagen_fruta la fruta que vamos a visualizar
		imagen_fruta1=numero;
		// cambiamos la imagen
		document.getElementById("imagen2").src="imagenes/"+numero+".jpg";		
		
		// alert("imagenes/"+numero+".jpg");
	}
	else if (contador==20) {document.getElementById("musica2").play();}

	if (contador<30) 
	{
		//generamos un nº aleatorio comprendido entre 1-8
		numero=Math.floor(Math.random() * (8)) + 1;
		//alert(numero);
		// si el número aleatorio generado es igual a la fruta que tenemos visualizada lo tengo que cambiar
		if (numero==imagen_fruta2)
		{
			numero++;
			if (numero>8) { numero=1;}
		}
		// almacenamos en imagen_fruta la fruta que vamos a visualizar
		imagen_fruta2=numero;
		// cambiamos la imagen
		document.getElementById("imagen3").src="imagenes/"+numero+".jpg";		
	}
	else if (contador==30) {document.getElementById("musica2").play();}	
	
	if (contador<40) 
	{
		//generamos un nº aleatorio comprendido entre 1-8
		numero=Math.floor(Math.random() * (8)) + 1;
		//alert(numero);
		// si el número aleatorio generado es igual a la fruta que tenemos visualizada lo tengo que cambiar
		if (numero==imagen_fruta3)
		{
			numero++;
			if (numero>8) { numero=1;}
		}
		// almacenamos en imagen_fruta la fruta que vamos a visualizar
		imagen_fruta3=numero;
		// cambiamos la imagen
		document.getElementById("imagen4").src="imagenes/"+numero+".jpg";		
		// me llamo otra vez
		aux=setTimeout("jugar()",100);
	}
	else if (contador==40)
	{
		document.getElementById("musica2").play();
		// paramos el sonido
		document.getElementById("musica1").pause();
		// situamos puntero sonido al principio
		document.getElementById("musica1").currentTime = 0;
		// modo bucle des-activado
		document.getElementById("musica1").loop=false;		
		// borramos temporizador
		clearTimeout(aux);		
		// habilitamos algunos botones
		document.getElementById("botonr").disabled=false;		
		document.getElementById("boton_pdf").disabled=false;		
		document.getElementById("boton2").disabled=false;
		document.getElementById("botonj").disabled=false;		
		contador=0;
		
		//*********************************************************************************		
		//*********************************************************************************		
		//*********************************************************************************
		// aquí hacemos la llamada a "altadejugada.php" para dar de alta la jugada en $_SESSION
		// al script PHP le pasaremos el nº de jugada -> contador1 y las tres frutas->imagen_fruta1, imagen_fruta2 y imagen_fruta3
		//*********************************************************************************
		var url = "PHP-altadejugada.php";
		$.post(url,{jugada:contador1, fruta1: imagen_fruta1, fruta2: imagen_fruta2, fruta3: imagen_fruta3});
		//*********************************************************************************
		//*********************************************************************************		
	}	
}

//************************************************************************************************
//****************************************** LISTADO PDF ******************************************
//*********************************** Llamo a "PHP-listado-pdf.php" ***********************************
//************************************************************************************************
//************************************************************************************************
function listado()
{
	// genera el listado PDF de las jugadas que tenemos almacenadas en $_SESSION
	window.open('PHP-listado-pdf.php', '_blank');
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
								<div class="form-group">
									<label>Usuario:</label>
									<input class="input-control" id="user" name="user" maxlength="10" VALUE="JORGE"
									style="width: 65%;" required autocomplete="off"><br>
								</div>
								
								<div class="form-group">
									<label>Contraseña:</label>
									<input class="input-control" id="password" name="password" maxlength="10" VALUE="666666"
									style="width: 65%; " required autocomplete="off"><br>
								</div>
								
								<label id="info" class="label2"> &nbsp </label>				
								
								<button class="boton" id="boton1" type="button" 
								onclick="envio_datos();">
								<i class="fas fa-sign-in-alt"></i> Login
								</button>
								<button class="boton" id="botonj" type="button" disabled
								onclick="ver_jugadas();">
								<i class="far fa-play-circle fa-1x"></i>&nbsp&nbspJugadas
								</button>								
								<button class="boton" id="boton2" type="button" disabled
								onclick="termino();">
								<i class="fas fa-trash-alt"></i>&nbsp&nbspLogout
								</button>	

								<button class="boton" id="boton_pdf" type="button" disabled
								onclick="listado();">
								<i class="far fa-play-circle fa-1x"></i>&nbsp&nbspPDF
								</button>				
				</div>						
		</div>

		<!-- AZUL -->			
		<div class="contenedor3">
				<!-- NARANJA-5 -->
				<div class="contenedor5" id="jugadas" style="overflow-y: scroll;">
	
				</div>							
				<div class="contenedor6">
						<button class="boton" id="botonr" type="button" style="margin-top:25px;" disabled
						onclick="jugar();contador1++;">
						<i class="far fa-play-circle fa-1x"></i>&nbsp&nbspJugar
						</button>
						<img id="imagen2" name="imagen2" width="80px" height="80px" src="imagenes/8.jpg" border=1
						style="margin-right:10px">
						<img id="imagen3" name="imagen3" width="80px" height="80px" src="imagenes/8.jpg" border=1 
						style="margin-right:10px">
						<img id="imagen4" name="imagen4" width="80px" height="80px" src="imagenes/8.jpg" border=1
						style="margin-right:10px">
						<label id="njugadas" class="label3">00</label>				
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