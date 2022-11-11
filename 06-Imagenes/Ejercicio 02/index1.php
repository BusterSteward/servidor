<?php

require('conexion.php');


//**** RECOMENDACIONES  ****
// te recomiendo que utilices este trozo de código en tus consultas PHP-SQL para que te quede claro si has cometido algún error 
// una vez que funcione tu aplicación puedes quitarlo o dejarlo comentado 
/*
if (mysqli_errno($conexion)==0)
{
	     echo "No hay error";
}
else 
{
	     $numerror=mysqli_errno($conexion); 
	     $descrerror=mysqli_error($conexion); 
	     echo "<br>";
	     echo "Se ha producido un error nº $numerror que corresponde a: $descrerror  <br>"; 
}
*/
//**** RECOMENDACIONES  ****

$numero=1000;

// tenemos que dar de alta 11 imágenes -> de 1000.jpg a 1010.jpg
while ($numero<=1010)
{
	//selecciono la imagen 
	$imagenaux=strval($numero).".jpg";

	// devuelve un identificador de imagen que representa la imagen obtenida desde el nombre de archivo dado
	$image = imagecreatefromjpeg($imagenaux); 

	ob_start(); 
	//imagejpeg(): esta función produce la salida de una imagen al navegador o a un archivo.
	//en este caso la imagen se almacenará en el buffer de salida.
	imagejpeg($image);
	//ob_get_contents(): obtiene el contenido del búfer de salida, sin borrarlo.
	$jpg = ob_get_contents();
	//ob_end_clean(): esta función desecha el contenido del búfer de salida en cola y lo deshabilita.
	ob_end_clean();

	//escapamos la imagen
	$jpg = addslashes($jpg);

	//doy de alta la imagen	
	$consulta = "INSERT $tabla (ID,IMAGEN) VALUES ('$numero','$jpg')";
	$resultado = mysqli_query($conexion,$consulta);
	
	$numero++;
}	

echo "Las imágenes han sido cargadas en la tabla";

//MUY IMPORTANTE
//siempre hay que hacer esto
//cerramos la conexion  con la base de datos
mysqli_close($conexion); 						
?>
