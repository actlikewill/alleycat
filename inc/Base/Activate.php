<?php
/**
* @package AlleyCat
*/

namespace Inc\Base;

class Activate
{
    public static function activate() 
    {
        flush_rewrite_rules();
        
        $default = array();

        if( ! get_option('alleycat_plugin')){
            update_option('alleycat_plugin', $default);
        }
        
        if( ! get_option('alleycat_plugin_cpt')){
            update_option('alleycat_plugin_cpt', $default);
        }


        if( ! get_option('alleycat_plugin_taxonomy')){
            update_option('alleycat_plugin_taxonomy', $default);
        }
    }
}