<?php
// con librer�a PHP mysqli
header('Content-Type: text/html; charset=iso-8859-1');

    $host = 'localhost';  
    $username = 'jorge';
    $password = '666666';
    
# recogemos en una variable el nombre de BASE DE DATOS (esquema)
$base="basedatos1"; 

# recogemos en una variable el nombre de la TABLA
# en ning�n sitio en este script utilizo esta variable ($tabla)
# esta variable la utilizar� en el script donde se tenga que utilizar la tabla 
$tabla="tabla1"; 

#--------------------------------------------------------------------------
# establecemos la conexion con el servidor 
# gestionamos posible error
#--------------------------------------------------------------------------
// a mysqli le paso el servidor al que me quiero conectar, el usuario y su password, el esquema que quiero utilizar

// MI SERVIDOR LOCAL
//**********************************************************************
try {
  $conexion = new PDO("mysql:host=$host;dbname=$base", $username, $password);
  
} catch (PDOException $pe) {
  die("Could not connect to the database $base :" . $pe->getMessage());
}
//esta l�nea la quitaremos cuando usemos este script en PHP para conectarnos a una base de datos
//echo "<font color='blue' size='4' font-weight: extra-bold>
//MENSAJE: La conexi�n con los datos se ha establecido correctamente !!</font>";
?>