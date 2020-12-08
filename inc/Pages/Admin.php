<?php
/**
* @package AlleyCat
*/

namespace Inc\Pages;

class Admin

{

    public function register() 
    {
      add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );  
    }

    /**
     * Setup admin Pages
     */
    public function add_admin_pages() 
    {
      add_menu_page( 'AlleyCat', 'AlleyCat', 'manage_options', 'alleycat_plugin', array( $this, 'admin_index'), 'dashicons-store', 110);
    }

    /**
     * Add Custom links
     */
    public function settings_link( $links ) 
    {       
      $settings_link = '<a href="admin.php?page=alleycat_plugin">Settings</a>';
      array_push( $links, $settings_link );
      return $links;
    }

    public function admin_index() 
    {
      require_once PLUGIN_PATH . 'templates/admin.php';
    }   

    
}