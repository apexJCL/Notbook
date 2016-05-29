<?php
 
class Profile extends \ActiveRecord\Model{
    static $has_many = [
        'notbooks'
    ];
}