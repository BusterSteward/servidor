<?php  
//¿variable global?

//declaro 2 arrays, en uno las palabras en ingles se guardan como indice y en español como valor
//y en el otro array al contrario, las palabras en español como indice y en ingles como valor
$ingles=array();
$espanol=array();


//compruebo si el fichero existe
$existe = file_exists("diccionario.txt");

if(!$existe){
    exit("ERROR: no se pudo abrir el archivo diccionario.txt");
}
else{
    //abro el fichero
    $fichero=fopen("diccionario.txt","rb");
    
    while(!feof($fichero)){//leo todas sus lineas
        $linea=trim(fgets($fichero));
        $dic=explode("-",$linea);

        //guardo las palabras de cada linea en los arrays
        $ingles[$dic[1]]=$dic[0];
        $espanol[$dic[0]]=$dic[1];
    }
    //cierro el fichero
    fclose($fichero);
}

function traductor($frase)
{
    //si la frase esta vacia devuelvo nada
    if($frase==""){
        return "Nada";
    }

    //en caso contrario separo la frase en palabras
    $palabras=explode(" ",$frase);

    $resultado="";

    //utilizo los arrays como variables globales
    global $ingles;
    global $espanol;

    //traduzco cada palabra de la frase
    for($i=0;$i<count($palabras);$i++){
        //concateno al resultado un espacio si ya he entrado al menos una vez
        if($i>0)
            $resultado.=" ";
        
        //compruebo si la palabra existe en el diccionario de ingles
        if(isset($ingles[$palabras[$i]]))
            $resultado.=$ingles[$palabras[$i]];//si existe concateno al resultado la palabra en español

        //si no existe compruebo si está en el diccionario de español
        else if(isset($espanol[$palabras[$i]]))
            $resultado.=$espanol[$palabras[$i]];//si existe concateno al resultado la palabra en ingles
        
        //si no existe en ninguno de los 2, concateno al resultado "ERROR"
        else
            $resultado.="ERROR";
    }
    return $resultado;

}



// pruebas
$frase1 = "TU ERES GUAPO";
$frase2 = "HOLA PEDRO ERES BUEN AMIGO";
$frase3 = "EN MADRID VIVE JUAN";
$frase4 = "BILBAO";
$frase5 = "";

$traducir = traductor($frase1);
echo $traducir;
echo "<br><br>";

$traducir = traductor($frase2);
echo $traducir;
echo "<br><br>";

$traducir = traductor($frase3);
echo $traducir;
echo "<br><br>";

$traducir = traductor($frase4);
echo $traducir;
echo "<br><br>";

$traducir = traductor($frase5);
echo $traducir;
echo "<br><br>";
?>