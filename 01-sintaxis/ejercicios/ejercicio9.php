<?php
    $c1="antoniosevaalcine";
    $c2="cerezas";
    echo "cadena1: ".$c1."<br>";
    echo "cadena2: ".$c2."<br>";
    $resultado=cadenamaslarga($c1,$c2);
    echo $resultado;

    function cadenamaslarga($cad1,$cad2){
        $res;
        $longCad1=strlen($cad1):
        $longCad2=strlen($cad2);
        if($longCad1==$longCad2){
            $res=0;
        }
        elseif($longCad1>$longCad2){
            $res=1;
        }
        else{
            $res=2;
        }
        return $res;
    }
?>