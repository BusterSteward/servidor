<?php

require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

          
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
  
  //************************************************************************
  // datos de configuración de quien envía el correo
  $mail->Username = "bustersteeward24@gmail.com"; 
  $mail->Password = "Jinjuriki_1997";
  
  // para que el receptor sepa quien envía el correo
  $mail->From = "bustersteeward24@gmail.com";
  $mail->FromName = "andres";
  
  // asunto del mensaje
  $mail->Subject = "asunto";  
  //************************************************************************
  
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

  // TIEMPO DE ESPERA
  // el valor por defecto 10 de Timeout es un poco escaso ya que es una cuenta SMTP gratuita 
  // por tanto lo ponemos a 30  
  $mail->Timeout=30;

  //******************* DESTINATARIOS **************************    
  // configuramos a quien enviamos el correo
  // podemos poner más direcciones de correo
  // tendremos que hacer un "AddAddress" por cada dirección
  $mail->AddAddress($Address);
  
  

  //****************** CONTENIDO CORREO ***********************  
   
  // FORMATO: html
  $mail->Body =""; 

  // otra forma de hacerlo
  // FORMATO: html	
  $message  ="<!DOCTYPE html PUBLIC '-//W3C//DTD HTML 4.01//EN' 'https://www.w3.org/TR/html4/strict.dtd'>";
  
   $message  = "<html><body>";
   
   $message .= "<table width='100%' bgcolor='darkturquoise' cellpadding='0' cellspacing='0' border='0'>";
   $message .= "<tr><td>";
   $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";
    
   $message .= "<thead>
      <tr height='80'>
       <th colspan='4' style='background-color:#f5f5f5; border-bottom:solid 1px #bdbdbd; font-family:Calibri; color:navy; font-size:34px;' >Programacion.net</th>
      </tr>
      </thead>";
    
   $message .= "<tbody>
      <tr align='center' height='50' style='font-family:Calibri;'>
		   <td style='background-color:#00a2d1; text-align:center;'><a href='http://programacion.net/articulos/c' style='color:#fff; text-decoration:none;'>C</a></td>
		   <td style='background-color:#00a2d1; text-align:center;'><a href='http://programacion.net/articulos/php' style='color:#fff; text-decoration:none;'>PHP</a></td>
		   <td style='background-color:#00a2d1; text-align:center;'><a href='http://programacion.net/articulos/ASP' style='color:#fff; text-decoration:none;' >ASP</a></td>
		   <td style='background-color:#00a2d1; text-align:center;'><a href='http://programacion.net/articulos/java' style='color:#fff; text-decoration:none;' >Java</a></td>
      </tr>
      
      <tr>
		   <td colspan='4' style='padding:15px;' align='center' >
		   <p style='font-size:20px;'>Hola Manolito... Bienvenido!!!</p>
		   <hr />
		   <p style='font-size:25px;'>Envío de HTML eMail usando <b>PHPMailer</b></p>
		   <img src='https://spammer.ro/blog/wp-content/uploads/2019/09/php-mailer-330x330.png' 
			style='height:auto; width:60%; max-width:60%;' />

			<p style='font-size:22px; font-weight: bold;font-family:Calibri; color:blue;'>".
			'¿Qué quieres hacer hoy?'."</p>	

			<p style='font-size:18px; font-family:Calibri;'>".
			'<b>Desarrollo web</b> es un término que define la creación de <b>sitios web</b> para Internet o una intranet. 
			 Para conseguirlo se hace uso de tecnologías de software del lado del <b>servidor</b> y del <b>cliente</b> que involucran una combinación
			 de procesos de <b>base de datos</b> con el uso de un <b>navegador web</b> a fin de realizar determinadas tareas o mostrar información
			 configurando el acceso en una base de datos.'."</p>

			<p style='font-size:22px; font-weight: bold;font-family:Calibri; color:red;'>".
			'¿Aprendemos algo...?'."</p>			 
			</td>
      </tr>
      </tbody>";
    
   $message .= "</table>";
   // hace falta doble  "</table>" para que lo del virus salga fuera
   // prueba a quitar
   $message .= "</table>";
   $message .= "</body></html>";

   $mail->Body=$message;

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
