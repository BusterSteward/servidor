<?php 
// SALIDA->0 : el usuario no existe
// SALIDA->: si el usuario existe->los datos del usuario en formato "JSON" - tabla unidimensional

sleep(1);

//conexión con la base de datos
require('conexion.php');

// recogemos los datos de USUARIO a consultar del array $GET									
$v1=$_GET['nifusuario'];

// compruebo si el usuario existe en la tabla "Tabla1"
$consulta="SELECT * FROM tabla1 WHERE DNI='$v1'";
$resultado=mysqli_query($conexion,$consulta); 

// si se comprueban errores internos del SGBD hay que hacerlo aquí
// ** ** //

// obtengo el numero de registros devueltos por la consulta
// cuantos registros me devolverá esta consulta como máximo??->1
$nregistros=mysqli_num_rows($resultado);

if($nregistros==1)
{
			// existe el usuario
			// recupero el registro de datos devuelto por la consulta
			
			// en "$resultado" tengo los datos devueltos por la consulta->pero son inaccesibles
			// para que sean accesibles->hay que formatearlos con "fetch"
			// ahora en "$registro" tendré los datos en formato tabla-array
			$registro = mysqli_fetch_array($resultado);
			
			// en este array iremos almacenando los datos del "usuario buscado"-> en este caso es único->1
			$json_data_cliente = array();
			
			$json_data_cliente["nombre"] = $registro["NOMBRE"];
			$json_data_cliente["edad"] = $registro["EDAD"];
			
			$fechaaux=date("d-m-Y", strtotime($registro["FECHA"]));
			$json_data_cliente["fecha"] = $fechaaux;
			
			$json_data_cliente["precio"] = $registro["PRECIO"];
			$json_data_cliente["observaciones"] = $registro["OBSERVACIONES"];
			$json_data_cliente["imagen"] = base64_encode($registro["IMAGEN"]);

			// almacenamos la información de "$json_data_cliente" en otra tabla "$jsondataLista"
			// en este script nos podríamos ahorrar "$jsondataLista[]" ya que sólo tendremos un usuario
			$jsondataLista[]=$json_data_cliente;
			
			// en la tabla "$jsondatos" introducimos los datos  de la tabla "$jsondataLista"
			// array_values() devuelve todos los valores del array e indexa "numéricamente" el array
			// esto hace falta porque ahora después lo vamos a codificar en formato "json"
			$jsondatos["lista"] = array_values($jsondataLista);
		
			header("Content-type:application/json; charset = utf-8"); 
			// devuelvo "$jsondatos" en formato "json"
			echo json_encode($jsondatos);
}
else
{
			// no existe el usuario
			// devolveré un 0
			echo 0;
}

//MUY IMPORTANTE
//siempre hay que hacer esto
//cerramos la conexion  con la base de datos
mysqli_close($conexion); 
 ?>