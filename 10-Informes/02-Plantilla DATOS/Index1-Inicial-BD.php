<?php 
header('Content-Type: text/html; charset=UTF-8');

// la fecha en Español
setlocale(LC_TIME, 'spanish');

// incluimos la librería que vamos a utilizar
include('libreria/Cezpdf.php');

// incluimos la conexión a la base de datos
require('conexion.php');

// creamos un nuevo OBJETO para crear el pdf
// especificamos el tamaño del documento
$pdf = new Cezpdf('a4');

// especificamos los bordes exteriores
// ezSetCmMargins(top,bottom,left,right)
// valores en cm
$pdf->ezSetCmMargins(1,1,1.5,1.5); 

// dibujamos cabecera
$pdf->selectFont('fonts/Helvetica');
$pdf->ezText("Consulta de Registros:",18);
//dibujar línea
$pdf->line(45,785,450,785);

$pdf->ezText("\n",10);
$pdf->ezText("\n",10);
$pdf->selectFont('fonts/Helvetica.afm'); 


//conexión a la Base de Datos
$resultado=mysqli_query($conexion,"select * from libros"); 

//************************************************************************
//			LISTAMOS LOS REGISTROS DE LA BASE DE DATOS
//************************************************************************
while ($fila=mysqli_fetch_array($resultado))
{
	$pdf->ezText("ID: ".$fila['ID'],10);
	$pdf->ezText("TITULO: ".$fila['TITULO'],10);
	$pdf->ezText("AUTOR: ".$fila['AUTOR'],10);
	$pdf->ezText("PRECIO: ".$fila['PRECIO']." €",10);
	$pdf->ezText("EDITORIAL: ".$fila['EDITORIAL'],10);
	
	$pdf->ezText("IMAGEN: ",10);

	//creo el fichero imagen a partir de la imagen almacenada en la base de datos
	// OJO:
	// siempre tendremos un fichero llamado "imagen1.jpg" -> después de la creación del listado podremos borrar el fichero
	file_put_contents("imagen1.jpg", $fila['IMAGEN']); 

	//tamaño original de la imagen 156x156
	//ezImage(image,[padding],[width],[resize],[justification],[array border])
	$pdf->ezImage("imagen1.jpg", 20, 56,'none', 'left');
	$pdf->ezText("\n",10);
}

//************************************************************************
//						CREAMOS PDF EN PANTALLA
//************************************************************************
$pdf->ezStream(); 

//************************************************************************
//						CREAMOS PDF EN FICHERO
//************************************************************************
$pdf = $pdf->ezOutput();
// CREAMOS UN FICHERO
$fichero = fopen('ListadoBD.pdf','wb');
fwrite ($fichero, $pdf);
fclose ($fichero);


// MUY IMPORTANTE
// borro fichero "imagen1.jpg" en el servidor
unlink('imagen1.jpg');
 ?>