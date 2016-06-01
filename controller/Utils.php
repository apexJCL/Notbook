<?php

use Dompdf\Dompdf;
use Dompdf\Options;

class Utils {

    static $default_note = "## ¬book  
#### Para apuntes rápidos
---
Con **¬book** puedes comenzar a escribir y sólo enfocarte en eso, escribir.

Para comenzar, crea una cuenta en [notbook](http://notbook-oswebapp.rhcloud.com), después, en tu cuenta, usa el menú flotante en la **esquina inferior derecha** para comenzar a crear notas o ver una lista de las que tengas.

##### Comandos rápidos  
```
Alt + N : Nuevo ¬book
```

##### Comandos  del editor
```
Alt + P : Parsear nota (guarda también)
Alt + S : Guardar (sólo guarda)
Alt + E : Cambia a la pestaña de edición
Alt + V : Cambia a la pestaña de visualización
```

### Para móviles
Al momento en que cambies a la pestaña **Vista**, automáticamente tu ¬book se guardará, así que, no te preocupes, sólo edita, ve tus cambios y listo!
Después se agregará un botón explícito de guardado.

Conforme se avance, se irán agregando características, como compartir ¬book's, u otros";
    
    public static function register($email, $password, $password_ver){
        if (!self::isValidEmail($email))
            return -1; // Invalid Email
        $account = Account::find_by_email($email);

        if(!empty($account))
            return -3; // Email already registered

        if (strcmp($password, $password_ver))
            return -2; // Password mismatch

        $account = new Account();
        $account->email = $email;
        $account->password = md5($password);
        $account->save();

        return $account;
    }

    /**
     * Checks if the email is valid
     *
     * @param $email
     * @return bool
     */
    public static function isValidEmail($email){
        return (filter_var($email, FILTER_VALIDATE_EMAIL) === $email);
    }

    public static function create_profile($name, $last_name, $account){
        try{
            $profile = new Profile(['id' => $account->id, 'name' => $name, 'last_name' => $last_name]);
            $profile->save();
            // Default note
            $notbook = new Notbook();
            $notbook->profile_id = $profile->id;
            $notbook->title = 'Bienvenido';
            $notbook->unparsed = self::$default_note;
            $notbook->parsed = self::parseData(self::$default_note);
            $notbook->save();
            return $profile;
        } catch (Exception $e){
            return false;
        }
    }

    public static function LoginSuccessful($account, $profile){
        // Designamos el rol
        $profile_role = new ProfileRole();
        $profile_role->profile_id = $profile->id;
        $profile_role->role_id = Role::find_by_role('user')->id;
        $profile_role->save();
        // Regeneramos la sesión
        session_regenerate_id(true);
        $_SESSION['user_logged_in'] = true;
        $_SESSION['email'] = $account->email;
        $_SESSION['name'] = $profile->name;
        $_SESSION['pid'] = $profile->id;
        $_SESSION['isAdmin'] = ProfileRole::isAdmin($account->id);
    }

    public static function login($email, $password){
        $account = Account::find([
            'conditions' => ['email' => $email, 'password' => md5($password)],
            'readonly' => true
        ]);
        if(empty($account))
            return false;
        else {
            $profile = Profile::find($account->id);
            self::LoginSuccessful($account, $profile);
            return true;
        }
    }

    public static function html2pdf($htmldoc, $title, $nid, $date){
        $options = new Options();
        $options->set('defaultFont', 'Roboto');
        $options->set('isHtml5ParserEnabled', true);
        $domPDF = new Dompdf($options);
        $domPDF->setBasePath(PATH);
        $domPDF->loadHtml($htmldoc);
        $domPDF->setPaper('A4', 'portrait');
        $domPDF->render();
        file_put_contents(PATH.'/cache/'.$title.'_'.$nid.'_'.$date.'.pdf', $domPDF->output());
        return '/cache/'.$title.'_'.$nid.'_'.$date.'.pdf';
    }

    public static function logout(){
        /*
        $account = Account::find_by_email($_SESSION['email']);
        $account->last_session =
        */
        session_destroy();
    }

    public static function parseData($text){
        $parser = new Parsedown();
        return $parser->parse($text);
    }
}