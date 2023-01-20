<?php
    header('Content-Type: text/html; charset=utf-8');

    $usuario=$_POST["elusuario"];

    require("conexion.php");

    $consulta='SELECT ACTIVIDAD FROM historial WHERE USUARIO="'.$usuario.'"';

    $resultado=mysqli_query($conexion,$consulta);

    $nregistros=mysqli_num_rows($resultado);

    echo "<font face='Calibri' color='black' size='3'><b>Historial Actividad:</b> ".$usuario."</font>"."<br><br>";

    if($nregistros>0){
        $nActividad=1;
        echo "<table>";
        while($registro=mysqli_fetch_array($resultado)){
            echo "<tr>";
            echo "<td width='30' heigth='30' align='center'  style='background-color:#FA58F4;color:#FFFFFF';font-family:Calibri;>".$nActividad."</td><td width='350' height='30' align='left'  style='background-color:#ACFA58;color:#0404B4';font-family:Calibri;>".$registro["ACTIVIDAD"]."</td>";
            echo "</tr>";
            $nActividad++;
        }
        echo "</table><br><br>";

        echo "<font face='Calibri' color='black' size='3'>Nº de Eventos Registrados: ".$nregistros."</font><br><br>";
    }
    else{
        echo "<font face='Calibri' color='black' size='3'>No se ha registrado actividad por parte de este usuario</font><br><br>";
    }
?>