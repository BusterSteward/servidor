<?php

$tabla=array();
// *****************************************************************************************
function relleno_tabla($latabla)
{
	for($c=0; $c<11; $c++)
	{
			$latabla[$c]=$c;
			echo "valor de la tabla en la posición ".$c." es ".$c."<br>";
	}		

	$aux=0;
	
	for($i=1; $i<100000000; $i++)
	{
			$aux=$aux+1;
	}		
	
	echo "<br> el valor de la variable es: ".$aux."<br>";
	
	return $latabla;
}
// *****************************************************************************************


echo "el lenguaje PHP es síncrono y bloqueante-1<br>";
echo "el lenguaje PHP es síncrono y bloqueante-2<br>";
echo "el lenguaje PHP es síncrono y bloqueante-3<br>";
echo "el lenguaje PHP es síncrono y bloqueante-4<br>";
echo "<br>";
// antes de llamar a la función
echo "el nº de columnas de la tabla es ".count($tabla)."<br><br>";
$tabla=relleno_tabla($tabla);
echo "<br>";
// después de llamar a la función
echo "el nº de columnas de la tabla es ".count($tabla)."<br>";
echo "<br>";
echo "el lenguaje PHP es síncrono y bloqueante-5<br>";
echo "el lenguaje PHP es síncrono y bloqueante-6<br>";
echo "el lenguaje PHP es síncrono y bloqueante-7<br>";
echo "el lenguaje PHP es síncrono y bloqueante-8<br><br>";

echo "y no se puede hacer nada... (busca información PHP asíncrono)";

?>
