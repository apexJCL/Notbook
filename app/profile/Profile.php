<?php

require_once PATH.'controller/Controller.php';

class Profile extends Controller{
    public function __construct(){
        parent::__construct('profile');

        if(!isset($_SESSION['user_logged_in'])){
            $this->display('login.tpl');
        } else if(!$_SESSION['user_logged_in'])
            $this->display('login.tpl');
        else $this->profile();
    }

    private function profile(){
        $this->assign('baseurl', $this->template_dir);
        $this->display('profile.tpl');
    }
}

$profile = new Profile();