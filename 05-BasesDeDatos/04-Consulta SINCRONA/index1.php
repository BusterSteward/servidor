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
//*******************************************************************************************
//*******************************************************************************************
//********************************CONSULTA DE USUARIO***************************************
//*******************************************************************************************
//*******************************************************************************************
function consulta(elnif)
{
	// cosas que hay que hacer ANTES
	document.getElementById('estrella').style.visibility='visible';
	
	// si hay algo en iframe "datos" lo borro
	borro_iFrame('datos');
	
	// inhabilito botón consulta
	document.getElementById('boton2').disabled=true;	
	// inhabilito botón limpiar
	document.getElementById('boton1').disabled=true;	
		
	// llamo a "PHP-consulta.php" de forma **SÍNCRONA** que realizará la consulta
	//	en este caso utilizaremos una estrategia "**Fat-Server/Thin-Client**"
	// cargamos de trabajo al "servidor" y liberamos al "cliente"
	// el servidor NO devuelve datos en JSON -> devuelve HTML con los datos solicitados 
	
	document.formulario1.target="datos";
	document.formulario1.action="PHP-consulta.php";
	document.formulario1.submit(); 
}
//*******************************************************************************************
// esta función se ejecuta cuando termina el script "PHP-consulta.php"
// a esta función se le llama desde el servidor
function termino_consulta(datos)
{	

	// cosas que hay que hacer DESPUÉS
	// una vez que se termine de ejecutar "PHP-consulta.php" se ejecutará esta función
	
	// oculto estrella
	document.getElementById('estrella').style.visibility='hidden';
	// habilito botón limpiar
	document.getElementById('boton1').disabled=false;		
	
	if (datos==1)
	// SI he encontrado el socio
	{
		// inhabilito caja texto nif
		document.getElementById('nif').disabled=true;
		// habilito el botón de borrar
		document.getElementById('boton3').disabled=false;
		//*******************************
		// habilito botones anterior y siguiente
		//*******************************
		document.getElementById('b1').disabled=false;
		document.getElementById('b2').disabled=false;						
	}
	else
	// NO he encontrado el socio
	{
		// habilito botón consulta
		document.getElementById('boton2').disabled=false;	
		// paso foco nif
		pasofoco('nif');
	}
}
//*******************************************************************************************
//*******************************************************************************************
//****************************ANTERIOR-SIGUIENTE*********************************************
//*******************************************************************************************
//*******************************************************************************************
function anterior_siguiente(elnif,quehago)
{	
	// cosas que hay que hacer ANTES
	
	//quehago=0 -> anterior
	//quehago=1 -> siguiente
	
	// OJO: aquí se puede realizar mejora para que no se salte ningún registro en caso de primer o último registro
	// mejora realizada
	// este código sólo se ejecuta si los botones correspondientes están deshabilitados
	//**************************************************************************
	if (document.getElementById('b1').disabled==true) {elnif="0";}
	if (document.getElementById('b2').disabled==true) {elnif="99999999999";}

	// para asegurarnos que ningún botón de anterior-siguiente quede deshabilitado para siempre
	//**************************************************************************
	if (quehago==1) {document.getElementById('b1').disabled=false;}
	if (quehago==0) {document.getElementById('b2').disabled=false;}
	
	// visualizo estrella
	document.getElementById('estrella').style.visibility='visible';
	
	// inhabilito botón consulta
	document.getElementById('boton2').disabled=true;	
		
	// llamo a "PHP-anterior-siguiente.php" de forma **"SÍNCRONA"** que realizará la consulta
	//	en este caso utilizaremos una estrategia "**Fat-Server/Thin-Client**"
	// cargamos de trabajo al "servidor" y liberamos al "cliente"
	// el servidor NO devuelve datos en JSON -> devuelve HTML con los datos solicitados 
	
	document.formulario1.target="datos";
	// llamamos al script PHP y por GET le pasamos cual es el "nif" actual y el botón pulsado->anterior o siguiente
	document.formulario1.action="PHP-anterior-siguiente.php?nifactual="+elnif+"&quehacer="+quehago;
	document.formulario1.submit(); 
}
//**********************************************************************************
// esta función se ejecuta cuando termina la consulta el script "PHP-anterior-siguiente.php"
// a esta función se le llama desde el servidor
function termino_consulta_anterior_siguiente(elnif)
{	
	// cosas que hay que hacer DESPUÉS
	// una vez que se termine de ejecutar "PHP-anterior-siguiente.php" se ejecutará esta función
	
	// oculto estrella
	document.getElementById('estrella').style.visibility='hidden';
	
	if ((elnif==0) || (elnif==1))
	{
		if (elnif==0)
		{
			document.getElementById('b1').disabled=true;
			document.getElementById('datos').contentWindow.document.write("<b><font face='Calibri' color='maroon' size='3'>Este DNI->Primer Registro!!</font><b>");
		}
		if (elnif==1)
		{
			document.getElementById('b2').disabled=true;
			document.getElementById('datos').contentWindow.document.write("<b><font face='Calibri' color='maroon' size='3'>Este DNI->Último Registro!!</font><b>");
		}
	}
	else
	{
		// habilito caja texto nif
		document.getElementById('nif').disabled=false;
		document.getElementById('nif').value=elnif;
		// des-habilito caja texto nif
		document.getElementById('nif').disabled=true;
	}
}
//*******************************************************************************************
//*******************************************************************************************
//**********************************BAJA DE USUARIO******************************************
//*******************************************************************************************
//*******************************************************************************************
function baja(elnif)
{
	// visualizo estrella
	document.getElementById('estrella').style.visibility='visible';
	// inhabilito botón BORRAR
	document.getElementById('boton3').disabled=true;	
	// inhabilito botón LIMPIAR
	document.getElementById('boton1').disabled=true;	

	// des-habilito botones anterior y siguiente
	document.getElementById('b1').disabled=true;
	document.getElementById('b2').disabled=true;

	//no hace falta
	//document.formulario1.target="datos";
	// llamamos al script PHP y por GET le pasamos cual es el "nif" a borrar
	document.formulario1.action="PHP-baja.php?nifactual="+elnif;
	document.formulario1.submit(); 
}
//**********************************************************************************
// esta función se ejecuta cuando termina la consulta el script "PHP-baja.php"
// a esta función se le llama desde el servidor
function termino_baja(datos)
{	
	// cosas que hay que hacer DESPUÉS
	// una vez que se termine de ejecutar "PHP-baja.php" se ejecutará esta función
	
	// oculto estrella
	document.getElementById('estrella').style.visibility='hidden';
	
	// *****************************************************
	// ¿¿habría aquí que tratar otros casos?? -> reflexiona
	// *****************************************************	
	
	if (datos==1)
	{
			document.getElementById('datos').contentWindow.document.write("<b><font face='Calibri' color='green' size='3'>Usuario borrado con éxito!!</font><b>");
	}

	// llamo a limpiar iframe 'datos' con un retardo de 3 seg
	setTimeout("borro_iFrame('datos')",4000);				

	document.getElementById('nif').disabled=false;
	document.getElementById('nif').value="";
	pasofoco('nif');
	// habilito botones
	document.getElementById('boton2').disabled=false;
	document.getElementById('boton1').disabled=false;		
}
//**********************************************************************************
//**********************************************************************************
//*******************************FUNCIONES*****************************************
//**********************************************************************************
//**********************************************************************************
function borro_iFrame(elqueborro)
{
	document.getElementById(elqueborro).contentWindow.document.body.innerHTML="";
}
//**********************************************************************************
// para pasar el foco a un objeto y seleccionar su contenido
function pasofoco(objeto)
{
	document.getElementById(objeto).focus();
	document.getElementById(objeto).select();
}
//**********************************************************************************
function pulso_limpiar()
{
	document.getElementById('nif').disabled=false;
	pasofoco('nif');
	borro_iFrame('datos');
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
				<label  class="L3">SÍNCRONA (con espera->chapuza)</label>	
				<label  class="L4">Fat-Server/Thin-Client</label>	
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
	onsubmit="return false;"> 

		<legend class="leyenda">Consulta-Baja de Usuario: </legend><br>

		<div class="form-group">
				<label>Nif:</label>
				<input class="input-control" id="nif" name="nif" maxlength="10" style="width: 35%" required autocomplete="off">

				<div><button type="button" id="b1" style="width:50px;height:30px;cursor:pointer" disabled
				onclick="anterior_siguiente(document.getElementById('nif').value,0)"><i class="fas fa-arrow-left"></i></button>
				
				<button type="button" id="b2" style="width:50px;height:30px;cursor:pointer;margin-bottom:10px" disabled 
				onclick="anterior_siguiente(document.getElementById('nif').value,1)"><i class="fas fa-arrow-right"></i></button></div>			
		</div>

		<div class="form-group">
			<iframe id="datos" name="datos" align="left" scrolling="no" 
					style="border:1px solid blue;width:280px;height:215px;">
			</iframe>	
		</div>
		
		<div class="form-group" align="left">
								<button class="boton" id="boton1" type="reset"
								onclick="pulso_limpiar();">
								<i class="fa fa-trash"></i> Limpiar
								</button>
				
								<button class="boton" id="boton2" form="formulario1" type="submit"
								onclick="if (document.getElementById('nif').value!='')
												{consulta(document.getElementById('nif').value);borro_iFrame('datos');}else{pasofoco('nif');};">
								<i class="fas fa-question"></i> Consulta
								</button>
								
								<button class="boton" id="boton3" type="button"  disabled
								onclick="baja(document.getElementById('nif').value);">
								<i class="fas fa-trash-alt"></i> Borrar
								</button>
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