<?php

require_once PATH . 'controller/Controller.php';

class Admin extends Controller
{

    public function __construct()
    {
        parent::__construct('admin');

        if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in']) {
            if (ProfileRole::isAdmin($_SESSION['pid'])) {
                if (isset($_POST['request']))
                    $this->POSTHandler();
                else
                    $this->index();
            } else {
                // 404
            }
        }
    }

    private function POSTHandler()
    {
        try {
            $result = $this->POSTstatements();
        } catch (Exception $e) {
            var_dump($e);
            exit;
        }
        header('Content type: application/json');
        if (empty($result))
            echo json_encode(['response' => 'error', 'message' => 'Ocurrió un error']);
        else
            echo json_encode($result);
        exit;
    }

    private function POSTstatements()
    {
        switch ($_POST['request']) {
            case 'logout':
                return $this->logout();
            case 'stats':
                return $this->stats();
            case 'accounts':
                return $this->accounts();
            case 'search_account':
                return $this->search_account();
            case 'delete_account':
                return $this->delete_account();
            case 'profile_update':
                return $this->profile_update();
            case 'account_update':
                return $this->account_update();
            case 'account_page':
                return $this->account_page();
        }
        return null;
    }

    public function index(){
        $this->display('index.tpl');
    }

    private function stats(){
        $result = [];
        $amount = Notbook::find_by_sql("SELECT COUNT(*) AS total FROM notbooks WHERE DATE(created) = CURDATE()");
        $last_comments = NotbookComment::find_by_sql("SELECT notbook_id, comment, p.name AS name FROM notbook_comments nc JOIN profiles p ON nc.profile_id = p.id  WHERE DATE(comment_date) = CURDATE() LIMIT 10");
        $this->assign('today_notbooks', $amount[0]->total);
        $this->assign('last_comments', $last_comments);
        $amount = Account::count();
        $this->assign('amount', $amount);
        $result['response'] = 'ok';
        $result['data'] = $this->fetch('stats.tpl');
        return $result;
    }

    private function accounts(){
        $result = [];
        $amount = Account::count();
        $accounts = Account::find_by_sql("SELECT id, email FROM accounts LIMIT 5");
        $this->assign('amount', $amount);
        $this->assign('pages', ceil($amount/5));
        $this->assign('accounts', $accounts);
        $result['response'] = 'ok';
        $result['data'] = $this->fetch('accounts.tpl');
        return $result;
    }

    private function logout()
    {
        Utils::logout();
        $result = [
            'response' => 'ok',
            'redirect' => 'true'
        ];
        return $result;
    }

    private function search_account(){
        $result =  [];
        if (isset($_POST['form']))
            parse_str($_POST['form'], $form);
        else
            $form = [];

        if(empty($form['email']) && empty($form['id']) && empty($_POST['id'])){
            $result['response'] = 'error';
            $result['message'] = 'No hay datos';
            return $result;
        }

        if(!empty($form['id']) || !empty($_POST['id'])) {
            try {
                if(!empty($form['id']))
                    $account = Account::find($form['id']);
                else
                    $account = Account::find($_POST['id']);
            } catch (Exception $e){
                $result['response'] = 'error';
                $result['message'] = 'No se ha encontrado el ID indicado';
                return $result;
            }
        }
        else if(!empty($form['email']))
            $account = Account::find_by_email($form['email']);

        if(!empty($account)) {
            $profile = Profile::find($account->id);
            $this->assign('profile', $profile);
            $this->assign('account', $account);
            $result['response'] = 'ok';
            $result['data'] = $this->fetch('account_data.tpl');
        } else {
            $result['response'] = 'error';
            $result['message'] = 'No se ha encontrado una cuenta relacionada a ese correo';
        }
        return $result;
    }

    private function delete_account(){
        $result = [];
        $account = Account::find($_POST['aid']);
        if(empty($account)){
            $result['response'] = 'error';
            $result['message'] = 'Ocurrió un error al eliminar la cuenta (Cuenta no encontrada)';
        } else {
            $account->delete();
            $result['response'] = 'ok';
            $result['message'] = 'Cuenta eliminada';
        }
        return $result;
    }

    private function profile_update(){
        $result = [];
        parse_str($_POST['data'], $form);
        $profile = Profile::find($form['id']);
        if(empty($profile)){
            $result['response'] = 'error';
            $result['message'] = 'Ocurrió un error al actualizar los datos';
        } else {
            $profile->name = (empty($form['name']))? $profile->name: $form['name'];
            $profile->last_name = empty($form['last_name'])? $profile->last_name: $form['last_name'];
            $profile->birthdate = empty($form['birthdate'])? $profile->birthdate: $form['birthdate'];
            $profile->save();
            $result['response']= 'ok';
            $result['message'] = 'Perfil Actualizado correctamente';
        }
        return $result;
    }

    private function account_update(){
        $result = [];
        parse_str($_POST['data'], $form);
        $account = Account::find($form['id']);
        if(empty($account)){
            $result['response'] = 'error';
            $result['message'] = 'Ocurrió un error al actualizar los datos';
        } else {
            $account->email = (empty($form['email']))? $account->email: $form['email'];
            $account->password = empty($form['password'])? $account->password: md5($form['password']);
            $account->save();
            $result['response']= 'ok';
            $result['message'] = 'Datos acceso actualizado correctamente';
        }
        return $result;
    }

    private function account_page(){
        $result = [];
        $accounts = Account::find_by_sql(sprintf("SELECT id, email FROM accounts LIMIT %d,5", $_POST['page']*5));
        $this->assign('accounts', $accounts);
        $result['response'] = 'ok';
        $result['data'] = $this->fetch('account_pager.tpl');
        return $result;
    }
}

new Admin();