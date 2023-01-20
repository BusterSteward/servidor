<?php 
	session_start();
	
	// podemos borrar una "variable de sesión" o las dos, sin borrar "la sesión"
	unset ( $_SESSION['userid'] );
	unset ( $_SESSION['username'] );
	
	// o podemos borrar "la sesión" y borraremos todas las "variables de sesión"
	session_destroy();
	
	header('location: index1.php');
?>