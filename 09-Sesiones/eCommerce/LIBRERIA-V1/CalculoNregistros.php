<?php
	// conexión con la base de datos
	require('conexion.php');

	// filtros

	// ID artículos
	$patron2=trim($_GET['criterio1']).'%';
	// caja de texto búsqueda
	$patron1='%'.trim(strtoupper($_GET['criterio2'])).'%';
	
	$consulta = "SELECT ID FROM articulos WHERE ID LIKE '".$patron2."' AND TITULO2 LIKE '".$patron1."' ORDER BY ID ASC";
	
	$resultado = mysqli_query($conexion,$consulta);
	$nregistros = mysqli_num_rows($resultado);
	
	echo $nregistros;
	
	// cerramos la conexión 
	 mysqli_close($conexion); 
?>