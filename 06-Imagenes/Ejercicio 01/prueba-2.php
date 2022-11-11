<?php
// Enviamos la cabecera Content-Type
header('Content-Type: image/jpeg');

// "imagecreatefromjpeg()"
// obtenemos la imagen desde el nombre de archivo pasado como parámetro
// Cargamos la imagen en formato JPEG
$imagen = imagecreatefromjpeg('1000.jpg');

// imagejpeg(): esta función produce la salida de una imagen al navegador o a un archivo.
// Enviamos la imagen al navegador


imagejpeg($imagen);
imagejpeg($imagen,'pepe2.jpg');

// si tenemos activo "ob_start()" la imagen será enviada al navegador
// pero también se almacenará en el buffering de salida
// la imagen quedará almacenada en memoria y la recuperamos con "ob_get_contents()"

//Destruimos la imagen
imagedestroy($imagen);
?>