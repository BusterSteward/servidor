<?php
	header('Content-Type: text/html; charset=utf-8');
	
	// haz la prueba de este script -> con alguna carpeta de usuario que no exista (por no tener ninguna actividad)
	require("conexion.php");

	$consulta="SELECT * FROM usuarios";

	$resultado=mysqli_query($conexion,$consulta);

	$nusers=mysqli_num_rows($resultado);

	echo "<font face='Calibri' color='black' size='3'>Usuarios en Total: ".$nusers."</font>"."<br><br>";

	if($nusers>0){

		$ficherosTotales=0;
		while($registro=mysqli_fetch_array($resultado)){
			$dir=$registro["CARPETA"];

			if(file_exists($dir."/"))
			{
				$glob = glob($dir."/{*}",GLOB_BRACE);
				$ficherosCarpeta=count($glob);
				echo "<font face='Calibri' color='black' size='3'>Nº Ficheros <b>".$dir.": </b>".$ficherosCarpeta."</font>"."<br>";
				$ficherosTotales+=$ficherosCarpeta;
			}
			else{
				echo "<font face='Calibri' color='black' size='3'>Nº Ficheros <b>".$dir.": </b>No Existe</font>"."<br>";
			}
		}
		echo "<br><font face='Calibri' color='black' size='3'>Total Ficheros <b>Todas las Carpetas: </b>".$ficherosTotales."</font>"."<br><br>";

		
	}

?>