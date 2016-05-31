<?php

class Role extends \ActiveRecord\Model{
    static $has_many = [
        'profile_roles'
    ];
}