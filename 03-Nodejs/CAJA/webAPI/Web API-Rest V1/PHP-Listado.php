<?php
	usleep(300000);

	//cojo los "DATOS json" que me devuelve "nodejs" con esa url y los devuelvo
	header('Content-Type: application/json');

	$acceso = "http://127.0.0.1:3000/";
	$json = file_get_contents($acceso);

	// si todo va bien-> la respuesta de la API será:
	// res.json(datos);
	// todos los registros de la tabla empleados
	echo $json;
 ?>