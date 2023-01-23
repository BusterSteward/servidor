<!DOCTYPE html>
<html lang="es">
<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<meta http-equiv="Pragma" content="no-cache">
		 
		<meta name="description" content="Plataforma Comercio Electrónico: e-Commerce">
		<meta name="author" content="Jorge López">

		<link rel="shortcut icon" href="imagenes/icon.png"/>

		<title>e-Commerce</title>

		<!-- estilo general de la página -->
		<link href="ficheros/estilo_pagina.css" rel="stylesheet">
		
		<!-- estilo barra de menú -->
		<link href="ficheros/barra_menu.css" rel="stylesheet">		
		
		<!-- estilo de tablas -->
		<link href="ficheros/tablas.css" rel="stylesheet">
		
		<!-- estilo barra de Navegar -->
		<link href="ficheros/navegacion.css" rel="stylesheet">

		<!-- librería jQuery -->
		<script type="text/javascript" src="ficheros/jquery.js"></script>		
		
		<!-- biblioteca de iconos -->
		<link href="ficheros/all.css" rel="stylesheet">
		
		<!-- paginación -->
		<script type="text/javascript" src="ficheros/paginacion.js"></script>
		
 </head>

<script language='javascript'>
// variable para saber si el usuario ha iniciado SESIÓN
var sesion_iniciada=0;


//************************************************************************************************
//***************************************** INICIO *************************************************
//************************************* SESIÓN INICIADA???? ****************************************
//********************************* Llamo a "PHP-sesion_iniciada.php" *********************************
//************************************************************************************************
function inicio()
{
	// para visualizar la primera página de artículos
	primera_consulta();

	// comprobamos si la sesión ya está iniciada
	// hago la llamada ->	utilizamos método "$.post" de jQuery
	$.post("PHP-sesion_iniciada.php",{ },llegadaDatos1);

}

// callback
function llegadaDatos1(datos)
{
	if (datos==0)
	// SESIÓN NO INICIADA
	{
		sesion_iniciada=0;
		document.getElementById("01").style.display ="";
		document.getElementById("02").style.display ="none";
		document.getElementById('user').focus();
		document.getElementById('user').select();
		
	}
	else
	// SESIÓN INICIADA
	{
		sesion_iniciada=1;
		// configuro cuadros LOGIN
		document.getElementById("01").style.display ="none";
		document.getElementById("02").style.display ="";
		
		// actualizo el nº de artículos en el carro
		// hago la llamada ->	utilizamos método "$.post" de jQuery
		$.post("PHP-articulos_carro.php",{ },llegadaDatos1A);
		
		// habilito SELECT y caja texto BÚSQUEDA
		document.getElementById('categoria').disabled=false;
		document.getElementById('busqueda').disabled=false;
	}	
}

// callback
function llegadaDatos1A(datos)
{
	//alert(datos);
	document.getElementById('unidades').innerText="("+datos.trim()+")";		
}

//************************************************************************************************
//***************************************** LOGIN *************************************************
//******************************** Llamo a "PHP-verificacion.php" *************************************
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
			document.getElementById('info').innerHTML="&nbsp";
					
			var elusuario=document.getElementById('user').value;
			var lacontasenia=document.getElementById('password').value;
			
			var url = "PHP-verificacion.php";
			
			// compruebo si la casilla recordar está marcada
			var marcadocheck=0;
			if (document.getElementById('recordar').checked) {marcadocheck=1;}
			else {marcadocheck=0;}			
			
			// hago la llamada
			// utilizamos método "$.post" de jQuery
			$.post(url,{tuser:elusuario.trim(), tpassword: lacontasenia.trim(),recordar:marcadocheck}, llegadaDatos2);
		}	
}

// callback
function llegadaDatos2(datos)
{
	// oculto estrella
	document.getElementById('estrella').style.visibility='hidden';
	// habilito botón
	document.getElementById('boton1').disabled=false;		
	
	// trato error de validación
	if (datos==0)
	{
		document.getElementById('info').innerHTML="<font face='Calibri' color='red' size='3'>&nbspError Validación!</font>";
		document.getElementById('user').select();	
	}
	// o habilito plataforma
	else
	{
		document.getElementById("01").style.display = "none";
		document.getElementById("02").style.display = "";
		document.getElementById('nombreuser').innerHTML=datos.trim();
		
		// habilito SELECT y caja texto BÚSQUEDA
		document.getElementById('categoria').disabled=false;
		document.getElementById('busqueda').disabled=false;
		
		// actualizo variable de sesión iniciada
		sesion_iniciada=1;
	}
}
//************************************************************************************************
//********************************* ALTA CARRO DE LA COMPRA **************************************
//******************************** Llamo a "PHP-metocarro-V1.php" ***********************************
//************************************************************************************************
//************************************************************************************************
function pulso_carro(celda)
{
	// SESIÓN INICIADA
	if (sesion_iniciada==1)
	{	
		// visualizo estrella
		document.getElementById('estrella').style.visibility='visible';	
		
		var tabla=document.getElementById("mitabla");
		
		var fila_pulsada=celda.parentNode.parentNode.rowIndex;
		var columna_pulsada=celda.parentNode.cellIndex;
		// obtengo el "ID" de la celda pulsada (así obtengo el contenido de toda la celda)
		var valor=tabla.rows[fila_pulsada].cells[columna_pulsada].innerText; 
		//alert(valor);		
		//alert(valor.substring(0,5));	
		var articulo=valor.substring(0,5);
		
		var url = "PHP-metocarro-V1.php";
		// hago la llamada
		// utilizamos método "$.post" de jQuery
		$.post(url,{elarticulo:articulo.trim()}, llegadaDatos3);		
		
	}
	// SESIÓN NO INICIADA -> No hago nada
		
}

// callback
function llegadaDatos3(datos)
{
	// oculto estrella
	document.getElementById('estrella').style.visibility='hidden';
	// actualizo nº de artículos en el carrito
	document.getElementById('unidades').innerText="("+datos.trim()+")";		
	
	// pruebas
	//location.href="PHP-ListoCarro2.php";
	//window.open('PHP-ListoCarro2.php', '_blank');
}	


//************************************************************************************************
//****************************************** LOGOUT **********************************************
//************************************ Llamo a "PHP-logout.php" *************************************
//************************************************************************************************
//************************************************************************************************
function termino_sesion()
{
		var url = "PHP-logout.php";
		// hago la llamada
		// utilizamos método "$.post" de jQuery
		$.post(url,{},llegadaDatos4);		
}
// callback
function llegadaDatos4()
{
	// refrescamos la página
	location.href="index1.php";
}	
</script>

<body onload="inicio();">
<!-- **************************** CABECERA ************************************************ -->
<!-- **************************** CABECERA ************************************************ -->
<!-- **************************** CABECERA ************************************************ -->
<header>
<div class="BarraNavegar">
		<img id='logo' src="imagenes/logo.jpg" >	

		<!-- alineados a la derecha -->
		<nav id="01" class="Opcion_menu_right" style="border:1px solid blue;display:none;">
				
						<label>Usuario:</label>
						<input class="input-control" id="user" name="user" maxlength="10" value="JORGE"
						style="" autocomplete="off" onclick="document.getElementById('user').select();">
						<label id="info">&nbsp</label>
						
						<br>
				
						<label>Contraseña:</label>
						<input class="input-control" id="password" name="password" maxlength="10" value="666666"
						style="" autocomplete="off" onclick="document.getElementById('password').select();">
						
						<input type="checkbox" id="recordar" name="recordar">
						
						<button class="boton" id="boton1" type="button" style=""
							onclick="envio_datos();"><i class="fas fa-sign-in-alt"></i> Login
						</button>											
		</nav>

		<nav id="02" class="Opcion_menu_right" style="border:1px solid blue;display:none;">
				<a href='PHP-Web-ListoCarro.php'><img id="carro2" src="imagenes/carro2.png"></a>
				
				<label id="unidades" style="">(0)</label>		

				<label id="nombreuser" style="">JORGE</label>	
	
				<button class="boton" id="boton2" type="button"
					onclick="termino_sesion();"><i class="fas fa-sign-out-alt"></i> Logout
				</button>
		</nav>
</div>
</header>

<!-- **************************** CUERPO ************************************************ -->
<!-- **************************** CUERPO ************************************************ -->
<!-- **************************** CUERPO ************************************************ -->
<div class="contenedor1">
<div id="cajapagina" class="contenedor2">
		<div class="contenedor3">
				<label class="label">Artículos:</label>
				<select id="categoria" name="categoria" style="CURSOR:pointer;width:120px;height:31px;margin-right:10px"
				onchange="primera_consulta()" disabled >
						<option value="%" selected="selected">TODOS</option>
						<option value="L">LIBROS</option>
						<option value="R">RELOJES</option>
						<option value="P">PERFUMES</option>
				</select> 		

				<label class="label">Búsqueda:</label>
				<img src="imagenes/lupa.png" height="23" width="23">
				<input type="text" name="busqueda" id="busqueda" style="width:250px;height:26px;margin-right:10px;font-size: 16px;"
				autocomplete="off" disabled
				onkeyup="primera_consulta()"
				onclick="this.select()">
							
				<input class="caja_mensaje" id="mensaje_label" value="0">
		</div>
		
		<!-- donde se visualiza la tabla -->
		<div  class="contenedor4" id="pongotabla">
				<!-- la Tabla donde visualizo los datos -->
				<table class='table' id="mitabla" cellspacing="6" style='border:0px solid red'>
				</table>
		</div>	

		<!-- donde se visualiza la barra de navegación -->
		<div  class="paginacion" id="navegacion" style='border:0px solid red;margin-bottom:10px;margin-top:10px'>
				<!-- botón PRIMERA -->
				<a id="primera" onclick="primera()" href='#'>Primera</a>

				<!-- botón ANTERIOR -->
				<a id="anterior" onclick="anterior()" href='#'><<</a>
		
				<!-- 5 botones -->
				<a id="1" onclick="cualquiera(1)" href='#'>1</a>
				<a id="2" onclick="cualquiera(2)" href='#'>2</a>
				<a id="3" onclick="cualquiera(3)" href='#'>3</a>
				<a id="4" onclick="cualquiera(4)" href='#'>4</a>
				<a id="5" onclick="cualquiera(5)" href='#'>5</a>

				<!-- botón SIGUIENTE -->
				<a id="siguiente" onclick="siguiente()" href='#'>>></a>

				<!-- botón ÚLTIMA -->
				<a id="ultima" onclick="ultima()" href='#'>Última</a>
			
				<!-- botón Nº PÁGINA ACTUAL -->
				<input id="pa" class="marcador" value="">
				<!-- botón Nº PÁGINAS -->
				<input id="np" class="marcador" value="">
		</div>	
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