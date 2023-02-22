<?php
	session_start();
	
	// se pude utilizar COUNT para saber la columna correspondiente y no utilizar "jugada"
	// if (isset($_SESSION['f1'][1])) {$njugada=count($_SESSION['f1']);}
	// else {$njugada=1;}
	
	// fila jugada
	$njugada=$_POST["jugada"];
	
	$_SESSION['f1'][$njugada]=$_POST["fruta1"];
	$_SESSION['f2'][$njugada]=$_POST["fruta2"];
	$_SESSION['f3'][$njugada]=$_POST["fruta3"];
?>