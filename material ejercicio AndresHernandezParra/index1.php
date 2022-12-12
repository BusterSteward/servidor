<!DOCTYPE html>
<html lang="es">
<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<meta http-equiv="Pragma" content="no-cache">
		 
		<meta name="description" content="Paginación-Base de Datos">
		<meta name="author" content="Jorge López">

		<link rel="shortcut icon" href="imagenes/icon.png"/>

		<title>Paginación</title>

		<!-- estilo general de la página -->
		<link href="ficheros/estilo_pagina.css" rel="stylesheet">
		
		<!-- estilo barra de menú -->
		<link href="ficheros/barra_menu.css" rel="stylesheet">		
		
		<!-- estilo de formularios -->
		<link href="ficheros/formularios.css" rel="stylesheet">
		
		<!-- estilo de tablas -->
		<link href="ficheros/tablas.css" rel="stylesheet">
		
		<!-- estilo barra de Navegar -->
		<link href="ficheros/navegacion.css" rel="stylesheet">
		
		<!-- biblioteca de iconos -->
		<link href="ficheros/all.css" rel="stylesheet">
		
		<!-- librería jQuery -->
		<script type="text/javascript" src="ficheros/jquery.js"></script>				
		
		<!-- barra navegación-paginación Ejercicio 01 -->
		<!-- barra navegación-paginación Ejercicio 01 -->		
		<!-- prohibido modificar este script -> sólo mirar -->
		<script type="text/javascript" src="navegacion.js"></script>	
		<!-- prohibido modificar este script -> sólo mirar -->		
		<!-- barra navegación-paginación Ejercicio 01 -->
		<!-- barra navegación-paginación Ejercicio 01 -->		
 </head>


<script language='javascript'>

//***********************************************************************
function repinto_botones()
{
	if(NP<4){
		document.getElementById("mastres").classList.add('disabled');
		document.getElementById("menostres").classList.add('disabled');
	}
	// **************************************************
	// tratamiento botón -3
	// **************************************************	
	if(PA>=4){
		document.getElementById("menostres").classList.remove('disabled');
	}
	else{
		document.getElementById("menostres").classList.add('disabled');
	}
	// **************************************************	
	// tratamiento botón +3
	// **************************************************	
	if(PA<=(NP-3)){
		document.getElementById("mastres").classList.remove('disabled');
	}
	else{
		document.getElementById("mastres").classList.add('disabled');
	}
	var i=0;
	
	//pinto valor de nº página actual
	if (PA<=9)	document.getElementById("pa").value="0"+PA;
	else document.getElementById("pa").value=PA;

	//************ configuro botones de primera-siguiente-anterior-última página
	if (PA==NP)
	{
		document.getElementById("primera").classList.remove('disabled');
		document.getElementById("anterior").classList.remove('disabled');
		document.getElementById("ultima").classList.add('disabled');
		document.getElementById("siguiente").classList.add('disabled');		
	}
	else if (PA==1)
	{ 
		document.getElementById("primera").classList.add('disabled');
		document.getElementById("anterior").classList.add('disabled');
		document.getElementById("ultima").classList.remove('disabled');
		document.getElementById("siguiente").classList.remove('disabled');	
	}
	else
	{
		document.getElementById("primera").classList.remove('disabled');
		document.getElementById("anterior").classList.remove('disabled');
		document.getElementById("ultima").classList.remove('disabled');
		document.getElementById("siguiente").classList.remove('disabled');	
	}	

}
//***********************************************************************
function fetch_listado(REGI,REGF)
{
	// visualizo estrella
	document.getElementById('estrella').style.visibility='visible';	
	var url = "pintotabla.php?inicio="+REGI+"&fin="+REGF;
	//alert(REGI+" "+REGF);
	
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
			throw new Error('Página!! : '+response.statusText);
	})
	.then(function(datos)
	{
			// oculto estrella
			document.getElementById('estrella').style.visibility='hidden';
	
			// en "datos" tengo el array que devuelve "pintotabla.php" en formato JSON
			// $jsondatos["lista"]
			var lista = datos.lista;
			
			// puntero a la tabla html
			var table = document.getElementById("mitabla");
				
			// obligatorio
			// borro todo el contenido de la tabla
			// con otra política de paginación -> no tendría que borrar el contenido
			table.innerHTML = "";
			
			//****************************************************
			// creo CUERPO <tbody>
			var body = table.createTBody();

			// vamos a insertar -> 3 registros por fila
			filas_creadas=1;
			columna=0;
			var fila = body.insertRow(0);   	

			// me recorro el array y voy añadiendo las filas a la tabla
			//alert("tamaño tabla "+lista.length);
			lista.forEach(elemento =>
			{
				fila.insertCell(columna).innerHTML=
				elemento.dni+"<br>"+elemento.nombre+"<br>"+elemento.edad+"<br>"+elemento.precio+"<br>"+
				"<img width='45px' height='45px' style='margin-top:2px' src='data:image/jpeg;base64,"+elemento.imagen+"'>"+"<br>"+
				"<img onclick='alta_mysql(this)' style='cursor:pointer;width:45px;height:45px' src='imagenes/mysql.png'>";								;

				columna++;

				// si ya he escrito las 3 columnas->tengo que crear una fila nueva
				if (columna==3)
				{
					fila = body.insertRow(1);
					filas_creadas++;
					columna=0;
				}	
			});
			// creo adorno para los huecos que queden hasta completar los 8 huecos
			// sólo se ha creado 1 fila
			if (filas_creadas==1)
			{
				// completo celdas de la 1ª fila
				for (i=columna; i<=2; i++)
				{fila.insertCell(i).innerHTML="";}
				// creo la 2ª fila y sus 3 celdas
				fila = body.insertRow(1);
				for (i=0; i<=2; i++)
				{fila.insertCell(i).innerHTML="<br><br><br><br><br><br><br><br><br><br>";}			
			}		
			// se han creado 2 filas
			if (filas_creadas==2)
			{
				// completo celdas de la 2ª fila
				for (i=columna; i<=2; i++)
				{fila.insertCell(i).innerHTML="";}
			}								
	})
	.catch(function(err)
	{
		alert(err);
		// oculto estrella
		document.getElementById('estrella').style.visibility='hidden';
	});					
}

//*********************************************************************
//**************************** EXAMEN *********************************
//**************************** BOTÓN -3 *******************************
//*********************************************************************
//*********************************************************************
/*
// número de registros
var NR;
// tamaño de página
var TP=6;
// página actual
var PA=1;
// número de páginas
var NP;
// registro inicial y final
var RI=0;
var RF=TP;
// trozo
var TROZO;
*/
function menos_tres()
{
	if(PA>=4){

		//el registro inicial es el tamaño de las páginas por la Pagina actual menos 1 
		//ej: estoy en pagina 4 -> le resto a la pagina 3 y estoy en pagina 1
		// el registro inicial sería TP -(PA-1) -> 6*(1-0) = 0
		// registro final sería TP = 6 
	
		PA-=3;
		RI=TP*(PA-1);
		RF=TP;

		repinto_botones();
		// cargo la página anterior
        fetch_listado(RI,RF);
	}
}
//*********************************************************************
//**************************** EXAMEN *********************************
//**************************** BOTÓN +3 *******************************
//*********************************************************************
//*********************************************************************
function mas_tres()
{
	//esta condición no sería necesaria ya que el boton esta deshabilitado
	if(PA<=(NP-3)){
		PA+=3;
		RI=TP*(PA-1);
		//comprobamos si estoy en la ultima página y el trozo es distinto de 0
		//solo en este caso el RF se calculará con TROZO en lugar de TP
		if(PA==NP && TROZO!=0){
			RF=TROZO;
		}
		else{
			RF=TP;
		}

	}
	repinto_botones();
	// cargo la página anterior
	fetch_listado(RI,RF);
}

//*********************************************************************
//**************************** EXAMEN *********************************
//**************************** Alta-MySql *******************************
//*********************************************************************
//*********************************************************************
function alta_mysql(celda)
{

	
	let celdaReal = celda.parentNode;
	let celdaTexto = celdaReal.innerText;
	celdaTexto = celdaTexto.replaceAll("\n"," ");
	
	let datosCelda = celdaTexto.trim().split(" ");
	
	let url="Hago_Alta_MySql.php";

	let formData= new FormData();

	formData.append("eldni",datosCelda[0]);
	formData.append("elnombre",datosCelda[1]);
	formData.append("laedad",datosCelda[2])
	fetch(url,
	{ 
		method: "POST",
		body: formData
	})
	.then(function(response)
	{
		if (response.ok)
			//return response.text();
			return response.text();
		else	
			// generamos un error que será recogido por el método ".catch"
			throw new Error('Página!! : '+response.statusText);
	})
	.then(llegadaDatos1())
	.catch(function(error)
	{
		 alert(error)
	});

	
}	

function llegadaDatos1()
{
	alert("usuario dado de alta correctamente");
}	



</script>



<body onload="inicio();">
<!-- **************************** CABECERA ************************************************ -->
<!-- **************************** CABECERA ************************************************ -->
<!-- **************************** CABECERA ************************************************ -->
<header>
<div class="BarraNavegar">
		<i class="fas fa-tv fa-2x" ></i>
		<label  class="L1">Servidor 2º DAW&nbsp&nbsp&nbsp</label>		
		<label  class="L2"><b>EXAMEN PAGINACIÓN</b></label>		
		<label  class="L3">EJERCICIO 01 - EJERCICIO 02</label>	
</div>
</header>
<!-- **************************** CUERPO ************************************************ -->
<!-- **************************** CUERPO ************************************************ -->
<!-- **************************** CUERPO ************************************************ -->
<div class="contenedor1">
<div id="cajapagina" class="contenedor2">
		
		<!-- botón inicio consulta -->
		<div class="contenedor3">
				<button class="boton" id="boton1" type="button"  style="margin:10px;"
					onclick="primera_consulta();">
					<i class="fas fa-question"></i> Iniciar Consulta
				</button>

				<input class="caja_mensaje" id="mensaje_label" value="0">
		</div>
		
		<!-- donde se visualiza la tabla -->
		<div  class="contenedor4" id="pongotabla">
				<!-- la Tabla donde visualizo los datos -->
				<table class='table' id="mitabla" style='border:0px solid red'>
				</table>
		</div>	

		<!-- donde se visualiza la barra de navegación -->
		<div  class="paginacion" id="navegacion" style='border:0px solid red;margin-bottom:10px;margin-top:10px'>
				<!-- botón PRIMERA -->
				<a id="primera" onclick="primera()" href='#'>Primera</a>

				<!-- botón -3 -->
				<a id="menostres" onclick="menos_tres()" href='#'>-3</a>
				
				<!-- botón ANTERIOR -->
				<a id="anterior" onclick="anterior()" href='#'><<</a>
		
				<!-- botón SIGUIENTE -->
				<a id="siguiente" onclick="siguiente()"  href='#'>>></a>

				<!-- botón +3 -->
				<a id="mastres" onclick="mas_tres()" href='#'>+3</a>

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
		&nbsp&nbsp<i class="fas fa-building fa-2x" ></i>
		<label>&nbsp © 2022 IES Escultor</label>		
</footer>
</body>
</html>