<?php
function quitotrozo($cadena, $inicio, $fin){

    $nuevacadena="";
    $tam=strlen($cadena);
 
    if($fin>=$tam) $fin=$tam;

    $contador=0;

    if($inicio<=$fin && $fin>=0 && $inicio>=0){
        for($i=0;$i<$tam;$i++){
            
            if($i==$inicio)
                $i=$fin;
            else{
                
                $nuevacadena[$contador]=$cadena[$i];
                $contador++;
            }
        }
    }
    
    
    return $nuevacadena;
}

echo "Prueba quitotrozo('HolaPepeComoEstas',1,2) -> RESULTADO: ".quitotrozo("HolaPepeComoEstas",1,2)."<BR>";
echo "Prueba quitotrozo('HolaPepeComoEstas',5,8) -> RESULTADO: ".quitotrozo("HolaPepeComoEstas",5,8)."<BR>";
echo "Prueba quitotrozo('HolaPepeComoEstas',5,20) -> RESULTADO: ".quitotrozo("HolaPepeComoEstas",5,20)."<BR>";
echo "Prueba quitotrozo('HolaPepeComoEstas',5,-3) -> RESULTADO: ".quitotrozo("HolaPepeComoEstas",5,-3)."<BR>";
echo "Prueba quitotrozo('HolaPepeComoEstas',8,3) -> RESULTADO: ".quitotrozo("HolaPepeComoEstas",8,3)."<BR>";
?>