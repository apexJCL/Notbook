<?php

if (session_status() == PHP_SESSION_NONE){
    session_start();
}

require_once 'Utils.php';

if (session_status() == PHP_SESSION_NONE){
    session_start();
}

error_reporting(E_ALL);
require PATH.'vendor/autoload.php';

class Controller {
    
    var $smarty;
    var $template_dir;

    public function __construct($classname){
        $this->smarty = new Smarty();
        $this->smarty->setTemplateDir(SMARTYDIR.TEMPLATES);
        $this->smarty->setCompileDir(SMARTYDIR.TEMPLATES_C);
        $this->smarty->setConfigDir(SMARTYDIR.CONFIGS);
        $this->smarty->setCacheDir(SMARTYDIR.CACHE);
        $this->smarty->assign('baseurl',"http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        ActiveRecord\Config::initialize(function ($cfg) {
            $cfg->set_model_directory(MODELDIR);
            $cfg->set_connections([
                'development' => sprintf('%s://%s:%s@%s/%s', DB_DBMS, DB_USER, DB_PASSWORD, DB_HOST, DB_DATABASE)
            ]);
        });
        $this->template_dir = strtolower($classname);
    }
    /*
    public function __get_request($request_url){
        if(empty($request_url))
            return explode('/', str_replace('/Portafolio/','',$_SERVER['REQUEST_URI']));
        else
            return explode('/', str_replace('/Portafolio/','',$request_url));
    }
    */

    /*
    public function Redirect(){
        return sprintf('/Portafolio/%s/%s/', LoginModel::Role(User::find($_SESSION['user_id'])),$_SESSION['username']);
    }
    */

    public function assign($key, $value){
        $this->smarty->assign($key, $value);
    }

    public function display($template){
        $this->smarty->display($this->template_dir.'/'.$template);
    }

    public function fetch($template){
        return $this->smarty->fetch($this->template_dir.'/'.$template);
    }
}