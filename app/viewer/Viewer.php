<?php

require_once PATH . 'controller/Controller.php';

class Viewer extends Controller
{
    public function __construct()
    {
        parent::__construct('viewer');

        if(isset($_POST['request'])){
            $this->POSTHandler();
        }

        $this->showNote();
    }


    private function showNote(){

        $notbook = Notbook::find([
            'conditions' => [
                'id' => key($_GET),
                'private' => false,
            ]
        ]);

        if (empty($notbook)) {
            // Show Not Found
            $this->display('notfound.tpl');
            exit;
        }

        $comments = NotbookComment::getComments(key($_GET));

        $this->assign('notbook', $notbook);
        $this->assign('comments', $comments);
        $this->smarty->display('viewer/viewer.tpl');
    }

    private function POSTHandler(){
        try {
            $result = $this->POSTstatements();
        } catch (Exception $e){
            var_dump($e);
            exit;
        }
        header('Content type: application/json');
        if(empty($result))
            echo json_encode(['response' => 'error', 'message' => 'Ocurrió un error' ]);
        else
            echo json_encode($result);
        exit;
    }

    private function POSTstatements(){
        switch ($_POST['request']){
            case 'comment':
                return $this->comment();
        }
        return null;
    }

    private function comment(){
        $result = [];
        if(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in']){
            $comment = new NotbookComment();
            $comment->notbook_id = intval($_POST['nid']);
            $comment->profile_id = $_SESSION['pid'];
            $comment->comment = Utils::parseData($_POST['data']);
            $comment->comment_date = date('Y-m-d H:i:ss');
            $comment->save();
            // Smarty Process
            $this->assign('comments', NotbookComment::getComments(intval($_POST['nid'])));
            $result['data'] = $this->fetch('comments.tpl');
            $result['response'] = 'ok';

        } else {

        }
        return $result;
    }
}

new Viewer();