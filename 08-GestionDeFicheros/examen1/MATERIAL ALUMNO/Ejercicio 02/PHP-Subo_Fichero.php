<?php
	header('Content-Type: text/html; charset=utf-8');
	/////////////////////////////////////////////////////////////////////////////////////
	///    Script Que copia el archivo temporal subido al servidor en una carpeta    
	/////////////////////////////////////////////////////////////////////////////////////
	
	sleep(1);

	// definimos la carpeta donde se guardará el fichero que se ha subido al servidor
	// comprobamos que exista la carpeta
	// sino existe la creamos
	$dir = 'ficheros_subidos/';
	
	if(!file_exists($dir))
	{
		// creo la carpeta si no existe
		mkdir ($dir);
	}

	if (!copy($_FILES['objetofile']['tmp_name'], $dir.$_FILES['objetofile']['name']))
	//copy devuelve TRUE si copia el archivo
	//si hay algún problema devuelve FALSE
		echo "No se pudo copiar Archivo... Error COPY";
	else 
	// si no hay ningún problema
	{
		echo "<font face='Calibri' color='black' size='3'>El archivo: </font>";
		echo "<font face='Calibri' color='blue' size='3'>".$_FILES['objetofile']['name']."</font>"."<br>";
		echo "<font face='Calibri' color='black' size='3'> se ha subido al Servidor sin problemas</font><br><br>";
	
		if($_FILES['objetofile']['name']=="actualizar_facturas.txt"){

			echo "<font face='Calibri' color='black' size='3'> Leo el fichero de actualizacion</font><br><br>";
			require('conexion.php');
			
			
			
			//SOLUCION 1
			/*
			while(!feof($fichero)){
				$linea=trim(fgets($fichero));
				$campos=explode(" ",$linea);
				
				$consulta1='SELECT * FROM facturas WHERE NFACTURA="'.$campos[0].'"';
				$resultado=mysqli_query($conexion,$consulta1);
				$nregistros=mysqli_num_rows($resultado);

				if($nregistros==1){
					$registro = mysqli_fetch_array($resultado);
					$consulta2="UPDATE facturas SET TOTAL=TOTAL+".$campos[1].' WHERE NFACTURA="'.$campos[0].'"';
					echo "<font face='Calibri' color='black' size='3'> Modifico factura: <strong>".$campos[0]." + ".$campos[1]."</strong></font><br>"; 
				}
				else{
					$consulta2='INSERT INTO facturas VALUES ("'.$campos[0].'",'.$campos[1].')';
					echo "<font face='Calibri' color='black' size='3'> Alta factura: <strong>".$campos[0]." ".$campos[1]."</strong></font><br>";
				}
				mysqli_query($conexion,$consulta2);
			}*/
			//SOLUCION 2
			$consulta1='SELECT NFACTURA FROM facturas';
			$resultado=mysqli_query($conexion,$consulta1);
			$nregistros=mysqli_num_rows($resultado);
			$codigos=[];
			$ninserts=0;
			$consulta3="INSERT INTO facturas VALUES ";
			if($nregistros>=1){
				while($fila=mysqli_fetch_array($resultado)){
					$codigos[$fila["NFACTURA"]]=1;
				}
			}
			$fichero=fopen($dir.$_FILES['objetofile']['name'],'r');
			while(!feof($fichero)){
				$linea=trim(fgets($fichero));
				$campos=explode(" ",$linea);
				if(isset($codigos[$campos[0]])){
					$consulta2="UPDATE facturas SET TOTAL=TOTAL+".$campos[1].' WHERE NFACTURA="'.$campos[0].'"';
					mysqli_query($conexion,$consulta2);
					echo "<font face='Calibri' color='black' size='3'> Modifico factura: <strong>".$campos[0]." + ".$campos[1]."</strong></font><br>"; 
				}
				else{
					$consulta3.='("'.$campos[0].'",'.$campos[1].'),';
					$ninserts++;
					echo "<font face='Calibri' color='black' size='3'> Alta factura: <strong>".$campos[0]." ".$campos[1]."</strong></font><br>";
				}
				
			}
			if($ninserts>0){
				$consulta3=substr($consulta3,0,strlen($consulta3)-1);
				mysqli_query($conexion,$consulta3);
			}
		} 
	}  
?>
