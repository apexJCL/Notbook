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
            case 'delete_comment':
                return $this->delete_comment();
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
            $result['data'] = $this->fetch_comments($_POST['nid']);
            $result['response'] = 'ok';

        } else {
            $result['response'] = 'error';
            $result['message'] = 'No ha iniciado sesión';
        }
        return $result;
    }

    private function delete_comment(){
        $result = [];
        if(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in']) {
            $comment = NotbookComment::find([
                'conditions' => [
                    'id' => $_POST['cid'],
                    'profile_id' => $_SESSION['pid'],
                    'notbook_id' => $_POST['notbook_id']
                ]
            ]);
            if(empty($comment)){
                $result['response'] = 'error';
                $result['message'] = 'Comentario no encontrado';
            } else {
                $comment->delete();
                $result['response'] = 'ok';
                $result['data'] = $this->fetch_comments($_POST['notbook_id']);
            }
        } else {
            $result['response'] = 'error';
            $result['message'] = 'Sucedió un error, intente más tarde';
        }
        return $result;
    }

    private function fetch_comments($nid){
        $this->assign('comments', NotbookComment::getComments($nid));
        return $this->fetch('comments.tpl');
    }
}

new Viewer();