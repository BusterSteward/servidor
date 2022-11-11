<?php

// utilizamos el método POST (comunicación cliente-servidor)
$retraso=$_POST['retardo'];

// retardo
sleep($retraso);

//Creo una array con las distintas imagenes
$imagenes[1]='DADO1.JPG';
$imagenes[2]='DADO2.JPG';
$imagenes[3]='DADO3.JPG';
$imagenes[4]='DADO4.JPG';
$imagenes[5]='DADO5.JPG';
$imagenes[6]='DADO6.JPG';

// elegimos un valor entre 1 y 6
$x=rand(1,6); 

// mostramos la imagen
echo '<img name="eldado" id="'.$x.'" src="'.$imagenes[$x].'" height="190" width="190" >';

?>