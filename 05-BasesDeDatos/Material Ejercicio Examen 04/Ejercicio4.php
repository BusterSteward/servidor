<?php

    require("conexion.php");
    $fichero = fopen("clientes.txt","wb");

    // defino la consulta para recuperar todos los registros				
    $consulta = "SELECT DISTINCT DNI, NOMBRE, EDAD, PRECIO, IMAGEN FROM ".$tabla ;
    // ejecuto la consulta SQL
    $resultado = mysqli_query($conexion,$consulta);
    // calculo el nº de registros para informar al usuario del nº de ficheros que se van a crear
    $nregistros=mysqli_num_rows($resultado);

    if ($nregistros==0)
    {
        echo "No hay registros en la tabla";
    }
    else
    {
        $fila=mysqli_fetch_array($resultado);
        $noprimero=false;
        while ($fila)
        {
            file_put_contents($fila["DNI"].".jpg",$fila['IMAGEN']); 
            if($noprimero)
                fwrite($fichero,"\r\n");

            fwrite($fichero,$fila["DNI"]."\r\n");
            fwrite($fichero,$fila["NOMBRE"]."\r\n");
            fwrite($fichero,$fila["EDAD"]."\r\n");
            fwrite($fichero,$fila["PRECIO"]."\r\n");
            
            $fila=mysqli_fetch_array($resultado);
            $noprimero=true;
        }
    }
    fclose($fichero);	
    
    echo "Se han creado ".$nregistros." ficheros físicos<br>";
    echo "Se ha creado el fichero clientes.txt";

    //MUY IMPORTANTE
    //siempre hay que hacer esto
    //cerramos la conexion  con la base de datos
    mysqli_close($conexion); 
?>