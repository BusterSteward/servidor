<?php

require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('conexion_mail.php');
          
  // creamos objeto de correo
  $mail = new PHPMailer();
 
  //$mail->SMTPDebug =1;

  //********************** FORMATO ************************
  // Le dice a PHPMailer que vamos a usar HTML para enviar el correo
  $mail->IsHTML();
  
  //******************* DATOS CUENTA ************************
  // identificación de quien envía el correo
  // hay servidores que te obligan a identificarte para poder enviar correos
  // HOTMAIL y GMAIL te obligan a ello->SMTPAuth = true; 
  
  // habilitamos la AUTENTICACIÓN SMTP
  $mail->SMTPAuth = true;

  // datos de configuración de quien envía el correo
  $mail->Username=$Username; 
  $mail->Password=$Password;
  
  // para que el receptor sepa quien envía el correo
  $mail->From=$From;
  $mail->FromName=$FromName;
  
  //******************* CONFIGURACIÓN **************************
  // Establece el método para enviar el mensaje puede ser MAIL, SENDMAIL o SMTP 
  // Le indicamos que vamos a usar un servidor SMTP  
  $mail->Mailer = "smtp";
  // Establece Gmail como el servidor  de correo saliente ->SMTP
  $mail->Host = "smtp.gmail.com";

  // seguridad: capa de conexión segura (SSL-Secure Sockets Layer)
  $mail->SMTPSecure = 'ssl';


  // Establece el puerto del servidor SMTP de Gmail
  $mail->Port = 465;    // para 'ssl'

  
  // esto hay que ponerlo si el servidor no cuenta  con un certificado de seguridad SSL válido
  // obligatorio para PHP 5.6 o superior (certificado de seguridad SSL válido)
	$mail->SMTPOptions = array(
						'ssl' => array(
						'verify_peer' => false,
						'verify_peer_name' => false,
						'allow_self_signed' => true));

  // asunto del mensaje
  $mail->Subject = "mensaje de PRUEBA";						
						
  // TIEMPO DE ESPERA
  // el valor por defecto 10 de Timeout es un poco escaso ya que es una cuenta SMTP gratuita 
  // por tanto lo ponemos a 30  
  $mail->Timeout=30;

  //******************* DESTINATARIOS **************************    
  // configuramos a quien enviamos el correo
  // podemos poner más direcciones de correo
  // tendremos que hacer un "AddAddress" por cada dirección
  $mail->AddAddress($AddAddress);
  
  

  //****************** CONTENIDO CORREO ***********************  
  
	// TÉCNICA-2
   // parámetro-1: la imagen que quiero poner en el contenido del mensaje
   // parámetro-2: el id de la imagen que luego será puesto en el html donde quiero que aparezca "cid:milogo"
   // parámetro-3: es el nombre que recibe la imagen al descargarse 
   
   // es evidente que debe de existir el fichero 'cartel2.jpg' y 'cartel3.jpg' en el servidor
   // ¿ cómo se crea una imagen en disco a través de una imagen de un campo de base de datos ?
   // file_put_contents("imagen".$i.".jpg",$registro['IMAGEN']);
   $mail->AddEmbeddedImage('Cartel01.jpg', 'milogo1', 'Cartel01-A.jpg');
   $mail->AddEmbeddedImage('Cartel02.jpg', 'milogo2', 'Cartel02-A.jpg');   
   
   
  // FORMATO: html
  $mail->Body =" 
								<html> 
								<head> 
								<title></title> 
								</head> 
								<body> 
								<h1><b>Hola amigos!</b></h1>
								<br>
								<font face='Calibri' font color='red' size='4' font-weight: extra-bold>Esto es un mensaje de prueba con una IMAGEN</font>
								<br>
								<br>
								
								<font face='Calibri' font color='blue' size='2' font-weight: normal>
								<br>
								ENVÍO DE IMAGEN: TÉCNICA-1.<br><br>		
								<br>
								</font>
								<img src='http://i3.ytimg.com/vi/brrL2QxN_OU/hqdefault.jpg' >
								<br><br>
								
								<font face='Calibri' font color='blue' size='2' font-weight: normal>
								<br>
								ENVÍO DE IMAGEN: TÉCNICA-2.<br><br>
								</font>
								<img src='cid:milogo1'><br>
								<img src='cid:milogo2'><br>
								<br><br>		
								<font face='Calibri' font color='blue' size='2' font-weight: normal>
								Este cuerpo del mensaje es de prueba de envío de mails por PHP.<br>
								Habría que cambiarlo para poner tu propio cuerpo.</font>
								</body> 
								</html> 
								"; 

  //**************************************************
  // enviamos el mensaje
  $exito = $mail->Send();
  //**************************************************
  
  // comprobamos si hay problemas
  if(!$exito)
	{
		echo "Problemas enviando correo electrónico:";
		echo "<br/>".$mail->ErrorInfo;	
	}
	else
	{
		echo "Mensaje enviado correctamente";
	} 
?>
