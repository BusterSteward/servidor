<?php
header('Content-Type: text/html; charset=UTF-8');
# también se puede cambiar AddDefaultCharset en la configuración de Apache
$variable = "Domingo";
$frase_1 = "Hoy es $variable, el cielo está gris <br>";
$frase_2 = 'Hoy es $variable, el cielo está gris <br>';
$frase_3 = 'Hoy es'.$variable.', el cielo está gris <br>';
echo $frase_1;
echo $frase_2;
echo $frase_3;
?>