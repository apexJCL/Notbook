<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

class Parser {

    public function __construct(){

        if(!empty($_POST)){
            $this->WS();
        } else {
            header('Content type: application/json');
            $method = $_SERVER['REQUEST_METHOD'];
            switch ($method){
                case 'POST':
                    $obj = json_decode(file_get_contents("php://input"));
                    self::parseService($obj);
                    break;
                case 'GET':
                    echo 'GET';
                    break;
                default:
                    exit;
            }
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

    public static function parseService($obj){
        if(!empty($obj)) {
            $response = [
                'status' => 'ok',
                'parsed' => self::parseData($obj->data)
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'empty_body'
            ];
        }
        http_response_code(200);
        echo json_encode($response);
        exit;
    }

    public static function parseData($text){
        $parser = new Parsedown();
        return $parser->parse($text);
    }
}

$parser = new Parser();