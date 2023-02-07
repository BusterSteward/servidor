<?php 
header('Content-Type: text/html; charset=UTF-8');

//*****************************************************
// incluimos la librería que vamos a utilizar
// include('libreria/Cezpdf.php');
// AHORA ES OTRA LIBRERÍA
// OJO: para utilizar la funcionalidad de TABLAS -> "showimage"
include('libreria/CezTableImage.php');
//*****************************************************

// incluimos la conexión a la base de datos
require('conexion.php');

//*****************************************************
//creamos un nuevo OBJETO para crear el pdf
// OJO: -> ahora es distinto

// especificamos el tamaño del documento
// $pdf = new Cezpdf('a4');
$pdf = new CezTableImage("a4");

//*****************************************************

// especificamos los bordes exteriores
// ezSetCmMargins(top,bottom,left,right)
// valores en cm
$pdf->ezSetCmMargins(2,2,1.5,1.5); 


//************************************************************************
//													DIBUJAMOS LA CABECERA 
//************************************************************************
// dibujamos cabecera
$pdf->selectFont('fonts/Helvetica');
$pdf->setColor(1,0,0);
$pdf->addText(45,790,18,'<b>Biblioteca:</b>');
$pdf->setColor(0,0,0);
$pdf->addText(140,790,18,'consulta de registros.');
//dibujar línea
$pdf->setStrokeColor(0,0,1);
$pdf->line(45,785,520,785);
$pdf->ezText("\n",10);

//************************************************************************
//************************************************************************
//							problemas a la hora de poner esta información:
//							ESTABLECEMOS NUMERACIÓN DE PÁGINAS
//							ESTABLECEMOS PIE
//							EJERCICIO: añadir pie y nº de página en todas las hojas
//							¿Cómo se haría? -> alternativas
//************************************************************************
//************************************************************************
$i=1;
$pdf->setStrokeColor(0.4,0.1,0.1);

//ezStartPageNumbers(x,y,size,[pos],[pattern],[num])
//size: tamaño nº de página
//[pos]: izquierda o derecha
//[pattern]: '{PAGENUM} of {TOTALPAGENUM}'
//[num]: nº de página

$pdf->ezStartPageNumbers(565,43,11,'','{PAGENUM}',$i);

$pdf->line(30,40,570,40);
//$pdf->addText(30,32,12,'Documento Impreso: ' . date('D m/d/Y'));

// la fecha en Español
setlocale(LC_TIME, 'spanish');
$lafecha=strftime("%A %d de %B del %Y");
$pdf->addText(30,30,11,'Documento Impreso: '.$lafecha);

$i++;
//************************************************************************
//conexión a la Base de Datos 
//************************************************************************
$resultado=mysqli_query($conexion,"select ID,TITULO,AUTOR,PRECIO,IMAGEN from libros"); 

//************************************************************************
//			LISTAMOS LOS REGISTROS DE LA BASE DE DATOS -> CON IMAGEN
//************************************************************************

// para llevar la cuenta de los registros listados
// para introducir imágenes en la tabla -> todas las imágenes incluídas en la tabla deben de existir físicamente en la carpeta
// después de realizado el fichero pdf -> habrá que borrar todas esas imágenes
$nlibros=1;
while ($fila=mysqli_fetch_assoc($resultado)) 
{
	//creo el fichero imagen a partir de la imagen almacenada en la base de datos
	file_put_contents("imagen".$nlibros.".jpg", $fila['IMAGEN']); 
	// la imagen que quiero imprimir en cada iteración del bucle se llama así:
	$image = "imagen".$nlibros.".jpg";
	
	
	// $datos[]=array('LIBRO'=>'<C:showimage:'.$image.' 30>','ID'=>$fila['ID'], 'TITULO'=>$fila['TITULO'], 'AUTOR'=>$fila['AUTOR'], 'PRECIO'=>$fila['PRECIO']." €");
	
	// con DATOS DISTINTOS en la misma celda Y alineación vertical de celdas
	$datos[]=array('LIBRO'=>'<C:showimage:'.$image.' 30>'."\n ".$fila['ID'],'ID'=>"\n\n".$fila['ID'], 'TITULO'=>"\n\n".$fila['TITULO'], 'AUTOR'=>"\n\n".$fila['AUTOR'], 'PRECIO'=>"\n\n".$fila['PRECIO']." €");
	
	$nlibros++;
}

//************************** TÍTULO COLUMNAS******************************
// declaramos el siguiente array para especificar los títulos de las columnas de la tabla
 $titles = array('LIBRO'=>'<b>Libro</b>','ID'=>'<b>Código</b>', 'TITULO'=>'<b>Título</b>', 'AUTOR'=>'<b>Autor</b>', 'PRECIO'=>'<b>Precio</b>');
//*************************************************************************

//************************** CONFIGURACIÓN TABLA**************************
// opciones y configuración de la tabla
$options = array(
'showHeadings' => 1,
'fontSize' => 10,
'shaded'=>2,
'shadeCol2'=>array(0.7,0.8,1),
'shadeCol'=>array(0.9, 0.9, 0.7),
'xOrientation'=>'left',
'xPos'=>520,
'rowGap' => 5,
'colGap' => 3,
'textCol' => array(0,0,1),
'titleFontSize' => 26,
'width'=>440,
'cols'=>array(
				 'LIBRO'=>array('width'=>35,'justification'=>'left'),
				 'ID'=>array('width'=>50,'justification'=>'center'),
                 'TITULO'=>array('width'=>180,'justification'=>'left'),
				 'AUTOR'=>array('width'=>140,'justification'=>'left'),
				 'PRECIO'=>array('width'=>70,'justification'=>'center'))
); 
//*************************************************************************


//************************************************************************
// dibujamos la tabla con los parámetros
$pdf->ezTable($datos,$titles, '', $options);
//************************************************************************


//************************************************************************
//						CREAMOS PDF EN PANTALLA
//************************************************************************
$pdf->ezStream(); 

//************************************************************************
//						CREAMOS PDF EN FICHERO
//************************************************************************

// CREAMOS UN FICHERO
$pdf = $pdf->ezOutput();
// CREAMOS UN FICHERO
$fichero = fopen('Listado-2.pdf','wb');
fwrite ($fichero, $pdf);
fclose ($fichero);

// MUY IMPORTANTE
// borramos todos los ficheros de imagen generados
// también se puede crear una carpeta para generar dichos ficheros y luego borrar la carpeta
/*
$files = glob('*.jpg');
foreach($files as $file)
{
    if(is_file($file)) unlink($file);
}
*/
 ?>