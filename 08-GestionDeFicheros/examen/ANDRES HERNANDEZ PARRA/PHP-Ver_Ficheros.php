<?php
	header('Content-Type: text/html; charset=utf-8');
	
	//sleep(1);
	usleep(200000);
	
	// esta carpeta es donde se copian los ficheros subidos al servidor
	$carpeta = $_POST['directorio']."/";

	// recogemos el USUARIO activo
	$usuario=trim($_POST['usuario']);

	echo "<b><font face='Calibri' color='black' size='4'>Ficheros Subidos: </font></b>";
	echo "<font face='Calibri' color='red' size='3'>".$usuario." "."</font>";
	echo "<font face='Calibri' color='blue' size='3'>".$_POST['directorio']."</font><br><br>";	
	
	// nº de ficheros subidos
	$i=1;
	// si existe el directorio visualizo los ficheros
	// si no existe no hago nada->aviso de que la carpeta no existe
	if (file_exists($carpeta))
	{
		// creamos una lista de los ficheros del directorio
		if ($handle=opendir($carpeta))
		{
			// vamos leyendo los ficheros del directorio
			// mientras lea ficheros y vaya avanzando readdir($handle) retorna TRUE
			// cuando haya leído el último fichero y no pueda seguir leyendo más ficheros
			// readdir($handle) retorna FALSE
			
			//iniciamos la creación de la tabla
			echo "<table id='mitabla' name='mitabla'>";
			
			// en $file tenemos el nombre del fichero que hemos leído
			while($file=readdir($handle))
			{
				 // comprobamos que sea un fichero y no una carpeta
				 // dentro de las carpetas hay ficheros y carpetas especiales
				 
				 // si lo que leo es una carpeta->no hago nada
				 if (is_file($carpeta.$file))
				 {
					  echo "<tr>
					  <td width='30' height='35' align='center'  style='background-color:#FA58F4;color:#FFFFFF';font-family:Calibri;>".$i."</td>";

					  echo "
					  <td width='145' height='35' align='right'  style='background-color:#ACFA58;color:#0404B4';font-family:Calibri;>".
					  "<a href='PHP-DescargoFichero.php?nombref=".$file."&elusuario=".$usuario."&lacarpeta=".$carpeta."'>".$file."</a></td>";								  

  				     echo "						  
					 <td width='40' height='35' align='center' style='background-color:#F7BE81';><img onclick='borro_registro(this)' style='cursor:pointer;width:30px;height:30px;vertical-align:middle' src='imagenes/papelera.png'>"."</td>";
					   
					 echo "<tr>";
					 $i++;
				 }
			}
			echo "</table>"; 
			
			// importante: tengo que cerrar la carpeta
			closedir($handle);
			
			// informo del nº de fichros subidos
			$i--;
			echo "<br><font face='Calibri' color='black' size='4'>Nº de Ficheros Subidos: </font></b>";
			echo "<font face='Calibri' color='red' size='3'>".$i."</font>";			
		}
	}
	else
	// informo que la carpeta no existe
	{	
		mkdir($carpeta);
		echo "<font face='Calibri' color='black' size='3'>La carpeta <b>'".$_POST['directorio']."'</b></font>";
		echo "<font face='Calibri' color='red' size='3'> no EXISTE!!</font><br>";
		echo "<font face='Calibri' color='black' size='3'>La carpeta <b>'".$_POST['directorio']."'</b></font>";
		echo "<font face='Calibri' color='blue' size='3'> ha sido creada con exito!!</font>";
	}	
?>