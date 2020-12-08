<?php
/**
* @package AlleyCat
*/

namespace Inc\Base;

class Enqueue
{

    public function register() 
    {
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue') );;  
    }

    /**
     * Enqueue admin scripts
     */
    function enqueue() {        
        wp_enqueue_style('AlleyCatStyles', PLUGIN_URL . 'assets/styles.css' );
        wp_enqueue_script('AlleyCatScripts', PLUGIN_URL . 'assets/scripts.js' );
        }
}