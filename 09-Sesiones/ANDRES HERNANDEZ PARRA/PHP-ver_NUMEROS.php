<?php	
	
	// OJO: tamaño de problema N
	// diseña un buen algoritmo
	
	session_start();
	
	//sleep(1);
	usleep(400000);
	
	// debes de calcular el VALOR de estas 2 variables para realizar el algoritmo
	// no VALE -> poner a mano $filas->5 $columnas->4
	// considera que el tamaño de la tabla es NxM
	// calcula $filas y $columnas para calcular el nº de casillas
	
	//calculo el numero de filas y columnas
	$filas=count($_SESSION["TABLA"]);
	$columnas=count($_SESSION["TABLA"]["FILA1"]);
	$casillas=$filas*$columnas;
	
	echo "Casillas Rellenadas: ".$casillas;
	
	$fila=1;
	$columna=0;
	
	//**************************************************
	// CREACIÓN TABLA
	//**************************************************
	echo "<table id='mitabla' width=320px style='padding-top:10px'>";

	//**************************************************
	// CABECERA TABLA
	//**************************************************	
	echo "<tr>
	<td width='80'  align='center'  style='background-color:#FA58F4;color:#FFFFFF';font-family:Calibri;></td>";
	echo "
	<td width='50' height='35' align='center' style='background-color:#FA58F4;color:#FFFFFF';>0</td>";
	echo "
	<td width='50' height='35' align='center' style='background-color:#FA58F4;color:#FFFFFF';>1</td>";
	echo "
	<td width='50' height='35' align='center' style='background-color:#FA58F4;color:#FFFFFF';>2</td>";
	echo "
	<td width='50' height='35' align='center' style='background-color:#FA58F4;color:#FFFFFF';>3</td>";	
	echo "</tr>";	
	
	//**************************************************
	// CUERPO TABLA
	//**************************************************
	//recorro la tabla en $_SESSION pintando las filas en el contenedor #jugadas			
	for($fila;$fila<=$filas;$fila++){
		echo "<tr>";
		echo "<td width='50' height='35' align='center' style='background-color:#FA58F4;color:#FFFFFF';>FILA".$fila."</td>";
		for($columna=0;$columna<$columnas;$columna++){
			echo "
			<td width='50' height='35' align='center' style='background-color:#ccc;color:#FFFFFF';>".$_SESSION['TABLA']['FILA'.$fila][$columna]."</td>";
		}
		echo "<tr>";
	}


	
	echo "</table>"; 
			
?>