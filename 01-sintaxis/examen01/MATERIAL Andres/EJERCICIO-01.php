<?php
//*****************************************************
function visualizo($aux)
{
    for($i=0;$i<count($aux);$i++){
        for($j=0;$j<count($aux[$i]);$j++){
            echo $aux[$i][$j]." ";
        }
        echo "<br>";
    }
}
//*****************************************************
function transformo($A)
{
    $arr;
    for($i=0;$i<count($A);$i++){
        $columnas=count($A[$i]);
        $arr[$columnas-1] = $A[$i];
    }
    return $arr;
}
//*****************************************************

$originalA[0]=array('H','O','L','A');
$originalA[1]=array('E','S','T','O','Y');
$originalA[2]=array('10','10','10','10','10','10','10','10','10','10');
$originalA[3]=array('6','6','6','6','6','6');
$originalA[4]=array('P','E','N','S','A','N','D','O');
$originalA[5]=array('L','U','Z',);
$originalA[6]=array('L','O');
$originalA[7]=array('7','7','7','7','7','7','7');
$originalA[8]=array('Y');
$originalA[9]=array('9','9','9','9','9','9','9','9','9');

visualizo($originalA);

$mitabla=transformo($originalA);

visualizo($mitabla);
?>
