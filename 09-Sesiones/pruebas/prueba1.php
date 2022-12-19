<?php
 // setcookie escribe el contenido de la cookie en el ordenador del cliente
 setcookie("cookie1","Soy la cookie1 y me he almacenado en tu ordenador",time()+3600);
 // escribe el valor leído en la cookie
 if(isset($_COOKIE['cookie1']))
    echo "Esta es la <b>galletita</b>: ".$_COOKIE['cookie1']."<br>";
 else echo "Esta es la <b>galletita</b>: ";
?>
