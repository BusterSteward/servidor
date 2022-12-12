<?php
  $base="paginacion3"; 
  $tabla="tabla1"; 

  $conexion=@new mysqli("127.0.0.1","jorge","666666", $base);
  if (!$conexion){exit;}
  $conexion->query("SET NAMES 'utf8'");
?>