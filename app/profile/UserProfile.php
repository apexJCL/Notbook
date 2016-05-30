<?php

require_once PATH.'controller/Controller.php';
require_once PATH.'/ws/parser/Parser.php';

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
        $result = null;
        switch ($_POST['request']){
            case 'notbooks':
                $result = $this->notbooks();
                break;
            case 'edit':
                $result = $this->edit();
                break;
            case 'settings':
                $result = $this->settings();
                break;
            case 'new-notbook':
                $result = $this->create_notbook();
                break;
            case 'save_notbook':
                $result = $this->save_notbook();
                break;
            case 'parse':
                die('lel');
                $result = $this->parse_save();
                break;
            case 'logout':
                $result = $this->logout();
                breaK;
        }
        $this->response($result);
    }

    private function notbooks(){
        $result = [];
        $notbooks = Notbook::find('all', ['conditions' => [
            'profile_id' => 1
        ]]);
        $this->assign('data', $notbooks);
        $result['response'] = 'ok';
        $result['data'] = $this->fetch('notbooks_showcase.tpl');
        return $result;
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
        return $result;
    }

    private function create_notbook(){
        $result = [];
        parse_str($_POST['settings'], $notbookSettings);
        $notbook = new Notbook();
        $notbook->profile_id = $_SESSION['pid'];
        $notbook->title = $notbookSettings['title'];
        $notbook->private = isset($notbookSettings['private']);
        $notbook->save();
        $result['response'] = 'ok';
        $result['nid'] = $notbook->id;
        return $result;
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
        return $result;
    }

    private function parse_save(){
        $result = [];
        $notbook = Notbook::find([
            'conditions' =>  [
                'id' => $_POST['nid'],
                'profile_id' => $_SESSION['pid']
            ]
        ]);
        if(!empty($notbook)){
            $notbook->unparsed = $_POST['data'];
            $notbook->parsed = Parser::parseData($_POST['data']);
            $notbook->save();
            $result['response'] ='ok';
            $result['data'] = $notbook->parsed;
        } else {
            $result['response'] = 'error';
            $result['message'] = 'No se ha encontrado el ¬book indicado';
        }
        return $result;
    }

    private function save_notbook(){
        $result = [];
        $notbook = Notbook::find([
            'conditions' => [
                'id' => $_POST['nid'],
                'profile_id' => $_SESSION['pid']
            ]
        ]);
        if(empty($notbook)) {
            $result['response'] = 'error';
            $result['message'] = 'notbook vacio';
        } else {
            $notbook->unparsed = $_POST['data'];
            $notbook->parsed = Parser::parseData($_POST['data']);
            $notbook->save();
            $result['response'] = 'ok';
        }
        return $result;
    }
}

$profile = new UserProfile();