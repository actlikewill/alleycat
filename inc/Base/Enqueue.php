<?php
/**
* @package AlleyCat
*/

namespace Inc\Base;

class Enqueue extends \Inc\Base\BaseController
{
    public function register() 
    {
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue') );  
    }

    /**
     * Enqueue admin scripts
     */
    function enqueue() {              
        wp_enqueue_script( 'media_upload');
        wp_enqueue_media();
        wp_enqueue_style('AlleyCatStyles', $this->plugin_url . 'assets/styles.css' );
        wp_enqueue_script('AlleyCatScripts', $this->plugin_url . 'assets/scripts.js' );
        }
}