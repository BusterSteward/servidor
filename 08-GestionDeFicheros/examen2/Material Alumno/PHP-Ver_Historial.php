<?php
	header('Content-Type: text/html; charset=utf-8');
	
	//sleep(1);
	usleep(200000);

	require("conexion.php");

	echo "<b><font face='Calibri' color='black' size='4'>Acciones registradas en el historial </font></b><br>";
	echo "<font face='Calibri' color='red' size='4'>Leyendo <b>Historial</b> </font><br><br>";

	$consulta="SELECT * FROM historial";
	$resultado=mysqli_query($conexion,$consulta);
	$nregistros=mysqli_num_rows($resultado);
	if($nregistros>0){
		echo "<table>";
		while($fila=mysqli_fetch_array($resultado)){
			echo "<tr>
			<td width='30' align='center'  style='background-color:#FA58F4;color:#FFFFFF';font-family:Calibri;>ACCION: ".$fila["id"]."</td>";
			echo "
			<td width='160' align='right'  style='background-color:#ACFA58;color:#0404B4';font-family:Calibri;>".$fila["ACCION"]."</td>";
			echo "						  
			<td width='40' height='35' align='right' style='background-color:#ACFA58;color:#0404B4';>".$fila["FICHERO"]."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	else{
		echo "<font face='Calibri' color='black' size='4'>No hay acciones registradas en el historial</font><br><br>";
	}
?>