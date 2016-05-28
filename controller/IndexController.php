<?php

require_once 'Controller.php';

class IndexController extends Controller{
    public function __construct(){
        parent::__construct('index');

        if(empty($_POST))
            $this->index();
        else
            $this->register();
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
        $result = Utils::register($_POST['email'], $_POST['password'], $_POST['password_ver']);
        if($result > 0){ // Successful register, now create the profile
            Utils::create_profile($_POST['name'], $_POST['last_name'], $result);
            header('Location: profile');
        } else {
            $this->index();
        }
    }
}

$index = new IndexController();