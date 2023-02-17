<?php
//***************************************************************
	// configuración INICIAL
	//***************************************************************

	header('Content-Type: text/html; charset=UTF-8');
	
	// la fecha en Español
	setlocale(LC_TIME, 'spanish');

	// incluimos la librería que vamos a utilizar
	include('libreria/Cezpdf.php');

	
	// iniciamos la session
    session_start();
	
	
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
	$nRegistros=0;
	
	//****************************************************
	
	
	//****************************************************
	// esta variable me indicará si tengo que dibujar cabecera
	// cuando tendré que dibujar cabecera??
	// cada vez que cree una página nueva
	$cabecera=true;
	$datosFactura=true;
	//****************************************************
	
	
	//****************************************************
	// para dibujar el nº de cada una de las páginas
	$npagina=1;
	//****************************************************
	
	//****************************************************
	// En este ejercicio lo dibujaremos todo por coordenadas
	//****************************************************
	//coordenadas iniciales
	//necesito coordenadas para el cuadro, las imagenes, el texto, la tabla y el icono
	$INIT_RX=45;
	$INIT_RY=640;
	
	$INIT_RXI=90;
	$INIT_RYI=645;
	
	$INIT_RXT=285;
	$INIT_RYT=810;
	
	
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
$desY=-105;

//****************************************************
//variables para el control del texto
$TAM_LETRA_PEQUEÑA=8;
$TAM_LETRA_GRANDE=14;
$INTERLINEADO=10;

function calcularAlineamiento($num){
	//$num=settype($num,'string');
	$digitos=strlen($num);
	
	return $digitos*8-32;
}




//****************************************************
$totalfactura=0;
$totalRegistros=count($_SESSION["ID"]);
//  con esta variable ($npagina) controlo el nº de páginas ejemplo que imprimo en el pdf 
foreach($_SESSION["ID"] as $id){

		$precio=number_format($_SESSION["PRECIO"][$id],2,".","");
		$unidades=$_SESSION["CANTIDAD"][$id];
		$subTotal=number_format($precio*$unidades,2,".","");
		$totalfactura+=$subTotal;
        if($datosFactura){
            $ry-=40;
            $ryi-=40;
            $ryt-=40;
			$pdf->addText($rxt,$ryt,$TAM_LETRA_PEQUEÑA,'Datos: ');
            $datosFactura=false;
			$fechaActual = date('Y-m-d');
			$pdf->addText($rxt-180,$ryt-$INTERLINEADO,$TAM_LETRA_PEQUEÑA,"FECHA DEL PEDIDO: ");
			$pdf->addText($rxt+70,$ryt-$INTERLINEADO,$TAM_LETRA_PEQUEÑA,$fechaActual);
			//$pdf->addText($rxt-180,$ryt-$INTERLINEADO*2,$TAM_LETRA_PEQUEÑA,"IDENTIFICADOR DE PEDIDO: ");
			//$pdf->addText($rxt+80,$ryt-$INTERLINEADO*2,$TAM_LETRA_PEQUEÑA,rand(10000,99999));
			$fechaNueva = date('Y-m-d',strtotime($fechaActual.' + 2 days'));
			$pdf->addText($rxt-180,$ryt-$INTERLINEADO*3,$TAM_LETRA_PEQUEÑA,"FECHA DE ENTREGA PREVISTA: ");
			$pdf->addText($rxt+70,$ryt-$INTERLINEADO*3,$TAM_LETRA_PEQUEÑA,$fechaNueva);

			
        }
		if ($cabecera)
		{
				//*****************
				// dibujamos cabecera
				//*****************
				$npagina++;
				
				$pdf->selectFont('fonts/Helvetica');
                /*$pdf->selectFont('fonts/C39HrP24DhTt');*/
				$pdf->addJpegFromFile("./imagenes/Logo.jpg",30,790,142,41);
				$pdf->setColor(0,0,0);
				$pdf->addText(200,790,17,'Factura de pedido.   ID:'.rand(10000,99999));
                $pdf->setColor(0,0,1);
				$pdf->setStrokeColor(0,0.9,0.75);
				$pdf->line(30,785,550,785);
				$pdf->ezText("\n",10);
				$pdf->setColor(0,0.9,0.75);
				$pdf->filledRectangle ($rx,$ry+105,500,15,array(0,0.9,0.75));
				$pdf->setStrokeColor(0,0,0);
				$pdf->setColor(0,0,0);
				$pdf->rectangle($rx,$ry+105,200,15);
				$pdf->addText($rx+50,$ry+107.5,$TAM_LETRA_GRANDE,"PRODUCTO");
				$pdf->rectangle($rx+200,$ry+105,100,15);
				$pdf->addText($rx+225,$ry+107.5,$TAM_LETRA_GRANDE,"PRECIO");
				$pdf->rectangle($rx+300,$ry+105,100,15);
				$pdf->addText($rx+315,$ry+107.5,$TAM_LETRA_GRANDE,"UNIDADES");
				$pdf->rectangle($rx+400,$ry+105,100,15);
				$pdf->addText($rx+415,$ry+107.5,$TAM_LETRA_GRANDE,"SUBTOTAL");
				$cabecera=false;
		}
		
		
        
		
		
		
		$pdf->setStrokeColor(0,0,0);
		$pdf->setLineStyle(1,'round'); 
		$pdf->setColor(0,0.7,0.75);
		//******* imprimimos cuadros****************		
		$pdf->filledRectangle ($rx,$ry,500,100,array(0,0.7,0.75));
		$pdf->rectangle($rx,$ry,200,100);
		$pdf->rectangle($rx+200,$ry,100,100);
		$pdf->rectangle($rx+300,$ry,100,100);
		$pdf->rectangle($rx+400,$ry,100,100);
        $pdf->setColor(0,0,1);
        $pdf->setStrokeColor(0,0,0);
		$pdf->setLineStyle(1,'round'); 
        //$pdf->rectangle ($rxi,$ryi,122,130);
        //$pdf->rectangle ($rxi,$ryi-85,120,75);
		file_put_contents("imagen1.jpg", base64_decode($_SESSION['IMAGEN'][$id])); 
		$pdf->addJpegFromFile('imagen1.jpg', $rxi,$ryi,100,90);
        $pdf->setColor(0,0,0);
		$alineamiento=calcularAlineamiento($precio);
		$pdf->addText($rxi+190-$alineamiento,$ryi+42,$TAM_LETRA_GRANDE,$precio." € ");
		$pdf->addText($rxi+300,$ryi+42,$TAM_LETRA_GRANDE,$unidades);
		$alineamiento=calcularAlineamiento($subTotal);
		$pdf->addText($rxi+395-$alineamiento,$ryi+42,$TAM_LETRA_GRANDE,$subTotal." € ");
		

		//$pdf->addText($rxi+308,$ryi+42,$TAM_LETRA_GRANDE,$unidades);
		
        
		if($nRegistros==$totalRegistros-1){
			
			$pdf->setStrokeColor(0,0,0);
			$pdf->setLineStyle(1,'round');
			$pdf->setColor(1,1,0);
			$pdf->filledRectangle($rx+200,$ry-20,300,15);
			$pdf->setColor(0,0,0);
			$pdf->rectangle($rx+200,$ry-20,200,15);
			$pdf->addText($rx+240,$ry-17.5,$TAM_LETRA_GRANDE,"TOTAL A PAGAR");
			$pdf->rectangle($rx+400,$ry-20,100,15);
			$totalfactura=number_format($totalfactura,2,".","");
			$alineamiento=calcularAlineamiento($totalfactura);
			$pdf->addText($rxi+395-$alineamiento,$ry-17.5,$TAM_LETRA_GRANDE,$totalfactura." € ");

		}
		
		
		//******* imprimimos texto****************
        /*
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
		}*/
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

		
		$ry+=$desY;
		$ryt+=$desY;
		$ryi+=$desY;
		
		
		
		$nRegistros++;
		
		//*************** PREGUNTO POR PÁGINA NUEVA*************
		// si ya he imprimido 5 libros en la página -> creo página nueva
		//*******************************************************
		if ($nRegistros%6==0&&$nRegistros<=$totalRegistros-1)
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
			
		}
		
}

    //pinto las celdas del total de factura




	//***************************************************************
	//						CREAMOS PDF EN PANTALLA Y FICHERO
	//  si tienes errorres y no sale nada -> ANULA la visualización por pantalla
	//***************************************************************
	$pdf->ezStream(); 

	// LISTAMOS EN PANTALLA
	$pdf = $pdf->ezOutput();
	// CREAMOS UN FICHERO
	$fichero = fopen('Factura-pedido.pdf','wb');
	fwrite ($fichero, $pdf);
	fclose ($fichero);
	
	//unlink('imagen1.jpg');
?>