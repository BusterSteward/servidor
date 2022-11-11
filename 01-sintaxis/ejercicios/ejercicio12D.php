<?php
function cuentapalabra($cadena, $busco){

    
    $long=strlen($busco);
    $j=0;
    $res=0;
    echo $long."<br>";
    echo strlen($cadena)."<br>";
    //recorro toda la cadena
    for($i=0;$i<strlen($cadena);$i++){
        //compruebo si el caracter actual coincide con el primer caracter de la cadena buscada
        if($busco[0]==$cadena[$i]){
            //en caso de que asi sea incremento en 1 el caracter actual para no comprobarlo 2 veces
            $i++;
            //como ya he encontrado el primer caracter, empiezo a comprobar si la cadena buscada está completa
            for($j=1;$j<$long;$j++){//el contador empieza en 1 porque ya he comprobado el primer caracter
                //compruebo que el siguiente caracter de la cadena también coincide con la cadena buscada
                if($i>=strlen($cadena)){
                    break;
                }
                if($busco[$j]!=$cadena[$i]){
                    break; //si no coincide rompo el bucle para volver a empezar a buscar el primer caracter
                }
                //en caso de que haya coincidido, incremento la $i para comprobar el siguiente caracter
                $i++;
            }
            //compruebo que he comprobado todos los caracteres de la cadena buscada
            if($j==$long){
                $res++;//si es asi, incremento el numero de coincidencias
            }
        }

    }
    
    return $res;

}

$mi_cadena = "pepeholapepecomohoestaspelapepexxpe";
$busco="pepe";
echo "la cadena: ".$mi_cadena."<br>";
echo "lo que busco: ".$busco."<br>";
echo "aparece: ".cuentapalabra($mi_cadena,$busco)." veces";

echo "<br><br>";

$mi_cadena = "pepholapepecomohoestaspelapepexxpepe";
$busco="pepe";
echo "la cadena: ".$mi_cadena."<br>";
echo "lo que busco: ".$busco."<br>";
echo "aparece: ".cuentapalabra($mi_cadena,$busco)." veces";

echo "<br><br>";

$mi_cadena = "pepholapepepepecomohoestaspelapepexxpepe";
$busco="pepe";
echo "la cadena: ".$mi_cadena."<br>";
echo "lo que busco: ".$busco."<br>";
echo "aparece: ".cuentapalabra($mi_cadena,$busco)." veces";

echo "<br><br>";

$mi_cadena = "pepholapepecomohoestaspelapepexxpepe";
$busco="o";
echo "la cadena: ".$mi_cadena."<br>";
echo "lo que busco: ".$busco."<br>";
echo "aparece: ".cuentapalabra($mi_cadena,$busco)." veces";

echo "<br><br>";

$mi_cadena = "opepholapepecomoohoestaspelapepexxpepeo";
$busco="o";
echo "la cadena: ".$mi_cadena."<br>";
echo "lo que busco: ".$busco."<br>";
echo "aparece: ".cuentapalabra($mi_cadena,$busco)." veces";

echo "<br><br>";

$mi_cadena = "opepholapepecomoohoestaspelapepexxpepeo";
$busco="z";
echo "la cadena: ".$mi_cadena."<br>";
echo "lo que busco: ".$busco."<br>";
echo "aparece: ".cuentapalabra($mi_cadena,$busco)." veces";

echo "<br><br>";

$mi_cadena = "opepholapepecomoohoestaspelapepexxpepeo";
$busco="zzzz";
echo "la cadena: ".$mi_cadena."<br>";
echo "lo que busco: ".$busco."<br>";
echo "aparece: ".cuentapalabra($mi_cadena,$busco)." veces";

echo "<br><br>";

$mi_cadena = "1";
$busco="zzzz";
echo "la cadena: ".$mi_cadena."<br>";
echo "lo que busco: ".$busco."<br>";
echo "aparece: ".cuentapalabra($mi_cadena,$busco)." veces";

echo "<br><br>";

$mi_cadena = "";
$busco="zzzz";
echo "la cadena: ".$mi_cadena."<br>";
echo "lo que busco: ".$busco."<br>";
echo "aparece: ".cuentapalabra($mi_cadena,$busco)." veces";

/*
$res1=cuentapalabra("Mi perro es borde", "de");
$res2=cuentapalabra("Vi a el hombre misterioso y a el perro malo", "el");

echo "La primera cadena contiene 'de' {$res1} veces.<br>";
echo "La segunda cadena contiene 'el' {$res2} veces.<br>";*/
?>