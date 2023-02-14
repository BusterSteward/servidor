<?php 	
	//***************************************************************
	// configuración INICIAL
	//***************************************************************

	header('Content-Type: text/html; charset=UTF-8');
	
	// la fecha en Español
	setlocale(LC_TIME, 'spanish');

	// incluimos la librería que vamos a utilizar
	include('libreria/Cezpdf.php');

	// incluimos la conexión a la base de datos
	require('conexion.php');
	$consulta="SELECT * FROM RELOJ";
	$resultado=mysqli_query($conexion,$consulta);

	// creamos un nuevo OBJETO para crear el pdf
	// especificamos el tamaño del documento
	$pdf = new Cezpdf('a4');

	// especificamos los bordes exteriores
	// ezSetCmMargins(top,bottom,left,right)
	// valores en cm
	$pdf->ezSetCmMargins(1,1,1.5,1.5); 


	//***************************************************************
	//														TU SCRIPT
	//***************************************************************


	//****************************************************
// es el nº de libros dentro de la página -> vamos a imprimir 5 libros por página
$nRegistros=1;

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

$fechaActual = date('d/m/y');
//****************************************************
// En este ejercicio lo dibujaremos todo por coordenadas
//****************************************************
//coordenadas iniciales
//necesito coordenadas para el cuadro, las imagenes, el texto, la tabla y el icono
$INIT_RX=45;
$INIT_RY=540;

$INIT_RXI=55;
$INIT_RYI=606;

$INIT_RXT=54;
$INIT_RYT=740;


//coordenadas RECTÁNGULOS
$rx=$INIT_RX;
$ry=$INIT_RY;

//coordenadas IMAGEN
$rxi=$INIT_RXI;
$ryi=$INIT_RYI;

//coordenadas TEXTO
$rxt=$INIT_RXT;
$ryt=$INIT_RYT;

$desX=166;
$desY=-245;

//****************************************************
//variables para el control del texto
$TAM_LETRA=11;
$INTERLINEADO=20;

//variable de control del espacio entre diferentes textos
$offset=42;
//****************************************************
// numeración de páginas
$pdf->ezStartPageNumbers(492,790,12,'','Página: '.'{PAGENUM}',$npagina);

//****************************************************
$numRegistros=mysqli_num_rows($resultado);
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
                /*$pdf->selectFont('fonts/C39HrP24DhTt');*/
				$pdf->addJpegFromFile("logoReloj.jpg",30,790,142,41);
				$pdf->setColor(0,0,0);
				$pdf->addText(180,790,17,'Catálogo de RELOJES.');
                $pdf->addText(370,790,12,'Impreso:');
                $pdf->setColor(0,0,1);
                $pdf->addText(420,790,12,$fechaActual);
				$pdf->setStrokeColor(179/255, 68/255, 27/255);
				$pdf->line(30,785,550,785);
				$pdf->ezText("\n",10);
				$cabecera=false;
		}
		
		
		file_put_contents("imagen1.jpg", $fila['IMAGEN']); 
        $pdf->addJpegFromFile('imagen1.jpg', $rxi,$ryi+10,110,110);
        
		
	
		
		$pdf->setStrokeColor(0,0,1);
		$pdf->setLineStyle(1,'round'); 
		
		//******* imprimimos cuadros****************		
		$pdf->rectangle ($rx,$ry,142,220);

        $pdf->setStrokeColor(0,0,0);
		$pdf->setLineStyle(1,'round'); 

        $pdf->rectangle ($rxi,$ryi,122,130);
        //$pdf->rectangle ($rxi,$ryi-85,120,75);
        
		
		
		//******* imprimimos texto****************
        
		$pdf->setColor(0,0,0);
		$pdf->addText($rxt,$ryt,$TAM_LETRA,'Modelo: ');
		$pdf->setColor(0,0,1);
        $pdf->addText($rxt+$offset,$ryt,$TAM_LETRA,$fila["MODELO"]);
		$pdf->addText($rxt,$ryt-$INTERLINEADO*7.25,$TAM_LETRA,$fila["DESCRIPCION"]);
		$pdf->setColor(1,0,0);
		$pdf->addText($rxt,$ryt-$INTERLINEADO*9.5,$TAM_LETRA+6,$fila["PRECIO"]. " €");

		$stock=$fila["UNIDADES"];
		if($stock>0){
			$pdf->addJpegFromFile("stock1.jpg",$rxt+$offset*1.75,$ryt-$INTERLINEADO*9.7,45,45);
		}
		else{
			$pdf->addJpegFromFile("stock2.jpg",$rxt+$offset*1.75,$ryt-$INTERLINEADO*9.7,45,45);
		}
		/*
		//$pdf->addText($rxt,$ryt-$INTERLINEADO*3,$TAM_LETRA,'PRECIO: ');
		$pdf->addText($rxt+15,$ryt-$INTERLINEADO*4,$TAM_LETRA,'Piso: ');
        
		

		$pdf->setColor(.25,0,1);
		$pdf->addText($rxt+$offset,$ryt,$TAM_LETRA,$fila['MODELO']);
        $pdf->setColor(0,0,0);
        $pdf->selectFont('fonts/C39HrP24DhTt');
        $pdf->addText($rxt+$offset,$ryt-$INTERLINEADO,$TAM_LETRA*2,$fila['MODELO']);
        $pdf->setColor(.25,0,1);
        $pdf->selectFont('fonts/Helvetica');
        
		$pdf->addText($rxt+$offset,$ryt-$INTERLINEADO*2,$TAM_LETRA,$fila['HORMA']);
		$pdf->addText($rxt+$offset,$ryt-$INTERLINEADO*3,$TAM_LETRA,$fila['PIEL']);
		//$pdf->addText($rxt+$offset,$ryt-$INTERLINEADO*3,$TAM_LETRA,$fila['PRECIO']." €");
		$pdf->addText($rxt+$offset,$ryt-$INTERLINEADO*4,$TAM_LETRA,$fila['PISO']);
        
		$pdf->setColor(1,0,0);
		$pdf->addText(($rxt+$offset*5)-5,$ryt,$TAM_LETRA,$fila['FECHA']);
		$pdf->addText(($rxt+$offset*6),$ryt-$INTERLINEADO*4.2,$TAM_LETRA+6,$fila['PRECIO']." €");
        */

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
		/*
        file_put_contents("imagen1.jpg", $fila['IMAGEN']); 

		//tamaño original de la imagen 156x156
		//ezImage(image,[padding],[width],[resize],[justification],[array border])

		$pdf->addJpegFromFile("imagen1.jpg",$rxi+$offsetDerecha,$ryi,70,85);
        */
		//$pdf->ezText("\n",10);
		/*
		$imagenaimprimir='imagenes/'.$nlibrosimpresos.'.jpg';
		$pdf->addJpegFromFile($imagenaimprimir,$rxi,$ryi,70,85);
		*/


		// actualizar coordenadas

			if($nRegistros%3==0){
				$ry+=$desY;
				$ryt+=$desY;
				$ryi+=$desY;

				$rx=$INIT_RX;
				$rxt=$INIT_RXT;
				$rxi=$INIT_RXI;
			}
			else{
				$rx+=$desX;
				$rxt+=$desX;
				$rxi+=$desX;
			}

		
		$nRegistros++;
		
		//*************** PREGUNTO POR PÁGINA NUEVA*************
		// si ya he imprimido 5 libros en la página -> creo página nueva
		//*******************************************************
		if ($nRegistros>9)
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
			$nRegistros=1;
		}
		
		// actualizamos el nº total de libros impresos
		$total_impresos++;
}















	//***************************************************************
	//						CREAMOS PDF EN PANTALLA Y FICHERO
	//  si tienes errorres y no sale nada -> ANULA la visualización por pantalla
	//***************************************************************
	$pdf->ezStream(); 

	// LISTAMOS EN PANTALLA
	$pdf = $pdf->ezOutput();
	// CREAMOS UN FICHERO
	$fichero = fopen('ListadoRelojes '.date('d-m-Y').'.pdf','wb');
	fwrite ($fichero, $pdf);
	fclose ($fichero);
	
	unlink('imagen1.jpg');
 ?>