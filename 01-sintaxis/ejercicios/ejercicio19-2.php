<?php
function creoarray($cadena)
{
	$array = explode(" ",$cadena);
	$palabras=array();
	
   $i=0;
   while(isset($array[$i]))
   {
		$palabras[0][$i]=$array[$i];
		$palabras[1][$i]=strlen($array[$i]);
		$i++;
   }
   print_r($palabras);
   return $palabras;
}
$palabras2 = creoarray("Hola Pepe de donde vienes GAMBERRO");

$i=0;
echo "Los elementos del array de palabras son: <br>";
// imprimimos los valores del array

$filas=count($palabras2);
$columnas=count($palabras2[0]);

	for ($c=0; $c<$columnas; $c++)
	{
		echo $palabras2[0][$c]." ".$palabras2[1][$c]."<br>";
	}

?>