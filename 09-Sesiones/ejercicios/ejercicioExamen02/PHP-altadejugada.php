<?php

$carta = $_POST["lacarta"];
$njugada= $_POST["njugada"];

session_start();
$_SESSION["jugadas"][$njugada]=$carta;


?>