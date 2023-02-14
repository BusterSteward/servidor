<?php
    session_start();

    $producto=$_POST["producto"];

    
    unset($_SESSION['ID'][$producto]);
    unset($_SESSION['IMAGEN'][$producto]);
    unset($_SESSION['TITULO1'][$producto]);
    unset($_SESSION['TITULO2'][$producto]); 
    unset($_SESSION['CANTIDAD'][$producto]); 
    unset($_SESSION['PRECIO'][$producto]);
   
?>