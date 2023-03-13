<?php

header("Content-type:application/json; charset = utf-8"); 
/*
if(isset($_FILES["imagenNueva"]["tmp_name"])){
    echo "hola";
}
else{
    echo "adios";
}*/
$v1 = $_POST["id"];
$v2 = strtoupper($_POST["nombre"]);
$v3 = strtoupper($_POST["provincia"]);
$v4 = strtoupper($_POST["edad"]);
$v5 = $_POST["fecha"];

/*
$variables=[];
$variables['nombre']=$v1;
$variables['provincia']=$v2;
$variables['edad']=$v3;
$variables['fecha']=$v4;
*/
$variables;
if(isset($_FILES['imagenNueva'])){
    //echo json_encode(var_dump($_FILES));
    $foto_reconvertida = file_get_contents($_FILES['imagenNueva']['tmp_name']);
    $v6=base64_encode($foto_reconvertida);
    //echo $v6;
    $variables=array(
        'nombre'=>$v2,
        'provincia'=>$v3,
        'edad'=>$v4,
        'fecha'=>$v5,
        'imagenNueva'=>$v6
    );
    //echo 1;
    
}
else{
    $variables=array(
        'nombre'=>$v2,
        'provincia'=>$v3,
        'edad'=>$v4,
        'fecha'=>$v5,
    );
    
    //echo 2;
}

$datos=json_encode($variables);
//echo $datos;

$url ='http://127.0.0.1:3000/'.$v1;


// configuro conexión
$conexion = curl_init();

curl_setopt($conexion, CURLOPT_URL, $url);

//especificamos el método POST
curl_setopt ($conexion, CURLOPT_CUSTOMREQUEST, "PUT");

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

/*$string=$variables["nombre"]." ".$variables["provincia"]." ".$variables["edad"]." ".$variables["fecha"];*/




?>