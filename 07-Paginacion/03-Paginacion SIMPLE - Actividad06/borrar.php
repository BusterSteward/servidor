<?php

require("conexion.php");
$dni=$_POST["dni"];

$consulta="DELETE FROM $tabla WHERE DNI=$dni";

mysqli_query($conexion,$consulta);

$registros_borrados=mysqli_affected_rows($conexion);

echo $registros_borrados;

mysqli_close($conexion);
?>