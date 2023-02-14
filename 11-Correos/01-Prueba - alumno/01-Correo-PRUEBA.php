<?php

require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


// *********************************************************
// ********** ENVIAR CORREOS CON PHP ***********************
// *********************************************************

// Hay Dos formas de enviar un correo con PHP

// (1) Función mail() PHP
// como trabajo suplementario -> puedes intentar configurar un servidor de correo en -> tu Servidor Apache
// Ejemplo:
// mail("pepe@hotmail.com,maria@gmail.com","asuntillo","Este es el cuerpo del mensaje") 

// Esta forma tiene muchas limitaciones y es dificultosa
// - Hay que tener perfectamnte configurado en PHP.INI un servidor SMTP de correo (dificultoso)
// - No soporta autenticación SMTP (eleva nivel de seguridad en el envío de correos)
// - Dificultad para envío de mensajes en formato HTML
// - Dificultad para adjuntar documentos o ficheros


// (2) Librería PHPMailer()
// Todo resulta más sencillo y disponemos de muchas opciones

// (nota-1): Puedo utilizar mi propio servidor de correo-saliente (SMTP)
// (nota-2): Puedo utilizar mi propio servidor de correo-saliente por ejemplo de una cuanta de gmail
// **********************************************************
// **********************************************************




// ************** CONFIGURACIÓN PHP.INI *************************************
// si utilizamos este método (Librería PHPMAILER) no hace falta tocar nada del PHP.ini

// ESTO SIEMPRE HAY QUE TOCARLO (línea 921)
// capa de conexión segura (SSL-Secure Sockets Layer)
// extension=php_openssl.dll 
// **************************************************************************

// ************** CONFIGURACIÓN PHP.INI *************************************
// si utilizamos (MAIL function)
// SERVIDOR DE CORREO SMTP
// SMTP = smtp.gmail.com
// PUERTO
// smtp_port = 465
// Identificación de quien envía el correo
// sendmail_from = php_ini_jorgeProfe@gmail.com

// *********************************************************
// ************** FIN CONFIGURACIÓN PHP.INI *********************
// *********************************************************


// *********************************************************
// ******* CONFIGURACIÓN CUENTA GMAIL ********************
// *********************************************************

// tienes que acceder a GMAIL e identificarte con usuario y password
// una vez logeado ir a la siguiente dirección y CONFIGURAR SEGURIDAD
// https://myaccount.google.com/
// Menú seguridad ->
// Acceso de aplicaciones poco seguras->
// acceso de aplicaciones menos seguras->activado (si)

// Configuración de SMTP de Google-Información adicional
// https://support.google.com/a/answer/176600?hl=es
// **********************************************************
// **********************************************************

          
 // creamos objeto de correo
 $mail = new PHPMailer();
 
 // para ver los mensajes y diálogo entre servidor local y servidor de correo
 // se pueden poner varios valores según información deseda
 $mail->SMTPDebug =2;
 
 // hay 2 tipos de formato de envío a la hora de enviar un correo electrónico
 //  TEXTO (IsSMTP()) y HTML (IsHTML());
 // OJO: probar los dos...
  
  
  
  //********************** FORMATO ************************
  // Le dice a PHPMailer que vamos a usar TEXTO para enviar el correo
  // $mail->IsSMTP();

  // Le dice a PHPMailer que vamos a usar HTML para enviar el correo
  $mail->IsHTML();

  // Número máximo de caracteres que tendrá cada linea
  $mail->WordWrap = 50;   
  //******************* DATOS CUENTA ************************
  // identificación de quien envía el correo
  // hay servidores que te obligan a identificarte para poder enviar correos
  // HOTMAIL y GMAIL te obligan a ello->SMTPAuth = true; 
  
  // habilitamos la AUTENTICACIÓN SMTP
  $mail->SMTPAuth = true;
  
  //************************************************************************
  // datos de configuración de quien envía el correo
  $mail->Username = "tu mail"; 
  $mail->Password = "tu contraseña";
  
  // para que el receptor sepa quien envía el correo
  $mail->From = "tu mail";
  $mail->FromName = "tu nombre";
  
  // asunto del mensaje
  $mail->Subject = "tu asunto";  
  //************************************************************************
  
  //******************* CONFIGURACIÓN **************************
  // Establece el método para enviar el mensaje puede ser MAIL, SENDMAIL o SMTP 
  // Le indicamos que vamos a usar un servidor SMTP  
  $mail->Mailer = "smtp";
  // Establece Gmail como el servidor  de correo saliente ->SMTP
  $mail->Host = "smtp.gmail.com";

  // seguridad: capa de conexión segura (SSL-Secure Sockets Layer)
  $mail->SMTPSecure = 'ssl';
  //$mail->SMTPSecure = 'tls';

  // Establece el puerto del servidor SMTP de Gmail
  $mail->Port = 465;    // para 'ssl'
  //$mail->Port = 587; // para 'tls'
  
  // en caso de error de conexión (en algunos casos no da error):
  // esto hay que ponerlo si el servidor no cuenta  con un certificado de seguridad SSL válido
  // obligatorio para PHP 5.6 o superior (certificado de seguridad SSL válido)
	$mail->SMTPOptions = array(
						'ssl' => array(
						'verify_peer' => false,
						'verify_peer_name' => false,
						'allow_self_signed' => true));

  // TIEMPO DE ESPERA
  // el valor por defecto 10 de Timeout es un poco escaso ya que es una cuenta SMTP gratuita 
  // por tanto lo ponemos a 30  
  $mail->Timeout=30;

  //******************* DESTINATARIOS **************************    
  // configuramos a quien enviamos el correo
  // podemos poner más direcciones de correo
  // tendremos que hacer un "AddAddress" por cada dirección
  $mail->AddAddress("destinatario@gmail.com");
  
  

    //****************** CONTENIDO CORREO ***********************  
  
  // FORMATO: texto puro
  //$mail->Body ="HOLA PEPE-ESTO ES UNA PRUEBA";
  
  
  // FORMATO: html
  $mail->Body =" 
								<html> 
								<head> 
								<title></title> 
								</head> 
								<body> 
								<h1><b>Hola amigos!</b></h1>
								<br>
								<font face='Calibri' font color='red' size='4' font-weight: extra-bold>Esto es un mensaje de prueba</font>
								<br>
								<br>
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
	}
	else
	{
		echo "Mensaje enviado correctamente";
	} 
	echo "<br/>".$mail->ErrorInfo;		
?>
