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
function view($arr){

    if($arr!=false){
        echo "Se ha leído el fichero correctamente<br>";
        echo "El array contiene ".count($arr)." elementos<br>";
        echo "El array contiene la siguiente información<br>";
        for($i=0;$i<count($arr);$i++){
            for($j=0;$j<3;$j++){
                echo $arr[$i][$j]."<br>";
            }
            echo "<br><br>";
        }
    }
    
}

$arr = leerFichero("clientes.txt");


view($arr);

?>