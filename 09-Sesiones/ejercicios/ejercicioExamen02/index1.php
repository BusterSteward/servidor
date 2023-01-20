<?php 
	// borramos "la sesión" y borramos todas las "variables de sesión"
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
var carta=0;

function inicio()
{
	//document.getElementById('user').focus();	
	document.getElementById('user').select();	
}
//************************************************************************************************
//*************************************** VERIFICACIÓN ********************************************
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
			// ************************************************************************
			// aquí hacemos la llamada asíncrona jQuery a "PHP-verificacion.php"
			// ************************************************************************
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
		document.getElementById('botond').disabled=false;	
		document.getElementById('botonbd').disabled=false;	
		document.getElementById('botontxt').disabled=false		
		// deshabilito CAJAS DE TEXTO
		document.getElementById('user').disabled=true;	
		document.getElementById('password').disabled=true;	
		// habilito botón JUGAR
		document.getElementById('botonr').disabled=false;			
		// habilito botón LOGOUT
		document.getElementById('boton2').disabled=false;					
	}
}
//**********************************FUNCIONALIDAD-1*************************************
//*********************************VER JUGADAS TOTALES***********************************
//*************************Llamo a PHP-Ver_jugadas_TOTALES.php*****************************
//***************************************************************************************
//***************************************************************************************
function ver_jugadas_totales()
{
	

}

// callback
function llegadaDatos2()
{
	// oculto estrella
	document.getElementById('estrella').style.visibility='hidden';	
}

//**********************************FUNCIONALIDAD-2******************************************
//************************************VER JUGADAS*********************************************
//*****************************Llamo a PHP-Ver_jugadas.php**************************************
//********************************************************************************************
//********************************************************************************************
function ver_jugadas()
{

}

// callback
function llegadaDatos3()
{
	// oculto estrella
	document.getElementById('estrella').style.visibility='hidden';	
}

//**********************************FUNCIONALIDAD-3******************************************
//*********************************ALTA BASE DE DATOS*****************************************
//*****************************Llamo a PHP-BaseDatos.php****************************************
//********************************************************************************************
//********************************************************************************************
function base_datos()
{
	
}

// callback
function llegadaDatos4()
{
	// oculto estrella
	document.getElementById('estrella').style.visibility='hidden';	
}



//**********************************FUNCIONALIDAD-4******************************************
//******************************CREACIÓN FICHERO TEXTO****************************************
//*****************************Llamo a PHP-FicheroTexto.php*************************************
//********************************************************************************************
//********************************************************************************************
function fichero_texto()
{

}

// callback
function llegadaDatos5()
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
		// inhabilitamos el botón
		document.getElementById("botonr").disabled=true;
		// modo bucle activado
		document.getElementById("musica1").loop=true;
		// reproducimos sonido
		document.getElementById("musica1").play();
	}
	
	// llevamos la cuenta de los cambios
	contador++;
	
	if (contador1<10) {document.getElementById("njugadas").innerHTML="0"+contador1;}
	else {document.getElementById("njugadas").innerHTML=contador1;}
	
	if (contador<20) 
	{
		//generamos un nº aleatorio comprendido entre 1-7
		numero=Math.floor(Math.random() * (7)) + 1;
		//alert(numero);
		// si el número aleatorio generado es igual a la carta que tenemos visualizada lo tengo que cambiar
		if (numero==carta)
		{
			numero++;
			if (numero>7) { numero=1;}
		}
		// almacenamos en carta la carta que vamos a visualizar
		carta=numero;
		// cambiamos la imagen
		document.getElementById("imagen2").src="imagenes/"+numero+".jpg";		
		// me llamo otra vez
		aux=setTimeout("jugar()",100);
	}
	else if (contador==20)
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
		// habilitamos el botón
		document.getElementById("botonr").disabled=false;		
		contador=0;
		
		//*********************************************************************************		
		//***************************** FUNCIONALIDAD-1 ***********************************		
		//***************************** FUNCIONALIDAD-2 ***********************************		
		//*********************************************************************************
		// aquí hacemos la llamada a "altadejugada.php" para dar de alta la jugada en $_SESSION
		// al script PHP le pasaremos el nº de carta visualizada -> carta
		//*********************************************************************************
		var url = "PHP-altadejugada.php";
		$.post(url,{lacarta:carta});
		//*********************************************************************************
		//*********************************************************************************		
		
	}	
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
								onclick="ver_jugadas_totales();">
								<i class="far fa-play-circle fa-1x"></i>&nbsp&nbspTotal cartas
								</button>								

								<button class="boton" id="botond" type="button" disabled
								onclick="ver_jugadas();">
								<i class="far fa-play-circle fa-1x"></i>&nbsp&nbspDetalle Jugadas
								</button>								
								
								
								<button class="boton" id="boton2" type="button" disabled
								onclick="termino();">
								<i class="fas fa-trash-alt"></i>&nbsp&nbspLogout
								</button>												
				</div>						
		</div>

		<!-- AZUL -->			
		<div class="contenedor3">
				<!-- NARANJA-5 -->
				<div class="contenedor5" id="jugadas" style="overflow-y: scroll;">
	
				</div>	
				<div class="contenedor6">
						<img id="imagen2" name="imagen2" width="100px" height="153px" src="imagenes/0.jpg" border=1	style="margin-top:10px;margin-left:10px;">
						<label id="njugadas" class="label3" style="margin-top:135px;">00</label>

						<button class="boton" id="botonr" type="button" style="margin-top:110px;" disabled
						onclick="jugar();contador1++;">
						<i class="far fa-play-circle fa-1x"></i>&nbsp&nbspJugar
						</button>
						
						<button class="boton" id="botonbd" type="button" style="margin-top:110px;" disabled
						onclick="base_datos();">
						<i class="far fa-play-circle fa-1x"></i>&nbsp&nbspBD
						</button>						
						
						<button class="boton" id="botontxt" type="button" style="margin-top:110px;" disabled
						onclick="fichero_texto();">
						<i class="far fa-play-circle fa-1x"></i>&nbsp&nbspF.Texto
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
		<label>&nbsp © 2022 IES Escultor</label>		
</footer>

<audio id="musica1" src="imagenes/1.mp3" autobuffer></audio>
<audio id="musica2" src="imagenes/2.mp3" autobuffer></audio>
<audio id="musica3" src="imagenes/3.mp3" autobuffer></audio>

</body>
</html>