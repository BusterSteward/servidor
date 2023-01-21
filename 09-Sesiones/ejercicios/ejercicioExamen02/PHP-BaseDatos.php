<?php

    session_start();

    

    $nombre=$_SESSION["username"];
    $linea1= "<font color='black'>USUARIO: $nombre</font><br>";
    
    
    if(isset($_SESSION["jugadas"])){
        require("conexion.php");

        $consulta="INSERT INTO JUGADAS(USUARIO,NJUGADA,JUGADA) VALUES";

        $tabla="<table class='table'>";
        $njugadas=count($_SESSION["jugadas"]);
        for($i=1;$i<=$njugadas;$i++){
            $tabla.=
            "<tr>
            <td style='background-color:black; color:white;'>Jugada 0$i</td>
            <td><img src='./imagenes/".$_SESSION["jugadas"][$i].".jpg'/></td>
            <td color='blue'>".$_SESSION["jugadas"][$i]."</td>
            </tr>";

            $consulta.="('$nombre',$i,".$_SESSION['jugadas'][$i]."),";
        }
        $tabla.="</table>";
        $consulta=substr($consulta,0,strlen($consulta)-1);

        mysqli_query($conexion,$consulta);
        mysqli_close($conexion);

        $linea2="<font color='black'>Registros dados de alta: $njugadas</font><br>";
        $respuesta=$linea1.$linea2.$tabla; 
        
    }
    else{
        $linea2="<font color='black'>No hay jugadas, registros dados de alta: 0</font><br>";
        $respuesta=$linea1.$linea2;
    }
    echo $respuesta;
?>