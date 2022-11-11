<?php
function cuentapalabra($cadena, $busco){

    $numSust=0;
    $pongo="hola";
    $res=str_replace($busco,$pongo,$cadena,$numSust);
    
    return $numSust;

}

$res1=cuentapalabra("Mi perro es borde", "de");
$res2=cuentapalabra("Vi a el hombre misterioso y a el perro malo", "el");

echo "La primera cadena contiene 'de' {$res1} veces.<br>";
echo "La segunda cadena contiene 'el' {$res2} veces.<br>";
?>