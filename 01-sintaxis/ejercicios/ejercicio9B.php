<?php
    $c1="antoniosevaalcine";
    $c2="cerezas";
    echo "cadena1: ".$c1."<br>";
    echo "cadena2: ".$c2."<br>";
    
    $resultado=cadenamaslarga($c1,$c2);
    echo longitudCadena($c1)."<br>";
    echo longitudCadena($c2)."<br>";
    
    echo $resultado;
    function longitudCadena($cad){
        $i=0;
        while(isset($cad[$i])){
            $i+=1000;
        }
        $i-=1000;
        while(isset($cad[$i])){
            $i+=100;
        }
        $i-=100;
        while(isset($cad[$i])){
            $i+=10;
        }
        $i-=10;
        while(isset($cad[$i])){
            $i++;
        }
        $i--;
        return $i;
    }
    function cadenamaslarga($cad1,$cad2){
        $res;
        
        $longCad1=longitudCadena($cad1);
        $longCad2=longitudCadena($cad2);
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