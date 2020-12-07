<?php
/*
* @package AlleyCat
/
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
  function __construct() {
    add_action( 'init', array( $this, 'custom_post_type' ) );
  }

  function register() {
    add_action( 'wp_enqueue_scripts', array( $this, 'enqueue') );
  }

  function activate() {
    // Register Custom Posts
    $this->custom_post_type();

    // Flust Rewrite Rules
    flush_rewrite_rules();
  }

  function deactivate() {
    
  }
  
  function uninstall() {
    
  }

  function custom_post_type() {
    register_post_type('book', ['public' => true, 'label' => 'Books']);
  }

  function enqueue() {
    // Register scripts
    wp_enqueue_script('AlleyCatStyles', plugins_url( '/assets/styles.css', __FILE__ ) );
    wp_enqueue_script('AlleyCatScripts', plugins_url( '/assets/scripts.js', __FILE__ ) );
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

