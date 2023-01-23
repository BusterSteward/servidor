<?php
	//sleep(1);
	usleep(100000);
	// conexión con la base de datos
	require('conexion.php');
	
	// filtros

	// ID artículos
	$patron2=trim($_GET['criterio1']).'%';
	// caja de texto búsqueda
	$patron1='%'.trim(strtoupper($_GET['criterio2'])).'%';

	$apartirde=$_GET["inicio"];
	$cantidad=$_GET["fin"];

	// en este array almacenaremos los datos de todos los artículos
	$jsondataLista = array();
	// este será el array que devolvemos
	$jsondatos= array();

	
	$query = "SELECT * FROM articulos WHERE ID LIKE '".$patron2."' AND TITULO2 LIKE '".$patron1."' ORDER BY ID ASC LIMIT $apartirde,$cantidad";
	
	$resultado = mysqli_query($conexion, $query);
	
	while($fila = $resultado ->fetch_assoc())
	{
		// en este array iremos almacenando los datos de los alumnos 1 por 1
		$json_data_articulo = array();
		
		$json_data_articulo["id"] = $fila["ID"];
		$json_data_articulo["titulo1"] = $fila["TITULO1"];
		$json_data_articulo["titulo2"] = $fila["TITULO2"];
		$json_data_articulo["precio"] = $fila["PRECIO"];
		$json_data_articulo["empresa"] = $fila["EMPRESA"];
		$json_data_articulo["imagen"] = base64_encode($fila["IMAGEN"]);

		$jsondataLista[]=$json_data_articulo;
	}
	$jsondatos["lista"] = array_values($jsondataLista);
	
header("Content-type:application/json; charset = utf-8"); 
echo json_encode($jsondatos);

//MUY IMPORTANTE
//siempre hay que hacer esto
//cerramos la conexion  con la base de datos
mysqli_close($conexion); 
exit();
 ?>