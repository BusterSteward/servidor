<?php

	sleep(2);
	
	header("Content-type:application/json; charset = utf-8"); 

	// "cURL" es una librería que permite realizar peticiones HTTP con el objetivo de transferir información con sintaxis de URL.
	// En el contexto de PHP, permite crear un script que literalmente se comporte como un navegador para así ->
	// realizar una petición a otro servidor remoto.
	// más info: https://blog.educacionit.com/2017/08/16/guia-sobre-como-utilizar-curl-en-php/

	//*************************************************************************************
	//												TRATAMOS LA IMAGEN SELECCIONADA
	//*************************************************************************************

	// una forma más rápida de hacer todo lo que hay abajo comentado
	$foto_reconvertida = file_get_contents($_FILES['foto1']['tmp_name']);

	/*	
	// propiedades del fichero de imagen que hemos seleccionado en el formulario
	$foto_name= $_FILES['foto1']['name'];
	$foto_size= $_FILES['foto1']['size'];
	$foto_type=  $_FILES['foto1']['type'];
	// el fichero de imagen cuando se almacena en el servidor
	// no se almacena con su nombre, el servidor le asigna un nombre temporal
	$foto_temporal= $_FILES['foto1']['tmp_name'];
	// tenemos que reconvertir la imagen para poder darla de alta en la tabla
	// abrimos y "leemos" el fichero temporal en modo lectura "r" binaria"b"
	$f1= fopen($foto_temporal,"rb");
	// leemos el fichero completo limitando la lectura al tamaño de fichero		
	$foto_reconvertida = fread($f1, $foto_size);
	fclose($f1);
	*/	

	// configuramos los valores que vamos a pasar a la API
	$v1=strtoupper($_POST['nombre']);
	$v2=strtoupper($_POST['provincia']);
	$v3=strtoupper($_POST['edad']);
	$v4=$_POST['fecha'];
	$v5_aux=$foto_reconvertida;
	// esto es obligatorio -> no se pueden enviar los datos en binario
	$v5=base64_encode($foto_reconvertida);
	
	// creamos una matriz con los valores
	$variables = array(
	'nombre' => $v1,
	'provincia' => $v2,
	'edad'   => $v3,
    'fecha' => $v4,
	'imagen' => $v5
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