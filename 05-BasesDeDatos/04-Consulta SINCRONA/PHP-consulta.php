<?php 
// SALIDA->ERROR->si el socio no existe
// SALIDA->: si el socio existe->los datos del socio en formato "HTML"

sleep(1);

//conexión con la base de datos
require('conexion.php');

// recogemos los datos de SOCIO a consultar del array $POST									
$v1=$_POST['nif'];

// compruebo si el socio existe en la tabla"socios"
$consulta="SELECT * FROM Tabla1 WHERE DNI='$v1';";
$resultado=mysqli_query($conexion,$consulta); 

// si se comprueban errores internos del SGBD hay que hacerlo aquí
// ** ** //

// obtengo el numero de registros devueltos por la consulta
// cuantos registros me devolverá esta consulta como máximo??->1
$nregistros=mysqli_num_rows($resultado);

if($nregistros==1)
{
			// existe el socio
			// recupero el registro de datos devuelto por la consulta
			
			// en "$resultado" tengo los datos devueltos por la consulta->pero son inaccesibles
			// para que sean accesibles->hay que formatearlos con "fetch"
			// ahora en "$registro" tendré los datos en formato tabla-array
			$registro = mysqli_fetch_array($resultado);
			
			echo
			"<input readonly disabled value=".$registro['NOMBRE']." 
			style='border:0px solid black;font-family:calibri;font-size:18px;color:maroon;background-color: white'><br>";

			echo
			"<input readonly disabled value=".$registro['EDAD']." 
			style='border:0px solid black;font-family:calibri;font-size:18px;color:maroon;background-color: white'><br>";			
		
			$fechaaux=date("d-m-Y", strtotime($registro['FECHA']));
			echo
			"<input readonly disabled value=".$fechaaux." 
			style='border:0px solid black;font-family:calibri;font-size:18px;color:maroon;background-color: white'><br>";

			echo
			"<input readonly disabled value=".$registro['PRECIO']." 
			style='border:0px solid black;font-family:calibri;font-size:18px;color:maroon;background-color: white'><br>";					

			echo
			"<input readonly disabled value='".$registro['OBSERVACIONES']. 
			"' style='border:0px solid black;font-family:calibri;font-size:18px;color:maroon;background-color: white'><br>";			
			
			echo
			"<img width='70px' height='70px' style='margin-top:5px' src='data:image/jpeg;base64,".base64_encode($registro['IMAGEN'])."'>";
			
			echo "<script>parent.termino_consulta(1);</script>";
}
else
{
			// no existe el socio
			// devuelvo mensaje ERROR
			echo "<script>parent.termino_consulta(0);</script>";
			echo "<b><font face='Calibri' color='red' size='3'>Error: NIF de socio no existe!!</font><b>";
}

//MUY IMPORTANTE
//siempre hay que hacer esto
//cerramos la conexion  con la base de datos
mysqli_close($conexion); 
 ?>