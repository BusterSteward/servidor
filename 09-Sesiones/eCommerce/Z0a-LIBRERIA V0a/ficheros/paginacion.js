//*******************************************************
// 									cosas que habrá que calcular
//*******************************************************

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

// botón pulsado ANTERIOR y AHORA
var PulsadoANTES=1;
var PulsadoAHORA=1;

// criterio de filtro
var articulos;
var busqueda;

//*********************************************************************
//*************************** INICIO() **********************************
//*********************************************************************
function primera_consulta()
{
		// dejamos todo en situación inicial
		for (i=1;i<=5;i++)
		{
			document.getElementById(i).innerHTML=i;
			document.getElementById(i).classList.remove('disabled');
			document.getElementById(i).classList.remove('active');
		}			  		
		
		document.getElementById("primera").classList.add('disabled');
		document.getElementById("anterior").classList.add('disabled');
		document.getElementById("ultima").classList.add('disabled');
		document.getElementById("siguiente").classList.add('disabled');		
		
		// criterios de filtro
		articulos=document.getElementById('categoria').value;
		busqueda=document.getElementById('busqueda').value;
		//alert(articulos+'   '+busqueda);		
		
		// calculo el nº de registros que tiene la tabla
		// algo necesario para organizar todo el trabajo y calcular algunos valores NECESARIOS
		var url = "CalculoNregistros.php?criterio1="+articulos+"&&criterio2="+busqueda;
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
			//alert("número rgistros: "+datos);
			PA=1;
			
			// informo del nº de registros devueltos
			document.getElementById('mensaje_label').value=datos;	
			
			// calculo el valor de algunas variables
			
			// nº de registros
			NR=parseInt(datos);
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
			PulsadoANTES=1;
			RI=0;
			RF=TP;
			// cargo la 1ª página
			if (NP==0) { document.getElementById("np").value="00";document.getElementById("pa").value="00";todo_inactivo(); }
			else { document.getElementById('estrella').style.visibility='visible'; fetch_listado(RI,RF,articulos,busqueda); }
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
// función utilizada en "primera_consulta()"
function todo_inactivo()
{
		// dejamos todo en situación inicial
		// des-habilito todos los elementos de la barra de navegación
		for (i=1;i<=5;i++)
		{
			document.getElementById(i).innerHTML=i;
			document.getElementById(i).classList.add('disabled');
			document.getElementById(i).classList.remove('active');
		}			  		
		
		document.getElementById("primera").classList.add('disabled');
		document.getElementById("anterior").classList.add('disabled');
		document.getElementById("ultima").classList.add('disabled');
		document.getElementById("siguiente").classList.add('disabled');		
}
//*********************************************************************
//*********************************************************************


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
			  fetch_listado(RI,RF,articulos,busqueda);	
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
			fetch_listado(RI,RF,articulos,busqueda);			
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
            fetch_listado(RI,RF,articulos,busqueda);	
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
            fetch_listado(RI,RF,articulos,busqueda);	
	}
}
//***********************************************************************
function cualquiera(numero)
// esta función se ejecuta cuando se pulsa algún botón [1][2][3][4][5]
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
			fetch_listado(RI,RF,articulos,busqueda);	
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
function fetch_listado(REGI,REGF,losarticulos,labusqueda)
// esta función me devuelve los registros solicitados a la base de datos 
{
	// visualizo estrella
	document.getElementById('estrella').style.visibility='visible';	
	var url = "pintotabla.php?inicio="+REGI+"&fin="+REGF+"&criterio1="+losarticulos+"&criterio2="+labusqueda;
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
	
			// en "datos" tengo el array que devuelve "PHP-pintotabla.php" en formato JSON
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
			// var header = table.createTHead();
			//****************************************************
			// Creo una fila <tr> en la cabecera <thead>
			// para las celdas <th> lo hacemos de una forma distinta
			// nos hacen falta en la cabecera que las celdas sean <th> ya que en la hoja de estilo
			// tienen un tratamiento distinto
			/*
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
			*/
			
			//****************************************************
			// creo CUERPO <tbody>
			var body = table.createTBody();
			
			// me recorro el array y voy añadiendo las filas a la tabla
			//alert("tamaño tabla "+lista.length);
			filas_creadas=1;
			columna=0;
			var fila = body.insertRow(0);   
			lista.forEach(elemento =>
			{
				// con esta forma de trabajar estoy creando <td>
				fila.insertCell(columna).innerHTML=
				"<label style='margin-right:140px;border: 0px solid blue;color:brown;font-size:12px;'>"+elemento.id+"</label>"+"<br>"+
				"<img id='articulo' width='98px' height='140px' style='padding-right:10px;padding-top:5px' src='data:image/jpeg;base64,"+elemento.imagen+"'>"+
				"<img  id='carro' onclick='pulso_carro(this)' height='60px' width='60px' style='cursor:pointer;' src='imagenes/carro.png' >"+
				"<p id='parrafo1' style='line-height:1px; color:blue;font-size:12px;'>"+elemento.titulo1+"</p>"+
				"<p style='line-height:1px; color:black; font-size:14px;'>"+elemento.titulo2+"</p>"+
				"<p style='line-height:1px; color:red; font-size:16px;'><b>"+elemento.precio+" €"+"</b></p>";
				columna++;
				if (columna==4 && filas_creadas<2)
				{
					//alert('entro');
					fila = body.insertRow(1);
					filas_creadas++;
					columna=0;
				}	
			});
			// compruebo si no se han creado las 4 columnas
			if (columna<4 && columna>0)
			{
				for (i=columna; i<=3; i++)
				{fila.insertCell(columna).innerHTML="";}
			}
	})
	.catch(function(err)
	{
		alert(err);
		// oculto estrella
		document.getElementById('estrella').style.visibility='hidden';
	});					
}
