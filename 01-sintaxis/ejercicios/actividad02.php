<?php

function imprimir($arr)
{
    for($i=0;$i<count($arr);$i++){
        
        for($j=0;$j<count($arr[$i]);$j++){
            //if(!isset($arr[$i][$j]))
                //continue;
            //echo "<br>".$i." ".$j."<br>";
            echo $arr[$i][$j]." ";
        }
        echo "<br>";
    }
}

function imprimir2($original)
{
$filas_nuevo=count($original);
$columnas_nuevo=count($original[0]);

for($fila=0; $fila<$filas_nuevo; $fila++)
{
	for($columna=0; $columna<$columnas_nuevo; $columna++)
	{
		if (!isset($original[$fila][$columna]))
			// el asterisco lo pongo para que se puedea ver el array ordenado
			echo ' * ';
		else
		   echo ' '.$original[$fila][$columna].' ';
	}
	echo "<br>";
}
}



function actividad02($arr)
{
    $nuevo;
    for($i=0;$i<count($arr);$i++){
        for($j=0;$j<count($arr[$i]);$j++){
            $nuevo[$j][$i]=$arr[$i][$j];
        }
        
    }
    return $nuevo;
}

$arr = array(
    array('H','O','L','A'),
    array('S','U'),
    array('E','S','T','O','Y'),
    array('A','Q','U','I'),
    array('F','E','L','I','Z'),
    array('P','E','N','S','A','N','D','O')
);
$nuevo = actividad02($arr);

echo "<br>";
echo "Imprimo el array <br>";
imprimir($arr);


echo "Imprimo el array invertido <br>";
imprimir2($nuevo);
?>