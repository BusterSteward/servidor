<?php 
// SALIDA->1 : no hay "DNI" SIGUIENTE
// SALIDA->2 : no hay "DNI" ANTERIOR
// SALIDA->: si hay ANTERIOR o SIGUIENTE->los datos del usuario en formato "JSON" - tabla unidimensional

$salida=0;

//conexión con la base de datos
require('conexion.php');

// recogemos el "nif" del usuario actual
$v1=$_GET['nifusuario'];
// recogemos si es botón anterior o siguiente
$v2=$_GET['loquehago'];

if($v2==1)
{
	// SIGUIENTE (1)
	$consulta="SELECT * FROM tabla1 WHERE DNI>'".trim($v1)."' ORDER BY DNI LIMIT 1";
	$resultado=mysqli_query($conexion,$consulta); 
	$nregistros=mysqli_num_rows($resultado);
	if ($nregistros==0) {$salida=1;echo $salida;}
}
else
{
	// ANTERIOR (0)
	$consulta="SELECT * FROM tabla1 WHERE DNI<'".trim($v1)."' ORDER BY DNI DESC LIMIT 1";
	$resultado=mysqli_query($conexion,$consulta); 
	$nregistros=mysqli_num_rows($resultado);
	if ($nregistros==0) {$salida=2;echo $salida;}
}


if($nregistros==1)
{
			// EXISTE REGISTRO
			// recupero el registro de datos devuelto por la consulta
			$registro = mysqli_fetch_array($resultado);
			
			// en este array iremos almacenando los datos del "usuario buscado"->en este caso es único->1
			$json_data_cliente = array();
			
			$json_data_cliente["nif"] = $registro["DNI"];
			$json_data_cliente["nombre"] = $registro["NOMBRE"];
			$json_data_cliente["edad"] = $registro["EDAD"];
			
			$fechaaux=date("d-m-Y", strtotime($registro["FECHA"]));
			$json_data_cliente["fecha"] = $fechaaux;
			
			$json_data_cliente["precio"] = $registro["PRECIO"];
			$json_data_cliente["observaciones"] = $registro["OBSERVACIONES"];
			$json_data_cliente["imagen"] = base64_encode($registro["IMAGEN"]);

			// almacenamos la información de "$json_data_cliente" en otra tabla "$jsondataLista"
			$jsondataLista[]=$json_data_cliente;
			
			// en la tabla "$jsondatos" introducimos los datos  de la tabla "$jsondataLista"
			// array_values() devuelve todos los valores del array e indexa "numéricamente" el array
			// esto hace falta porque ahora después lo vamos a codificar en formato "json"
			$jsondatos["lista"] = array_values($jsondataLista);
		
			header("Content-type:application/json; charset = utf-8"); 
			// devuelvo "$jsondatos" en formato "json"
			echo json_encode($jsondatos);
}

//MUY IMPORTANTE
//siempre hay que hacer esto
//cerramos la conexion  con la base de datos
mysqli_close($conexion); 
 ?>