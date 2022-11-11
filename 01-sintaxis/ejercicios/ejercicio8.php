<?php
    header('Content-Type: text/html; charset=UTF-8');
    
    //prueba funcion strrev
    //devuelve un string invertido
    $prueba1="strrev";
    $res_prueba1=strrev($prueba1);
    echo "Prueba de strrev <br>";
    echo $prueba1." -> ".$res_prueba1."<br><br>";

    //prueba funciones strtolower y strtouper
    //cambian una cadena a minusculas y a mayusculas respectivamente

    $prueba2="HOLA";
    $res_prueba2_1=strtolower($prueba2);
    $res_prueba2_2=strtoupper($res_prueba2_1);
    echo "Prueba de strtolower y strtouper <br>";
    echo $prueba2." strtolower -> ".$res_prueba2_1."<br>";
    echo $res_prueba2_1." strtouper -> ".$res_prueba2_2."<br><br>";

    //prueba de la funcion count()
    //devuelve el numero de elementos de un array
    $array=array(4,2,1,5,6);
    $prueba3 = count($array);
    echo "Prueba de count() <br>";
    echo "Array {4,2,1,5,6} <br>";
    echo "El array tiene ".$prueba3." elementos <br><br>";

    //prueba de la funcion array_push()
    //inserta un elemento o más en un array pasado por parametro

    array_push($array,100);
    echo "Prueba de array_push()<br>";
    echo "Se ha insertado en el array el valor 100<br>";
    echo "Mostramos el array -> ";
    $i=0;
    while(isset($array[$i])){
        echo $array[$i]." ";
        $i++;
    }
    
?>

