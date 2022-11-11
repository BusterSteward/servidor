<?php


function validacion($string){
    $res="no";
    
    if(strlen($string)==11){
        
        for($i=0;$i<11;$i++){
            
            if($i==4){
                if(ord($string[$i])!=45)
                    break;
            }
            
            else{
                if(ord($string[$i])<48||ord($string[$i])>57)
                    break;
            }    
        }
            
    }
    if($i==11){
        $res="si";
    }
    return $res;

}
    

echo "La cadena '1234-787878' tiene que ser valida -> RESULTADO: ".validacion("1234-787878")."<br>";
echo "La cadena '12346-787878' tiene que ser invalida -> RESULTADO: ".validacion("12346-787878")."<br>";
echo "La cadena '1234787878' tiene que ser invalida -> RESULTADO: ".validacion("1234787878")."<br>";
echo "La cadena '1ab4-87878' tiene que ser invalida -> RESULTADO: ".validacion("1ab4-87878")."<br>";



?>