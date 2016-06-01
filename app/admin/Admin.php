<?php

require_once PATH . 'controller/Controller.php';

class Admin extends Controller
{

    public function __construct()
    {
        parent::__construct('admin');
        if(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in']){
            if(ProfileRole::isAdmin($_SESSION['pid'])){
                $this->index();
            }
        }
    }

    public function index(){
        $this->display('index.tpl');
    }

}

new Admin();