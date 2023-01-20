<?php

	session_start();
	
	//sleep(1);
	usleep(400000);
	
	echo "<font color='black'>USUARIO: ".$_SESSION["user"]."</font><br>";
	if(isset($_SESSION["jugadas"])){
		echo "<font color='black'>Jugadas Realizadas: ".count($_SESSION["jugadas"])."</font><br>";
		echo "<table class='table'>";
		for($i=1;$i<=count($_SESSION["jugadas"]);$i++){
			$njugada=$i;
			if($njugada<10) $njugada="0".$njugada;

			$frutas=explode("/",$_SESSION["jugadas"][$i]);
			
			echo "<tr>
			<td style='background-color:pink; text-align:center;'>$njugada</td>
			<td><img width='50px' height='50px' src='./imagenes/".$frutas[0].".jpg'/></td>
			<td><img width='50px' height='50px' src='./imagenes/".$frutas[1].".jpg'/></td>
			<td><img width='50px' height='50px' src='./imagenes/".$frutas[2].".jpg'/></td>
			</tr>";
			
		}
		echo "</table>";
	}
	else{
		echo "<font color='black'>Jugadas Realizadas: 0</font><br>";
	}

?>