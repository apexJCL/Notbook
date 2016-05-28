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

        return $account->id;
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
        $profile = new Profile(['id' => $account_id, 'name' => $name, 'last_name' => $last_name]);
        $profile->save();
    }
}