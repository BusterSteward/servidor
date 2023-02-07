<?php
// OJO: hay 2 formas de escribir o dibujar im�genes en el documento

// FORMA-1: con el puntero interno del objeto que empieza a situar los elementos en la parte superior
// FORMA-2: con coordenadas y situar las cosas donde queramos. 


// incluimos la librería que vamos a utilizar
include('libreria/Cezpdf.php');

// creamos un nuevo OBJETO para crear el pdf
// 1ª COSA IMPORTANTE->TAMAÑO DEL DOCUMENTO
$pdf = new Cezpdf('a4');


// 2ª COSA IMPORTANTE->MÁRGENES DEL DOCUMENTO
// especificamos los bordes márgenes
// ezSetCmMargins(top,bottom,left,right)
// valores en cm
$pdf->ezSetCmMargins(1,1,1.5,1.5); 

//************************************************************************
//						ESCRIBIMOS TEXTO
//************************************************************************

//seleccionamos la FUENTE
$pdf->selectFont('fonts/Helvetica.afm');
// seleccionamos el COLOR AZUL
$pdf->setColor(0.4,0.4,1);
//escribimos una cadena de texto con un tama�o 30 -> FORMA-1
$pdf->ezText('Mi primer pdf en PHP', 30);
// línea en blanco
$pdf->ezText("\n",10);

//************************************************************************
//						ESCRIBIMOS TEXTO
//************************************************************************

//seleccionamos la FUENTE
$pdf->selectFont('fonts/Times-Roman.afm');
// seleccionamos el COLOR ROSA
$pdf->setColor(1,0,1);
//escribimos una cadena de texto con un tama�o 20 -> FORMA-1
$pdf->ezText('Mi primer pdf en PHP', 20);
// línea en blanco
$pdf->ezText("\n",10);

//************************************************************************
//						ESCRIBIMOS TEXTO
//************************************************************************

//seleccionamos la FUENTE
$pdf->selectFont('fonts/Helvetica-Bold.afm');
// seleccionamos el COLOR ROJO
$pdf->setColor(1,0,0);
//escribimos una cadena de texto con un tama�o 10 -> FORMA-1
$pdf->ezText('Mi primer pdf en PHP', 10);
// línea en blanco
$pdf->ezText("\n",10);

//************************************************************************
//						ESCRIBIMOS TEXTO
//************************************************************************

//seleccionamos la FUENTE
$pdf->selectFont('fonts/Times-Italic.afm');
// seleccionamos el COLOR VERDE
$pdf->setColor(0,1,0);
//escribimos una cadena de texto con un tama�o 20 -> FORMA-1
$pdf->ezText('Mi primer pdf en PHP', 20);
// línea en blanco
$pdf->ezText("\n",10);

//************************************************************************
//						DIBUJAMOS UN RECT�NGULO
//************************************************************************

// "COLOR RELLENO RECT�NGULO"
// seleccionamos el color VERDE para rellenar el rect�ngulo
$pdf->setColor(0,1,0);

// "COLOR L�NEA RECT�NGULO"
// que es color AZUL
$pdf->setStrokeColor(0,0.3,0.6);

// seleccionamos el "ESTILO DE L�NEA" de la l�nea del rect�ngulo
// setLineStyle(grosor,tipo de l�nea); 

// l�nea continua
$pdf->setLineStyle(2,'round'); 
//l�nea discontinua
//$pdf->setLineStyle(2,'','',array(5));

// FORMA-2
// dibujamos un rect�ngulo, valores en px
// rectangle(x1,y1,width,height) (esta coordenada es el v�rtice inferior izquierdo del rect�ngulo)
// coordenada y1 empezando desde abajo (mayor valor en y1->m�s arriba situado en la p�gina)
// la parte de la p�gina "0" ser�a abajo y la parte de la p�gina"xxxx" ser�a arriba

// con esta instrucci�n dibujamos el "RELLENO" -> FORMA-2
$pdf->filledrectangle(40,540,500,60);
// con esta instrucci�n dibujamos la "L�NEA" -> FORMA-2
$pdf->rectangle (40,540,500,60);

//************************************************************************
//						ESCRIBIMOS TEXTO DENTRO DEL RECT�NGULO
//************************************************************************

//seleccionamos la FUENTE
$pdf->selectFont('fonts/Helvetica-Bold.afm');
// seleccionamos el COLOR ROJO
$pdf->setColor(1,0,0);

// escribimos TEXTO ahora con otra funci�n -> addText
// addText (x,y,size,text,[width=0],[justification='left'],[angle=0],[wordspace=0],[test=0)
// [angle=0] es el �ngulo que modifica la horizontalidad del texto
// [wordspace=0] es la separaci�n entre las palabras del texto
$pdf->addText(50,560,18,'Texto dentro del cuadro');

$pdf->addText(350,620,16,'El texto de prueba',0,'left',-10,9);

//************************************************************************
//						DIBUJAMOS DOS L�NEAS-UNA IMAGEN-TEXTO
//************************************************************************

// seleccionamos el COLOR para la L�NEA AZUL
$pdf->setStrokeColor(0,0,1);
// seleccionamos el ESTILO DE LA L�NEA
$pdf->setLineStyle(2,'round');
 
// Coordenadas de la l�nea (x1,y1) to (x2,y2)
// con estas 2 coordenadas definimos "tama�o" y "posici�n"

// FORMA-2
// l�nea superior
$pdf->line(40,500,540,500);
// l�nea inferior
$pdf->line(40,420,540,420);

// situamos el cursor VERTICAL Y donde nos interese
// hay funciones como "ezImage" donde no podemos indicar posici�n
// la imagen se inserta donde est� colocado el puntero VERTICAL(Y) 

// este es el puntero del documento
// NO SE VE -> PERO EXISTE, se actualiza solo
// si quiero cambiar el valor de este puntero lo puedo hacer con el m�todo "ezSetY"
$pdf->ezSetY(490);

// ******************************
// INSERTAR IMAGEN -> FORMA-1
// ******************************

// insertamos la imagen
//tama�o original de la imagen 156x156

// ANTES
// ezImage(image,[padding],[width],[resize],[justification],[array border])
// AHORA
// ezImage (image,[padding],[width],[resize],[justification], [angle],[array border])

// padding -> desplazamiento->(horizontal y vertical al mismo tiempo)
// $resize (optional) 'full', 'width', or 'none'.  el valor por defecto es 'full'.  
// $pdf->ezImage("1.jpg");


// OJO!!!!!!!!!
// *****************************************************************
// el padding modifica la coordenada X y la coordenada Y del cursor interno
// *****************************************************************

// aqu� el padding es 0
$pdf->ezImage("1.jpg",0, 60,'none','left',0);


// el padding restará 70 al cursor interno del documento
// para que al final el cursorY interno se quede al mismo valor, es decir, 490
// el cursor interno lo establecemos a 560-70=490
$pdf->ezSetY(560);

// aqu� el padding es 70
$pdf->ezImage("2.jpg", 70,60,'none', 'left',0);

// c�mo dibujamos una 3� imagen???
// el cursor interno lo establecemos a 630-140=490
$pdf->ezSetY(630);

// aqu� el padding es 140
$pdf->ezImage("3.jpg", 140,60,'none', 'left',0);

//seleccionamos la fuente
$pdf->selectFont('fonts/Helvetica-Bold.afm');
// seleccionamos el color ROSA
$pdf->setColor(1,0,1);

// escribimos el texto junto a la imagen
$pdf->addText(260,430,16,'Texto de prueba con la imagen');

//************************************************************************
//						INSERTAMOS TRES IM�GENES EJE HORIZONTAL -> FORMA-2
//************************************************************************

// "addJpegFromFile"
// nos permite insertar una imagen en la coordenada deseada:
// Par�metros: FileName, x, y, ancho, alto

$pdf->addJpegFromFile('1.jpg', 45, 292,60,60);
$pdf->addJpegFromFile('2.jpg', 140, 292,60,60);
$pdf->addJpegFromFile('3.jpg', 235, 292,60,60);

// insertamos 2 rect�ngulos de adorno: a la 1� IMAGEN y 3� IMAGEN

// COLOR->el que ten�amos antes seleccionado -> AZUL
$pdf->rectangle (40,287,70,70);

//2ªImagen
$pdf->rectangle(125,277,90,90);
// seleccionamos el COLOR ROJO
$pdf->setStrokeColor(1,0,0);
$pdf->rectangle (230,287,70,70);

//************************************************************************
//						INSERTAMOS M�S TEXTO con ACENTOS
//************************************************************************

//seleccionamos la fuente
$pdf->selectFont('fonts/Courier.afm');
// seleccionamos el color AZUL
$pdf->setColor(0,0,1);
// ajustamos el puntero vertical
$pdf->ezSetY(250);
//escribimos una cadena de texto con acentos y en negrita y con un tama�o 16
$pdf->ezText('<b>Mis palabras con acentos: Azúcar y Camión </b>', 16);

// si tenemos problemas con los acentos lo escribimos as�
//$text = utf8_decode('<b>Mis palabras con acentos: Az�car y Cami�n</b>');
//$pdf->ezText($text,16);

// l�nea en blanco
$pdf->ezText("\n",10);

//*******************************************
//						CREAMOS PDF EN PANTALLA
//*******************************************

//*******************************************
//OJO: -> PARA TODOS LOS EJERCICIOS
// si queremos ver ERRORES comentaremos la salida por pantalla
//*******************************************

//creamos el pdf en pantalla
$pdf->ezStream();

// VAMOS A CREAR UN FICHERO
$pdf = $pdf->ezOutput();
// CREAMOS UN FICHERO
$fichero = fopen('prueba.pdf','wb');
fwrite ($fichero, $pdf);
fclose ($fichero);
?>