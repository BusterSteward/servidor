<?php

header('Content-Type: text/html; charset=UTF-8');
function suma($n1=0,$n2=0,$n3=0)
{
    $na = func_num_args();
    
    if($na=0){
        $suma=0;
    }
    elseif($na=1){
        $suma=$n1;
    }
    elseif($na=2){
        $suma=$n1+$n2;
    }
    else{
        $suma=$n1+$n2+$n3;
    }
        return $suma;
    
}
$resultado=suma();
echo "el resultado es: ".$resultado."<br><br>";
$resultado=suma(6);
echo "el resultado es: ".$resultado."<br><br>";
$resultado=suma(6,4);
echo "el resultado es: ".$resultado."<br><br>";
$resultado=suma(6,4,1);
echo "el resultado es: ".$resultado."<br><br>";


?>