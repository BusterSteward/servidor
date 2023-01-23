<?php
// OJO: cuando almacenamos una imagen (recuperada de la BD) en $_SESSION se hace as� ->
// $_SESSION[][]=base64_encode($registro['IMAGEN']);

// OJO: cuando visualizo una imagen almacenada en $_SESSION se hace as� ->
// <img style='width:30px;height:43px' src='data:image/jpeg;base64,".addslashes($_SESSION[][])."'>

// iniciamos sesi�n
session_start();

require("conexion.php");

$articulo=$_POST["elarticulo"];

$consulta='SELECT * FROM ARTICULOS WHERE ID="'.$articulo.'"';

$resultado=mysqli_query($conexion,$consulta);

$nregistros=mysqli_num_rows($resultado);

if (isset($_SESSION['ID'])) {$elementos=count($_SESSION['ID']);}
else {$elementos=0;}

if($nregistros==1){
    $registro=mysqli_fetch_array($resultado);

    // tendrás que realizar una consulta SQL para recuperar los siguientes valores
    // creo las variables de sesión
    // de esta forma utilizo para las columnas -> 0,1,2,3
    $_SESSION['ID'][$elementos]=trim($articulo);
    $_SESSION['IMAGEN'][$elementos]=base64_encode($registro['IMAGEN']);
    $_SESSION['TITULO1'][$elementos]=$registro['TITULO1'];
    $_SESSION['TITULO2'][$elementos]=$registro['TITULO2'];
    $_SESSION['CANTIDAD'][$elementos]=1;
    $_SESSION['PRECIO'][$elementos]=$registro['PRECIO'];

    $elementos++;

}





// devuelvo el n� de "art�culos distintos" que hay en el carro
echo $elementos;
?>
