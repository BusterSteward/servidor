<?php

$existo = file_exists("clientes.txt");

if(!$existo){
    exit("No se ha encontrado el archivo 'clientes.txt'");
}
else{
    $fichero=fopen("clientes.txt","r");
    $clientes=[];
   
    $contador=0;
    $key;
    while(!feof($fichero)){
          $linea=trim(fgets($fichero));
          if($linea==""){
            $contador=0;
          }
          else{
            if($contador==0){
                $key=$linea;
                if(isset($clientes[$key])){
                    $linea=trim(fgets($fichero));
                    $linea=trim(fgets($fichero));
                    $linea=trim(fgets($fichero));
                }
                else{
                    $clientes[$key]=[];
                    $clientes[$key][$contador]=$linea;
                    $contador++;
                }
            }
            else{
                $clientes[$key][$contador]=$linea;
                $contador++;
            } 
            
          }
          
    }
    
    //fwrite($resul,$contenido);
    fclose($fichero);
    
    echo "INFORMACIÓN EXTRAÍDA DEL FICHERO<BR>";

    require("conexion.php");
    foreach($clientes as $cliente){

        $v1=strval($cliente[0]);
        $v2=$cliente[1];
        $v3=strval($cliente[2]);

        $imagenaux=$v1.".jpg";

        // devuelve un identificador de imagen que representa la imagen obtenida desde el nombre de archivo dado
        $image = imagecreatefromjpeg($imagenaux); 

        ob_start(); 
        //imagejpeg(): esta función produce la salida de una imagen al navegador o a un archivo.
        //en este caso la imagen se almacenará en el buffer de salida.
        imagejpeg($image);
        //ob_get_contents(): obtiene el contenido del búfer de salida, sin borrarlo.
        $jpg = ob_get_contents();
        //ob_end_clean(): esta función desecha el contenido del búfer de salida en cola y lo deshabilita.
        ob_end_clean();

        //escapamos la imagen
        $jpg = addslashes($jpg);
        
        //doy de alta la imagen	
        $consulta = "INSERT INTO $tabla VALUES ($v1,'$v2',$v3,'$jpg')";
        $resultado = mysqli_query($conexion,$consulta);
    }
    mysqli_close($conexion);
    echo "DATOS INTRODUCIDOS EN LA BBDD";

}

?>