<?php
// recogemos en una variable el nombre de BASE DE DATOS (esquema)
// al que nos queremos conectar
$base="ESQUEMA_PRUEBA1"; 

// a "mysqli()" le tengo que pasar:
// -> el servidor al que me quiero conectar
// -> el usuario
// -> contraseña
// -> esquema (shema) que quiero utilizar

// Creamos la conexión al Servidor de Base de Datos
//**********************************************************************
// si en el código que hay dentro de un "try" -> se produce un error->
// se ejecuta el código que haya en el "catch"
try
{
	// establecemos conexión al servidor de base de Datos
	$conexion=new mysqli("127.0.0.1","jorge","666666", $base);
	
	// visualizamos mensaje éxito
	//echo "<font color='blue' size='5'>
	//<b>MENSAJE:</b><br> La conexión al Servidor de Base de Datos se ha establecido correctamente !!</font>";
	
	//para evitar problemas con acentos y ñ configuramos las querys de esta manera 
	$conexion->query("SET NAMES 'utf8'");
} 
//**********************************************************************
catch (exception $e)
{
    //echo "Error capturado: ".$e->getMessage()."<br>";
	//echo "<font color='blue' size='5'>
	//<b>ERROR:</b><br> No se pudo realizar la conexión al Servidor de Base de Datos!!</font>";
} 
?>