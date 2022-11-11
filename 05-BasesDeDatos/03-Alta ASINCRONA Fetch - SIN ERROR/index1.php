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
//**********************************************************************************
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
function borrodiv()
{
	document.getElementById('mensaje').innerHTML="";
}
//**********************************************************************************
// función NO UTILIZADA
function borro_iFrame()
{
	// de esta forma se borra el contenido de un iFrame
	mensaje.document.open();
	mensaje.document.close();
}
//**********************************************************************************
//**********************************************************************************
// formulario de alta:
// esta función la utilizo para pre-visualizar la imagen de usuario que selecciono
function visualizo(objeto,pongo)
{
    var seleccionArchivos =document.getElementById(objeto);
	var archivos=seleccionArchivos.files;
	var imagenPrevisualizacion = document.getElementById(pongo);

    if (!archivos.length)
    {
		imagenPrevisualizacion.src="imagenes/usuario.png";
		return;
    }

    // ahora tomamos el primer archivo, el cual vamos a previsualizar
    var primerArchivo = archivos[0];
    // lo convertimos a un objeto de tipo objectURL
    var objectURL = URL.createObjectURL(primerArchivo);
    // y a la fuente de la imagen le ponemos el objectURL
    imagenPrevisualizacion.src = objectURL; 
}    
//**********************************************************************************
function hago_llamada_ajax()
{
	// aquí se podrían validar muchas más cosas->que no validamos
	// sólo validamos en el formulario-> que las cajas contengan información

	// borro div mensaje
	borrodiv();
	// visualizo la estrellita
	document.getElementById('estrella').style.visibility='visible';
	// inhabilito botón de realizar alta
	document.getElementById('boton1').disabled=true;
	//  inhabilito botón de limpiar
	document.getElementById('boton2').disabled=true;

	// a "new FormData" se le tiene que pasar el formulario con el que estemos trabajando
	// Crea el objeto FormData, el cual obtiene los datos del formulario.
	// de esta forma extraemos los datos del formulario
	var formData = new FormData(document.getElementById("formulario1"));				

	// AJAX JavaScript
	
	// para generar un error
	// fetch ('realizar_alta_usuario11111.php',
	fetch ('realizar_alta_usuario.php',
	{ 
	  method: "POST",
	  body: formData 
	}) 
	.then(function(response)
	{
		if(!response.ok)
		{
			document.getElementById('mensaje').innerHTML="<b><font face='Calibri' color='red' size='3'>Error: "+response.statusText+"</font><b>";
			throw new Error('Problema con el fichero!!');
		}	
		// recibo la respuesta del script PHP en forma de promesa
		return response.json();
	})
	.then (function(datos)
	// si ya no hay error
	// en esta sección sobran muchas cosas
	// el "1" que se supone hay en "datos" no lo estamos utilizando
	{
			document.getElementById('mensaje').innerHTML="<b><font face='Calibri' color='green' size='3'>Socio dado de alta correctamente!!</font><b>";
			limpio_pantalla(0);
	})
	.catch (function(error)
	{
		// podemos poner un alert que visualizará "Error: Problema con el fichero!!"
		//alert( 'Error: '+error);
		limpio_pantalla(1);
	});
}
//**********************************************************************************
function limpio_pantalla(estado)
{
	// oculto estrella
	document.getElementById('estrella').style.visibility='hidden';
	// habilito botones
	document.getElementById('boton1').disabled=false;
	document.getElementById('boton2').disabled=false;
	
	// no hay error
	if (estado==0)
		{
			// limpio cajas
			document.formulario1.reset();
			// limpio imagen usuario
			borroimagen('img1');						
			
			// llamo a limpiar iframe con un retardo de 3 seg
			setTimeout("borrodiv()",3000);
			// paso foco a DNI
			document.formulario1.nif.select();
		}
	// hay error	
	else	
		{
			// selecciono el contenido de la caja de texto DNI
			document.formulario1.nif.select();
		}
}
//**********************************************************************************
</script>

<body onload="document.getElementById('nif').focus();">
<!-- **************************** CABECERA ************************************************ -->
<!-- **************************** CABECERA ************************************************ -->
<!-- **************************** CABECERA ************************************************ -->
<header>

<div class="BarraNavegar">
				<i class="fab fa-php fa-3x" ></i>
				<label  class="L1">Servidor:</label>
				<label  class="L2"><b>ALTA USUARIO</b></label>		
				<label  class="L3">ASÍNCRONA (Fetch JavaScript-Sin ERROR)</label>	
</div>
</header>
<!-- **************************** CUERPO ************************************************ -->
<!-- **************************** CUERPO ************************************************ -->
<!-- **************************** CUERPO ************************************************ -->
<div class="contenedor1">
<div id="cajapagina" class="contenedor2">
<div class="contenedor-formulario">
		<form id="formulario1" name="formulario1" ENCTYPE="multipart/form-data" 
		ACTION="" METHOD="POST" TARGET="" autocomplete="off"
		onsubmit="hago_llamada_ajax();return false;"> 
				<!-- con "return false" impido que se realice el submit aquí --> 
				<!-- onsubmit="alert('hola submit!');hago_submit();return false;">  -->
				
				<legend class="leyenda">Alta de Usuario: </legend><br>
				
				<div class="form-group">
					<label>Nif:</label>
					<input class="input-control" id="nif" name="nif" maxlength="10" style="width: 25%" 
					required autocomplete="off">
				</div>

				<div class="form-group">
					<label>Nombre:</label>
					<input class="input-control" id="nombre" name="nombre" maxlength="15" style="width:45%" 
					required autocomplete="off">
				</div>

				<div class="form-group">
					<label>Edad:</label>
					<input class="input-control" type="number" id="edad" name="edad" min="1" max="120" step="1" style="width:12%" 
					required autocomplete="off">
				</div>

				<div class="form-group">
					<label>Fecha Alta:</label>
					<input class="input-control" type="date" id="fecha" name="fecha" required
					value="<?php echo date('Y-m-d');?>" style="width:35%;cursor:pointer">
				</div>
				
				<div class="form-group">
					<label>Precio:</label>
					<input class="input-control" type="number" id="precio" name="precio" maxlength="10" style="width:23%" 
					value="0.00" step="0.01" required autocomplete="off">
				</div>

				<div class="form-group">
					<label>Info:</label>
					<input class="input-control" id="info" name="info" maxlength="60" style="width:75%" 
					required autocomplete="off">
				</div>

				 <img id="img1" src="imagenes/usuario.png" width="80" height="80" style="border:1px solid blue" >
				
				<div class="form-group">
					<label>Imagen:</label>
					<input type="file" class="input-control" id="imagen" name="imagen" required 
					style="padding-bottom: 10px;" onchange="visualizo('imagen','img1')">
				</div>
				
				<div class="form-group" align="left">
										<button class="boton" id="boton1" type="reset"
										onclick="pasofoco('nif');borroimagen('img1');borrodiv();
														document.getElementById('boton2').disabled=false;">
										<i class="fa fa-trash"></i> Limpiar
										</button>
						
										<!-- el "button" lo pongo de tipo "submit" para que se realice la validación del formulario -->
										<!-- pero en realidad no quiero que se haga el "submit" aquí -->
										<!-- si no lo pongo "submit" no se realizaría la validación del formulario -->						
										<button class="boton" id="boton2" form="formulario1" type="submit"
										onclick="">
										<i class="fas fa-pencil-alt"></i> Alta
										</button>
						
										<div id="mensaje" name="mensaje" align="center" scrolling="no" 
												style="border:1px solid blue;width:300px;height:30px;padding-top:8px;">
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