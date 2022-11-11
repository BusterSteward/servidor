<?php


function insertaTrozo($cadena,$subcadena,$inicio){
    $res="";
    

    $tam=strlen($cadena);
    if($inicio==$tam){
        $res=$cadena.$subcadena;
    }
    if($inicio>=0 && $inicio<$tam){
        
        $tam2=strlen($subcadena);

        $z=0;
        
        for($i=0;$i<$tam;$i++){
            if($i==$inicio){
                $res.=$subcadena;
                $z+=$tam2;
                
                $res[$z]=$cadena[$i];
                $z++;
            }
            else{
                $res[$z]=$cadena[$i];
                $z++;
            }
        }
    }


    return $res;
}

echo "Prueba de 'insertotrozo('HolaPepeComoEstas','XXX',0)' -> RESULTADO :".insertatrozo("HolaPepeComoEstas","XXX",0)."<br>"; 
echo "Prueba de 'insertotrozo('HolaPepeComoEstas','XXX',17)' -> RESULTADO :".insertatrozo("HolaPepeComoEstas","XXX",17)."<br>"; 
echo "Prueba de 'insertotrozo('HolaPepeComoEstas','XXX',20)' -> RESULTADO :".insertatrozo("HolaPepeComoEstas","XXX",20)."<br>"; 
echo "Prueba de 'insertotrozo('HolaPepeComoEstas','XXX',-3)' -> RESULTADO :".insertatrozo("HolaPepeComoEstas","XXX",-3)."<br>"; 
echo "Prueba de 'insertotrozo('HolaPepeComoEstas','XXX',4)' -> RESULTADO :".insertatrozo("HolaPepeComoEstas","XXX",4)."<br>"; 

?>