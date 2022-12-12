<?php
//**********************************************************************
// MI SERVIDOR LOCAL
//$base="paginacion2"; 
//$tabla="tabla1"; 
//$conexion=@new mysqli("127.0.0.1","jorge","666666", $base);
//**********************************************************************
// MI SERVIDOR EXTERNO
$base="id17630328_paginacion1"; 
$tabla="tabla1"; 
$conexion=@new mysqli("localhost","id17630328_pag","Jirafaaaa13.", $base);
//**********************************************************************
if(!$conexion){exit;}

$conexion->query("SET NAMES 'utf8'");
?>