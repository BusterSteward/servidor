<?php
    header('Content-Type: text/html; charset=UTF-8');
    session_start();
    
    $nombre=$_SESSION["username"];
    $total=0;
    $fichero=fopen('Total Jugadas.txt','w+b');
    fwrite($fichero,"Usuario: $nombre \r\n");
    
    $jugadas=[0,0,0,0,0,0,0,0,0];
    if(isset($_SESSION["jugadas"])){
        $total=count($_SESSION["jugadas"]);
        for($i=1;$i<=$total;$i++){
            $carta=$_SESSION["jugadas"][$i];
            $jugadas[$carta]++;
        }
    }
    fwrite($fichero,"Jugadas Realizadas: $total \r\n\r\n");
    for($i=1;$i<10;$i++){
        fwrite($fichero,"Carta nº$i: ".$jugadas[$i-1]."\r\n");
    }

    echo "El fichero Total Jugadas.txt ha sido creado";
?>