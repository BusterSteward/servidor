<?php 

sleep(1);

//conexión con la base de datos
require('conexion.php');

// recogemos los datos del NIF a borrar del array $GET				
$v1=strtoupper($_GET['nifusuario']);

$consulta="DELETE FROM tabla1 WHERE DNI='$v1'";
mysqli_query($conexion,$consulta);

// calculo los registros que en realidad han sido borrados
$registros_borrados=mysqli_affected_rows($conexion);

// informamos al cliente de los registros que han sido borrados
// ¿¿puede ser 0?? -> reflexiona
echo $registros_borrados;

//MUY IMPORTANTE
//siempre hay que hacer esto
//cerramos la conexion  con la base de datos
 mysqli_close($conexion); 
 ?>