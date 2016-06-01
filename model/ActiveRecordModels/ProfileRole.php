<?php

class ProfileRole extends \ActiveRecord\Model{
    static $belongs_to = [
        ['profile'],
        ['role']
    ];

    public static function isAdmin($pid){
        $profileRoles = ProfileRole::find('all',[
            'conditions' => [
                'profile_id' => $pid
            ]
        ]);
        foreach ($profileRoles as $profileRole){
            if($profileRole->role->role == 'admin')
                return true;
        }
        return false;
    }
}