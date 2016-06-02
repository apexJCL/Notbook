<?php

require_once 'Controller.php';

class IndexController extends Controller{
    public function __construct(){

        parent::__construct('index');

        /*
        $client = new nusoap_client('http://www.webservicex.net/country.asmx?WSDL', 'wsdl');
        $response = $client->call('GetCurrencyByCountry', ['CountryName' => 'Mexico']);
        echo get_class($response);
        */

        if(isset($_SESSION['user_logged_in'])) {
            if($_SESSION['user_logged_in']) {
                if(ProfileRole::isAdmin($_SESSION['pid']))
                    header('Location: /admin');
                else
                    header('Location: /profile');
            }
        }

        if(empty($_POST)) $this->index();
        else $this->POSTHandler();
    }


    public function index(){
        $parsedown = new Parsedown();
        $code = '```python
mensaje = "Soporte para marcado de sintáxis"
while True:
    print(mensaje)
```';
        $abt = '#### Redacta en Markdown  
* Crea fácilmente listas  
* Realiza tus apuntes  
* O escribe tu siguiente investigación';
        $welcome_text = '##### Programación Web
> Curso básico acerca de tecnologías  
> **HTML, CSS, JS y PHP**

La temática del curso en sí, consiste 
en _aprender a desarrollar_...';
        $this->smarty->assign('class', 'Markdown');
        $this->smarty->assign('pre', $welcome_text);
        $this->smarty->assign('post', $parsedown->parse($welcome_text));
        $this->smarty->assign('about_unparsed', $abt);
        $this->smarty->assign('about', $parsedown->parse($abt));
        $this->assign('code', $parsedown->parse($code));
        $this->assign('code_unparsed', $code);
        $this->assign('weather', Utils::weather());
        $this->display("index.tpl");
    }


    private function POSTHandler(){
        if(!isset($_POST['choice'])) {
            $this->index();
        } else switch ($_POST['choice']){
            case 'register':
                $this->register();
                break;
            case 'login':
                $this->login();
                break;
        }
    }


    private function register(){
        $result = [];
        parse_str($_POST['form'], $data);
        Account::connection()->transaction();
        $account = Utils::register($data['email'], $data['password'], $data['password_ver']);
        if($account instanceof Account){
            $profile = Utils::create_profile($data['name'], $data['last_name'], $account);
            if($profile instanceof Profile){
                Utils::assign_role($profile->id, 'user');
                Account::connection()->commit();
                Utils::LoginSuccessful($account, $profile);
                $result['response'] = 'ok';
                $result['action'] = '/profile/';
            } else {
                Account::connection()->rollback();
                $result['response'] = 'error';
                $result['message'] = 'Ocurrió un error al crear su perfil, contacte al administrador';
            }
        } else {
            Account::connection()->rollback();
            $result['response'] = 'error';
            switch ($account){
                case -1:
                    $result['message'] = 'Dirección de correo inválida';
                    break;
                case -2:
                    $result['message'] = 'Las contraseñas no coinciden';
                    break;
                case -3:
                    $result['message'] = 'Cuenta de correo ya asociada';
                    break;
            }
        }
        echo json_encode($result);
        exit;
    }

    private function login(){
        parse_str($_POST['form'], $form);
        $result = Utils::login($form['email'], $form['password']);
        header('Content type: application/json');
        if($result)
            echo json_encode(['response' => 'ok', 'location' => '/']);
        else
            echo json_encode(['response' => 'error', 'message' => 'No se pudo iniciar sesión, revise sus credenciales']);
        exit;
    }
}

$index = new IndexController();