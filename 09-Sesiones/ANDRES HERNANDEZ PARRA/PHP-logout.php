<?php 
	session_start();
	
	// borramos "la sesión" y borramos todas las "variables de sesión"
	session_destroy();
	
	header('location: index1.php');
?>