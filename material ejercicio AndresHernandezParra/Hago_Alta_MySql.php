<?php
sleep(1);

//conexión con la base de datos
require('conexion.php');

// recogemos los datos en array $POST
$v1=$_POST['eldni'];
$v2=$_POST['elnombre'];
$v3=(int) $_POST['laedad'];

//$v1="11111";
//$v2="pepe";
//$v3=24;


//  OJO -> los campos numéricos no llevan comillas -> OJO
$consulta="INSERT usuarios2 (DNI,NOMBRE,EDAD) VALUES ('$v1','$v2',$v3)";

mysqli_query($conexion,$consulta);

//MUY IMPORTANTE
//siempre hay que hacer esto
//cerramos la conexion  con la base de datos
mysqli_close($conexion); 
?>
