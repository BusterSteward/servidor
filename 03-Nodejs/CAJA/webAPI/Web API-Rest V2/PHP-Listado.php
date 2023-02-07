<?php
	usleep(300000);

	//cojo los "DATOS json" que me devuelve "nodejs" con esa url y los devuelvo
	header('Content-Type: application/json');

	$criterio=$_POST['el_criterio'];
	$acceso = "http://127.0.0.1:3000/listado/".$criterio;
	$json = file_get_contents($acceso);

	// devuelvo los datos recuperados en formato "json"
	echo $json;
 ?>