<?php
	header('Content-Type: text/html; charset=UTF-8');

	$existo=file_exists('fichero3.txt'); 

	if(!$existo){ 
	exit("ERROR: no se pudo abrir el archivo fichero3.txt");
	} else {

		$fichero=fopen('fichero3.txt','rb');
		$resul=fopen("Fichero3A.txt","wb");
		$palabras = array();
		while (!feof($fichero)){ 
			$linea=trim(fgets($fichero)); 
			$palabra="";
			$l = explode(" ",$linea);

			foreach($l as $palabra){
				if(!isset($palabras[$palabra])){
					$palabras[$palabra]=1;
					fwrite($resul,$palabra."\r\n");
				}
			}
			
		}
	}

	echo "TODO OK";
	fclose($fichero);
	fclose($resul);

?>

