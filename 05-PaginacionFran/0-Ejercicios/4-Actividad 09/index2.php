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
		<!-- estilo de Paginacion JQUERY -->
		<link rel="stylesheet" href="ficheros/media/css/boostrap.min.css">
		<link rel="stylesheet" href="ficheros/media/css/jquery.dataTables.min.css">


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
	//***********************************************************************
	function fetch_listado(){
		// visualizo estrella
		document.getElementById('estrella').style.visibility='visible';	
		// hago la llamada al script
		fetch("pintotabla.php",{method: "GET"}) 
		.then(function(response){
			if (response.ok)return response.json();
			else throw new Error('Página!! : '+response.statusText);
		})
		.then(function(datos){
				// oculto estrella
				document.getElementById('estrella').style.visibility='hidden';
				// en "datos" tengo el array que devuelve "pintotabla.php" en formato JSON
				var lista = datos.lista;
				// puntero a la tabla html
				var table = document.getElementById("mitabla");
				// creo CABECERA <thead>
				var header = table.createTHead();
				// para las celdas <th> lo hacemos de una forma distinta
				var fila = header.insertRow(0);    
				/*************************THEAD*************************/
				var th = document.createElement('th');th.innerHTML = "<b>DNI</b>";fila.appendChild(th);
				var th = document.createElement('th');th.innerHTML = "<b>NOMBRE</b>";fila.appendChild(th);				
				var th = document.createElement('th');th.innerHTML = "<b>EDAD</b>";fila.appendChild(th);
				var th = document.createElement('th');th.innerHTML = "<b>PRECIO</b>";fila.appendChild(th);			
				var th = document.createElement('th');th.innerHTML = "<b>FECHA</b>";fila.appendChild(th);
				var th = document.createElement('th');th.innerHTML = "<b>IMAGEN</b>";fila.appendChild(th);								
				/*************************TBODY*************************/
				var body = table.createTBody();
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
		.catch(function(err){
			alert(err);
			// oculto estrella
			document.getElementById('estrella').style.visibility='hidden';
		});					
	}
</script>

<body onload="fetch_listado();">
<!-- **************************** CABECERA ************************************************ -->
<!-- **************************** CABECERA ************************************************ -->
<!-- **************************** CABECERA ************************************************ -->
<header>
<div class="BarraNavegar">
		<i class="fas fa-tv fa-2x" ></i>
		<label  class="L1">Servidor 2º DAW</label>		
		<label  class="L2"><b>PAGINACIÓN</b></label>		
		<label  class="L3">DataTable</label>	
		<label  class="L4">JQUERY</label>	
</div>
</header>
<!-- donde se visualiza la tabla -->
<div  class="contenedor4" id="pongotabla">
	<!-- la Tabla donde visualizo los datos -->
	<table class='display table' id="mitabla" style='border:0px solid red'></table>
</div>	
<!-- **************************** FOOTER ************************************************ -->
<!-- **************************** FOOTER ************************************************ -->
<!-- **************************** FOOTER ************************************************ -->
<footer class="footer">
		<img  id="estrella" src="imagenes/estrella.gif"  height="40" width="40" style="visibility:hidden;"/>
		<label>&nbsp Paginacion con DataTable</label>		
</footer>
</body>

<!--<script src="ficheros/paginacion/jQuery-3.6.0/jquery-3.6.0.js"></script>
<script src="js/boostrap.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script>
	//JQUERY PARA CUANDO SE HA CARGADO LA PAGINA
	//NECESSARIO CLASE "display" en la tabla mas el como lo identificamos(table)
	$('document').ready( function(){
		$(".table").DataTable({
			"pageLength": 5;
		});
	});
</script>-->
<script type="text/javascript" src="jquery.dataTables.js"></script>
<script type="text/javascript" src="dataTables.scrollingPagination.js"></script>
<script type="text/javascript" languaje="javascript" src="ficheros/media/js/jquery-3.6.0.js"></script>
<script  type="text/javascript" languaje="javascript" src="ficheros/media/js/jquery.dataTables.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.table').dataTable( {
            "pagingType": "input"
        } );
    } );
</script>
</html>