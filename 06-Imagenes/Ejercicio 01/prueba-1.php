<?php

// "ob_start()": esta función sirve para indicarle a PHP que se ha de iniciar el buffering de la salida, es decir, 
// que debe empezar a guardar la salida en un bufer interno "ob_get_contents()", en vez de enviarla al cliente.
// De modo que, aunque se escriba código HTML con echo o directamente fuera del código PHP,
// no se enviará al navegador hasta que se ordene explícitamente.


//ejemplo de uso de ob_start() y ob_get_contents()

echo "vamos a activar <br><br>";

// inicio-activamos
ob_start();

echo "Hola";
$salida1 = ob_get_contents();
// $salida1: tiene el valor de "Hola"

echo "Mundo";
$salida2 = ob_get_contents();
// $salida2: tiene el valor de  "Hola" o ''HolaMundo" ??

echo "Cruel";
$salida3 = ob_get_contents();
// $salida3: tiene el valor de  "Cruel" o ''HolaMundoCruel" ??

// fin-desactivamos
ob_end_clean();

echo "ya no está activo <br><br>";

echo ("echo FINAL: ".$salida1."+++".$salida2."+++".$salida3);
?>