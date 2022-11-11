<?php 
	sleep(2);
	// recuperamos valor con $_post
	$valor_pasado=$_POST['VALOR'];
	$valor_get=$_GET['valor2'];
	echo "Soy el SCRIPT-1: <br>Ya he terminado...<br><br>";
	echo "Valor pasado=".$valor_pasado."<br>";
	echo "Valor por get= ".$valor_get;
?>