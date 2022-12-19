<?php
 session_start();

 // iniciamos sesión
 // accede al SERVIDOR -> c:\xamp\tmp
 // y comprueba que se ha creado una SESIÓN.
 // accede al CLIENTE -> cookies
 // comprueba que el servidor donde hemos iniciado sesión ha creado una cookie.

 echo "Iniciamos una sesión:"."<br><br>";

 // creamos la variable de sesión "mivariabledesesion"
 $_SESSION["mivariabledesesion"] = "Hola este es el valor de la variable de sesión";
 // visualizamos el Id para esta sesión
 // cada vez que se inicia una sesión, esta sesión tiene un ID asociado
 echo "Id de esta Sesión: ".session_id();
 echo "<br>";
 // visualizamos el nombre de la sesión
 // el nombre de sesión por defecto es "PHPSESSID"
 echo "Nombre de Sesión: ".session_name();
 echo "<br>";
 // visualizamos el valor de la variable de sesión "mivariabledesesion"
 echo "Valor de Variable mivariabledesesion: ".$_SESSION["mivariabledesesion"];
 echo "<br><br>";
 echo "Si miras las cookies en tu ordenador, verás que se ha creado una cookie llamada PHPSESSID"."<br>";
 echo "Comprobarás también que su valor coincide con el ID de la sesión creada en el Servidor";
?>
