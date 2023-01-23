<?php    
	
	//usleep(400000);
	
	session_start();

	//claculo el nº de articulos que hay en el carro
	if(isset($_SESSION['ID'])) { $elementos=count($_SESSION['ID']); }
	else { $elementos=0; } 
	// devuelvo el nº de artículos en el carrito
	echo $elementos;
?>

 
 