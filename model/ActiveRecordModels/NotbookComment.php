<?php

class NotbookComment extends \ActiveRecord\Model{
    static $belongs_to = [
        ['profile'],
        ['notbook'],
        ['notbookcomment']
    ];
}