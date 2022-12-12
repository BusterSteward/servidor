<?php
$directorio = "imagenes";
// hace una lista de archivos del directorio
// scandir() devuelve un array con los nombres de los ficheros
// si el directorio no est� vac�o->warning->no se puede borrar

// "scandir"->devuelve una tabla con el nombre de los ficheros y carpetas que contiene
// la carpeta
// una carpeta contiene 2 carpetas ocultas ("." y "..")
$archivos = scandir($directorio);
$num=count($archivos);
// compruebo los ficheros que tengo en la carpeta
if ($num>2)
{
	echo "n-ficheros: ".$num."<br><br>";
	//borramos los ficheros
	for ($i=0; $i<$num; $i++)
	{
        if(is_file($directorio."/".$archivos[$i]))
		    unlink ($directorio."/".$archivos[$i]);
	}	
	
	//borramos el directorio
	if (rmdir ($directorio)) echo "se ha borrado porque está vacía"."<br><br>";
	else	echo "NO se ha borrado"."<br><br>";
}
else
{
	//borramos el directorio
	if (rmdir ($directorio)) echo "se ha borrado porque está vacía"."<br><br>";
	else	echo "NO se ha borrado"."<br><br>";
}

?>