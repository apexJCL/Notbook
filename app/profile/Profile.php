<?php

require_once PATH.'controller/Controller.php';

class Profile extends Controller{
    public function __construct(){
        parent::__construct('profile');

        echo '<pre>';
        print_r($_REQUEST);
        print_r($_POST);
        print_r($_GET);
        print_r($_SERVER);

        die();

        if(!isset($_SESSION['user_logged_in'])){
            header('Location: /');
        }
    }
}

$profile = new Profile();