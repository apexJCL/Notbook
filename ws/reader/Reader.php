<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

class Reader {

    public function __construct(){
        header('Content type: application/json');
        $method = $_SERVER['REQUEST_METHOD'];
       switch ($method){
           case 'POST':
               self::read_notbooks();
               break;
       }
    }

    private static function read_notbooks(){
        $obj = json_decode(file_get_contents("php://input"));
    }
}

new Reader();