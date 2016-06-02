<?php

require $_SERVER['DOCUMENT_ROOT'].'/ws/BaseWS.php';
require $_SERVER['DOCUMENT_ROOT'].'/controller/Utils.php';

class Accounts extends BaseWS {

    public function __construct()
    {
        parent::__construct();
        header('Content type: application/json');
        $method = $_SERVER['REQUEST_METHOD'];
        switch ($method){
            case 'GET':
                $this->get_info();
                break;
            case 'POST':
                $this->new_account();
                break;
            case 'PUT':
                $this->update_password();
                break;
            case 'DELETE':
                $this->delete_account();
                break;
        }
    }

    /**
     * Devuelve la información acerca
     *
     * {
     *      'email': email usuario que solicita,
     *      'password': password de la cuenta,
     *      'email_cuenta': email de la cuenta de la cual se solicita información
     * }
     *
     * Sólo se acepta y devuelve el 3er parámetro a los administradores, a los demás, se les devuelve la información de su cuenta,
     * y si se usa el parámetro 3, se deniega el accesso
     *
     */
    private function get_info(){
        if(empty($_GET))
            $this->response(400, "error", "Solicitud Vacía");
        elseif (!isset($_GET['email']) || !isset($_GET['password']))
            $this->response(400, "error", "Verifique sus credenciales");

        $account = Account::find([
            'conditions' => [
                'email' => $_GET['email'],
                'password' => md5($_GET['password'])
            ]
        ]);
        
        if(empty($account))
            $this->response(404, "error", "Cuenta no encontrada");
        elseif(isset($_GET['email_cuenta']) && !ProfileRole::isAdmin($account->id))
            $this->response(401, "error", "No tiene acceso al servicio");
        
        $result = [];
        
        if (!ProfileRole::isAdmin($account->id)){ // Cuenta del usuario
            $profile = Profile::find($account->id);
        } else {
            if(empty($_GET['email_cuenta']))
                $this->response(400, "error", "No se indicó cuenta");
            $account = Account::find_by_email($_GET['email_cuenta']);
            $profile = Profile::find($account->id);
            
        }
        
        $result['info'] = [
            'name' => $profile->name,
            'last_name' => $profile->last_name,
            'birthdate' => $profile->birthdate
        ];
        $this->response(200, "Ok", $result);
    }


    /**
     * Crea una nueva cuenta en Notbook
     *
     * {
     *      'email',
     *      'password',
     *      'password_ver',
     *      'nombre',
     *      'apellidos',
     *      'rol',
     *      'admin_email',
     *      'admin_passwd'
     * }
     *  Se puede crear cuentas, con permiso de admin y asignar rol tal como Usuario o Administrador
     *
     */
    private function new_account(){
        $params = json_decode(file_get_contents("php://input"));
        if(empty($params))
            $this->response(400, "error", "No hay datos");
        elseif(!isset($params->email) || !isset($params->password) ||!isset($params->password_ver) || !isset($params->nombre) || !isset($params->apellidos) || !isset($params->rol) || !isset($params->admin_email) || !isset($params->admin_passwd))
            $this->response(400, "Error", "Faltan parámetros");

        $account = Account::find([
            'conditions' => [
                'email' => $params->admin_email,
                'password' => md5($params->admin_passwd)
            ]
        ]);

        if(empty($account))
            $this->response(404, "error", "Cuenta no encontrada");
        elseif(!ProfileRole::isAdmin($account->id))
            $this->response(401, "error", "Acceso no autorizado");

        Account::connection()->transaction();
        $new_account = Utils::register($params->email, $params->password, $params->password_ver);
        if(!$new_account instanceof Account){
            Account::connection()->rollback();
            $this->response(406, "error", "Error "+$new_account);
        }

        $profile = Utils::create_profile($params->nombre, $params->apellidos, $new_account);
        if(!$profile instanceof Profile) {
            Account::connection()->rollback();
            $this->response(404, "error", "Error al crear el perfil");
        }
        Utils::assign_role($profile->id, $params->rol);
        Account::connection()->commit();
        
        $this->response(200, "Ok", "Cuenta creada exitósamente");
    }

    /**
     * Actualiza la contraseña del perfil indicado, con permisos de administrador
     *
     * {
     *      "email",
     *      "password",
     *      "admin_email",
     *      "admin_passwd"
     * }
     *
     */
    private function update_password(){
        $params = json_decode(file_get_contents("php://input"));
        if(empty($params))
            $this->response(400, "error", "No hay datos");
        elseif(!isset($params->email) || !isset($params->password) || !isset($params->admin_email) || !isset($params->admin_passwd))
            $this->response(400, "error", "Datos incompletos");

        $account = Account::find([
            'conditions' => [
                'email' => $params->admin_email,
                'password' => md5($params->admin_passwd)
            ]
        ]);

        if(empty($account))
            $this->response(400, "Error", "Datos incompletos");
        elseif(!ProfileRole::isAdmin($account->id))
            $this->response(401, "Error", "Acceso Denegado");

        $affected_account = Account::find([
            'conditions' => [
                'email' => $params->email
            ]
        ]);

        if(empty($affected_account))
            $this->response(404, "error", "Cuenta no encontrada");

        $affected_account->password = md5($params->password);
        $affected_account->save();
        $this->response(200, "Ok", "Contraseña actualizada correctamente");
    }

    /**
     * Elimina una cuenta, con permisos de administrador
     *
     * {
     *      "email",
     *      "admin_email",
     *      "admin_passwd"
     * }
     *
     */
    private function delete_account(){
        $params = json_decode(file_get_contents("php://input"));
        if(empty($params))
            $this->response(400, "error", "No hay datos");
        elseif(!isset($params->email) || !isset($params->admin_email) || !isset($params->admin_passwd))
            $this->response(400, "error", "Datos incompletos");

        $account = Account::find([
            'conditions' => [
                'email' => $params->admin_email,
                'password' => md5($params->admin_passwd)
            ]
        ]);

        if(empty($account))
            $this->response(400, "Error", "Datos incompletos");
        elseif(!ProfileRole::isAdmin($account->id))
            $this->response(401, "Error", "Acceso Denegado");

        $affected_account = Account::find([
            'conditions' => [
                'email' => $params->email
            ]
        ]);

        if(empty($affected_account))
            $this->response(404, "error", "Cuenta no encontrada");
        $affected_account->delete();
        $this->response(200, "Ok", "Cuenta eliminada correctamente");
    }

}

new Accounts();