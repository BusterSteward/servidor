<?php

  require 'src/PHPMailer.php';
  require 'src/SMTP.php';
  require 'src/Exception.php';

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  // incluimos la conexión a la base de datos
  require('conexion.php');
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
  
   // asunto del mensaje
  $mail->Subject = "prueba Base de Datos";		
  
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
  $mail->AddAddress($AddAddress);
   
  // VARIABLES
  // la tabla con todos los registros
  $datos="";
   
  //consulta que recupera los datos de la tabla1
  $consulta = "SELECT * FROM $tabla" ;
  $resultado = mysqli_query($conexion,$consulta);
  //numero de filas devueltas.
  $nRegistros = mysqli_num_rows($resultado);
  $registro = mysqli_fetch_array($resultado);
  
  //logo biblioteca
  $mail->AddEmbeddedImage('LogoBiblioteca.jpg', 'milogo', 'LogoBiblioteca.jpg');
  
  $i=1;
  while ($registro) 
  {
		//añado imagen de base de datos 
		file_put_contents("imagen".$i.".jpg",$registro['IMAGEN']);
		$mail->AddEmbeddedImage('imagen'.$i.'.jpg', 'milogo'.$i, 'imagen'.$i.'.jpg');
	
		//creo filas en la tabla que todavía NO EXISTE
		$datos = $datos.
					   "
					    <tr>  
						<td style='padding:5px 10px;background-color:#ffffff;text-align:center;font-size:14px;font-family:Arial;'><p><b>nº".$i."</b></p></td>
						<td style='padding:5px 10px;background-color:#ffffff;text-align:center;font-size:14px;font-family:Arial;'><img width='80px' height='80px' src='cid:milogo".$i."'/></td>
						<td style='padding:5px 10px;background-color:#ffffff;font-size:14px;font-family:Arial'>"
							."<strong>".$registro['DNI']."</strong><br>".$registro['NOMBRE']."<br>".$registro['EDAD']."
						</td>
						</tr>";
	    $registro = mysqli_fetch_array($resultado);
		$i++;
}	 							
 
  // cuerpo del mensaje
  $mail->Body =
					"<html> 
					<head> 
					<title></title> 
					</head> 
					<body> 
							<br><br>
							<img width='150px' height='49px' src='cid:milogo'/>
							<br>
							<font style='font-size:24px; font-weight: bold;font-family:Calibri; color:blue;'> Biblioteca de Navarra</font>
							<br><br>
	
							<font style='font-size:20px; font-weight: bold;font-family:Calibri; color:red;'> Listado de Socios:</font>
							<br>
	
							<table width='310' cellpadding='0' cellspacing='1' style='background-color:#dddddd;'>
							<tr>
								<td width='10' style='text-align:center;background-color:#eeeeee;padding:6px 10px;font-size:15px;font-family:Arial;font-weight: bold;'>Nº</td>
								<td width='100' style='text-align:center;background-color:#eeeeee;padding:6px 10px;font-size:15px;font-family:Arial;font-weight: bold;'>IMAGEN</td>
								<td width='200' style='background-color:#eeeeee;padding:6px 10px;font-size:15px;font-family:Arial;font-weight: bold;'>DATOS</td>
							</tr>".$datos."
							</table>
 
 
		  </body>
		  </html>";


  // enviamos el mensaje
  $exito = $mail->Send();
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
	
	// borramos las imagenes creadas para que se mostraran en el correo
	// han sido numeradas de 1 a x imagenes.
	
	$nimagen = 1;
	while ($nimagen<=$nRegistros)
	{
			
		$imgBorrar = 'imagen'.$nimagen.'.jpg';
		// borro imagen
		unlink($imgBorrar);
			
		$nimagen++;
	}
?>
