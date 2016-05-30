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
                $this->parse();
                break;
            default:
                break;
        }
    }

    private function parse(){
        $result = [];
        $parser = new Parsedown();
        $result['response'] = 'ok';
        $result['data'] = $parser->parse($_POST['data']);
        echo json_encode($result);
        exit;
    }
}

$parser = new Parser();