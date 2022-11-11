<?php
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

function palindromo($string){
    $res="si";
    
    $tam = longitudCadena($cad);
    for($i=0;$i<$tam/2;$i++){
        if($string[$i]!=$string[($tam-1)-$i]){
            $res="no";
            break;
        }
    }

    
    return $res;

}
    

$cad1 =  "reconocer";
$cad2 = "amanecer";

echo "La cadena '{$cad1}' ".palindromo($cad1)." es un palindromo <BR>";
echo "La cadena '{$cad2}' ".palindromo($cad2)." es un palindromo";


?>