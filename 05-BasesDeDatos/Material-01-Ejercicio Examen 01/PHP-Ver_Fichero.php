<?php
	header('Content-Type: text/html; charset=utf-8');
	
	sleep(1);

	// abrimos ficheros para lectura
	$fichero1=@fopen('ficheros_subidos/clientes.txt', 'rb');
	if(!$fichero1)
	{
		echo "ERROR: no se pudo abrir el archivo clientes.txt";
		exit();
	}
	else
	{
		echo "<b><font face='Calibri' color='red' size='3'>Fichero clientes.txt: </font></b>"."<br><br>";
		while (!feof($fichero1))
		{
			$lineaFile= trim(fgets($fichero1));
			echo $lineaFile."<br>";
		}
	}	
	
	// cerramos
	fclose($fichero1);
?>