<?php
function recorrerTabla($tabla){

    foreach($tabla as $fila){
        foreach($fila as $celda){
            echo $celda." ";
        }
        echo "<br>";
    }
}
$tabla['uno']['pepe']="1P";
$tabla['uno']['juan']="1J";
$tabla['uno']['luis']="1L";

$tabla['dos']['pepe']="2P";
$tabla['dos']['juan']="2J";
$tabla['dos']['luis']="2L";

$tabla['tres']['pepe']="3P";
$tabla['tres']['juan']="3J";
$tabla['tres']['luis']="3L";

recorrerTabla($tabla);

?>
