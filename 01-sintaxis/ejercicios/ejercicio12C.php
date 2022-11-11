<?php
function cuentapalabra($cadena, $busco){

    
    
    $res=substr_count($cadena,$busco);
    
    return $res;

}

$res1=cuentapalabra("Mi perro es borde", "de");
$res2=cuentapalabra("Vi a el hombre misterioso y a el perro malo", "el");

echo "La primera cadena contiene 'de' {$res1} veces.<br>";
echo "La segunda cadena contiene 'el' {$res2} veces.<br>";
?>