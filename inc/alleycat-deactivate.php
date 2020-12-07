<?php
/**
* @package AlleyCat
*/


class AlleyCatDeactivate
{
    public static function deactivate() {
        flush_rewrite_rules();
    }
}