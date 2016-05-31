<?php

class ProfileRole extends \ActiveRecord\Model{
    static $belongs_to = [
        ['profile'],
        ['role']
    ];
}