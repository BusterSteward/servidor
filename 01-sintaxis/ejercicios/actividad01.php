<?php

function Actividad01($cad){
    $nueva="";
    $nCaracteres=1;
    $cont=0;
    $i=0;
    while(isset($cad[$i])){
        if($cad[$i]==" "){
            $i++;
            continue;
        }
        else if($nCaracteres<7){
            $nueva.=$cad[$i];
            $cont++;
            if($cont==$nCaracteres){
                $nueva.="*";
                $nCaracteres++;
                $cont=0;
            }
        }
        else{
            $nueva.=$cad[$i];
        }
        $i++;
    }
    return $nueva;

}

$cad = "LA TARDE ERA UNA TARDE BONITA";
$nuevaCad = Actividad01($cad);

echo $cad."<br>";
echo $nuevaCad."<br>";
?>