<?php


function encrypt($plain, $key) {
    if(ctype_upper($plain)) {
        $alpha = range('A', 'Z');
    } else if(ctype_lower($plain)) {
        $alpha = range('a', 'z');
    }
    $table = $alpha;
    $str = str_split($plain);
    $encryptedText = "";

    foreach ($str as $cipher) {
        $number = array_search($cipher, $table);
        $formular = $number + $key;
        $mode = $formular % 26;
         $encryptedText .= $table[$mode];
    }

    return $encryptedText;

}

function decrypt($cipher, $key) {
    if(ctype_upper($cipher)) {
        $alpha = range('A', 'Z');
    } else if(ctype_lower($cipher)) {
        $alpha = range('a', 'z');
    }
    $table = $alpha;
    $str = str_split($cipher);
    $PlainText = "";

    foreach ($str as $plain) {
        $number = array_search($plain, $table);
        $formular = $number - $key;
        $mode = $formular % 26;
        $PlainText .= $table[$mode];
    }

    return $PlainText;

}