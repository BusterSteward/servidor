<html>

<?php

?>

<style type="text/css" media="screen">

body
{
	text-align: center;
}

h1
{
	color: blue;
	margin-top: 100px;
	margin-bottom: 5px;
}

#contenedor
{
	width: 300px;
	height: 200px;
	border: 2px solid green;
	margin: auto;
	text-align: center
}

#contador
{
	width: 200px;
	background-color: lightgrey;
	margin: 50px auto;
}

img
{
	width: 110px;
	height: 100px;
}

</style>

<head>
	<meta charset="UTF-8">
	<title>Contador</title>
</head>
<?php
function visita($cad){
	//compruebo que los ficheros existen y los abro para lectura
	$existo=file_exists($cad);
	
	if(!$existo)
		exit("No se ha encontrado el archivo");

	else{
		$fichero=fopen($cad,'r+'); 
		$contador = fread($fichero,filesize($cad));
		$contador = (int)$contador;
		$contador++;
		rewind($fichero);
		fwrite($fichero,$contador."");

		fclose($fichero);
		return $contador;
	}
	
}
?>
<body>

<h1>Contador de VISITAS</h1>
<div id="contenedor">
	<img src="smile.jpg">
	<div id="contador">Visitante N?: <?php  echo visita("cont.txt");?></div>
</div>



</body>
</html>