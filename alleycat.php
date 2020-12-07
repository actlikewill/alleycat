<?php
/**
* @package AlleyCat
*/
/*
Plugin Name: AlleyCat
Plugin URI: http://alleycat.com
Description: First attempt at plugin building.
Version: 1.0.0
Author: Wilson Gaturu
Author URI: http://actlikewill.com
License: GPLv2 or later.
Text Domain: alleycat
*/

if ( ! defined( 'ABSPATH' ) ) {
  die;
}

class AlleyCat 
{
  
  function register() {
    add_action( 'admin_enqueue_scripts', array( $this, 'enqueue') );
  }

  
  function uninstall() {
    
  }

  function custom_post_type() {
    register_post_type('book', ['public' => true, 'label' => 'Books']);
  }

  function enqueue() {
    // Register scripts
    wp_enqueue_style('AlleyCatStyles', plugins_url( '/assets/styles.css', __FILE__ ) );
    wp_enqueue_script('AlleyCatScripts', plugins_url( '/assets/scripts.js', __FILE__ ) );
  }

  function activate() {
    require_once plugin_dir_path(__FILE__). '/inc/alleycat-activate.php';
    AlleyCatActivate::activate();
  }

  function deactivate() {
    require_once plugin_dir_path(__FILE__). '/inc/alleycat-deactivate.php';
    AlleyCatDectivate::deactivate();
  }

}

if ( class_exists( 'AlleyCat' ) ) {
  $alleycat = new AlleyCat();
  $alleycat->register();
} 


// Activation
register_activation_hook(__FILE__, array( $alleycat, 'activate') );

// Deactivation
register_deactivation_hook(__FILE__, array( $alleycat, 'deactivate') );

