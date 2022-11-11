<?php

    function visualizarArray($array){
        $maxColum=-1;
        for($i=0;$i<count($array);$i++){
            if($maxColum<count($array[$i])){
                $maxColum=count($array[$i]);
            }
        }
        for($i=0;$i<$maxColum;$i++){
            for($j=0;$j<count($array);$j++){
                if(isset($array[$j][$i]))
                    echo $array[$j][$i]." ";
                else
                    echo "* ";
            }
            echo "<br>";
        }
    }
    $arr = array(
            array('H','O','L','A'),
            array('S','U'),
            array('E','S','T','O','Y'),
            array('A','Q','U','I'),
            array('F','E','L','I','Z'),
            array('P','E','N','S','A','N','D','O')
    );
    visualizarArray($arr);
?>