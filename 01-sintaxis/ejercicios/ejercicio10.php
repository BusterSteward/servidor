<?php
    $c1="antoniosevaalcine";
    
    echo "cadena: ".$c1."<br>";
    
    $resultado=alreves($c1);

    echo "cadena al revés: ".$resultado;
    

    function alreves($cad1){
        $res = strrev($cad1);
        
        return $res;
    }
?>