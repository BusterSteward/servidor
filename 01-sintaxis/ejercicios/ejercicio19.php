<?php
function creoarray($cadena){
   $array = explode(" ",$cadena);
   
   $palabras=array();
   $cont=0;
   while(isset($array[$cont])){
   
    $palabras[0][$cont]=$array[$cont];
    $palabras[1][$cont]=strlen($array[$cont]);
    $cont++;
   }

   
   return $palabras;
}
$palabras = creoarray("Hola Pepe de donde vienes GAMBERRO");
$i=0;
echo "Los elementos del array de palabras son: <br>";
while(isset($palabras[0][$i])){
    echo $palabras[0][$i]." ".$palabras[1][$i]."<br>";
    $i++;
}
?>