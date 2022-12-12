function inicio()
{
	//alert("La resolución de tu pantalla es: " + screen.width + " x " + screen.height);
	// monitor grande
	if (screen.height>=1080)
	{
		//alert("1");
		document.getElementById('imagenessubidas').style.setProperty('max-height', (screen.height-385)+'px');
	}
	// monitor 15.6"
	else if (screen.height>=768)
	{
		//alert("2");
		document.getElementById('imagenessubidas').style.setProperty('max-height', (screen.height-385)+'px');	
	}	
	// monitor 14"
	else if (screen.height>=720)
	{
		//alert("3");
		document.getElementById('imagenessubidas').style.setProperty('max-height', (screen.height-420)+'px');
	}
}
//************************************************************************************************
//************************************************************************************************
//*********************************** SUBIDA SÍNCRONA ********************************************
//************************************************************************************************
//************************************************************************************************
function subo_fichero1()
{
	// visualizo estrella
	document.getElementById('estrella').style.visibility='visible';	
			
	// borramos contenido del iFrame donde aparece el mensaje1
	mensaje1.document.open();
	mensaje1.document.close();
	// borro si hay algo en el div donde se ven las imágenes subidas
	document.getElementById('imagenessubidas').innerHTML="";		
	// borramos contenido del div donde aparece el mensaje2
	document.getElementById('mensaje2').innerHTML="";	
	
	document.formulario1.target="mensaje1";
	document.formulario1.action="PHP-Subo_Ficheros-S.php";
	document.formulario1.submit(); 
}

function terminar()
{
	// oculto estrella
	document.getElementById('estrella').style.visibility='hidden';

	// situación inicial
	document.getElementById('formulario1').action="";
	document.getElementById('objetofile1').value="";
}
//************************************************************************************************
//************************************************************************************************
//******************************** SUBIDA ASÍNCRONA-jQuery ***************************************
//************************************************************************************************
//************************************************************************************************
function subo_fichero2()
{
	// visualizo estrella
	document.getElementById('estrella').style.visibility='visible';	
			
	// borramos contenido del iFrame donde aparece el mensaje1
	mensaje1.document.open();
	mensaje1.document.close();
	// borro si hay algo en el div donde se ven las imágenes subidas
	document.getElementById('imagenessubidas').innerHTML="";		
	// borramos contenido del div donde aparece el mensaje2
	document.getElementById('mensaje2').innerHTML="";	

	// preparo variables
	var formData = new FormData(document.getElementById("formulario2"));		
	var ruta="PHP-Subo_Ficheros-A.php";
	
	// hago la llamada
	$.ajax({
		url: ruta,
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,		
		success: function(datos)
		{
			// oculto estrella
			document.getElementById('estrella').style.visibility='hidden';
			// situación inicial
			document.getElementById('objetofile2').value="";
			
			// visualizo el mensaje que me envía el servidor
			document.getElementById('mensaje2').innerHTML=datos;		
		}
		});	
}
//************************************************************************************************
//************************************************************************************************
//********************************* VER Ficheros Subidos ********************************************
//************************************************************************************************
//************************************************************************************************
function ver_imagenes()
{
	// visualizo estrella
	document.getElementById('estrella2').style.visibility='visible';	
	// borro si hay algo en el div donde se ven las imágenes subidas
	document.getElementById('imagenessubidas').innerHTML="";	
	
	// hago la llamada
	$("#imagenessubidas").load("PHP-Ver_Ficheros.php",{},llegadaDatos1);	
}

function llegadaDatos1()
{
	// oculto estrella
	document.getElementById('estrella2').style.visibility='hidden';	
}