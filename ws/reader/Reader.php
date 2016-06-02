<?php
require $_SERVER['DOCUMENT_ROOT'].'/ws/BaseWS.php';

class Reader extends BaseWS
{

    public function __construct()
    {
        parent::__construct();
        header('Content type: application/json');
        $method = $_SERVER['REQUEST_METHOD'];
        switch ($method) {
            case 'POST':
                $this->read_notbooks();
                break;
            case 'GET':
                $this->get_notbook();
                break;
            default:
                header('Location: /');
        }
    }

    /**
     *
     * Servicio Web, devuelve n ¬books públicas, ya sea en
     *
     * 1) Enlace
     * 2) Texto Parseado
     * 3) Texto Sin Parsear
     *
     * Estructura esperada:
     * POST
     * {
     *      'number': n, // Cantidad
     *      'option': k //1,2 ó 3
     * }
     */
    private function read_notbooks()
    {
        $result = [];
        if (empty($_POST)) {
            $this->response(400, "error","Solicitud Vacía");
        } elseif (!isset($_POST['option'])) {
            $this->response(400, "error","Opción no seleccionada");
        } elseif (!isset($_POST['number'])){
            $this->response(400, "error","Cantidad no seleccionada");
        }
        switch ($_POST['option']) {
            case 1:
                $notbooks = Notbook::find('all', [
                    'limit' => $_POST['number'],
                    'conditions' => [
                        'private' => false
                    ]
                ]);
                $result['links'] = [];
                foreach ($notbooks as $notbook) {
                    array_push($result['links'], sprintf("http://%s/view/nid=%d", $_SERVER['SERVER_NAME'], $notbook->id));
                }
                break;
            case 2:
                $notbooks = Notbook::find('all', [
                    'limit' => $_POST['number'],
                    'conditions' => [
                        'private' => false
                    ]
                ]);
                $result['parsed'] = [] ;
                foreach ($notbooks as $notbook){
                    array_push($result['parsed'], ['nid' => $notbook->id, 'content' => $notbook->parsed]);
                }
                break;
            case 3:
                $notbooks = Notbook::find('all', [
                    'limit' => $_POST['number'],
                    'conditions' => [
                        'private' => false
                    ]
                ]);
                $result['parsed'] = [] ;
                foreach ($notbooks as $notbook){
                    array_push($result['parsed'], ['nid' => $notbook->id, 'content' => $notbook->unparsed]);
                }
                break;
        }
        $this->response(200, "Ok", $result);
    }


    /**
     * Devuelve una notbook, de la siguiente manera
     *
     * {
     *      'method': 'url'|'nid',
     *      'url': url pública notbook | 'nid': id notbook
     * }
     *
     */
    private function get_notbook(){
        $result = [];
        if(empty($_GET)){
            $this->response(400, "error", "Sin solicitud");
        } elseif( !isset($_GET['method'])){
            $this->response(400, "error", "Solicitud Incompleta");
        }

        switch ($_GET['method']){
            case 'url':
                $noteid = substr($_GET['url'], strpos($_GET['url'], 'nid=') + 4, strlen($_GET['url']));
                if(empty($noteid) || $noteid === false){
                    $this->response(400, "error", "url inválida");
                }
                $notbook = Notbook::find($noteid);
                break;
            case 'nid':
                if(empty($_GET['nid']) || is_nan($_GET['nid']))
                    $this->response(400, "error", "NID inválido");
                $notbook = Notbook::find($_GET['nid']);
                break;
            default:
                break;
        }
        $result['note'] = [
            'nid' => $notbook->id,
            'title' => $notbook->title,
            'unparsed' => $notbook->unparsed,
            'parsed' => $notbook->parsed,
            'created' => $notbook->created,
            'last_parsed_date' => $notbook->last_parsed_date
        ];
        $this->response(200, "Ok", $result);
    }
}

new Reader();