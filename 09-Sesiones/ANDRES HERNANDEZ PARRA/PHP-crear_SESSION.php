<?php    
	
	usleep(400000);
	
	session_start();

	// esta función PHP genera un número aleatorio entre el 1 y el 8 ->rand(1,8);
	
	//Introduzco todas las filas en una única variable que es $_SESSION["TABLA"]
	//para poder extraer después el número de filas fácilmente
	for($fila=1;$fila<=5;$fila++){
		for($columna=0;$columna<=3;$columna++){
			$num=rand(1,8);
			$_SESSION["TABLA"]["FILA".$fila][$columna]=$num;
		}
	}
	
?>

 
 