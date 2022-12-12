<?php
$directorio = "imagenes";
//hace una lista de archivos del directorio
//scandir() devuelve un array con los nombres de los ficheros
$archivos = scandir($directorio);
//cuenta los ficheros
$num = count($archivos);
echo "nFicheros: ".$num."<br>"; 
//borramos los ficheros
for ($i=2; $i<$num; $i++)
{

if(unlink ($directorio."/".$archivos[$i])){
    echo "Se ha eliminado el archivo: ".$archivos[$i]."<br>";
}
}
//borramos el directorio
rmdir ($directorio);
?>