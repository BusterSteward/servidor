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

 </head>


<script language='javascript'>

	// número de registros
	var NR;
	// tamaño de página
	var TP=8;
	// página actual
	var PA=1;
	// número de páginas
	var NP;
	// registro inicial y final
	var RI=0;
	var RF=TP;
	// trozo
	var TROZO;

	//*********************************************************************
	//*************************** INICIO() **********************************
	//*********************************************************************
	function inicio(){
		// des-habilito todos los elementos de la barra de navegación
		document.getElementById("primera").classList.add('disabled');
		document.getElementById("anterior").classList.add('disabled');
		document.getElementById("ultima").classList.add('disabled');
		document.getElementById("siguiente").classList.add('disabled');		
	}

	function primera_consulta(){
			// visualizo estrella
			document.getElementById('estrella').style.visibility='visible';	
			// in-habilito botón consulta 
			document.getElementById('boton1').disabled=true;	

			// habilito los botones de "siguiente" y "última" en la barra de navegación		
			// botón "primera" y "anterior" lo pongo deshabilitado
			document.getElementById("ultima").classList.remove('disabled');
			document.getElementById("siguiente").classList.remove('disabled');			
			
			// calculo el nº de registros que tiene la tabla
			// algo necesario para organizar todo el trabajo y calcular algunos valores de variables
			var url = "CalculoNregistros.php";
			fetch(url)
			.then(function(response)
			{
				//alert("La respuesta del servidor es: "+response.ok);
				if (response.ok)
				{
					return response.text();
				}
				else	
					// generamos un error que será recogido por el método ".catch"
					throw new Error('Página '+response.statusText);
			})
			// una vez que termine se ejecutará el siguiente código
			.then(function(datos)
			{
				// alert(datos);
				
				// informo del nº de registros devueltos
				document.getElementById('mensaje_label').value=datos;	
				
				// calculo el valor de algunas cosas importantes
				NR=parseInt(datos);
				NP=parseInt(NR/TP);

				TROZO=NR%TP;	
				if (TROZO>0) NP++;
				
				//alert('trozo: '+TROZO);
				
				//pinto los valores de nº páginas y nº página actual
				if (PA<=9)	document.getElementById("pa").value="0"+PA;
				else document.getElementById("pa").value=PA;
				if (NP<=9)	document.getElementById("np").value="0"+NP;
				else document.getElementById("np").value=NP;
				
				// cargo la 1ª página
				fetch_listado(RI,RF);	
			})
			.catch(function(err)
			{
				alert("este"+err);
				document.getElementById("mensaje_label").value=err;
				// oculto estrella
				document.getElementById('estrella').style.visibility='hidden';
			});
	}
	//*********************************************************************
	//*********************************************************************
	//********************** BOTÓN 1ª PÁGINA*******************************
	//*********************************************************************
	//*********************************************************************
	function primera()
	{
		RI=0;
		RF=TP;

		PA=1;

		repinto_botones();
		// cargo la última página
		fetch_listado(RI,RF);			
	
	}
	//*********************************************************************
	//*********************************************************************
	//******************* BOTÓN ÚLTIMA PÁGINA ****************************
	//*********************************************************************
	//*********************************************************************
	function ultima(){
		// actualizo variables
		if (TROZO==0){
			RI=TP*(NP-1);
			RF=RI+TP;
		}else{
			RI=(NR-TROZO);
			RF=TROZO;
		}	
		PA=NP;

		repinto_botones();
		// cargo la última página
		fetch_listado(RI,RF);
	}
	//*********************************************************************
	//*********************************************************************
	//********************** BOTÓN SIGUIENTE ******************************
	//*********************************************************************
	//*********************************************************************
	function siguiente(){
		// actualizo variables
		RI=TP*(PA);
		RF=TP;
		PA++;

		repinto_botones();
		// cargo la siguiente página
		fetch_listado(RI,RF);	
	}
	//*********************************************************************
	//*********************************************************************
	//********************** BOTÓN ANTERIOR ******************************
	//*********************************************************************
	//*********************************************************************
	function anterior(){
		RI=(RI-TP);
		RF=TP;
		PA=PA-1;
		// cargo la siguiente página
		repinto_botones();
		fetch_listado(RI,RF);		
	}
	//***********************************************************************
	function repinto_botones(){
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
		// es if está bien suponiendo que el nº de páginas que tengo sea >1
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
	function fetch_listado(REGI,REGF){
		// visualizo estrella
		document.getElementById('estrella').style.visibility='visible';	
		//saco el autor
		var autor=document.getElementById('cajaautor').value;
		
		// hago la llamada al script
		var url = "pintotabla.php?inicio="+REGI+"&fin="+REGF+"&autor="+autor;
		fetch(url,{method: "GET"}) 
		.then(function(response){
			if (response.ok)return response.json();
			else throw new Error('Página!! : '+response.statusText);
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
			
				columna=0;
				var fila = body.insertRow(0);
				
				lista.forEach(elemento =>
				{
					fila.insertCell(columna).innerHTML=  
					"<img width='100px' height='140px' style='margin-top:2px' src='data:image/jpeg;base64,"+elemento.imagen+"'/>"+
					"<img onclick='comprar(this)' style='cursor:pointer;width='45px' height='45px' style='margin-top:2px' src='imagenes/carro.png'/>"+
					"<p> <em style='color:blue;'>"+elemento.titulo1+"</em><br>"+
					elemento.titulo2+"<br>"+
					"<em style='color:red';>"+elemento.precio+"€</em></p>";
			
					columna++;

					if (columna==4){
						fila = body.insertRow(1);
						columna=0;
					}
				});

		})
		.catch(function(err){
			alert(err);
			// oculto estrella
			document.getElementById('estrella').style.visibility='hidden';
		});
		//Si el autor se ha modificado muestra en la pagina 01
		if(autor!="por-defecto"){
			document.getElementById("primera").classList.add('disabled');
			document.getElementById("anterior").classList.add('disabled');
			document.getElementById("ultima").classList.add('disabled');
			document.getElementById("siguiente").classList.add('disabled');
			document.getElementById("np").value="01";
			document.getElementById("pa").value="01";
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
			<label  class="L1">Servidor 2º DAW&nbsp&nbsp&nbsp</label>		
			<label  class="L2"><b>PAGINACIÓN-SIMPLE con Borrado</b></label>		
			<label  class="L3">ASÍNCRONA (Fetch)</label>	
			<label  class="L4">Thin-Server/Fat-Client</label>	
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

					<label for="estado">Filtrar por autor:
					<select onchange="document.getElementById('boton1').disabled=false;inicio();" id="cajaautor" >
						<option value="por-defecto">TODOS</option>
						<option value="PABLO NERUDA">PABLO NERUDA</option>
						<option value="MARIO BENEDETTI">MARIO BENEDETTI</option>
						<option value="FEDERICO GARCÍA LORCA">FEDERICO GARCÍA LORCA</option>
						<option value="OCTAVIO PAZ">OCTAVIO PAZ</option>
						<option value="JULIA NAVARRO">JULIA NAVARRO</option>
						<option value="FRAY LUIS DE LEÓN">FRAY LUIS DE LEÓN</option>
						<option value="SUSAN SPENCER">SUSAN SPENCER</option>
						<option value="SYLVIA DAY">SYLVIA DAY</option>
					</select>
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

					<!-- botón ANTERIOR -->
					<a id="anterior" onclick="anterior()" href='#'><<</a>
			
					<!-- botón SIGUIENTE -->
					<a id="siguiente" onclick="siguiente()"  href='#'>>></a>

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