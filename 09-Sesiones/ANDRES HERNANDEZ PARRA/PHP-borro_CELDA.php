<?php    
	
	session_start();
	
	//sleep(1);
	usleep(400000);
	
	//la celda a borrar se genera desde el cliente y la mandamos por post
	$fila=$_POST["f"];
	$columna=$_POST["c"];

	//actualizamos el valor de la tabla a 0
	$_SESSION["TABLA"]["FILA".$fila][$columna]=0;
?>

 
 