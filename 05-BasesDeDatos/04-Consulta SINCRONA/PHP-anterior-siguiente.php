<?php 
// SALIDA->1 : no hay "nif" SIGUIENTE
// SALIDA->2 : no hay "nif" ANTERIOR
// SALIDA->: si hay ANTERIOR o SIGUIENTE->los datos del socio en formato "JSON" - tabla unidimensional

$salida=0;

//conexión con la base de datos
require('conexion.php');

// recogemos los datos del nombre Socio actual
// esta valor del NIF lo podría obtener de $_POST o $_GET
$v1=$_GET['nifactual'];
// recogemos si es botón anterior o siguiente
$v2=$_GET['quehacer'];

if($v2==1)
{
	// SIGUIENTE (1)
	$consulta="SELECT * FROM tabla1 WHERE DNI>'".trim($v1)."' ORDER BY DNI LIMIT 1";
	$resultado=mysqli_query($conexion,$consulta); 
	$nregistros=mysqli_num_rows($resultado);
}
else
{
	// ANTERIOR (0)
	$consulta="SELECT * FROM tabla1 WHERE DNI<'".trim($v1)."' ORDER BY DNI DESC LIMIT 1";
	$resultado=mysqli_query($conexion,$consulta); 
	$nregistros=mysqli_num_rows($resultado);
}

if($nregistros==1)
{
			// EXISTE REGISTRO
			// recupero el registro de datos devuelto por la consulta
			$registro = mysqli_fetch_array($resultado);
			
			echo
			"<input readonly disabled value=".$registro['NOMBRE']." 
			style='border:0px;font-family:calibri;font-size:18px;color:maroon;background-color: white'><br>";

			echo
			"<input readonly disabled value=".$registro['EDAD']." 
			style='border:0px;font-family:calibri;font-size:18px;color:maroon;background-color: white'><br>";			
		
			$fechaaux=date("d-m-Y", strtotime($registro['FECHA']));
			echo
			"<input readonly disabled value=".$fechaaux." 
			style='border:0px;font-family:calibri;font-size:18px;color:maroon;background-color: white'><br>";

			echo
			"<input readonly disabled value=".$registro['PRECIO']." 
			style='border:0px;font-family:calibri;font-size:18px;color:maroon;background-color: white'><br>";					

			echo
			"<input readonly disabled value='".$registro['OBSERVACIONES']. 
			"' style='border:0px;font-family:calibri;font-size:18px;color:maroon;background-color: white'><br>";			
			
			echo
			"<img width='70px' height='70px' style='margin-top:5px' src='data:image/jpeg;base64,".base64_encode($registro['IMAGEN'])."'>";
			
			echo "<script>parent.termino_consulta_anterior_siguiente(".$registro['DNI'].");</script>";
}
else
{
			// Hemos llegado al primer o último registro
			// pasamos al script javascript "termino_consulta_anterior_siguiente" el botón que se haya pulsado
			echo "<script>parent.termino_consulta_anterior_siguiente(".$v2.");</script>";
}

//MUY IMPORTANTE
//siempre hay que hacer esto
//cerramos la conexion  con la base de datos
mysqli_close($conexion); 
 ?>