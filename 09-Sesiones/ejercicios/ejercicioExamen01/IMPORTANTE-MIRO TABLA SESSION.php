<?php

#--------------------------------------------------------------------------
# iniciamos SESIÓN
#--------------------------------------------------------------------------
session_start();

// calculo el nº de "artículos" que hay en el carro
// puedo utilizar cualquier variable de sesión -> por ejemplo ID
if(isset($_SESSION["user"])){
	echo "existe el user";
}
else{
	echo "no existe el user";
}
if (isset($_SESSION['jugadas']))
{
		$elementos=count($_SESSION['jugadas']);
}
else
{
	$elementos=0;
}

#--------------------------------------------------------------------------
# visualizamos los registros de $_SESSION en una tabla
#--------------------------------------------------------------------------

// los índices de las columnas de $_SESSION son -> 0,1,2,3,4

// revisa el tema de Sintaxis->Arrays
for ($x=0; $x<$elementos; $x++)
{
		echo $_SESSION['jugadas'][$x]."<br>";
		
}		
?>
