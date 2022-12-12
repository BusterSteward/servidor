<?php
	// conexión con la base de datos
	require('conexion.php');
	
	// en este array almacenaremos los datos de todos los registros
	$jsondataLista = array();
	
	// este será el array que devolvemos
	$jsondatos= array();

	$apartirde=$_GET["inicio"];
	$cantidad=$_GET["fin"];
	$autor=$_GET["autor"];
	//Ejecuto una sentencia sacando los datos dependiendo si se ha introducidoun autor
	if($autor=="por-defecto"){
		$query = "SELECT * FROM ARTICULOS ORDER BY ID ASC LIMIT $apartirde,$cantidad";
		$resultado = mysqli_query($conexion, $query);
	}else{
		$query = "SELECT * FROM ARTICULOS WHERE TITULO2='$autor' ORDER BY ID ASC LIMIT $apartirde,$cantidad";
		$resultado = mysqli_query($conexion, $query);
	}
	while($fila = $resultado ->fetch_assoc())
	{
		// en este array iremos almacenando los datos de los registros 1 por 1
		$json_data_cliente = array();
		
		$json_data_cliente["id"] = $fila["ID"];
		$json_data_cliente["titulo1"] = $fila["TITULO1"];
		$json_data_cliente["titulo2"] = $fila["TITULO2"];
		$json_data_cliente["precio"] = $fila["PRECIO"];
		$json_data_cliente["imagen"] = base64_encode($fila["IMAGEN"]);

		$jsondataLista[]=$json_data_cliente;
	}
	//$jsondatos["lista"] = array_values($jsondataLista);
	// en este caso no hace falta aplicar el "array_values" porque el array ya está
	// indexado numerícamente
	$jsondatos["lista"] = $jsondataLista;
	
header("Content-type:application/json; charset = utf-8"); 
echo json_encode($jsondatos);

//MUY IMPORTANTE
//siempre hay que hacer esto
//cerramos la conexion  con la base de datos
mysqli_close($conexion); 
exit();
 ?>