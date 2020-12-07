<?php
/**
* @package AlleyCat
*/


class AlleyCatActivate
{
    public static function activate() {
        echo 'ACTIVATING...';
        flush_rewrite_rules();
    }
}