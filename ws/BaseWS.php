<?php

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

class BaseWS
{

    /**
     * BaseWS constructor.
     */
    public function __construct()
    {
        ActiveRecord\Config::initialize(function ($cfg) {
            $cfg->set_model_directory(MODELDIR);
            $cfg->set_connections([
                'development' => sprintf('%s://%s:%s@%s/%s', DB_DBMS, DB_USER, DB_PASSWORD, DB_HOST, DB_DATABASE)
            ]);
        });
        ActiveRecord\Connection::$datetime_format = 'Y-m-d H:i:s';
    }

    public function response($code = 200, $status = "", $message = "")
    {
        http_response_code($code);
        $response = [
            "status" => $status,
            "message" => $message
        ];
        echo json_encode($response, JSON_PRETTY_PRINT);
        exit;
    }
}