<?php
function longitudCadena($cad){
    $i=0;
    while(isset($cad[$i])){
        $i+=1000;
    }
    $i-=1000;
    while(isset($cad[$i])){
        $i+=100;
    }
    $i-=100;
    while(isset($cad[$i])){
        $i+=10;
    }
    $i-=10;
    while(isset($cad[$i])){
        $i++;
    }
    $i--;
    return $i;
}
function trozo($cad,$inicio,$fin){
    $inicio--;
    $fin--;
    $trozo="";
    if($inicio>=0 && $fin>=0 && $inicio<=$fin){
        $tam = longitudCadena($cad);

        if($inicio<$tam && $fin<$tam){
            $j=0;
            for($i=$inicio;$i<=$fin;$i++){
                $trozo[$j] = $cad[$i];
                $j++;
            }
        }
    }
    return $trozo;
}
echo "Prueba trozo('HolaPepeComoEstas',1,2) -> ".trozo("HolaPepeComoEstas",1,2)."<br>";
echo "Prueba trozo('HolaPepeComoEstas',5,8) -> ".trozo("HolaPepeComoEstas",5,8)."<br>";
echo "Prueba trozo('HolaPepeComoEstas',5,20) -> ".trozo("HolaPepeComoEstas",5,20)."<br>"; 
echo "Prueba trozo('HolaPepeComoEstas',5,-3) -> ".trozo("HolaPepeComoEstas",5,-3)."<br>";
echo "Prueba trozo('HolaPepeComoEstas',8,3) -> ".trozo("HolaPepeComoEstas",8,3)."<br>";

?>