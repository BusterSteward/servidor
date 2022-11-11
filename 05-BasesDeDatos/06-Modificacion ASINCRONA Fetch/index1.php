<!DOCTYPE html>
<html lang="es">
<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<meta http-equiv="Pragma" content="no-cache">
		 
		<meta name="description" content="Estudio Trabajo con Base de Datos en PHP">
		<meta name="author" content="Jorge López">

		<link rel="shortcut icon" href="imagenes/icon.png"/>

		<title>Base Datos</title>

		<!-- estilo general de la página -->
		<link href="ficheros/estilo_pagina.css" rel="stylesheet">
		
		<!-- estilo barra de menú -->
		<link href="ficheros/barra_menu.css" rel="stylesheet">		
		
		<!-- estilo de formularios -->
		<link href="ficheros/formularios.css" rel="stylesheet">
		
		<!-- biblioteca de iconos -->
		<link href="ficheros/all.css" rel="stylesheet">
		
</head>


<script type="text/javascript">
//*********************************************************************************
//*********************************************************************************
//****************************CONSULTA DE USUARIO*********************************
//*********************************************************************************
//*********************************************************************************
function fetch_consulta(elnif)
{
	// cosas que hay que hacer ANTES
		
	// visualizo estrella
	document.getElementById('estrella').style.visibility='visible';
	
	// si hay algo en div "mensaje" lo borro
	borrodiv();
	
	// inhabilito botón "consulta"
	document.getElementById('boton2').disabled=true;	
	// inhabilito botón "limpiar"
	document.getElementById('boton1').disabled=true;					
		
	// FETCH nativo JavaScript 
	// llamo a "PHP-consulta.php" de forma **"asíncrona"** que realizará la consulta
	// al script PHP le pasamos el "nif"
	var url = "PHP-consulta.php?nifusuario="+elnif;
	// hago la llamada al script
	fetch(url,
	{ 
		method: "GET"
	}) 
	.then(function(response)
	{
		if (response.ok)
			//return response.text();
			return response.json();
		else	
			// generamos un error que será recogido por el método ".catch"
			throw new Error('Problema con la página!! : '+response.statusText);
	})
	.then(function(datos)
	{
		// oculto estrella
		document.getElementById('estrella').style.visibility='hidden';
		
		// en "datos" tengo el array que devuelve "PHP-consulta.php" en formato JSON
		// $jsondatos["lista"]
		var lista = datos.lista;

		if (datos!=0)
		// SI he encontrado el usuario
		{
				// OJO: en este caso no hace falta este bucle porque sólo tenemos los datos de un socio
				// "forEach" implementa un bucle que trata 1 por 1 los elementos de la tabla "datos.lista"
				lista.forEach(elemento =>
				{
					document.getElementById('nombre').value=elemento.nombre;
					document.getElementById('edad').value=elemento.edad;
					//alert(elemento.edad+elemento.nombre);
					document.getElementById('fecha').value=elemento.fecha;
					document.getElementById('precio').value=elemento.precio;
					// formato de fecha español
					//document.getElementById('fecha').value=" "+
					//elemento.fecha.substr(8,2)+"-"+elemento.fecha.substr(5,2)+"-"+elemento.fecha.substr(0,4);
					document.getElementById('info').value=elemento.observaciones;
					document.getElementById('img1').src="data:image/jpeg;base64,"+elemento.imagen;
				});
				document.getElementById('mensaje').innerHTML="<b><font color='green' size='2'>Usuario encontrado!!</font><b>";
				
				// inhabilito caja texto nif
				document.getElementById('nif').disabled=true;
				//**********************************************
				// habilito botones anterior-siguiente // borrar 
				//**********************************************
				document.getElementById('b1').disabled=false;
				document.getElementById('b2').disabled=false;										
				document.getElementById('boton3').disabled=false;		
				
				// llamo a limpiar div con un retardo de 4 seg
				setTimeout("borrodiv()",4000);				
		}
		else
		// NO he encontrado el usuario
		{
			// habilito botón consulta
			document.getElementById('boton2').disabled=false;		
			// pongo mensaje					
			document.getElementById('mensaje').innerHTML="<b><font color='red' size='2'>Usuario NO encontrado!!</font><b>";
			// paso foco nif
			pasofoco('nif');
		}	
		// habilito botón "limpiar" en ambos casos
		document.getElementById('boton1').disabled=false;				
	})
	 .catch(function(err)
	{
		//alert(err);
		document.getElementById("mensaje").innerHTML="<b><font color='red' size='2'>"+err+"</font><b>";
		// oculto estrella
		document.getElementById('estrella').style.visibility='hidden';
	});
}
//*********************************************************************************
//*********************************************************************************
//**************************ANTERIOR-SIGUIENTE*************************************
//*********************************************************************************
//*********************************************************************************
function fetch_anterior_siguiente(elnif,quehago)
{
	// cosas que hay que hacer ANTES
	
	// para asegurarnos que ningún botón de anterior-siguiente quede deshabilitado para siempre
	if (quehago==1) {document.getElementById('b1').disabled=false;}
	if (quehago==0) {document.getElementById('b2').disabled=false;}
	
	// visualizo estrella
	document.getElementById('estrella').style.visibility='visible';
	
	// si hay algo en div "mensaje" lo borro
	borrodiv();
	
	// inhabilito botón consulta
	document.getElementById('boton2').disabled=true;	
	// inhabilito botón "limpiar"
	document.getElementById('boton1').disabled=true;						
		
	// FETCH nativo JavaScript 
	// llamo a "PHP-anterior-siguiente.php" de forma **"asíncrona"** que realizará la consulta
	// al script PHP le pasamos el "nif" y el botón pulsado (anterior o siguiente)
	var url = "PHP-anterior-siguiente.php?nifusuario="+elnif+"&loquehago="+quehago;
	// hago la llamada al script
	fetch(url,
	{ 
		method: "GET"
	}) 
	.then(function(response)
	{
		if (response.ok)
			//return response.text();
			return response.json();
		else	
			// generamos un error que será recogido por el método ".catch"
			throw new Error('Problema con la página!! : '+response.statusText);
	})
	.then(function(datos)
	{
		// cosas que hay que hacer DESPUÉS
		// una vez que se termine de ejecutar "PHP-anterior-siguiente.php" se ejecutará esta función
		document.getElementById('estrella').style.visibility='hidden';
		
		// en "datos" tengo el array que devuelve "PHP-consulta.php" en formato JSON
		// $jsondatos["lista"]
		var lista = datos.lista;

		if (datos!=1 && datos!=2)
		// HAY REGISTRO
		{
				// en este caso no hace falta este bucle porque sólo tenemos los datos de un socio
				// "forEach" implementa un bucle que trata 1 por 1 los elementos de la tabla "datos.lista"
				lista.forEach(elemento =>
				{
					document.getElementById('nif').value=elemento.nif;
					document.getElementById('nombre').value=elemento.nombre;
					document.getElementById('edad').value=elemento.edad;
					//alert(elemento.edad+elemento.nombre);
					document.getElementById('fecha').value=elemento.fecha;
					document.getElementById('precio').value=elemento.precio;
					// formato de fecha español
					//document.getElementById('fecha').value=" "+
					//elemento.fecha.substr(8,2)+"-"+elemento.fecha.substr(5,2)+"-"+elemento.fecha.substr(0,4);
					document.getElementById('info').value=elemento.observaciones;
					document.getElementById('img1').src="data:image/jpeg;base64,"+elemento.imagen;
				});
		}
		else
		// NO HAY REGISTRO
		{
			if (datos==1)
			{
			// pongo mensaje-> "último registro"			
			document.getElementById('mensaje').innerHTML="<b><font color='red' size='2'>Último Registro!!</font><b>";
			// inhabilito botón "siguiente"
			document.getElementById('b2').disabled=true;					
			}	
			if (datos==2)
			{
			// pongo mensaje-> "primer registro"			
			document.getElementById('mensaje').innerHTML="<b><font color='red' size='2'>Primer Registro!!</font><b>";
			// inhabilito botón "anterior"
			document.getElementById('b1').disabled=true;					
			}	
		}
		// habilito botón "limpiar" en ambos casos
		document.getElementById('boton1').disabled=false;			
	})
	.catch(function(err)
	{
		//alert(err);
		document.getElementById("mensaje").innerHTML="<b><font color='red' size='2'>"+err+"</font><b>";
		// oculto estrella
		document.getElementById('estrella').style.visibility='hidden';
	});		
}
function fetch_puedoModificar(elnif)
{
	// visualizo estrella
	document.getElementById('estrella').style.visibility='visible';
	
	// inhabilito botón modificar
	document.getElementById('boton3').disabled=true;	
	// inhabilito botón "limpiar"
	document.getElementById('boton1').disabled=true;		
	
	// si hay algo en div "mensaje" lo borro
	borrodiv();

	// FETCH nativo JavaScript 
	// llamo a "PHP-puedo_modificar.php" de forma **"asíncrona"**
	// este script bloqueará el registro para poder modificarlo
	// o me dirá si ya está bloqueado
	// al script PHP le pasamos el "nif" 
	var url = "PHP-puedo_modificar.php?nifusuario="+elnif.trim();
	// hago la llamada al script
	fetch(url,
	{ 
		method: "GET"
	}) 
	.then(function(response)
	{
		if (response.ok)
		{
			//return response.text();
			return response.json();
		}	
		else	
			// generamos un error que será recogido por el método ".catch"
			throw new Error('Problema con la página!! : '+response.statusText);
	})
	.then(function(datos)
	{	
		// oculto estrella
		document.getElementById('estrella').style.visibility="hidden";
		
		//*********************************
		// trato mensaje devuelto por el servidor
		//*********************************

		if (datos==999)
		// no existe
		{
			document.getElementById('mensaje').innerHTML="<b><font color='red' size='2'>El Usuario ya NO EXISTE!!</font><b>";
			pulso_limpiar();
			document.getElementById('boton1').disabled=false;
		}
		else if (datos==1)
		// registro bloqueado
		{
			document.getElementById('mensaje').innerHTML="<b><font color='red' size='2'>El Usuario está BLOQUEADO!!</font><b>";
			pulso_limpiar();
			document.getElementById('boton1').disabled=false;
		}
		else if (datos==0)
		// se puede modificar el registro
		{
			// des-habilito botones anterior y siguiente
			document.getElementById('b1').disabled=true;
			document.getElementById('b2').disabled=true;
			
			// habilito cajas de texto
			document.getElementById('nombre').disabled=false;	
			document.getElementById('edad').disabled=false;	
			document.getElementById('fecha').disabled=false;	
			document.getElementById('precio').disabled=false;	
			document.getElementById('info').disabled=false;	
			document.getElementById('imagen').disabled=false;	
			
			// in-habilito botón nif
			document.getElementById('nif').disabled=true;			
			// in-habilito botón modificar
			document.getElementById('boton3').disabled=true;
			// habilito botón confirmar
			document.getElementById('boton4').disabled=false;			
			// paso foco
			pasofoco('nombre');
		}
		
		// llamo a limpiar div con un retardo de 5 seg
		setTimeout("borrodiv()",5000);				
	})
	.catch(function(err)
	{
		alert(err);
		document.getElementById("mensaje").innerHTML="<b><font color='red' size='2'>"+err+"</font><b>";
		// oculto estrella
		document.getElementById('estrella').style.visibility='hidden';
	});					
}
//*********************************************************************************
//*********************************************************************************
//*************************MODIFICACIÓN DE USUARIO*********************************
//*********************************************************************************
//*********************************************************************************
//*********************************************************************************
function fetch_modificacion(elnif)
{
	
	// visualizo estrella
	document.getElementById('estrella').style.visibility='visible';
	
	// inhabilito botón borrar
	document.getElementById('boton3').disabled=true;	
	// inhabilito botón "limpiar"
	document.getElementById('boton1').disabled=true;		
	
	// si hay algo en div "mensaje" lo borro
	borrodiv();

	const DATA = new FormData(document.getElementById("formulario1"));
	alert(DATA.get("nif"))

	// FETCH nativo JavaScript 
	// llamo a "PHP-baja.php" de forma **"asíncrona"** que realizará la baja
	// al script PHP le pasamos el "nif" 
	var url = "PHP-modificacion.php?nif="+elnif.trim();
	// hago la llamada al script
	
	fetch(url,
	{ 
		method: "POST",
		body: DATA
	}) 
	.then(function(response)
	{
		
		if (response.ok) 
		{

			//return response.text();
			return response.json();
		}
		else	
			// generamos un error que será recogido por el método ".catch"
			throw new Error('Problema con la página!! : '+response.statusText);
	})
	.then(function(datos)
	{	
		// oculto estrella
		document.getElementById('estrella').style.visibility="hidden";				
		alert(datos);
		if (datos==1)
		{
			document.getElementById('mensaje').innerHTML="<b><font color='green' size='2'>Usuario borrado con éxito!!</font><b>";
		}
		else if(datos==0)
		{
			document.getElementById('mensaje').innerHTML="<b><font color='red' size='2'>Error: otro usuario lo borró</font><b>";
		}
		else if(datos==2){
			document.getElementById('mensaje').innerHTML="<b><font color='red' size='2'>Error: El usuario se encuentra bloqueado</font><b>";
		}

		// habilito botón consulta
		document.getElementById('boton2').disabled=false;	
		// habilito botón "limpiar"
		document.getElementById('boton1').disabled=false;	
		// habilito caja texto nif
		document.getElementById('nif').disabled=false;	
		// limpio cajas formulario
		document.formulario1.reset();

		// limpio imagen usuario
		borroimagen('img1');				
		pasofoco('nif');	
		// des-habilito botones anterior y siguiente
		document.getElementById('b1').disabled=true;
		document.getElementById('b2').disabled=true;
		// llamo a limpiar div con un retardo de 4 seg
		setTimeout("borrodiv()",4000);				
	})
	.catch(function(err)
	{
		
		document.getElementById("mensaje").innerHTML="<b><font color='red' size='2'>"+err+"</font><b>";
		// oculto estrella
		document.getElementById('estrella').style.visibility='hidden';
	});					
}

//*********************************************************************************
//*********************************************************************************
//*******************************FUNCIONES****************************************
//*********************************************************************************
//*********************************************************************************
// para pasar el foco a un objeto y seleccionar su contenido
function pasofoco(objeto)
{
	document.getElementById(objeto).focus();
	document.getElementById(objeto).select();
}
//**********************************************************************************
// para quitar la imagen del usuario si necesito quitarla
function borroimagen(objeto)
{
	 document.getElementById(objeto).src="imagenes/usuario.png";
}
//**********************************************************************************
// para borrar el contenido del div "mensaje"
// función NO UTILIZADA
function borrodiv()
{
	document.getElementById('mensaje').innerHTML="";
}
//**********************************************************************************
function pulso_limpiar()
{
	document.getElementById('nif').disabled=false;
	pasofoco('nif');
	borrodiv();
	borroimagen('img1');
	document.getElementById('boton2').disabled=false;
	document.getElementById('boton3').disabled=true;
	document.getElementById('b1').disabled=true;
	document.getElementById('b2').disabled=true;
}
</script>

<body onload="document.getElementById('nif').focus();">
<!-- **************************** CABECERA ************************************************ -->
<!-- **************************** CABECERA ************************************************ -->
<!-- **************************** CABECERA ************************************************ -->
<header>

<div class="BarraNavegar">
				<i class="fab fa-php fa-3x" ></i>
				<label  class="L1">Servidor:</label>
				<label  class="L2"><b>CONSULTA-BAJA USUARIO</b></label>		
				<label  class="L3">ASÍNCRONA (Fetch)</label>	
				<label  class="L4">Thin-Server/Fat-Client</label>	
</div>
</header>
<!-- **************************** CUERPO ************************************************ -->
<!-- **************************** CUERPO ************************************************ -->
<!-- **************************** CUERPO ************************************************ -->
<div class="contenedor1">
<div id="cajapagina" class="contenedor2">
<div class="contenedor-formulario">
	<form id="formulario1" name="formulario1" ENCTYPE="multipart/form-data" 
	ACTION="" TARGET="" METHOD="POST" autocomplete="off"
	onsubmit="fetch_modificacion(document.getElementById(nif).value);return false;"> 

		<legend class="leyenda">Consulta-Baja de Usuario: </legend><br>

		<div class="form-group">
			<label>Nif:</label>
			<input class="input-control" id="nif" name="nif" maxlength="10" style="width: 20%" required autocomplete="off">

			<div><button type="button" id="b1" style="width:50px;height:30px;cursor:pointer" disabled
			onclick="fetch_anterior_siguiente(document.getElementById('nif').value,0)"><i class="fas fa-arrow-left"></i></button>
			
			<button type="button" id="b2" style="width:50px;height:30px;cursor:pointer;margin-bottom:10px" disabled 
			onclick="fetch_anterior_siguiente(document.getElementById('nif').value,1)"><i class="fas fa-arrow-right"></i></button></div>			
		</div>
	
		<div class="form-group">
			<label>Nombre:</label>
			<input class="input-control" id="nombre" name="nombre" maxlength="15" 
			readonly disabled style="width:45%">
		</div>

		<div class="form-group">
			<label>Edad:</label>
			<input class="input-control" type="number" id="edad" name="edad" maxlength="3"
			readonly disabled style="width:12%">
		</div>

		<div class="form-group">
			<label>Fecha Alta:</label>
			<input class="input-control" id="fecha" name="fecha" 
			readonly disabled style="width: 20%"> 
		</div>
		
		<div class="form-group">
			<label>Precio:</label>
			<input class="input-control" type="number" id="precio" name="precio" style="width:23%" 
			readonly disabled >
		</div>

		<div class="form-group">
			<label>Info:</label>
			<input class="input-control" id="info" name="info" maxlength="60" style="width:75%" 
			readonly disabled >
		</div>

		 <img id="img1" src="imagenes/usuario.png" width="80" height="80" style="border:1px solid blue;margin-bottom:10px;" >
		
		<div class="form-group" align="left">
								<button class="boton" id="boton1" type="reset"
								onclick="pulso_limpiar();">
								<i class="fa fa-trash"></i> Limpiar
								</button>
				
								<button class="boton" id="boton2" form="formulario1" type="submit"
								onclick="if (document.getElementById('nif').value!='')
												{fetch_consulta(document.getElementById('nif').value)}else{pasofoco('nif');};">
								<i class="fas fa-question"></i> Consulta
								</button>
								
								<button class="boton" id="boton3" type="button"  disabled
								onclick="fetch_puedoModificar();">
								<i class="fas fa-trash-alt"></i> Modificar
								</button>

								<button class="boton" id="boton4" form="formulario1" type="submit"  disabled
								onclick="">
								<i class="fas fa-check"></i> Confirmar
								</button>

								<div id="mensaje" name="mensaje" align="center" scrolling="no" 
										style="border:1px solid blue;width:300px;height:20px;padding-top:8px;">
								</div>
		</div>

	</form>
</div>
</div>
</div>
<!-- **************************** FOOTER ************************************************ -->
<!-- **************************** FOOTER ************************************************ -->
<!-- **************************** FOOTER ************************************************ -->
<footer class="footer">
		<img  id="estrella" src="imagenes/estrella.gif"  height="40" width="40" style="visibility:hidden;"/>
		&nbsp&nbsp<i class="fab fa-php fa-3x" ></i>
		<label>&nbsp de PHP al Cielo ©</label>	
</footer>

</body>
</html>