<?php


function palindromo($string){
    $res="si";
    
    $tam=strlen($string);
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