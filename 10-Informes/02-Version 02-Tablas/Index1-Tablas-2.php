<?php
// incluimos la librería que vamos a utilizar
include('libreria/Cezpdf.php');

// creamos un nuevo OBJETO para crear el pdf
// especificamos el tamaño del documento
$pdf = new Cezpdf('a4');

// especificamos los bordes exteriores
// ezSetCmMargins(top,bottom,left,right)
// valores en cm
$pdf->ezSetCmMargins(1,1,1.5,1.5); 

// declaramos el siguiente array $data[] con los siguientes datos

$data[] = array('num'=>1, 'mes'=>'Enero','santo'=>'San Luis');
$data[] = array('num'=>2, 'mes'=>'Febrero','santo'=>'San Pedro');
$data[] = array('num'=>3, 'mes'=>'Marzo','santo'=>'San Marta');
$data[] = array('num'=>4, 'mes'=>'Abril','santo'=>'San Jorge');
$data[] = array('num'=>5, 'mes'=>'Mayo','santo'=>'San Nicomedes');
$data[] = array('num'=>6, 'mes'=>'Junio','santo'=>'San Pepe');
$data[] = array('num'=>7, 'mes'=>'Julio','santo'=>'San Dionisia');
$data[] = array('num'=>8, 'mes'=>'Agosto','santo'=>'San Poluto');
$data[] = array('num'=>9, 'mes'=>'Septiembre','santo'=>'San Perro');
$data[] = array('num'=>10, 'mes'=>'Octubre','santo'=>'San Carlos');
$data[] = array('num'=>11, 'mes'=>'Noviembre','santo'=>'San Carmina');
$data[] = array('num'=>12, 'mes'=>'Diciembre','santo'=>'San Elvis');
 
// declaramos el siguiente array para especificar los títulos de las columnas de la tabla
// si no indico esto -> los títulos de las cabeceras serán num,mes y santo 
$titles = array('num'=>'Id Mes', 'mes'=>'Mes', 'santo'=>'Santo');

// escribimos un TEXTO DE INICIO
$pdf->selectFont('fonts/Helvetica');
$pdf->setColor(0,0,1);
$pdf->addText(20,790,18,'Meses en PHP');
$pdf->setColor(1,0,0);
$pdf->addText(20,775,14,'Listado de Meses');

// establecemos el puntero vertical
$pdf->ezSetY(730);

//**********************************
// dibujamos la 1ª TABLA
//**********************************

// le pasamos ARRAY de datos -> $data
// le pasamos ARRAY de cabecera columnas -> $titles

$options = array(
'fontSize' => 10,
'showHeadings' => 1,
'shaded' => 1,
'gridlines' => 2, // modifica este número
'xOrientation'=> 'center',
'innerLineThickness' => 0.5,
'outerLineThickness' => 3,
'width'=>320,
'cols'=>array(
                 'num'=>array('width'=>50,'justification'=>'center'),
                 'mes'=>array('width'=>150,'justification'=>'right'),
				 'santo'=>array('width'=>120,'justification'=>'left'))
); 

$pdf->ezTable($data,$titles, 'cabecera de la tabla', $options);
$pdf->ezText("\n\n\n",10);

//**********************************
// dibujamos la 2ª TABLA
//**********************************

// dibujamos la tabla otra vez con opciones
// definimos la tabla $options para definir las opciones

// dibujamos la tabla
// ezTable(array data,[array cols],[title],[array options]

// $options is an associative array which can contain:
 
// 'showLines'=> 0,1,2, default is 1 (1->show the borders, 0->no borders, 2-> show borders AND lines between rows.)
// 'showHeadings' => 0 or 1
// 'shaded'=> 0,1,2, default is 1 (1->alternate lines are shaded, 0->no shading, 2->both sets are shaded)
// 'shadeCol' => (r,g,b) array, defining the colour of the shading, default is (0.8,0.8,0.8)
// 'shadeCol2' => (r,g,b) array, defining the colour of the shading of the second set, default is (0.7,0.7,0.7), used when 'shaded' is set to 2.
// 'fontSize' => 10
// 'textCol' => (r,g,b) array, text colour
// 'titleFontSize' => 12
// 'rowGap' => 2 , the space between the text and the row lines on each row
// 'colGap' => 5 , the space between the text and the column lines in each column
// 'lineCol' => (r,g,b) array, defining the colour of the lines, default, black.
// 'xPos' => poniendo un valor sin comillas te pone la tabla donde quieras en el eje x ->'xPos'=>510
// 'xOrientation' => 'left','right','center','centre', position of the table w.r.t 'xPos'. This entry is to be used in conjunction with 'xPos' to give control over the lateral position of the table.
// 'width' => <number>, the exact width of the table, the cell widths will be adjusted to give the table this width.
// 'maxWidth' => <number>, the maximum width of the table, the cell widths will only be adjusted if the table width is going to be greater than this.
// 'cols' => array(<colname>=>array('justification'=>'left','width'=>100,'link'=><linkColName>),<colname>=>....) ,allow the setting of other paramaters for the individual columns, each column can have its width and/or its justification set.
// 'innerLineThickness' => <number>, the thickness of the inner lines, defaults to 1
// 'outerLineThickness' => <number>, the thickness of the outer lines, defaults to 1
// 'protectRows' => <number>, the number of rows to keep with the heading, if there are less than this on a page, then all is moved to the next page.
// 'evenColumns' => 0, 1, 3, Set set all columns to the same widths, version 0.12.44
// 'evenColumnsMin' => , the minimum width a column should have
// 'shadeHeadingCol'=>(r,g,b) array, defining the backgound color of headings, default is empty
// 'gridlines'=> EZ_GRIDLINE_* default is EZ_GRIDLINE_DEFAULT, overrides 'showLines' to provide finer control
// 'alignHeadings' => 'left','right','center'
// 'evenColumns' => 0,1 make all column width the same size

$options = array(
'fontSize' => 10,
'showHeadings' => 1,
'showBgCol' => 1,
'shadeHeadingCol' => [0.6, 0.6, 0.5],
'xOrientation'=> 'center',
'rowGap' => 5,
'colGap' => 3,
'width'=>320,
'cols'=>array(
                 'num'=>array('width'=>50,'justification'=>'center'),
                 'mes'=>array('width'=>150,'justification'=>'right','bgcolor' => [0.9, 0.9, 0.7]),
				 'santo'=>array('width'=>120,'justification'=>'left','bgcolor' => [0.6, 0.4, 0.3]))
); 

// dibujamos la tabla otra vez
// le pasamos ARRAY de datos -> $data
// le pasamos ARRAY de cabecera columnas -> $titles
// le pasamos -> Texto de cabecera
// le pasamos ARRAY de opciones -> $options

$pdf->ezTable($data,$titles, 'cabecera de la tabla', $options);
$pdf->ezText("\n\n\n",10);

// insertamos fecha y hora
$pdf->ezText("<b>Fecha:</b> ".date("d/m/Y"),10);
$pdf->ezText("<b>Hora:</b> ".date("H:i:s")."\n\n",10);

//************************************************************************
//			VISUALIZAMOS EL PDF EN PANTALLA Y ADEMÁS CREAMOS UN FICHERO
//************************************************************************

// creamos el pdf
// SE VISUALIZA EN PANTALLA
$pdf->ezStream();

// VAMOS A CREAR UN FICHERO
$pdf = $pdf->ezOutput();
// CREAMOS UN FICHERO
$fichero = fopen('prueba-2.pdf','wb');
fwrite ($fichero, $pdf);
fclose ($fichero);

?>