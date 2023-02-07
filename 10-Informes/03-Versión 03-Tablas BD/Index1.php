<?php 
header('Content-Type: text/html; charset=UTF-8');

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
$pdf->ezSetCmMargins(2,1,1.5,1.5); 


//************************************************************************
//			ESTABLECEMOS NUMERACIÓN DE PÁGINAS -> sólo hay que hacerlo 1 vez -> iremos actualizando $i
//************************************************************************
$i=1;
$pdf->setStrokeColor(0.4,0.1,0.1);

//ezStartPageNumbers(x,y,size,[pos],[pattern],[num])
//size: tamaño nº de página
//[pos]: izquierda o derecha
//[pattern]: '{PAGENUM} of {TOTALPAGENUM}'
//[num]: nº de página

$pdf->ezStartPageNumbers(565,43,11,'','{PAGENUM}',$i);

//************************************************************************
//							ESTABLECEMOS PIE
//************************************************************************
$pdf->line(30,40,570,40);
//$pdf->addText(30,32,12,'Documento Impreso: ' . date('D m/d/Y'));

// la fecha en Español
setlocale(LC_TIME, 'spanish');
$lafecha=strftime("%A %d de %B del %Y");
$pdf->addText(30,30,11,'Documento Impreso: '.$lafecha);

$i++;

//************************************************************************
//													DIBUJAMOS LA CABECERA (sólo de esta página)
//************************************************************************
// dibujamos cabecera
$pdf->selectFont('fonts/Helvetica');
$pdf->setColor(1,0,0);
$pdf->addText(45,790,18,'<b>Biblioteca:</b>');
$pdf->setColor(0,0,0);
$pdf->addText(140,790,18,'consulta de registros.');
//dibujar línea
$pdf->setStrokeColor(0,0,1);
$pdf->line(45,785,480,785);
$pdf->ezText("\n",10);$pdf->ezText("\n",10);

//************************************************************************
//conexión a la Base de Datos
//************************************************************************
$resultado=mysqli_query($conexion,"select ID,TITULO,AUTOR,EDITORIAL from libros"); 

//************************************************************************
//			LISTAMOS LOS REGISTROS DE LA BASE DE DATOS
//************************************************************************

//seleccionamos la fuente
$pdf->selectFont('fonts/Helvetica.afm');

// $fila = mysql_fetch_row($resultado)
// te devuelve un array con índices núméricos para los campos:
// $fila[0], $fila[1], etc...

// $fila = mysql_fetch_assoc($resultado)
// te devuelve un array asociativo (cadenas como índices) para los campos:
// $fila['campo_1'], $fila['campo_2'], etc...

// $fila = mysql_fetch_array($resultado)
// te devuelve un array con índices numéricos y asociativos
// El tema de ahorrar recursos viene justamente porque esta función genera los dos arrays anteriores.

// si lo hago así no corrijo el problema de los acentos
//while ($fila=mysql_fetch_assoc($resultado)) 
//{
//$datos[] = array_merge($fila);
//}


// lo hacemos así
while ($fila=mysqli_fetch_assoc($resultado)) 
{
$datos[]=array('ID'=>$fila['ID'], 'TITULO'=>$fila['TITULO'], 'AUTOR'=>$fila['AUTOR'], 'EDITORIAL'=>$fila['EDITORIAL']);
}

// listamos la tabla SIN $titles
// por defecto coge los campos para las columnas de la consulta de la base de datos
$pdf->ezTable($datos);

//************************************************************************
//************************************************************************
//************************************************************************
//								Creamos una PÁGINA NUEVA
//************************************************************************
//************************************************************************
//************************************************************************

$pdf->ezNewPage();

//************************************************************************
//							ESTABLECEMOS PIE
//************************************************************************

$pdf->setStrokeColor(0.4,0.1,0.1);
$pdf->line(30,40,570,40);

// la fecha en Español
setlocale(LC_TIME, 'spanish');
$lafecha=strftime("%A %d de %B del %Y");
$pdf->addText(30,30,11,'Documento Impreso: '.$lafecha);

// tenemos que ir actualizando el valor de $i para que el número de página sea el correcto
$i++;

//****************************************************************
//****************************************************************
// listamos la TABLA otra vez
//****************************************************************
//****************************************************************

$pdf->ezText("\n",10);$pdf->ezText("\n",10);

//************************** TÍTULO COLUMNAS******************************
// declaramos el siguiente array para especificar los títulos de las columnas de la tabla
 $titles = array('ID'=>'<b>Código</b>', 'TITULO'=>'<b>Título</b>', 'AUTOR'=>'<b>Autor</b>', 'EDITORIAL'=>'<b>Editorial</b>');
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
'xPos'=>490,
'rowGap' => 5,
'colGap' => 3,
'textCol' => array(0,0,1),
'titleFontSize' => 26,
'width'=>440,
'cols'=>array(
                 'ID'=>array('width'=>50,'justification'=>'left'),
                 'TITULO'=>array('width'=>180,'justification'=>'left'),
				 'AUTOR'=>array('width'=>140,'justification'=>'left'),
				 'EDITORIAL'=>array('width'=>70,'justification'=>'right'))
); 
//*************************************************************************

// dibujamos la tabla otra vez pero le pasamos los parámetros
$pdf->ezTable($datos,$titles, '', $options);

// color negro para que no afecte al nº de página
$pdf->setColor(0,0,0);

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
$fichero = fopen('Listado-1.pdf','wb');
fwrite ($fichero, $pdf);
fclose ($fichero);

 ?>