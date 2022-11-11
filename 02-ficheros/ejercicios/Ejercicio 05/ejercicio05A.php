<!-- En este ejemplo meto código PHP en HTML -->
<HTML>
<HEAD>
<TITLE>Creación Tabla</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</HEAD>
<?php
function leerFichero($url){

    $arr=array();
    $file = @fopen($url,"r");
    if(!$file){
        exit("Error: no se ha encontrado el fichero");
        return false;
    }

    else
    {
        $i=0;
        $j=0;
        while(!feof($file)){
            $linea=fgets($file);
            if($linea=="\r\n"){
                $j=0;
                $i++;
            }
            else{
                $arr[$i][$j]=$linea;
                $j++;
            }
        }
    }
    fclose($file);
    return $arr;
}
    $clientes = leerFichero("clientes.txt");
?>
<BODY>
<BR>

<div id="cuadrado contenedor"
		style="border:2px solid green;width:800px;height:490px;padding-left:60px;position:absolute;
		            top:50%;margin-top:-290px;left:50%;margin-left:-400px">
		
					<h2><font color="blue">Ejemplo de creación de Tabla:</font></h2>
				
					<div style="border:1px solid red;width:375px;">  
						<table border='1' cellpadding='0' cellspacing='0' width='375' bordercolor='#FFFFFF'> 
							<tr>  
								  <td width='150' style="font-weight:bold;background-color:#0404B4;color:#F7F8E0";>NOMBRE</td>  
								  <td width='100' style="font-weight:bold;background-color:#0B610B;color:#F7F8E0";>CONTADOR</td>  
								  <td width='125' style="font-weight:bold;background-color:#B40486;color:#F7F8E0";>POBLACIÓN</td>  
							</tr>  
					
							<?php $i=0;while ($i<count($clientes)) { ?>
						  <tr>
								<td width='150' style='background-color:#F6CECE;color:#0404B4';><?php echo $clientes[$i][0];?></td>
								<td width='100' style='background-color:#A9E2F3;color:#0404B4';><?php echo $clientes[$i][1];?></td>
								<td width='125' style='background-color:#81F79F;color:#0404B4';><?php echo $clientes[$i][2];$i++;?></td>
						  </tr>
						  <?php };?>					
						
						</table>
					</div>	
</div>
</BODY>
</HTML>
