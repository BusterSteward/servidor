<?php

// OJO: cuando almacenamos una imagen (recuperada de la BD) en $_SESSION se hace así ->
// $_SESSION[][]=base64_encode($registro['IMAGEN']);

// OJO: cuando visualizo una imagen almacenada en $_SESSION se hace así ->
// <img style='width:30px;height:43px' src='data:image/jpeg;base64,".addslashes($_SESSION[][])."'>

//usleep(400000);

#--------------------------------------------------------------------------
# iniciamos SESIÓN
#--------------------------------------------------------------------------
session_start();

// calculo el nº de "artículos" que hay en el carro
if (isset($_SESSION['ID'])) {$elementos=count($_SESSION['ID']);}
else {$elementos=0;}

// para almacenar el total de la factura
$totalfactura=0;


echo "<table class='table' id='mitabla' style='border:0px solid red;margin-bottom:10px;'>";
echo "
<tr>  
<th>Codigo</th>  
<th>Imagen</th>  
<th>&nbspDescripción1</th>  
<th>&nbspDescripción2</th>  
<th>Cantidad</th>  
<th>Borro</th>  
<th>Precio&nbsp</th>  
<th>Total&nbsp</th>  
</tr>";  

#--------------------------------------------------------------------------
# visualizamos los registros de $_SESSION en una tabla
#--------------------------------------------------------------------------

// los índices de las columnas de $_SESSION son -> 0,1,2,3,4

// revisa el tema de Sintaxis->Arrays
foreach($_SESSION['ID'] as $x)
{
		echo "
		<tr>  
			  <td style='background-color:#FAC4FA;color:#0404B4';>".$_SESSION['ID'][$x]."</td>  
			  
			  <td style='background-color:white;'>  
			  <img style='width:30px;height:43px' src='data:image/jpeg;base64,".addslashes($_SESSION['IMAGEN'][$x])."'></td>
			
			  <td style='background-color:#A9E2F3;color:#0404B4';>&nbsp".$_SESSION['TITULO1'][$x]."</td>  
			  
			  <td style='background-color:#A9E2F3;color:#0404B4';>&nbsp".$_SESSION['TITULO2'][$x]."</td>  
			
			  <td style='background-color:#ACFA58;color:#0404B4';>
			  <select>";
			  for($i=1;$i<=10;$i++){
				if($i==$_SESSION['CANTIDAD'][$x]){
					echo "<option value='$i' selected>$i</option>";
				}
				else
					echo "<option value='$i'>$i</option>";
			  }
			  echo "</select></td>

			 <td style='background-color:#F6CEF5;color:#29088A';>
			  <a href='#'><img style='width:40px;height:40px' src='imagenes/papelera.png'></a></td>			
			  
			  <td style='background-color:#F4FA58;color:#0404B4';>".$_SESSION['PRECIO'][$x]."&nbsp€&nbsp</td>  																  
			  
			  <td style='background-color:#F7D358;color:#0404B4';>".number_format(($_SESSION['PRECIO'][$x]*$_SESSION['CANTIDAD'][$x]),2,".","")."&nbsp€&nbsp</td>  											  
						
						
		</tr>
		 ";	
		$totalfactura=$totalfactura+number_format(($_SESSION['PRECIO'][$x]*$_SESSION['CANTIDAD'][$x]),2,".","");
}
// pinto el total factura
echo "<tr><td colspan='7' style='color:blue;text-align: right;'>Total Factura:</td><td id='totalTabla' style='color:brown;text-align: right;'>".number_format($totalfactura,2,".","")."&nbsp€&nbsp</td></tr>";
echo "</table>";
?>
