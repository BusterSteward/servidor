<?php
	usleep(300000);

	//cojo los "DATOS json" que me devuelve "nodejs" con esa url y parámetro y lo devuelvo
	header('Content-Type: application/json');

	$el_id=$_POST['id_cliente'];
	$acceso = "http://127.0.0.1:3000/".$el_id;
	$json = file_get_contents($acceso);

	// si todo va bien y se encuentra el registro -> la respuesta de la API será:
	// res.json(datos) -> el registro que queremos consultar
	
	// si no se encuentra el registro -> la respuesta de la API será:
	// res.json({estado: 'false'});
	echo $json;
 ?>