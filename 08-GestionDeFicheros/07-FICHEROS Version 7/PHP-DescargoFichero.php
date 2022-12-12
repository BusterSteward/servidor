<?php

// Utilizamos basename por SEGURIDAD,
// devuelve el nombre del FICHERO eliminando cualquier ruta que le podamos haber pasado
// (suponiendo que le hayamos pasado una ruta)
$archivo = basename($_GET['nombref']);

// ruta donde está el fichero en el servidor
$ruta = 'ficheros_subidos/'.$archivo;

// compruebo que sea una fichero y no una carpeta
if (is_file($ruta))
{
   // no se pueden poner echo´s
   // si pongo echo -> NO FUNCIONA
   // echo $ruta;
   
   // fichero
   header('Content-Description: File Transfer'); 	
   // no da opción al usuario de guardarlo
   header('Content-Type: application/force-download');
   // nombre del fichero a descargar
   header('Content-Disposition: attachment; filename='.$archivo);
   // código binario
   header('Content-Transfer-Encoding: binary');
   // anula la memoria caché utilizada en la próxima petición de descarga
   header('Cache-Control: must-revalidate');
   // tamaño del fichero a descargar
   header('Content-Length: '.filesize($ruta));

   // se realiza la descarga
   readfile($ruta);
}

exit();
?>