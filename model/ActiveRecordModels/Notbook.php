<?php

class Notbook extends \ActiveRecord\Model{
    static $belongs_to = ['profile'];
    static $has_many = [
        ['notbook_comments']
    ];
}