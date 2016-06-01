<?php

class NotbookComment extends \ActiveRecord\Model{
    static $belongs_to = [
        ['profile'],
        ['notbook'],
        ['notbookcomment']
    ];

    public static function getComments($nid){
        return NotbookComment::find('all',[
            'conditions' => [
                'notbook_id' => $nid
            ],
            'order' => 'comment_date DESC'
        ]);
    }
}