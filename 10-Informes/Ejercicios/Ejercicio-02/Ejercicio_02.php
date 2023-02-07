<?php 
header('Content-Type: text/html; charset=UTF-8');

// la fecha en Español
setlocale(LC_TIME, 'spanish');

// incluimos la librería que vamos a utilizar
include('libreria/Cezpdf.php');

// incluimos la conexión a la base de datos
require('conexion.php');

//conexión a la Base de Datos
$resultado=mysqli_query($conexion,"select * from libros"); 


// creamos un nuevo OBJETO para crear el pdf
// especificamos el tamaño del documento
$pdf = new Cezpdf('a4');

// especificamos los bordes exteriores
// ezSetCmMargins(top,bottom,left,right)
// valores en cm
$pdf->ezSetCmMargins(1,1,1.5,1.5); 


// VARIABLES utilizadas

//****************************************************
// es el nº de libros dentro de la página -> vamos a imprimir 5 libros por página
$nlibrosimpresos=1;

// es el "nº TOTAL DE LIBROS" que vamos a imprimir -> este ejemplo 43 libros
// 8 páginas completas y la página nº9 con 3 libros
$total_impresos=1;
//****************************************************


//****************************************************
// esta variable me indicará si tengo que dibujar cabecera
// cuando tendré que dibujar cabecera??
// cada vez que cree una página nueva
$cabecera=true;
//****************************************************


//****************************************************
// para dibujar el nº de cada una de las páginas
$npagina=1;
//****************************************************


//****************************************************
// En este ejercicio lo dibujaremos todo por coordenadas
//****************************************************
//coordenadas iniciales
$INIT_RX=35;
$INIT_RY=665;

$INIT_RXI=40;
$INIT_RYI=667;

$INIT_RXT=135;
$INIT_RYT=735;

//coordenadas RECTÁNGULOS
$rx=$INIT_RX;
$ry=$INIT_RY;

//coordenadas IMAGEN
$rxi=$INIT_RXI;
$ryi=$INIT_RYI;

//coordenadas TEXTO
$rxt=$INIT_RXT;
$ryt=$INIT_RYT;
//****************************************************
$TAM_LETRA=7;
$INTERLINEADO=12;

//****************************************************
// numeración de páginas
/*
$pdf->ezStartPageNumbers(492,790,10,'','Página: '.'{PAGENUM}',$npagina);
*/
//****************************************************

$numRegistros=mysqli_num_rows($resultado);
$derecha=false;
$offsetDerecha=0;
//  con esta variable ($npagina) controlo el nº de páginas ejemplo que imprimo en el pdf 
while ($total_impresos<=$numRegistros) 
{
	$fila=mysqli_fetch_array($resultado);
		if ($cabecera)
		{
				//*****************
				// dibujamos cabecera
				//*****************
				$npagina++;
				
				$pdf->selectFont('fonts/Helvetica');
				$pdf->setColor(1,0,0);
				$pdf->addText(45,790,18,'<b>Biblioteca:</b>');
				$pdf->setColor(0,0,0);
				$pdf->addText(140,790,18,'consulta de LIBROS.');
				$pdf->setStrokeColor(0,0,1);
				$pdf->line(45,785,535,785);
				$pdf->ezText("\n",10);
				$cabecera=false;
		}
		
		/*
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
*/
		// dibujamos un rectángulo
		// valores en puntos
		// rectangle(x1,y1,width,height)
		// coordenada y1 empezando desde abajo (mayor valor en y1->más arriba situado en la página)
		
		$pdf->setStrokeColor(0,0.3,0.6);
		$pdf->setLineStyle(1,'round'); 
		
		//******* imprimimos cuadros****************		
		$pdf->rectangle ($rx+$offsetDerecha,$ry,80,90);
		$pdf->rectangle ($rx+90+$offsetDerecha,$ry,165,90);
		
		//******* imprimimos texto****************

		$pdf->setColor(0,0,0);
		$pdf->addText($rxt+$offsetDerecha,$ryt,$TAM_LETRA,'ID: ');
		$pdf->addText($rxt+$offsetDerecha,$ryt-$INTERLINEADO,$TAM_LETRA,'TÍTULO: ');
		$pdf->addText($rxt+$offsetDerecha,$ryt-$INTERLINEADO*2,$TAM_LETRA,'AUTOR: ');
		//$pdf->addText($rxt,$ryt-$INTERLINEADO*3,$TAM_LETRA,'PRECIO: ');
		$pdf->addText($rxt+$offsetDerecha,$ryt-$INTERLINEADO*3,$TAM_LETRA,'EDITORIAL: ');

		$offset=50;
		$pdf->setColor(234/255,137/255,154/255);
		$pdf->addText($rxt+$offset+$offsetDerecha,$ryt,$TAM_LETRA,$fila['ID']);
		$pdf->addText($rxt+$offset+$offsetDerecha,$ryt-$INTERLINEADO,$TAM_LETRA,$fila['TITULO']);
		$pdf->addText($rxt+$offset+$offsetDerecha,$ryt-$INTERLINEADO*2,$TAM_LETRA,$fila['AUTOR']);
		//$pdf->addText($rxt+$offset,$ryt-$INTERLINEADO*3,$TAM_LETRA,$fila['PRECIO']." €");
		$pdf->addText($rxt+$offset+$offsetDerecha,$ryt-$INTERLINEADO*3,$TAM_LETRA,$fila['EDITORIAL']);

		$pdf->setColor(1,0,0);
		$pdf->addText(($rxt+$offset*1.9)+$offsetDerecha,$ryt-$INTERLINEADO*5.35,$TAM_LETRA*2,$fila['PRECIO']." €");


		
		/*
		$pdf->ezText("TITULO: ".$fila['TITULO'],10);
		$pdf->ezText("AUTOR: ".$fila['AUTOR'],10);
		$pdf->ezText("PRECIO: ".$fila['PRECIO']." €",10);
		$pdf->ezText("EDITORIAL: ".$fila['EDITORIAL'],10);
		*/
		
		//******* imprimimos imagen**************
		//$pdf->addJpegFromFile('imagenes/imagen1.jpg', $rxi,$ryi,70,100);
		
		// también nos podríamos plantear visualizar la imagen con -> $pdf->ezImage
		
		// siempre utilizamos las mismas 5 imágenes en todas las páginas
		file_put_contents("imagen1.jpg", $fila['IMAGEN']); 

		//tamaño original de la imagen 156x156
		//ezImage(image,[padding],[width],[resize],[justification],[array border])

		$pdf->addJpegFromFile("imagen1.jpg",$rxi+$offsetDerecha,$ryi,70,85);
		//$pdf->ezText("\n",10);
		/*
		$imagenaimprimir='imagenes/'.$nlibrosimpresos.'.jpg';
		$pdf->addJpegFromFile($imagenaimprimir,$rxi,$ryi,70,85);
		*/

		// actualizar coordenadas
		if($derecha){
			$derecha=false;
			$offsetDerecha=0;
			$ry=$ry-105;
			$ryt=$ryt-105;
			$ryi=$ryi-105;
		}
		else{
			$derecha=true;
			$offsetDerecha=260;
		}
		
		$nlibrosimpresos++;
		
		//*************** PREGUNTO POR PÁGINA NUEVA*************
		// si ya he imprimido 5 libros en la página -> creo página nueva
		//*******************************************************
		if ($nlibrosimpresos>14)
		{
			//creo página nueva
			$pdf->ezNewPage();
			//para pintar cabecera
			$cabecera=true;
			//coordenadas iniciales
			$rx=$INIT_RX;
			$ry=$INIT_RY;
			$rxi=$INIT_RXI;
			$ryi=$INIT_RYI;
			$rxt=$INIT_RXT;
			$ryt=$INIT_RYT;
			//actualizar libros impresos
			$nlibrosimpresos=1;
		}
		
		// actualizamos el nº total de libros impresos
		$total_impresos++;
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
$fichero = fopen('Ejercicio_02.pdf','wb');
fwrite ($fichero, $pdf);
fclose ($fichero);
?>