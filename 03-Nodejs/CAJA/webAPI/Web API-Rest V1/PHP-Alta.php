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
	
	// creamos una matriz con los valores
	// en id ponemos un 0 porque vamos a realizar una ALTA
	$variables = array
	(
		'id'=>'0',
		'nombre' => $v1,
		'salario' => $v2
	);	
	
	// codificamos a formato "json" los valores
	$datos = json_encode($variables);
	
	$url ='http://127.0.0.1:3000/';

	// configuro conexión
	$conexion = curl_init();
	curl_setopt($conexion, CURLOPT_URL, $url);

	//especificamos el método POST
	curl_setopt ($conexion, CURLOPT_POST, 1);
 
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
	
	// si todo va bien y se realiza el alta -> la respuesta de la API será:
	// res.json({estado: 'true'});
	echo $respuesta;
?>