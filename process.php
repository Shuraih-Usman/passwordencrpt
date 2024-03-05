<?php
require_once __DIR__.'/function.php';
header("Content-type: application/json");
if($_SERVER['REQUEST_METHOD'] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $action = $data['action'];

    switch ($action) {
        case 'encrypt':
            $s = 0;
            $m = "";
            if(empty($data['plain'])) {
                $m = "Plain text field cannot be empty";
            } else if(empty($data['key'])) {
                $m = "Key field cannot be empty";
            } else if(!is_numeric($data['key'])) {
                $m = "Key value must be a number";
            } else if(preg_match('/\d/', $data['plain'])) {
                $m = "Plain text field cannot contain digits";
            } else if(!ctype_upper($data['plain']) && !ctype_lower($data['plain'])) {
                $m = "Plain text must be in Uppercase or lowercase all";
            } else {
               $m = encrypt($data['plain'], $data['key']);
               $s = 1;
            }
            $response =  ['s' => $s, 'm' => $m];
            break;
        case 'decrypt':
            $s = 0;
            $m = "";
            if(empty($data['cipher'])) {
                $m = "cipher field cannot be empty";
            } else if(empty($data['key'])) {
                $m = "Key field cannot be empty";
            } else if(!is_numeric($data['key'])) {
                $m = "Key value must be a number";
            } else if(preg_match('/\d/', $data['cipher'])) {
                $m = "cipher field cannot contain digits";
            } else if(!ctype_upper($data['cipher']) && !ctype_lower($data['cipher'])) {
                $m = "Pcipher must be in Uppercase or lowercase all";
            } else {
                $m = decrypt($data['cipher'], $data['key']);
                $s = 1;
            }
            $response =  ['s' => $s, 'm' => $m];
            break;
            break;
        default:
            $response =  ['s' => 0, 'm' => "Undefined action"];
    }

    echo json_encode($response);
}


