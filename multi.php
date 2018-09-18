<?php

    function displayMultiplication($max){
        for( $i=1 ; $i <= $max ; ++$i ){
            for( $j=1 ; $j <= $max; ++$j){
                $range = $max * $max;
                echo str_pad($i * $j, mb_strlen($range)+1, " ",STR_PAD_LEFT);
            }
            echo "\n";
        }
    }


    function read_stdin(){
        $fr = fopen("php://stdin","r");
        $input = fgets($fr,128);
        $input = rtrim($input);
        fclose ($fr);
        return $input;
    }

    echo "Give a number over 1 : ";
    $number = read_stdin();


    if(intval($number)) {
        displayMultiplication($number);
    } else {
        echo "Hm its not a number, try again." . PHP_EOL;
    }

