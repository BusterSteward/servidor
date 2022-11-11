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
function transformo($A,$B)
{
	$arr;
    for($i=0;$i<count($A);$i++){
        $tam=count($A[$i])+count($B[$i]);
        $aux=0;
        for($j=0;$j<$tam;$j++){
            if(isset($A[$i][$j]))
                $arr[$i][$j]=$A[$i][$j];
            else{
                $arr[$i][$j]=$B[$i][$aux];
                $aux++;
            }  
        }
    }
    return $arr;
}
//*****************************************************

$originalA[0]=array('H','O','L','A');
$originalA[1]=array('P','E');
$originalA[2]=array('E','S','T','O','Y');
$originalA[3]=array('A','Q','U','I');
$originalA[4]=array('F','E','L','I','Z');

$originalB[0]=array('1','X','1');
$originalB[1]=array('2','2','Y','Y','2','2','2');
$originalB[2]=array('3','3');
$originalB[3]=array('4','4','X');
$originalB[4]=array('5','5','5','5','5','5');

visualizo($originalA);
visualizo($originalB);

$mitabla=transformo($originalA,$originalB);

visualizo($mitabla);
?>
