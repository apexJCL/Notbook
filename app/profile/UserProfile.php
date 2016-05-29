<?php

require_once PATH.'controller/Controller.php';

class UserProfile extends Controller{
    public function __construct(){
        parent::__construct('profile');

        if(!isset($_SESSION['user_logged_in'])){
            $this->display('login.tpl');
            return;
        } else if(!$_SESSION['user_logged_in']) {
            $this->display('login.tpl');
            return;
        }

        if(isset($_POST['action'])){
            $this->POSTHandler();
        }

        $this->profile();
    }

    private function profile(){
        $this->display('profile.tpl');
    }

    private function POSTHandler(){
        switch ($_POST['request']){
            case 'notbooks':
                $this->notbooks();
                break;
            case 'logout':
                $this->logout();
                breaK;
        }
    }

    private function notbooks(){
        $result = [];
        $notbooks = Notbook::find('all', ['conditions' => [
            'profile_id' => 1
        ]]);
        $this->assign('data', $notbooks);
        $result['response'] = 'ok';
        $result['data'] = $this->fetch('notbooks_showcase.tpl');
        echo json_encode($result);
        exit;
    }

    private function logout(){
        Utils::logout();
        $result = [
            'response' => 'ok',
            'redirect' => 'true'
        ];
        echo json_encode($result);
        exit;
    }
}

$profile = new UserProfile();