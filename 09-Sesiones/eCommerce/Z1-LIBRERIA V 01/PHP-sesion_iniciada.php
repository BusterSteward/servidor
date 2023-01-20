<?php    
	
	//usleep(400000);
	
	session_start();
    
	// si existe la variable de sesión "$_SESSION['username']" -> eso significa que no se ha cerrado la sesión
	if(isset($_SESSION['username']))
	// SESIÓN INICIADA
	{
		echo 1;
	}
	else
	// SESIÓN NO INICIADA
	{
		echo 0;
	}
?>

 
 