<?php 
header('Content-Type: text/html; charset=UTF-8');

// la fecha en Español
setlocale(LC_TIME, 'spanish');

// incluimos la librería que vamos a utilizar
include('libreria/Cezpdf.php');

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
//coordenadas RECTÁNGULOS
$rx=45;
$ry=640;

//coordenadas IMAGEN
$rxi=60;
$ryi=650;

//coordenadas TEXTO
$rxt=215;
$ryt=720;
//****************************************************


//****************************************************
// numeración de páginas
$pdf->ezStartPageNumbers(492,790,10,'','Página: '.'{PAGENUM}',$npagina);
//****************************************************


//  con esta variable ($npagina) controlo el nº de páginas ejemplo que imprimo en el pdf 
while ($total_impresos<=43) 
{
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
				$pdf->addText(140,790,18,'Consulta de Registros.');
				$pdf->setStrokeColor(0,0,1);
				$pdf->line(45,785,535,785);
				$pdf->ezText("\n",10);
				$lafecha=strftime("%d de %B del %Y");
				$pdf->addText(340,790,10,'Impreso: ' . $lafecha);
				$cabecera=false;
		}

		// dibujamos un rectángulo
		// valores en puntos
		// rectangle(x1,y1,width,height)
		// coordenada y1 empezando desde abajo (mayor valor en y1->más arriba situado en la página)
		$pdf->setStrokeColor(0,0.3,0.6);
		$pdf->setLineStyle(1,'round'); 
		
		//******* imprimimos cuadros****************		
		$pdf->rectangle ($rx,$ry,140,120);
		$pdf->rectangle ($rx+160,$ry,330,120);
		
		//******* imprimimos texto****************
		$pdf->addText($rxt,$ryt,14,'Este es el LIBRO '.$total_impresos);
		
		//******* imprimimos imagen**************
		//$pdf->addJpegFromFile('imagenes/imagen1.jpg', $rxi,$ryi,70,100);
		
		// también nos podríamos plantear visualizar la imagen con -> $pdf->ezImage
		
		// siempre utilizamos las mismas 5 imágenes en todas las páginas
		$imagenaimprimir='imagenes/'.$nlibrosimpresos.'.jpg';
		$pdf->addJpegFromFile($imagenaimprimir,$rxi,$ryi,70,100);

		// actualizar coordenadas
		$ry=$ry-135;
		$ryt=$ryt-135;
		$ryi=$ryi-135;
		
		$nlibrosimpresos++;
		
		//*************** PREGUNTO POR PÁGINA NUEVA*************
		// si ya he imprimido 5 libros en la página -> creo página nueva
		//*******************************************************
		if ($nlibrosimpresos>5)
		{
			//creo página nueva
			$pdf->ezNewPage();
			//para pintar cabecera
			$cabecera=true;
			//coordenadas iniciales
			$rx=45;$ry=640;$rxi=60;$ryi=650;$rxt=215;$ryt=720;
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
$fichero = fopen('ListadoCUADROS.pdf','wb');
fwrite ($fichero, $pdf);
fclose ($fichero);
?>