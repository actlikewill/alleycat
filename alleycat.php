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

 defined( 'ABSPATH' ) or die( "I'm just a plugin. Nothing to see here.");


if ( file_exists( dirname(__FILE__) . '/vendor/autoload.php' ) ) {
  require_once dirname(__FILE__) . '/vendor/autoload.php';
}



register_activation_hook(__FILE__, 'activate_alleycat' );
register_deactivation_hook(__FILE__, 'deactivate_alleycat' );


function activate_alleycat() {
  Inc\Base\Activate::activate();
}

function deactivate_alleycat() {
  Inc\Base\Deactivate::deactivate();
}

if ( class_exists( 'Inc\\init') ) {
  Inc\Init::register_services();
}

