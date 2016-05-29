<?php

require_once 'Controller.php';

class IndexController extends Controller{
    public function __construct(){
        
        parent::__construct('index');

        if(isset($_SESSION['user_logged_in']))
            header('Location: /profile');

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
        $this->display("index.tpl");
    }
    
    private function register(){
        $account = Utils::register($_POST['email'], $_POST['password'], $_POST['password_ver']);
        if($account instanceof Account){
            $profile = Utils::create_profile($_POST['name'], $_POST['last_name'], $account);
            if($profile instanceof UserProfile){
                Utils::LoginSuccessful($account, $profile);
                header('Location: /profile');
            }
        } else $this->index();
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

    private function login(){
        $result = Utils::login($_POST['email'], $_POST['password']);
        if($result)
            header('Location: /profile');
        else
            header('Location: /');
    }
}

$index = new IndexController();