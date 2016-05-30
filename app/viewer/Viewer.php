<?php

require_once PATH.'controller/Controller.php';

class Viewer extends Controller{
    public function __construct(){
        parent::__construct('viewer');
        echo '<pre>';
        print_r($_GET);
        echo 'Hello :D';
    }

}

new Viewer();