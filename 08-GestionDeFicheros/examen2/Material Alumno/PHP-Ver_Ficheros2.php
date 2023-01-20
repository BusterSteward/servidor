<?php
	header('Content-Type: text/html; charset=utf-8');
	
	//sleep(1);
	usleep(200000);

	require("conexion.php");

	echo "<b><font face='Calibri' color='black' size='4'>Imágenes Subidas a la base de datos: </font></b><br>";
	echo "<font face='Calibri' color='red' size='4'>Leyendo <b>BBDD</b> </font><br><br>";
	$consulta="SELECT * FROM ficheros";
	$resultado=mysqli_query($conexion,$consulta);
	$nregistros=mysqli_num_rows($resultado);
	if($nregistros>0){
		echo "<table>";
		while($fila=mysqli_fetch_array($resultado)){
			echo "<tr>
			<td width='50' align='center'  style='background-color:#FA58F4;color:#FFFFFF';font-family:Calibri;>BD: ".$fila["id"]."</td>";
			echo "
			<td width='160' align='right'  style='background-color:#ACFA58;color:#0404B4';font-family:Calibri;>".$fila["FICHERO"]."</td>";
			echo "						  
			<td width='40' height='35' align='center' style='background-color:#F7BE81';><img onclick='borro_registro(this)' style='cursor:pointer;width:30px;height:30px;vertical-align:middle' src='imagenes/papelera.png'>"."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	else{
		echo "<font face='Calibri' color='black' size='4'>No hay ficheros subidos a la BBDD</font><br><br>";
	}
?>