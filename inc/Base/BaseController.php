<?php
/**
* @package AlleyCat
*/

namespace Inc\Base;

class BaseController 

{
    public $plugin_path;
    
    public $plugin_url;
    
    public $plugin;

    public $admin_options;
    
    public function __construct() {
        $this->plugin_path = plugin_dir_path( dirname( __FILE__, 2 ) );
        $this->plugin_url = plugin_dir_url( dirname( __FILE__, 2 ) );
        $this->plugin = plugin_basename( dirname( __FILE__, 3 ) ) . '/alleycat.php';

        $this->admin_options = [
            [
              'id' => 'cpt_manager',
              'title' => 'Activate CPT Manager'
            ],
            [
              'id' => 'taxonomy_manager',
              'title' => 'Activate Taxonomy Manager'
            ],
            [
              'id' => 'media_widget',
              'title' => 'Activate Media Widget'
            ],
            [
              'id' => 'gallery_manager',
              'title' => 'Activate Gallery Manager'
            ],
            [
             'id' => 'testimonial_manager',
              'title' =>'Activate Testimonial Manager'
            ],
            [
             'id' => 'template_manager',
              'title' => 'Activate Taxonomy Manager'
            ],
            [
              'id' => 'login_manager',
              'title' => 'Activate Login Manager'
            ],
            [
              'id' => 'membership_manager',
              'title' => 'Activate Membership Manager'
            ],
            [
              'id' => 'chat_manager',
              'title' => 'Activate Chat Manager'
            ]        
          ];
       
    }
}