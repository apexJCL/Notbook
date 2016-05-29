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

        if(isset($_POST['request'])){
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
            case 'edit':
                $this->edit();
                break;
            case 'settings':
                $this->settings();
                break;
            case 'new-notbook':
                $this->create_notbook();
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

    private function settings(){
        $result = [
            'response' => 'ok',
            'data' => $this->fetch('settings.tpl')
        ];
        echo json_encode($result);
        exit;
    }

    private function create_notbook(){
        $result = [];
        parse_str($_POST['settings'], $notbookSettings);
        echo 'Created';
        exit;
    }

    private function edit(){
        $result =  [];
        $notbook = Notbook::find(['conditions' => [
            'profile_id' => 1,
            'id' => $_POST['nid']
        ]]);
        if(empty($notbook)){
            $result['response'] = 'error';
            $result['message'] = 'Notbook no encontrada pid '.Notbook::connection()->last_query;
        } else {
            $this->assign('notbook', $notbook);
            $result['data'] = $this->fetch('editor.tpl');
            $result['response'] = 'ok';
        }
        echo json_encode($result);
        exit;
    }
}

$profile = new UserProfile();