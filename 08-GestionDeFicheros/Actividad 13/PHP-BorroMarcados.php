<?php

//sleep(1);
usleep(200000);

// directorio donde están los ficheros 
$dir=$_POST['directorio']."/";
//$dir='ficheros_subidos/';
$handle=opendir($dir);
$noBorrados=array();

// recupero los checkbox
// todos los checkbox marcados (TRUE) llamados marca están en el siguiente array "$posiciones_marcadas"
// los que no están marcados (FALSE) no están en este array
$posiciones_marcadas=$_POST['marca'];

// calculo el nº de check´s que hay marcados
// if (isset($_POST['marca'][0]))  {$cantidad=count($posiciones_marcadas);}

// este if no haría falta -> si se ha llamado al servidor es porque algún checkbox habría marcado
// se podría quitar
//if ($cantidad>0)
//{
		echo "<b><font face='Calibri' color='black' size='3'>Los siguientes ficheros han sido borrados: </font></b>"."<br>";
		foreach ($posiciones_marcadas as $valor)
		{
			//Primero comprobamos que el fichero exista
			if (file_exists($dir.$valor)){
				// borro fichero
				unlink($dir.$valor);
				// visualizo el nombre del fichero borrado
				echo "<font face='Calibri' color='blue' size='3'>".$valor."</font>"."<br>";
			}else{
				array_push($noBorrados,$valor);
			}
		}

		echo "<br>";

		if(count($noBorrados)>0){
			echo "<b><font face='Calibri' color='black' size='3'>Los siguientes ficheros NO han sido borrados: </font></b>"."<br>";

			foreach ($noBorrados as $valor){
				//Si el fichero no existe aviso
				echo "<font face='Calibri' color='red' size='3'>El fichero ".$valor." ya no existe o no se puede borrar</font>"."<br>";
			}
		}
//}
	?>