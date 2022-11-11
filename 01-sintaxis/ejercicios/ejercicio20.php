<?php
function promedio($cadena){
    $array = array('a'=>0,'e'=>0,'i'=>0,'o'=>0,'u'=>0,"palabras"=>0);

    $i=0;
    $cadena=strtolower($cadena);
    $aux="";
    while(isset($cadena[$i])){
        if($aux==" "|| $aux==""){
            $array["palabras"]++;
        }
        $aux=$cadena[$i];
        
        switch($aux){
            case 'a':
                $array['a']++;
                break;
            case 'e':
                $array['e']++;
                break;
            case 'i':
                $array['i']++;
                break;
            case 'o':
                $array['o']++;
                break;
            case 'u':
                $array['u']++;
                break;
            
        }
        $i++;
    }
    return $array;
}
$array = promedio("Hola PepE mi PipA Es VerdE");

echo "La cadena pasada es: <br> Hola PepE mi PipA Es VerdE<br>";
echo "Vocal a: ".$array['a']."<br>";
echo "Vocal e: ".$array['e']."<br>";
echo "Vocal i: ".$array['i']."<br>";
echo "Vocal o: ".$array['o']."<br>";
echo "Vocal u: ".$array['u']."<br>";
echo "Nº de palabras: ".$array["palabras"]."<br>";

?>