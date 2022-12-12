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
var TP=5;
// página actual
var PA=1;
// número de páginas
var NP;
// registro inicial y final
var RI=0;
var RF=TP;
// trozo
var TROZO;

// botón pulsado ANTERIOR y AHORA
var PulsadoANTES=1;
var PulsadoAHORA=1;

// criterio de "ordenación" y filtro "edad"
var ordeno;
var laedad;

//*********************************************************************
//*************************** INICIO() **********************************
//*********************************************************************
function inicio()
{
	// des-habilito todos los elementos de la barra de navegación
	document.getElementById("primera").classList.add('disabled');
	document.getElementById("anterior").classList.add('disabled');
	document.getElementById("ultima").classList.add('disabled');
	document.getElementById("siguiente").classList.add('disabled');			
	
	document.getElementById("1").classList.add('disabled');
	document.getElementById("2").classList.add('disabled');
	document.getElementById("3").classList.add('disabled');
	document.getElementById("4").classList.add('disabled');		
	document.getElementById("5").classList.add('disabled');		
}

function primera_consulta()
{
		// visualizo estrella
		document.getElementById('estrella').style.visibility='visible';	
	
		// in-habilito botón consulta y NO DEJO APLICAR FILTROS
		document.getElementById('boton1').disabled=true;	
		document.getElementById('criterio1').disabled=true;	
		document.getElementById('criterio2').disabled=true;	

		/*document.getElementById("1").classList.remove('disabled');
		document.getElementById("2").classList.remove('disabled');
		document.getElementById("3").classList.remove('disabled');
		document.getElementById("4").classList.remove('disabled');			
		document.getElementById("5").classList.remove('disabled');*/
		
		// criterios de ordenación y de filtro
		ordeno=document.getElementById('criterio1').value;
		laedad=document.getElementById('criterio2').value;
		//alert(ordeno+'   '+laedad);		
		
		// calculo el nº de registros que tiene la tabla
		// algo necesario para organizar todo el trabajo y calcular algunos valores NECESARIOS
		var url = "CalculoNregistros.php?criterio2="+laedad;
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
			//alert(datos);

			// nº de registros
			NR=parseInt(datos);

			// informo del nº de registros devueltos
			document.getElementById('mensaje_label').value=NR;	
			
			if (NR!=0)
			{
			document.getElementById("1").classList.remove('disabled');
			document.getElementById("2").classList.remove('disabled');
			document.getElementById("3").classList.remove('disabled');
			document.getElementById("4").classList.remove('disabled');			
			document.getElementById("5").classList.remove('disabled');		

			// calculo el valor de algunas variables
			
			// nº de páginas
			NP=parseInt(NR/TP);

			// calculo TROZO, si hay TROZO aumento en 1 el nº de páginas
			TROZO=NR%TP;	
			if (TROZO>0) NP++;
			
			//alert('trozo: '+TROZO);

			// habilito todos los elementos "siguiente" y "última" de la barra de navegación	(si tengo más de una página)		
			// botón "primera" y "anterior" siguen deshabilitados
			if (NP!=1)
			{
				document.getElementById("ultima").classList.remove('disabled');
				document.getElementById("siguiente").classList.remove('disabled');			
			}	
			
			//pinto los valores de nº páginas y nº página actual
			if (PA<=9)	document.getElementById("pa").value="0"+PA;
			else document.getElementById("pa").value=PA;
			if (NP<=9)	document.getElementById("np").value="0"+NP;
			else document.getElementById("np").value=NP;
			
			// el botón 1º lo pongo activo
			document.getElementById(1).classList.add('active');

			// en el caso que tenga menos de 5 páginas
			// pinto blancos en botones y des-habilito los botones correspondientes
			for (i=NP+1;i<=5;i++)
			{
				document.getElementById(i).innerHTML="&nbsp&nbsp";
				document.getElementById(i).classList.add('disabled');
			}			  
			
			// tengo que saber el último botón que ha sido activado para realizar la gestión de la paginación
			PulsadoAHORA=1;
		
			// cargo la 1ª página
			fetch_listado(RI,RF,ordeno,laedad);	
			}
			else
			{
				/*document.getElementById("1").classList.add('disabled');
				document.getElementById("2").classList.add('disabled');
				document.getElementById("3").classList.add('disabled');
				document.getElementById("4").classList.add('disabled');	
				document.getElementById("5").classList.add('disabled'); */
				// oculto estrella
				document.getElementById('estrella').style.visibility='hidden';
				alert("No hay registros devueltos !!");
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
//*********************************************************************
//********************** BOTÓN 1ª PÁGINA*******************************
//*********************************************************************
//*********************************************************************
function primera()
{
	// si estoy en la 1ª página no hago nada
	 // esta condición sobra porque el botón estará des-habilitado
	if (PA>1)
	{
			  // actualizo algunas variables
			  RI=0;
			  RF=TP;
			  PA=1;
			  
			  // dibujo el valor de los botones
			  // lo hago en 2 pasos porque puede pasar -> que tenga menos de 5 páginas
			  // pinto números
			  if (NP<5)
			  {
					  for (i=1;i<=NP;i++)
					  {
							//alert('menos de 5');
							document.getElementById(i).text=i;
							// por si algún botón estuviese des-habilitado
							document.getElementById(i).classList.remove('disabled');
					  }			  
					  // los botones que me sobran
					  // pinto blancos y des-habilito los botones correspondientes
					  for (i=NP+1;i<=5;i++)
					  {
							document.getElementById(i).innerHTML="&nbsp&nbsp";
							document.getElementById(i).classList.add('disabled');
					  }			  
			  }
			  // en el caso de que tenga más de 5 páginas
			  else
			  {
					  for (i=1;i<=5;i++)
					  {
						document.getElementById(i).text=i;
						// por si algún botón estuviese des-habilitado
						document.getElementById(i).classList.remove('disabled');						
					  }			  				  
			  }
			  
			  // des-activo el último botón que se hubiese pulsado
			  document.getElementById(PulsadoAHORA).classList.remove('active');
			  // botón "primera" y "anterior" lo pongo deshabilitado
			  document.getElementById("primera").classList.add('disabled');
			  document.getElementById("anterior").classList.add('disabled');			  
			  // habilito los botones "última" y "siguiente"
			  document.getElementById("ultima").classList.remove('disabled');
			  document.getElementById("siguiente").classList.remove('disabled');	
			  
			  // tengo que saber el último botón que ha sido activado para realizar la gestión de la paginación
			  PulsadoAHORA=1;
			  // activo el botón nº1
			  document.getElementById(1).classList.add('active');			  			  

			  //pinto el valor de página actual
			  if (PA<=9)	document.getElementById("pa").value="0"+PA;
			  else document.getElementById("pa").value=PA;				  
			  
			  // cargo la 1ª página
			  fetch_listado(RI,RF,ordeno,laedad);	
	}	  
}
//*********************************************************************
//*********************************************************************
//******************* BOTÓN ÚLTIMA PÁGINA ****************************
//*********************************************************************
//*********************************************************************
function ultima()
{
	 // si ya estoy en la última página no hago nada
	 // esta condición sobra porque el botón estará des-habilitado
	 if (PA<NP)
	{
			// actualizo variables
			if (TROZO==0)
			{
				RI=TP*(NP-1);
			    RF=RI+TP;
			}
			else
			{
			    RI=(NR-TROZO);
				RF=TROZO;
			}
			  
			PA=NP;
			
			 // dibujo el valor de los botones
			 // lo hago en 2 pasos porque puede pasar -> que tenga menos de 5 páginas
			 // pinto números
			 if (NP<5)
			 {					
					// el último botón lo pongo activo
					// si tengo 3 páginas, pues el botón nº3 lo pondré activo
					document.getElementById(NP).classList.add('active');		
					
					// des-activo el botón que se hubiese pulsado antes			
					document.getElementById(PulsadoAHORA).classList.remove('active');
					
					// tengo que saber el último botón que ha sido activado para realizar la gestión de la paginación
					PulsadoAHORA=NP;

					//alert('pulsado ahora:  '+PulsadoAHORA+'      pulsado antes:    '+PulsadoANTES);
			 }
			 // en el caso de que tenga más de 5 páginas
			 else
			 {
					// dibujo los valores de los 5 botones
					var resto=4;
					for (i=1;i<=5;i++)
					{
						// dibujo los números en los botones
						document.getElementById(i).text=NP-resto;
						// por si algún botón estuviese des-habilitado
						document.getElementById(i).classList.remove('disabled');						
						resto--;
					}		
					// des-activo el botón que se hubiese pulsado antes			
					document.getElementById(PulsadoAHORA).classList.remove('active');
					// tengo que saber el último botón que ha sido activado para realizar la gestión de la paginación					
					PulsadoAHORA=5;				  
					// activo el botón nº5
					document.getElementById(PulsadoAHORA).classList.add('active');
			 }			  
			
			// des-habilito los botones "última" y "siguiente"
			document.getElementById("ultima").classList.add('disabled');
			document.getElementById("siguiente").classList.add('disabled');	
			// habilito los botones "primera" y "anterior"
			document.getElementById("primera").classList.remove('disabled');
			document.getElementById("anterior").classList.remove('disabled');				

			//pinto el valor de página actual
			if (PA<=9)	document.getElementById("pa").value="0"+PA;
			else document.getElementById("pa").value=PA;				  
	  
		    // cargo la última página
			fetch_listado(RI,RF,ordeno,laedad);			
	}
}
//*********************************************************************
//*********************************************************************
//********************** BOTÓN SIGUIENTE ******************************
//*********************************************************************
//*********************************************************************
function siguiente()
{
	// si estoy en la última página no hago nada
	// esta condición sobra porque el botón estará des-habilitado
	if (PA<NP)
	{
  		    // actualizo variables
			RI=TP*(PA);
			RF=TP;
			PA++;
			
			//alert(PA);
			
			// tengo que saber el último botón que ha sido activado para realizar la gestión de la paginación					
			PulsadoANTES=PulsadoAHORA;
			
			// si ya estoy en el botón nº5 -> me toca volver a repintar los 5 botones
			if (PulsadoAHORA==5)
			{
				// calculo el primer número para el primer botón
				var primer_numero=parseInt(document.getElementById(5).text)+1;
				for (i=1;i<=5;i++)
				{
					document.getElementById(i).text=primer_numero;
					// por si algún botón estuviese des-habilitado
					document.getElementById(i).classList.remove('disabled');											
					
					primer_numero++;
					
					// si me quedo sin páginas que asignar a los botones
					// los botones que me sobran
					// pinto blancos y des-habilito los botones correspondientes					
					if (primer_numero>NP)
					{
						for (i=i+1;i<=5;i++)
						{
							document.getElementById(i).innerHTML="&nbsp&nbsp";
							document.getElementById(i).classList.add('disabled');
						}			  
						break;
					}
				}	

			    // tengo que saber el último botón que ha sido activado para realizar la gestión de la paginación					
				PulsadoAHORA=1;	
				//alert('el PA '+PA);
				
				// des-activo el botón nº5
				// activo el botón nº1
				document.getElementById(5).classList.remove('active');
				document.getElementById(1).classList.add('active');
			}
			// si no estoy en el botón nº5 y pulso siguiente
			else
			{
				// tengo que saber el último botón que ha sido activado para realizar la gestión de la paginación				
				PulsadoAHORA++;
				// activo y des-activo los botones correspondientes
				document.getElementById(PulsadoAHORA).classList.add('active');
 				document.getElementById(PulsadoANTES).classList.remove('active');
				
				// estos botones tienen que estar des-habilitados
				document.getElementById("primera").classList.remove('disabled');
				document.getElementById("anterior").classList.remove('disabled');							
			}

			// si ya estoy en la última página des-habilito los botones "ultima" y "siguiente"
			if (PA==NP)
			{
				//alert('última página');
				document.getElementById("ultima").classList.add('disabled');
				document.getElementById("siguiente").classList.add('disabled');						
			}				

			//pinto el valor de página actual
			if (PA<=9)	document.getElementById("pa").value="0"+PA;
			else document.getElementById("pa").value=PA;			
			
			// cargo la siguiente página
            fetch_listado(RI,RF,ordeno,laedad);		
	}
}
//*********************************************************************
//*********************************************************************
//********************** BOTÓN ANTERIOR ******************************
//*********************************************************************
//*********************************************************************
function anterior()
{
	// si estoy en la primera página no hago nada
	// esta condición sobra porque el botón estará des-habilitado
	if (PA>1)
	{
			// actualizo variables
			RI=(RI-TP);
			RF=TP;
			PA--;			

			// tengo que saber el último botón que ha sido activado para realizar la gestión de la paginación					
			PulsadoANTES=PulsadoAHORA;
			
			// calculo el nº de botones sueltos 
			var BS=NP%5;
			//***********************************************************************************************
			//***********************************************************************************************
			// si ya estoy en el botón nº1 -> me toca volver a repintar los 5 botones
			if (PulsadoAHORA==1)
			{
				//alert("el botón es 1");
				// compruebo si estoy en el último grupo de 5 botones 
				// y si hay TROZO -> para no estropear la ordenación de los botones (1-5)(6-10)(11-15)
				// el cálculo que hago de "primer_numero" es distinto
				
				if ( (PA>=NP-5) && (BS>0))
				//******* hay botones sueltos ********************
				//******* estoy en último grupo de 5 botones *******
				{
						// alert('entro BS y último grupo de botones: '+BS+'   '+PA+'   '+(NP-5));
						// tengo que pintar los 5 botones
						// pero si la PA(página actual) es <=5 está claro que los botones que pinto son del 1 al 5
						// para probar este caso EJEMPLO: prueba con 30 registros (6 páginas)
						if (PA<=5)
						{
								var primer_numero=1;
								//alert('último grupo BS 1-5: '+primer_numero);
								PulsadoAHORA=PA;	
								//alert('primer número PA<=5: '+PA);
						}
						else
						{
								// calculo este número para si estoy en este caso 9-10-11-12-13 (5 últimas páginas pintadas)
								// si estoy en 9 y pulso anterior repinte esto -> 6-7-8-9-10
								// para no estropear la ordenación de los botones (1-5)(6-10)(11-15)(16-20)...
								if (parseInt(document.getElementById(5).text)>0)
											{ 
												var primer_numero=(NP-5)-BS+1;
												PulsadoAHORA=PA%5;
											}	
								else
											{
												var primer_numero=(NP-5)-BS+1;
												PulsadoAHORA=5;
											}
											  
								//alert('primer número PA>=5: '+PA+'   '+primer_numero+'    '+PulsadoAHORA);
						}
				}				
				//******* NO hay botones sueltos *******************
				//******* o NO estoy en el primer grupo de 5 botones *****
				else
				{
						// calculo el primer número para el primer botón
						var primer_numero=parseInt(document.getElementById(1).text)-5;
						//alert('número primer botón: '+primer_numero);
						// tengo que saber el último botón que ha sido activado para realizar la gestión de la paginación					
						PulsadoAHORA=5;	
						//alert('el PA: '+PA);
				}		
				//******************************************************************************************************
				// sigo IF -> PulsadoAHORA==1
				// dibujo los botones
				//******************************************************************************************************
				for (i=1;i<=5;i++)
				{
					document.getElementById(i).text=primer_numero;
					// por si algún botón estuviese des-habilitado
					document.getElementById(i).classList.remove('disabled');											
					primer_numero++;
				}	
				
				if (PulsadoAHORA==5)
				// estamos en el caso -> (9) (10) (11) (12) (13)
				// des-activo el botón nº1
				// activo el botón nº5
				{
					//alert('PulsadoAHORA==5');
					document.getElementById(1).classList.remove('active');
					document.getElementById(5).classList.add('active');
				}
				else
				// estamos en el caso -> (11) (12) (13) (  ) (  )
				// des-activo el botón nº1
				// activo el botón correspondiente
				{
					//alert('PulsadoAHORA==otro valor y no 5');
					document.getElementById(1).classList.remove('active');
					document.getElementById(PulsadoAHORA).classList.add('active');
				}
				
			} // termino IF -> PulsadoAHORA==1
			//***********************************************************************************************
			//***********************************************************************************************
			// si no estoy en el botón nº1 y pulso anterior -> NO TENGO QUE repintar botones
			else
			{
				// tengo que saber el último botón que ha sido activado para realizar la gestión de la paginación				
				PulsadoAHORA--;
				// activo y des-activo los botones correspondientes
				document.getElementById(PulsadoAHORA).classList.add('active');
 				document.getElementById(PulsadoANTES).classList.remove('active');
				
				// estos botones tienen que estar habilitados
				document.getElementById("ultima").classList.remove('disabled');
				document.getElementById("siguiente").classList.remove('disabled');							
			}
			//***********************************************************************************************
			//***********************************************************************************************
			// ya he terminado con el tema de saber si estaba en el primer botón o no
			//***********************************************************************************************
			//***********************************************************************************************
			
			// compruebo si estoy en la 1ª página para des-habilitar botón "anterior" y "primera"
			if (PA==1)
			{
				//alert('botón anterior');
				document.getElementById("anterior").classList.add('disabled');		
				document.getElementById("primera").classList.add('disabled');
			}				

			//pinto el valor de página actual
			if (PA<=9)	document.getElementById("pa").value="0"+PA;
			else document.getElementById("pa").value=PA;			
			
			//alert('página actual: '+PA+" "+PulsadoAHORA);
			
			// cargo la página anterior
            fetch_listado(RI,RF,ordeno,laedad);		
	}
}
//***********************************************************************
function cualquiera(numero)
{
	// si ya estoy en la página que pulso -> no hago nada
	if ((PA!=parseInt(document.getElementById(numero).text)) &&
	// si en la cajita que pincho no hay nada -> no hago nada
	(document.getElementById(numero).text.trim()!=""))
	   
	{		
			PA=parseInt(document.getElementById(numero).text);
			//alert(parseInt(document.getElementById(numero).text));
			
			// fórmula para cargar la página que me piden
			RI=((PA-1) * TP);
			RF=TP;
			
			PulsadoANTES=PulsadoAHORA;
			PulsadoAHORA=numero;
			//alert("*****pulso antes "+PulsadoANTES+"*****pulso ahora "+PulsadoAHORA);
			
			repinto_botones();	
			//alert(ordeno+'   '+laedad);
			fetch_listado(RI,RF,ordeno,laedad);
	}		
}
//***********************************************************************
function repinto_botones()
{
	var i=0;
	
	// des-pinto y pinto botón activo
	document.getElementById(PulsadoANTES).classList.remove('active');
	document.getElementById(PulsadoAHORA).classList.add('active');

	//alert("el dos "+PA);

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
function fetch_listado(REGI,REGF,ordenacion,edades)
{
	// visualizo estrella
	document.getElementById('estrella').style.visibility='visible';	
	var url = "pintotabla.php?inicio="+REGI+"&fin="+REGF+"&criterio1="+ordenacion+"&criterio2="+edades;
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
			
			// OJO: mejora: se pueden borrar todas las filas excepto la cabecera
			// var nfilas = table.rows.length;
			// for (var x=nfilas-1; x>0; x--) {table.deleteRow(x);}

			//****************************************************
			//****************************************************
			// creo CABECERA <thead>
			var header = table.createTHead();
			//****************************************************
			// Creo una fila <tr> en la cabecera <thead>
			// para las celdas <th> lo hacemos de una forma distinta
			// nos hacen falta en la cabecera que las celdas sean <th> ya que en la hoja de estilo
			// tienen un tratamiento distinto
			var fila = header.insertRow(0);    
			
			var th = document.createElement('th');
			th.innerHTML = "<b>DNI</b>";
			fila.appendChild(th);
			
			var th = document.createElement('th');
			th.innerHTML = "<b>NOMBRE</b>";
			fila.appendChild(th);				
			var th = document.createElement('th');
			th.innerHTML = "<b>EDAD</b>";
			fila.appendChild(th);
			var th = document.createElement('th');
			th.innerHTML = "<b>PRECIO</b>";
			fila.appendChild(th);			
			var th = document.createElement('th');
			th.innerHTML = "<b>FECHA</b>";
			fila.appendChild(th);
			var th = document.createElement('th');
			th.innerHTML = "<b>IMAGEN</b>";
			fila.appendChild(th);								
			
			//****************************************************
			// creo CUERPO <tbody>
			var body = table.createTBody();
			
			// me recorro el array y voy añadiendo las filas a la tabla
			//alert("tamaño tabla "+lista.length);
			filatabla=0;
			lista.forEach(elemento =>
			{
				// con esta forma de trabajar estoy creando <td>
				var fila = body.insertRow(filatabla);    
				fila.insertCell(0).innerHTML = elemento.dni;
				fila.insertCell(1).innerHTML =elemento.nombre;
				fila.insertCell(2).innerHTML = elemento.edad;
				fila.insertCell(3).innerHTML = elemento.precio;
				fila.insertCell(4).innerHTML = elemento.fecha.substr(8,2)+"-"+elemento.fecha.substr(5,2)+"-"+elemento.fecha.substr(0,4);
				fila.insertCell(5).innerHTML = "<img width='45px' height='45px' style='margin-top:2px' src='data:image/jpeg;base64,"+elemento.imagen+"'>";
				filatabla++;
			});
	})
	.catch(function(err)
	{
		alert(err);
		// oculto estrella
		document.getElementById('estrella').style.visibility='hidden';
	});					
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
		<label  class="L2"><b>PAGINACIÓN</b></label>		
		<label  class="L3">ASÍNCRONA (Fetch)</label>	
		<label  class="L4">Thin-Server/Fat-Client</label>	
</div>
</header>
<!-- **************************** CUERPO ************************************************ -->
<!-- **************************** CUERPO ************************************************ -->
<!-- **************************** CUERPO ************************************************ -->
<div class="contenedor1">
<div id="cajapagina" class="contenedor2">
		<div class="contenedor3">
				<button class="boton" id="boton1" type="button"  style="margin:10px;"
				onclick="primera_consulta();">
				<i class="fas fa-question"></i> Iniciar Consulta
				</button>

				<label class="label">Ordenar:</label>
				<select id="criterio1" name= "criterio1" style="CURSOR:pointer;width:120px;height:31px;margin-right:10px">
							<option value="DNI">NIF</option>
							<option value="NOMBRE" selected="selected">NOMBRE</option>
							<option value="FECHA">FECHA</option>
							<option value="EDAD">EDAD</option>
				</select> 		

				<label class="label">Edad/Mayor que:</label>
				<input type="number" id="criterio2" name="criterio2" style="CURSOR:pointer;width:50px;height:26px;margin-right:10px;font-size: 16px;"
				maxlength="2" style="width: 20%" required	autocomplete="off" 	value="0" step="1" min="0">
							
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
				<input id="pa" class="marcador" value="00">
				<!-- botón Nº PÁGINAS -->
				<input id="np" class="marcador" value="00">
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