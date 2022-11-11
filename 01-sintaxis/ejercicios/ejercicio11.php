<?php
 $buscoesto="pepe";
 $pongoesto="juan";
 $cadena="epe no es pepe, pep no es pepe";
 $numSust=0;
 $resultado=sustituir($buscoesto,$pongoesto,$cadena,$numSust);

 echo "Cadena: {$cadena}<br>";
 echo "Numero de sustituciones: ".$numSust."<br>";
 echo "La cadena final es: {$resultado}<br>";
 

 function sustituir($busco,$pongo,$cad,&$numSust){
    $numSust=0;
    $res=str_replace($busco,$pongo,$cad,$numSust);
    
    return $res;
 }
?>
