<?php
//*****************************************
// En este caso el ERROR generado
// se le informa al usuario
// El ERROR es visible al usuario

// SALIDA: 1 -> se ha realizado el alta sin problemas
// SALIDA: numero de error -> devuelvo el numero de error que se haya producido
//*****************************************

sleep(2);

//conexión con la base de datos
//y con la tabla donde queremos dar el registro de alta
require('conexion.php');
mysqli_report(MYSQLI_REPORT_ERROR|MYSQLI_REPORT_OFF);
//*************************************************************************************
//												TRATAMOS LA IMAGEN SELECCIONADA
//*************************************************************************************

// los ficheros seleccionados en el formulario se almacenan en $_FILES
// propiedades del fichero de imagen que hemos seleccionado en el formulario
$foto_name= $_FILES['imagen']['name'];
$foto_size= $_FILES['imagen']['size'];
$foto_type=  $_FILES['imagen']['type'];
$foto_temporal= $_FILES['imagen']['tmp_name'];

 // tenemos que reconvertir la imagen para poder darla de alta en la tabla
 // abrimos el fichero temporal en modo lectura "r" binaria"b"
 $f1= fopen($foto_temporal,"rb");
 // leemos el fichero completo limitando la lectura al tamaño de fichero		
 $foto_reconvertida = fread($f1, $foto_size);
 
 // "addslashes"
 // anteponemos \ a las "comillas" u "otro caracter especial" que pudiera contener el fichero
 // a eso se le denomina "escapar"
 // para evitar que esos caracteres sean interpretados como no deben
 // ejemplo: -> final de cadena	
 $foto_reconvertida=addslashes($foto_reconvertida);
 
if ($_FILES["imagen"]["error"] > 0)
	{
	  echo "No se cargó el archivo. Error: ".$_FILES["imagen"]["error"];
	  exit;
	}
else
	{
	  // echo "<br><h4>Archivo cargado correctamente</h4><br>";
	}
//*************************************************************************************
//												FIN TRATAMIENTO IMAGEN SELECCIONADA
//*************************************************************************************

// recogemos los datos del formulario en array $POST
$v1=strtoupper($_POST['nif']);
$v2=strtoupper($_POST['nombre']);
$v3=$_POST['edad'];
//$v4=substr($_POST['fecha'],6,4)."-".substr($_POST['fecha'],3,2)."-".substr($_POST['fecha'],0,2);
$v4=$_POST['fecha'];
$v5=$_POST['precio'];
$v6=strtoupper($_POST['info']);

//echo "<br><br>";
//echo "VALOR DNI: $v1 <br>"; 
//echo "VALOR NOMBRE: $v2 <br>"; 
//echo "VALOR EDAD: $v3 <br>"; 
//echo "VALOR FECHA: $v4 <br>"; 
//echo "VALOR PRECIO: $v5 <br>"; 
//echo "VALOR OBSERVACIONES: $v6 <br>"; 
//echo "IMAGEN: $foto_name <br>"; 

//  OJO -> los campos numéricos no llevan comillas -> OJO
$consulta="INSERT $tabla (DNI,NOMBRE,EDAD,FECHA, PRECIO, OBSERVACIONES,IMAGEN,BLOQUEO)
                         VALUES ('$v1','$v2',$v3,'$v4',$v5,'$v6','$foto_reconvertida','0')";

@mysqli_query($conexion,$consulta); 

# comprobamos el resultado de la insercion 
# el error CERO significa NO ERROR 
# el error 1062 significa Clave duplicada 

if (mysqli_errno($conexion)==0)
	{
	echo 1;
	}
else 
	{
	// aquí tratamos el error que se supone que será la clave duplicada	
	$numerror=mysqli_errno($conexion); 
	//$descrerror=mysqli_error($conexion); 
	
	// aquí podríamos devolver el nº de error
	echo $numerror;
	}	

//MUY IMPORTANTE
//siempre hay que hacer esto
//cerramos la conexion  con la base de datos
 mysqli_close($conexion); 
?>
