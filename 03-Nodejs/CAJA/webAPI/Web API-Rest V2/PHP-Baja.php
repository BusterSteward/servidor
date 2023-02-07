<?php
	// para más información de los "Metodos http":
	// https://diego.com.es/metodos-http
	
	sleep(2);
	
	header('Content-Type: application/json');

	// no nos interesa detectarlo aquí -> pero así se haría en PHP
	// if ($_SERVER['REQUEST_METHOD'] === 'DELETE')	{echo "delete";}
    
	// recupero el "id" de cliente a borrar
	$id_cliente=$_GET['el_id'];

	// en este script vamos a utilizar "cURL"
	
	// "cURL" es una librería que permite realizar peticiones HTTP con el objetivo de transferir información con sintaxis de URL.
	// En el contexto de PHP, permite crear un script que literalmente se comporte como un navegador para así ->
	// realizar una petición a otro servidor remoto.
	
	// más info: https://blog.educacionit.com/2017/08/16/guia-sobre-como-utilizar-curl-en-php/


	$url ='http://127.0.0.1:3000/'.$id_cliente;
	
	// configuro conexión
	// curl_init() -> inicia una nueva sesión cURL
	$conexion = curl_init();
	
	// curl_setopt() -> Define opciones para nuestra sesion cURL
	
	// CURLOPT_URL ->  Define la URL de la petición HTTP
	// solamente esta opción es obligatoria, el resto son totalmente opcionales
	curl_setopt($conexion, CURLOPT_URL, $url);
	
	// CURLOPT_CUSTOMREQUEST -> método de petición
	curl_setopt($conexion, CURLOPT_CUSTOMREQUEST, "DELETE");
	
	// CURLOPT_RETURNTRANSFER -> si esperamos una respuesta
	curl_setopt($conexion, CURLOPT_RETURNTRANSFER, true);

	// ejecuto conexión y recupero valor (que será "true" o "false")
	$resultado = curl_exec($conexion);
	
	// cierro conexión
	curl_close($conexion);

	// si todo va bien y se borra el registro -> la respuesta de la API será:
	// res.json({estado: 'true'})
	
	// si no se encuentra el registro -> la respuesta de la API será:
	// res.json({estado: 'false'});
	echo $resultado;

?>