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
        $result = null;
        switch ($_POST['request']){
            case 'notbooks': $result = $this->notbooks();
                break;
            case 'edit': $result = $this->edit();
                break;
            case 'settings': $result = $this->settings();
                break;
            case 'new-notbook': $result = $this->create_notbook();
                break;
            case 'save_notbook': $result = $this->__save_notbook__(false);
                break;
            case 'parse': $result = $this->__save_notbook__(true);
                break;
            case 'delete_notbook': $result = $this->delete_notbook();
                break;
            case 'update_private_status': $result = $this->update_private_status();
                break;
            case 'update_profile': $result = $this->update_profile();
                break;
            case 'search': $result = $this->search();
                break;
            case 'logout': $result = $this->logout();
                breaK;
            case 'delete_account': $result = $this->delete_account();
                break;
            case 'html2pdf': $result = $this->html2pdf();
                break;
            case 'notbook2xml': $result = $this->notbook2xml();
                break;
        }
        $this->response($result);
    }

    private function notbooks(){
        $result = [];
        $notbooks = Notbook::find('all', [
            'conditions' => [
            'profile_id' => $_SESSION['pid']
        ],
            'readonly' => true
        ]);
        $this->assign('data', $notbooks);
        $this->assign('title', 'Tus ¬books');
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
        if(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in']) {
            $this->assign('profile', Profile::find_by_id($_SESSION['pid']));
            $result = [
                'response' => 'ok',
                'data' => $this->fetch('settings.tpl')
            ];
        } else {
            $result['response'] = 'error';
            $result['message'] = 'Sucedió un error, inténtelo más tarde';
        }
        return $result;
    }

    private function create_notbook(){
        $result = [];
        parse_str($_POST['settings'], $notbookSettings);
        $notbook = new Notbook();
        $notbook->profile_id = $_SESSION['pid'];
        $notbook->title = $notbookSettings['title'];
        $notbook->created = date('Y-m-d H:i:s');
        $notbook->private = isset($notbookSettings['private']);
        $notbook->save();
        $result['response'] = 'ok';
        $result['nid'] = $notbook->id;
        return $result;
    }

    private function edit(){
        $result =  [];
        $notbook = $this->getNotbook($_POST['nid']);
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

    private function __save_notbook__($data){
        $result = [];
        $notbook = $this->getNotbook($_POST['nid']);
        if(empty($notbook)) {
            $result['response'] = 'error';
            $result['message'] = 'datos: nota'.$_POST['nid'].', sesion:'.$_SESSION['pid'];
        } else {
            $notbook->unparsed = $_POST['data'];
            $notbook->title = $_POST['title'];
            $notbook->parsed = Utils::parseData($_POST['data']);
            $notbook->last_parsed_date = date('Y-m-d H:i:ss');
            $notbook->save();
            $result['response'] = 'ok';
            if($data)
                $result['data'] = $notbook->parsed;
        }
        return $result;
    }

    private function getNotbook($nid){
        return Notbook::find([
            'conditions' => [
                'id' => $nid,
                'profile_id' => $_SESSION['pid']
            ]
        ]);
    }

    private function delete_notbook(){
        $notbook = $this->getNotbook($_POST['nid']);
        if($notbook instanceof Notbook) {
            $notbook->delete();
        }
        $result = [
            'response' => 'ok',
            'message' => 'Éxito'
        ];
        return $result;
    }

    private function search(){
        $result = [];
        parse_str($_POST['query'], $search);
        try {
            $notbooks = Notbook::find_by_sql(sprintf("SELECT * FROM notbooks WHERE profile_id = %d AND unparsed LIKE '%%%s%%'", $_SESSION['pid'], $search['search_query']));
            if (empty($notbooks)) {
                $result['response'] = 'error';
                $result['message'] = 'No hay coincidencias';
            } else {
                $result['response'] = 'ok';
                $this->assign('data', $notbooks);
                $this->assign('title', 'Resultado de búsqueda');
                $result['data'] = $this->fetch('notbooks_showcase.tpl');
            }
        } catch (Exception $e){
            echo Notbook::connection()->last_query;
        }
        return $result;
    }

    private function update_private_status(){
        $result = [];
        $result['extra'] = $_POST['status'];
        $notbook = $this->getNotbook($_POST['nid']);
        if(empty($notbook))
            $result['message'] = 'Ocurrió un error';
        else {
            $notbook->private = $_POST['status'];
            $notbook->last_parsed_date = date('Y-m-d H:i:ss');
            $notbook->save();
            $result['message'] = 'Actualizado correctamente';
        }
        return $result;
    }

    private function delete_account(){
        $result = [];
        if(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in']){
            $account = Account::find($_SESSION['pid']);
            $account->delete();
            $result['response'] = 'ok';
        } else {
            $result['response'] = 'error';
            $result['message'] = 'Ocurrió un error';
        }
        return $result;
    }

    private function update_profile(){
        $result = [];
        if(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in']){
            $profile = Profile::find($_SESSION['pid']);
            if(empty($profile)){
                $result['response'] = 'error';
                $result['message'] = 'Cuenta no encontrada';
            } else {
                parse_str($_POST['data'], $form);
                $profile->name = $form['name'];
                $profile->last_name = $form['last_name'];
                $profile->birthdate = $form['birthdate'];
                $profile->save();
                $result['response'] = 'ok';
                $result['message'] = 'Datos Actualizados Correctamente';
            }
        } else {
            $result['response'] = 'error';
            $result['message'] = 'Ocurrió un error en el servidor';
        }
        return $result;
    }

    private function html2pdf(){
        $result = [];
        $notbook= Notbook::find([
            'conditions' => [
                'id' => $_POST['nid'],
                'profile_id' => $_SESSION['pid']
            ]
        ]);
        if(empty($notbook)){
            $result['response'] = 'error';
            $result['message'] = 'Error al crear el pdf';
            return $result;
        }
        $this->assign('title', $notbook->title);
        $this->assign('body', $notbook->parsed);
        $url = Utils::html2pdf($this->smarty->fetch('print.tpl'), $notbook->title, $notbook->id, $notbook->created);
        $result['response'] = 'ok';
        $result['message'] = 'PDF Creado Correctamente';
        $result['url'] = $url;
        return $result;
    }

    private function notbook2xml(){
        $result = [];
        if(!isset($_POST['nid'])){
            $result['response'] = 'error';
            $result['message'] = 'Error, ID de nota no especificado';
        } else {
            $result['response'] = 'ok';
            $result['message'] = 'XML Creado Correctamente';
            $result['url'] = Utils::notbook2xml($_POST['nid']);
        }
        return $result;
    }
}

$profile = new UserProfile();