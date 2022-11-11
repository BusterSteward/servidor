<?php
	header('Content-Type: text/html; charset=utf-8');
	
	sleep(1);

	// abrimos ficheros para lectura
	$fichero1=@fopen('ficheros_subidos/clientes01.txt', 'rb');
	if(!$fichero1)
	{
		echo "ERROR: no se pudo abrir el archivo clientes01.txt";
		exit();
	}
	else
	{
		echo "<b><font face='Calibri' color='red' size='3'>Fichero clientes01.txt: </font></b>"."<br><br>";
		while (!feof($fichero1))
		{
			$lineaFile= trim(fgets($fichero1));
			echo $lineaFile."<br>";
		}
	}	

	$fichero2=@fopen('ficheros_subidos/clientes02.txt', 'rb');
	if(!$fichero2)
	{
		echo "ERROR: no se pudo abrir el archivo clientes02.txt";
		exit();
	}
	else
	{
		echo "<b><font face='Calibri' color='red' size='3'>Fichero clientes02.txt: </font></b>"."<br><br>";
		while (!feof($fichero2))
		{
			$lineaFile= trim(fgets($fichero2));
			echo $lineaFile."<br>";
		}
	}	

	// cerramos
	fclose($fichero1);
	fclose($fichero2);
?>