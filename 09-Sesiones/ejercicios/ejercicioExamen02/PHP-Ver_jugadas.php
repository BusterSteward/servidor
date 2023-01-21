<?php

    session_start();

    $nombre=$_SESSION["username"];
    $linea1="<font color='black'>USUARIO: $nombre</font><br>";
    
    $respuesta;
    if(isset($_SESSION["jugadas"])){
        $tabla="<table class='table'>";
        $njugadas=count($_SESSION["jugadas"]);
        for($i=1;$i<=$njugadas;$i++){
            $tabla.=
            "<tr>
            <td style='background-color:black; color:white;'>Jugada 0$i</td>
            <td><img src='./imagenes/".$_SESSION["jugadas"][$i].".jpg'/></td>
            <td color='blue'>".$_SESSION["jugadas"][$i]."</td>
            </tr>";
        }
        $tabla.="</table>";
        
        $linea2 "<font color='black'>JUGADAS REALIZADAS: $njugadas</font><br>";
        $respuesta=$linea1.$linea2.$tabla; 
    }
    else{
        $linea2="<font color='black'>JUGADAS REALIZADAS: 0</font><br>";
        $respuesta=$linea1.$linea2;
    }
    echo $respuesta;

?>