<?php 
header('Content-Type: text/html; charset=UTF-8');

// la fecha en Español
setlocale(LC_TIME, 'spanish');

// incluimos la librería que vamos a utilizar
include('libreria/Cezpdf.php');

// incluimos la conexión a la base de datos
require('conexion.php');

//conexión a la Base de Datos
$resultado=mysqli_query($conexion,"select * from zapatos"); 


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
$INIT_RX=30;
$INIT_RY=600;

$INIT_RXI=40;
$INIT_RYI=695;

$INIT_RXT=170;
$INIT_RYT=755;

$INIT_RXP=400;
$INIT_RYP=400;

$INIT_RXTA=500;
$INIT_RYTA=665;

//coordenadas RECTÁNGULOS
$rx=$INIT_RX;
$ry=$INIT_RY;

//coordenadas IMAGEN
$rxi=$INIT_RXI;
$ryi=$INIT_RYI;

//coordenadas TEXTO
$rxt=$INIT_RXT;
$ryt=$INIT_RYT;

//coordenadas de algo
$rxp=$INIT_RXP;
$ryp=$INIT_RYP;

//coordenadas de tabla
$ryta=$INIT_RYTA;
//****************************************************
$TAM_LETRA=11;
$INTERLINEADO=20;

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
				$pdf->addJpegFromFile("logoManolito.jpg",30,790,283/2.5,96/2.5);
				$pdf->setColor(0,0,0);
				$pdf->addText(140,790,18,'Catálogo de STOCK.');
                $pdf->addText(370,790,12,'Impreso:');
                $pdf->setColor(0,0,1);
                $pdf->addText(420,790,12,$fechaActual);
				$pdf->setStrokeColor(179/255, 68/255, 27/255);
				$pdf->line(30,785,550,785);
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
        */
		//creo el fichero imagen a partir de la imagen almacenada en la base de datos
		// OJO:
		// siempre tendremos un fichero llamado "imagen1.jpg" -> después de la creación del listado podremos borrar el fichero
		file_put_contents("imagen1.jpg", $fila['IMAGEN1']); 
        $pdf->addJpegFromFile('imagen1.jpg', $rxi,$ryi,120,70);
        file_put_contents("imagen1.jpg", $fila['IMAGEN2']); 
        $pdf->addJpegFromFile('imagen1.jpg', $rxi,$ryi-85,120,70);

		// dibujamos un rectángulo
		// valores en puntos
		// rectangle(x1,y1,width,height)
		// coordenada y1 empezando desde abajo (mayor valor en y1->más arriba situado en la página)
		
		$pdf->setStrokeColor(0,0,1);
		$pdf->setLineStyle(1,'round'); 
		
		//******* imprimimos cuadros****************		
		$pdf->rectangle ($rx,$ry,520,180);

        $pdf->setStrokeColor(0,0,0);
		$pdf->setLineStyle(1,'round'); 

        $pdf->rectangle ($rxi,$ryi,120,75);
        $pdf->rectangle ($rxi,$ryi-85,120,75);
        
		
		$offset=42;
		//******* imprimimos texto****************
        
		$pdf->setColor(0,0,0);
		$pdf->addText($rxt+$offset*4,$ryt,$TAM_LETRA,'Fecha: ');
        $pdf->addText($rxt,$ryt,$TAM_LETRA,'Modelo: ');
		$pdf->addText($rxt+3,$ryt-$INTERLINEADO*2,$TAM_LETRA,'Horma: ');
		$pdf->addText($rxt+18,$ryt-$INTERLINEADO*3,$TAM_LETRA,'Piel: ');
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
		$pdf->addText(($rxt+$offset*6),$ryt-$INTERLINEADO*4.2,$TAM_LETRA*1.75,$fila['PRECIO']." €");
        

		$pdf->ezSetCmMargins(1,1,5.5,1.5);
		$data=[];
        $data[]=array(
            'T37'=>$fila["T37"],
            'T38'=>$fila["T38"],
            'T39'=>$fila["T39"],
            'T40'=>$fila["T40"],
            'T41'=>$fila["T41"],
            'T42'=>$fila["T42"],
            'T43'=>$fila["T43"],
            'T44'=>$fila["T44"],
            'T45'=>$fila["T45"],
            'T46'=>$fila["T46"],
            'T47'=>$fila["T47"],
            'T48'=>$fila["T48"],
            'PARES'=>$fila["UNIDADES"],
			'background_color' => array(0.9,0.9,0.5)
        );
        $data[]=array(
            'T37'=>"04",
            'T38'=>"05",
            'T39'=>"06",
            'T40'=>"07",
            'T41'=>"08",
            'T42'=>"09",
            'T43'=>"10",
            'T44'=>"11",
            'T45'=>"12",
            'T46'=>"13",
            'T47'=>"14",
            'T48'=>"15",
            'PARES'=>"PARES",
			'background_color' => array(0.9, 0.9, 0.7)
        );

        $titles = array(
            'T37'=>'37',
            'T38'=>'38',
            'T39'=>'39',
            'T40'=>'40',
            'T41'=>'41',
            'T42'=>'42',
            'T43'=>'43',
            'T44'=>'44',
            'T45'=>'45',
            'T46'=>'46',
            'T47'=>'47',
            'T48'=>'48',
            'PARES'=>'PARES');

        $options = array(
            'fontSize' => 7,
            'showHeadings' => 1,
			//'line'=> 1,
            'shaded' => 1,
            'gridlines' => 31, // modifica este número
            'xOrientation'=> 'center',
            'innerLineThickness' => 0.5,
			'outerLineThickness' => 0.5,
            'width'=>200,
            'cols'=>array(
                'T37'=>array('width'=>25,'justification'=>'center','bgcolor'=>[0.9, 0.9, 0.7],"border"=>1),
                'T38'=>array('width'=>25,'justification'=>'center','bgcolor'=>[0.9, 0.9, 0.7]),
                'T39'=>array('width'=>25,'justification'=>'center','bgcolor'=>[0.9, 0.9, 0.7]),
                'T40'=>array('width'=>25,'justification'=>'center','bgcolor'=>[0.9, 0.9, 0.7]),
                'T41'=>array('width'=>25,'justification'=>'center','bgcolor'=>[0.9, 0.9, 0.7]),
                'T42'=>array('width'=>25,'justification'=>'center','bgcolor'=>[0.9, 0.9, 0.7]),
                'T43'=>array('width'=>25,'justification'=>'center','bgcolor'=>[0.9, 0.9, 0.7]),
                'T44'=>array('width'=>25,'justification'=>'center','bgcolor'=>[0.9, 0.9, 0.7]),
                'T45'=>array('width'=>25,'justification'=>'center','bgcolor'=>[0.9, 0.9, 0.7]),
                'T46'=>array('width'=>25,'justification'=>'center','bgcolor'=>[0.9, 0.9, 0.7]),
                'T47'=>array('width'=>25,'justification'=>'center','bgcolor'=>[0.9, 0.9, 0.7]),
                'T48'=>array('width'=>25,'justification'=>'center','bgcolor'=>[0.9, 0.9, 0.7]),
                'PARES'=>array('width'=>34,'justification'=>'center','bgcolor'=>[0.9, 0.9, 0.7]))
            ); 


        $pdf->ezSetY($ryta);
        //$pdf->ezSetX(730);
		foreach ($data as &$row) {
			$row['background_color_cell'] = sprintf(
				'background-color: rgb(%d, %d, %d);',
				$row['background_color'][0] * 255,
				$row['background_color'][1] * 255,
				$row['background_color'][2] * 255
			);
		}
        $pdf->ezTable($data,$titles, '', $options);
		$pdf->ezSetCmMargins(1,1,1.5,1.5);
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
		
			$ry=$ry-190;
			$ryt=$ryt-190;
			$ryi=$ryi-190;
            $ryp=$ryp-190;
			$ryta=$ryta-190;
		
		$nRegistros++;
		
		//*************** PREGUNTO POR PÁGINA NUEVA*************
		// si ya he imprimido 5 libros en la página -> creo página nueva
		//*******************************************************
		if ($nRegistros>4)
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
            $ryp=$INIT_RYP;
			$ryta=$INIT_RYTA;
			//actualizar libros impresos
			$nRegistros=1;
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
$fichero = fopen('EjercicioLibre.pdf','wb');
fwrite ($fichero, $pdf);
fclose ($fichero);
?>