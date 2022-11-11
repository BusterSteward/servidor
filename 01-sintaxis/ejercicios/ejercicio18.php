<?php
 $buscoesto="pepe";
 $pongoesto="juan";
 $cadena="epe no es pepe, pep no es pepe";
 $numSust=0;
 $resultado=sustituir($buscoesto,$pongoesto,$cadena,$numSust);

 echo "Cadena: {$cadena}<br>";
 echo "Numero de sustituciones: ".$numSust."<br>";
 echo "La cadena final es: {$resultado}<br>";
 

 function sustituir($busco,$pongo,$cad,&$numSust){
    $numSust=0;
    $tamC=strlen($cad);
    $tamB=strlen($busco);
    $tamP=strlen($pongo);

    $nuevaCadena="";
    $z=0;
   
    for($i=0;$i<$tamC;$i++){
        
        if($cad[$i]==$busco[0]){
            $aux="";
            $aux[0]=$cad[$i];
            $i++;
            for($j=1;$j<$tamB;$j++){
                
                if($i==$tamC)
                    break;
                if($busco[$j]==$cad[$i])
                    $aux[$j]=$cad[$i];
                else
                    break;
                $i++;
            }
            $i--;
            if($aux==$busco){
                $numSust++;
                $nuevaCadena.=$pongo;
                $z+=$tamP;
            }
            else{
                
                $nuevaCadena.=$aux;
                $z+=strlen($aux);
                
            }
            
        }
        else{
           $nuevaCadena[$z]=$cad[$i];
           $z++; 
        }
    }
    
    return $nuevaCadena;
 }
?>