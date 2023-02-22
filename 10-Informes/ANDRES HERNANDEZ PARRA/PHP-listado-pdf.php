<?php
// OJO: hay 2 formas de escribir o dibujar im�genes en el documento

// FORMA-1: con el puntero interno del objeto que empieza a situar los elementos en la parte superior
// FORMA-2: con coordenadas y situar las cosas donde queramos. 


// incluimos la librería que vamos a utilizar
include('libreria/Cezpdf.php');

session_start();
// creamos un nuevo OBJETO para crear el pdf
// 1ª COSA IMPORTANTE->TAMAÑO DEL DOCUMENTO
$pdf = new Cezpdf('a4');
$impresos=0;

$desX=75;
$desY=-230;

// 2ª COSA IMPORTANTE->MÁRGENES DEL DOCUMENTO
// especificamos los bordes márgenes
// ezSetCmMargins(top,bottom,left,right)
// valores en cm
$pdf->ezSetCmMargins(1,1,1.5,1.5); 



//seleccionamos la FUENTE
$pdf->selectFont('fonts/Helvetica.afm');
// seleccionamos el COLOR VERDE

//escribimos una cadena de texto con un tama�o 20 -> FORMA-1

$pdf->setColor(0,0,0);

//coordenadas   
    $INIT_RX=75;
	$INIT_RY=660;
	
	$INIT_RXT=45;
	$INIT_RYT=810;

    $rx=$INIT_RX;
    $ry=$INIT_RY;

    $rxt=$INIT_RXT;
    $ryt=$INIT_RYT;



$pdf->setStrokeColor(0,0,0);


$pdf->setLineStyle(2,'round'); 
$nRegistros=count($_SESSION["f1"]);

$pdf->addText($rxt,$ryt,30,"Consulta de Jugadas");
$pdf->addText($rxt,$ryt-30,20,"Usuario:  ");

$pdf->addText($rxt,$ryt-50,20,"Jugadas: ");
$pdf->setColor(0,0,1);

$pdf->addText($rxt+90,$ryt-30,20,$_SESSION["username"]);
$pdf->setColor(1,0,0);

$pdf->addText($rxt+90,$ryt-50,20,$nRegistros);

$pdf->setColor(0,0,0);
foreach($_SESSION["f1"] as $id){
   

    $pdf->rectangle($rx,$ry,65,50);
    $pdf->rectangle($rx,$ry-170,65,160);

    $aux=$impresos+1;
    if($aux<10){
        $aux="0".$aux;
    }
    $pdf->addText($rx+16,$ry+14,30,$aux);
    $pdf->addJpegFromFile("./imagenes/".$_SESSION["f1"][$id].".jpg",$rx+14,$ry-60,40,40);
    $pdf->addJpegFromFile("./imagenes/".$_SESSION["f2"][$id].".jpg",$rx+14,$ry-110,40,40);
    $pdf->addJpegFromFile("./imagenes/".$_SESSION["f3"][$id].".jpg",$rx+14,$ry-160,40,40);


    $impresos++;
    

    $rx+=$desX;

    //actualizo coordenadas
    if($impresos%5==0){
        $rx=$INIT_RX;
        $ry+=$desY;
    }

}


$pdf->ezStream();

// VAMOS A CREAR UN FICHERO
$pdf = $pdf->ezOutput();
// CREAMOS UN FICHERO
$fichero = fopen('ListadoDeJugadas.pdf','wb');
fwrite ($fichero, $pdf);
fclose ($fichero);
?>