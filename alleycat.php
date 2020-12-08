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

define( 'PLUGIN_PATH', plugin_dir_path(__FILE__) );
define( 'PLUGIN_URL', plugin_dir_url(__FILE__) );

if ( class_exists( 'Inc\\init') ) {
  Inc\Init::register_services();
}

