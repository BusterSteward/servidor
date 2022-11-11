<?php 
// SALIDA->0 : el socio NO se ha borrado -> ��puede darse este caso?? -> reflexiona
// SALIDA->1: el socio lo hemos borrado con �xito

sleep(1);

//conexi�n con la base de datos
require('conexion.php');


// recogemos los datos del NIF a borrar del array $GET			
$v1=strtoupper($_GET['nifactual']);

$consulta="DELETE FROM tabla1 WHERE DNI='$v1'";
mysqli_query($conexion,$consulta);

// calculo los registros que en realidad han sido borrados
$registros_borrados=mysqli_affected_rows($conexion);
	
// informamos al cliente de los registros que han sido borrados
// ��puede ser 0?? -> reflexiona
echo "<script>parent.termino_baja(".$registros_borrados.");</script>";


//MUY IMPORTANTE
//siempre hay que hacer esto
//cerramos la conexion  con la base de datos
 mysqli_close($conexion); 
 ?>