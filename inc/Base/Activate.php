<?php
/**
* @package AlleyCat
*/

namespace Inc\Base;

class Activate
{
    public static function activate() 
    {
        echo 'ACTIVATING...';
        flush_rewrite_rules();
    }
}