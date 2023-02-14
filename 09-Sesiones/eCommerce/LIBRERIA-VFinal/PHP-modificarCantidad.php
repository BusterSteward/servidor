<?php
    session_start();

    $producto=$_POST["producto"];
    $cantidad=$_POST["cantidad"];

    $_SESSION["CANTIDAD"][$producto]=$cantidad;
?>