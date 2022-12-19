<?php
 header('Content-Type: text/html; charset=UTF-8');
 session_start();

 // no es lo mismo CERRAR una sesión que BORRAR todas las variables de sesión
 // destruimos la sesión -> la sesión queda cerrada y sin variables de sesión
$_SESSION = array();
session_destroy();

 // luego borramos la cookie que almacena la sesión
 // si no borramos la cookie se borrará sola al cerrar el navegador
 if(isset($_COOKIE[session_name()]))
 {
 //eliminamos la cookie del CLIENTE
 setcookie(session_name(), '', time() - 42000, '/');
 }
 echo "SESIÓN ELIMINADA";
 //header("Location: prueba.php");
?>