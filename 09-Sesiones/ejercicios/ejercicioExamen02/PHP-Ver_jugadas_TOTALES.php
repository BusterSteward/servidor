<?php

    session_start();

    $nombre=$_SESSION["username"];

    $jugadas=[0,0,0,0,0,0,0,0,0];
    if(isset($_SESSION["jugadas"])){
        for($i=1;$i<=count($_SESSION["jugadas"]);$i++){
            $carta=$_SESSION["jugadas"][$i];
            $jugadas[$carta]++;
        }
    }
    
    
    $linea1="<font color='black'>USUARIO: $nombre</font><br>";
    $jugadasTotales=0;
    
    $respuesta="<table class='table'>";
    for($i=1;$i<10;$i++){
        $njugadas=$jugadas[$i-1];
        $jugadasTotales+=$njugadas;

        $respuesta.=
        "<tr>
        <td style='background-color:black;color:white;'>0$i</td>
        <td><img src='./imagenes/$i.jpg'/></td>
        <td color='blue'>$njugadas</td>
        </tr>";
    }
    $respuesta.="</table>";
    $linea2="<font color='black'>JUGADAS REALIZADAS: $jugadasTotales</font><br>";
    echo $linea1.$linea2.$respuesta;
?>