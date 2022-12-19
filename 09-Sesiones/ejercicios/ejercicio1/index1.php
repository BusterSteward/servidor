<!DOCTYPE html>
<html lang="es">
<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<meta http-equiv="Pragma" content="no-cache">
		 
		<meta name="description" content="Prácticas con la Gestión de Sesiones-Login en Servidor">
		<meta name="author" content="Jorge López">

		<link rel="shortcut icon" href="imagenes/icon.png"/>

		<title>Login</title>

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
	document.getElementById('user').focus();	
}
//************************************************************************************************
//************************************************************************************************
//******************************** Llamo a "verificacion.php" *****************************************
//************************************************************************************************
//************************************************************************************************
function envio_datos()
{
		// compruebo que las cajas de texto no estén vacías	
		if ((document.getElementById('user').value==""))
		{
			document.getElementById('user').focus();	
			document.getElementById('info').innerHTML="";
		}
		else if ((document.getElementById('password').value==""))
		{
			document.getElementById('password').focus();	
			document.getElementById('info').innerHTML="";
		}		
		else
		{
			// visualizo estrella
			document.getElementById('estrella').style.visibility='visible';	
			// deshabilito botón
			document.getElementById('boton1').disabled=true;
			// borro mensaje etiqueta
			document.getElementById('info').innerHTML="";

			var elusuario=document.getElementById('user').value;
			var lacontasenia=document.getElementById('password').value;
			
			// hacemos la llamada jQuery $.post a "verificacion.php"
			// el callback de la llamada será "llegadaDatos1"
			var url = "verificacion.php";

		}	
}

function llegadaDatos1(datos)
{
	// alert('llego:'+datos);
	// oculto estrella
	document.getElementById('estrella').style.visibility='hidden';
	// deshabilito botón
	document.getElementById('boton1').disabled=false;		
	
	// trato error de validación
	if (datos!=0)
	{
		document.getElementById('info').innerHTML=datos;
		document.getElementById('user').select();	
	}
	// o cargo página de correo
	else
	{
		location.href="correo.php";
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
				<label  class="L3">Login Base Datos</label>	
</div>
</header>

<!-- **************************** CUERPO ************************************************ -->
<!-- **************************** CUERPO ************************************************ -->
<!-- **************************** CUERPO ************************************************ -->

<div class="contenedor1">
		<!-- AZUL -->
		<div class="contenedor2">
				<!-- NARANJA -->
				<div class="contenedor4">
								<div class="form-group">
									<label>Usuario:</label>
									<input class="input-control" id="user" name="user" maxlength="10" 
									style="width: 65%;" required autocomplete="off"><br>
								</div>
								
								<div class="form-group">
									<label>Contraseña:</label>
									<input class="input-control" id="password" name="password" maxlength="10"
									style="width: 65%; " required autocomplete="off"><br>
								</div>
								
								<!-- <div>
									<input type="checkbox" id="recordar" name="recordar" value='0' >Mantener sesión iniciada
								</div> -->
								
								<label id="info" class="label2"></label>				
								
								<button class="boton" id="boton1" type="button" style="padding: 15px; margin:10px"
								onclick="envio_datos();">
								<i class="fas fa-sign-in-alt"></i> Enviar
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

</body>
</html>