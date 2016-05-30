<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

class Parser {

    public function __construct(){
        if(!empty($_POST)){
            $this->WS();
        }
    }

    private function WS(){
        switch ($_POST['request']){
            case 'parse':
                self::parse();
                break;
            default:
                break;
        }
    }

    private static function parse(){
        $result = [];
        $parser = new Parsedown();
        $result['response'] = 'ok';
        $result['data'] = $parser->parse($_POST['data']);
        echo json_encode($result);
        exit;
    }

    public static function parseData($text){
        $parser = new Parsedown();
        return $parser->parse($text);
    }
}

$parser = new Parser();