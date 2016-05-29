<?php

class Utils {

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

    public static function create_profile($name, $last_name, $account_id){
        try{
            $profile = new Profile(['id' => $account_id, 'name' => $name, 'last_name' => $last_name]);
            $profile->save();
            return $profile;
        } catch (Exception $e){
            return false;
        }
    }

    public static function LoginSuccessful($account, $profile){
        session_regenerate_id(true);
        $_SESSION['user_logged_in'] = true;
        $_SESSION['email'] = $account->email;
        $_SESSION['name'] = $profile->name;
        $_SESSION['pid'] = $profile->id;
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

    public static function logout(){
        /*
        $account = Account::find_by_email($_SESSION['email']);
        $account->last_session =
        */
        session_destroy();
    }
}