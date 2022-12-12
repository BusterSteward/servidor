function inicio()
{
	//alert("La resolución de tu pantalla es: " + screen.width + " x " + screen.height);
	// monitor grande
	if (screen.height>=1080)
	{
		//alert("1");
		document.getElementById('mensaje1').style.setProperty('max-height', (screen.height-350)+'px');
		document.getElementById('imagenessubidas').style.setProperty('max-height', (screen.height-385)+'px');
	}
	// monitor 15.6"
	else if (screen.height>=768)
	{
		//alert("2");
		document.getElementById('mensaje1').style.setProperty('max-height', (screen.height-405)+'px');
		document.getElementById('imagenessubidas').style.setProperty('max-height', (screen.height-385)+'px');	
	}	
	// monitor 14"
	else if (screen.height>=720)
	{
		//alert("3");
		document.getElementById('mensaje1').style.setProperty('max-height', (screen.height-440)+'px');
		document.getElementById('imagenessubidas').style.setProperty('max-height', (screen.height-420)+'px');
	}

	// visualizo imágenes subidas al servidor
	ver_imagenes();
}
//************************************************************************************************
//************************************************************************************************
//******************************** SUBIDA ASÍNCRONA-jQuery ***************************************
//************************************************************************************************
//************************************************************************************************
function subo_fichero1()
{
	// visualizo estrella
	document.getElementById('estrella').style.visibility='visible';	
			
	// borro si hay algo en el div donde se ven las imágenes subidas
	document.getElementById('imagenessubidas').innerHTML="";		
	// borramos contenido del div donde aparecen los mensajes
	document.getElementById('mensaje1').innerHTML="";	

	// preparo variables
	var formData = new FormData(document.getElementById("formulario1"));		
	var ruta="PHP-Subo_Ficheros.php";
	
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
			document.getElementById('objetofile1').value="";
			
			// visualizo el mensaje que me envía el servidor
			document.getElementById('mensaje1').innerHTML=datos;			
			
			// actualizo la lista de imágenes subidas
			ver_imagenes();
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