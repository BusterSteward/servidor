<?php
    $c1="antoniosevaalcine";
    
    echo "cadena: ".$c1."<br>";
    
    
    $resultado=alreves($c1);

    
    echo "cadena al revés: {$resultado}";
    

   
    function alreves($cad){
        $res;
        for($i=(strlen($cad)-1);$i>=0;$i--){
            $res[10-$i]=$cad[$i];
        }
        $res = implode($res);

        return (string)$res;
    }
?>