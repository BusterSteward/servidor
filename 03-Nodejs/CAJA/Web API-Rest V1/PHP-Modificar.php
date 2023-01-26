<?php

	usleep(300000);
	
	header("Content-type:application/json; charset = utf-8"); 

	// "cURL" es una librería que permite realizar peticiones HTTP con el objetivo de transferir información con sintaxis de URL.
	// En el contexto de PHP, permite crear un script que literalmente se comporte como un navegador para así ->
	// realizar una petición a otro servidor remoto.
	// más info: https://blog.educacionit.com/2017/08/16/guia-sobre-como-utilizar-curl-en-php/


	// configuramos los valores que vamos a pasar a la API
	$v1=strtoupper($_POST['nombre']);
	$v2=$_POST['salario'];
	
	// recuperamos la "id" del registro a modificar
	$laid=$_GET['laidregistro'];
	
	// creamos una matriz con los valores
	$variables = array
	(
		'nombre' => $v1,
		'salario' => $v2
	);	
	
	// codificamos a formato "json" los valores
	$datos = json_encode($variables);
	
	$url ='http://127.0.0.1:3000/'.$laid;

	// configuro conexión
	$conexion = curl_init();
	curl_setopt($conexion, CURLOPT_URL, $url);

	// CURLOPT_CUSTOMREQUEST -> método de petición
	curl_setopt($conexion, CURLOPT_CUSTOMREQUEST, "PUT");
 
	// le decimos qué paramáetros enviamos (pares nombre/valor, también acepta un array)
	curl_setopt ($conexion, CURLOPT_POSTFIELDS,$datos);
 
	//le decimos que queremos recoger una respuesta 
	curl_setopt($conexion,CURLOPT_RETURNTRANSFER,true);
 
	curl_setopt($conexion, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: '. strlen($datos)));
  
 
	//ejecutamos conexión y recogemos la respuesta
	$respuesta = curl_exec ($conexion);
 
	//o el error, por si falla
	//$error = curl_error($ch);
 
	//y finalmente cerramos curl
	curl_close ($conexion);
	
	// si todo va bien-> la respuesta de la API será:
	// res.json({estado: 'true'});
	echo $respuesta;
?>