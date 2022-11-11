<?php

    function quitoVocales($cadena){
        $sinVocales="";
        $aux = strtolower($cadena);

        $i=0;
        while(isset($aux[$i])){
            switch($aux[$i]){
                case 'a':
                    
                case 'e':
                    
                case 'i':
                    
                case 'o':
                    
                case 'u':
                    break;
                default:
                    $sinVocales.=$cadena[$i];
                    break;
            }
            $i++;
        }
        return $sinVocales;
    }
    $cad = "LA tarde Estaba AlgO lluviosa y tristE";
    $sinVocales = quitoVocales($cad);

    echo $cad."<br>";
    echo $sinVocales."<br>";
?>