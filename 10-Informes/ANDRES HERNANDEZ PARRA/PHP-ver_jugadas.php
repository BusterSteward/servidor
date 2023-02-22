<?php

	session_start();
	
	//sleep(1);
	usleep(400000);
	
	if (isset($_SESSION['f1'][1])) {$numero_jugadas=count($_SESSION['f1']);}
	else {$numero_jugadas=0;}
	
	echo "Usuario: ".trim($_SESSION['username'])."<br>";
	echo "Jugadas Realizadas: ".$numero_jugadas;
	
	$i=1;
			
	//iniciamos la creación de la tabla
	echo "<table id='mitabla' width=200px style='padding-top:10px'>";
	
	
	while(isset($_SESSION['f1'][$i]))
	{
	
	  if ($i<10)
	  {echo "<tr>
	  <td width='50'  align='center'  style='background-color:#FA58F4;color:#FFFFFF';font-family:Calibri;>0".$i."</td>";}
	  else
	  {echo "<tr>
	  <td width='50'  align='center'  style='background-color:#FA58F4;color:#FFFFFF';font-family:Calibri;>".$i."</td>";}
	  
	  echo "
	  <td width='50' height='50' align='center' style='background-color:orange';><img style='cursor:pointer;width:48px;height:48px;vertical-align:middle' src='imagenes/".$_SESSION['f1'][$i].".jpg'>"."</td>";
	  echo "
	  <td width='50' height='50' align='center' style='background-color:orange';><img style='cursor:pointer;width:48px;height:48px;vertical-align:middle' src='imagenes/".$_SESSION['f2'][$i].".jpg'>"."</td>";
	  echo "
	  <td width='50' height='50' align='center' style='background-color:orange';><img style='cursor:pointer;width:48px;height:48px;vertical-align:middle' src='imagenes/".$_SESSION['f3'][$i].".jpg'>"."</td>";
	  $i++;
	}
	
	echo "</table>"; 
			
?>