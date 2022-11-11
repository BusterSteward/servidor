<?php
function cuentapalabra($cadena, $busco){

    $contador=0;
    $pos=strpos($cadena,$busco,0);
    while($pos!=false){
        $contador++;
        $pos=strpos($cadena,$busco,$pos+1);
    }

    return $contador;

}

$res1=cuentapalabra("Mi perro es borde", "de");
$res2=cuentapalabra("Vi a el hombre misterioso y a el perro malo", "el");

echo "La primera cadena contiene 'de' {$res1} veces.<br>";
echo "La segunda cadena contiene 'el' {$res2} veces.<br>";
?>