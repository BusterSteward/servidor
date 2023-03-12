<?php

$v1="hola"
//header("Content-type:application/json; charset = utf-8"); 
echo $v1;
/*
$v1=$_POST["id"];
$v2=$_POST["nombre"];
$v3=$_POST["provincia"];
$v4=$_POST["edad"];
$v5=$_POST["fecha"];


$variables = array(
    'nombre' => $v2,
    'provincia' => $v3,
    'edad'   => $v4,
    'fecha' => $v5,
    );
if(isset($_FILES["imagenNueva"]["tmp_name"])){
    $foto_reconvertida = file_get_contents($_FILES['foto1']['tmp_name']);
    $v6=base64_encode($foto_reconvertida);
    $variables['imagen']=$v6;
}
/*
// codificamos a formato "json" los valores
$datos = json_encode($variables);
	
$url ='http://127.0.0.1:3000/'.$v1;

// configuro conexión
$conexion = curl_init();
curl_setopt($conexion, CURLOPT_URL, $url);

//especificamos el método POST
curl_setopt ($conexion, CURLOPT_PUT, 1);

// le decimos qué paramáetros enviamos (pares nombre/valor, también acepta un array)
curl_setopt ($conexion, CURLOPT_POSTFIELDS,$datos);

//le decimos que queremos recoger una respuesta 
curl_setopt($conexion,CURLOPT_RETURNTRANSFER,true);

curl_setopt($conexion, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: '. strlen($datos)));


//ejecutamos conexión y recogemos la respuesta
curl_exec ($conexion);

//o el error, por si falla
//$error = curl_error($ch);

//y finalmente cerramos curl
curl_close ($conexion);
echo "hola";
/*
// si todo va bien y se realiza el alta -> la respuesta de la API será:
// res.json({estado: 'true'});
echo $respuesta;*/




?>