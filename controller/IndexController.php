<?php

require_once 'Controller.php';

class IndexController extends Controller{
    public function __construct(){
        parent::__construct('index');
    }


    public function index(){
        $parsedown = new Parsedown();
        $welcome_text = '##### Programación Web
> Curso básico acerca de tecnologías  
> **HTML, CSS, JS y PHP**

La temática del curso en sí, consiste 
en _aprender a desarrollar_...';
        $this->smarty->assign('class', 'Markdown');
        $this->smarty->assign('pre', $welcome_text);
        $this->smarty->assign('post', $parsedown->parse($welcome_text));
        $this->smarty->assign('about', $parsedown->parse('**Obtengan Resultados** _esperados_'));
        $this->smarty->assign('about_unparsed','**Obtengan Resultados** _esperados_');
        $this->display("index.tpl");
    }
}