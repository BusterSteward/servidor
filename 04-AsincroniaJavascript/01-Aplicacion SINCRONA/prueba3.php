<?php 
	echo "Soy el SCRIPT-3: <br>Ya he terminado...<br><br>";
	sleep(3);
	$valor_pasado=$_GET['VALOR'];
	echo "Valor pasado=".$valor_pasado;
	// observa como tenemos que ocultar la estrella
	echo "<script>parent.oculto_estrella(3);</script>";
 ?>