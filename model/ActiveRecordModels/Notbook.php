<?php

class Notbook extends \ActiveRecord\Model{
    static $belongs_to = ['profile'];
}