<?php

require_once PATH.'controller/Controller.php';

class Viewer extends Controller{
    public function __construct(){
        parent::__construct('viewer');
        //echo key($_GET);
        $this->showNote();
    }


    private function showNote(){

        $notbook = Notbook::find([
            'conditions' => [
                'id' => key($_GET),
                'private' => false
            ]
        ]);

        if(empty($notbook)){
            // Show Not Found
            $this->display('notfound.tpl');
            exit;
        }
        $this->assign('parsed', $notbook->parsed);
        $this->smarty->display('viewer/viewer.tpl');
    }
}

new Viewer();