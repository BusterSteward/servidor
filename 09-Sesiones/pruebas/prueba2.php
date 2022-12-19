<?php
 session_start();
 if(isset($_SESSION['contador']))
 {
 // comprobamos si la variable "$_SESSION['contador']" está definida:
 // es decir si la SESIÓN se inició y la variable de SESIÓN "contador" fué creada
 $_SESSION['contador'] = $_SESSION['contador'] + 1;
 $mensaje = 'Número de visitas a esta página: ' . $_SESSION['contador'];
 }
 else
 {
 // si la variable de SESIÓN $_SESSION['contador'] no se ha creado
 // creo la variable de SESIÓN ya que anteriormente no fue creada
 $_SESSION['contador'] = 1;
 $mensaje = 'Bienvenido a nuestra Página Web-Pulsa F5 para recargar';
 }
?>
<head>
<meta charset="UTF-8"/>
<title>Contador</title>
</head>
<body>
<p>
<?php
 echo $mensaje;
 echo "<br>";
 echo "<p><a href='terminarsesion.php'>Terminar la sesión actual</a></p>";
 echo "<br><br>";
 // aquí alargamos la vida
 // echo "valor cookie: ".$_COOKIE['PHPSESSID'];
 // setcookie('PHPSESSID', session_id(), time()+999999);
?>
</body>
</html>