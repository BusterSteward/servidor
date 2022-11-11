<?php

// utilizamos el método POST (comunicación cliente-servidor)
$retraso=$_POST['retardo'];

// retardo
sleep($retraso);

// elegimos un valor entre 1 y 6
$x=rand(1,6); 

// devolvemos el valor calculado
echo $x;

?>