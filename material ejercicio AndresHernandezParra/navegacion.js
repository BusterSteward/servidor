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
	
	// **************************************************	
	// botones -3 y +3
	// **************************************************	
	document.getElementById("menostres").classList.add('disabled');	
	document.getElementById("mastres").classList.add('disabled');
}

function primera_consulta()
{
		// visualizo estrella
		document.getElementById('estrella').style.visibility='visible';	
	
		// in-habilito botón consulta 
		document.getElementById('boton1').disabled=true;	

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

			// habilito todos los elementos "siguiente" y "última" de la barra de navegación	(si tengo más de una página)	
			// botón "primera" y "anterior" siguen deshabilitados
			if (NP!=1)
			{
				document.getElementById("ultima").classList.remove('disabled');
				document.getElementById("siguiente").classList.remove('disabled');		
				
				// si tengo más de 3 páginas (al menos 4) habilito "botón +3"
				if (NP>=4)
				{document.getElementById("mastres").classList.remove('disabled');}
			}	
			
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
	// si estoy en la 1ª página no hago nada
	if (PA>1)
	{
			  // actualizo algunas variables
			  RI=0;
			  RF=TP;
			  PA=1;
			  
			  repinto_botones();
			  // cargo la 1ª página
			  fetch_listado(RI,RF);	
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
	  
			repinto_botones();
		    // cargo la última página
			fetch_listado(RI,RF);			
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
	if (PA<NP)
	{
  		    // actualizo variables
			RI=TP*(PA);
			RF=TP;
			PA++;
			
			repinto_botones();
			// cargo la siguiente página
            fetch_listado(RI,RF);		
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
	if (PA>1)
	{
			// actualizo variables
			RI=(RI-TP);
			RF=TP;
			PA--;			

			repinto_botones();
			// cargo la página anterior
            fetch_listado(RI,RF);		
	}
}