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



// defino la consulta para recuperar todos los registros				
$consulta = "SELECT * FROM ".$tabla ;
// ejecuto la consulta SQL
$resultado = mysqli_query($conexion,$consulta);
// calculo el nº de registros para informar al usuario del nº de ficheros que se van a crear
$nregistros=mysqli_num_rows($resultado);

if ($nregistros==0)
{
	echo "No hay registros en la tabla";
}
else
{
	$fila=mysqli_fetch_array($resultado);
	while ($fila)
	{
		file_put_contents($fila["ID"].".jpg",$fila['IMAGEN']); 
		$fila=mysqli_fetch_array($resultado);
	}
}	
	
echo "Se han creado ".$nregistros." ficheros físicos";

//MUY IMPORTANTE
//siempre hay que hacer esto
//cerramos la conexion  con la base de datos
mysqli_close($conexion); 						
?>
