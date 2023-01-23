<?php

#--------------------------------------------------------------------------
# iniciamos SESIÓN
#--------------------------------------------------------------------------
session_start();

// calculo el nº de "artículos" que hay en el carro
// puedo utilizar cualquier variable de sesión -> por ejemplo ID
if (isset($_SESSION['ID']))
{
		$elementos=count($_SESSION['ID']);
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
		echo $_SESSION['ID'][$x]."<br>";
		echo $_SESSION['TITULO1'][$x]."<br>";
		echo $_SESSION['TITULO2'][$x]."<br>";
		echo $_SESSION['CANTIDAD'][$x]."<br>";
		echo $_SESSION['PRECIO'][$x]."<br><br>";
}		
?>
