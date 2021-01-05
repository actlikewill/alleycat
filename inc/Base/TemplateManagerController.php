<?php
/**
* @package AlleyCat
*/

namespace Inc\Base;

use \Inc\Base\BaseManagerController;

class TemplateManagerController extends BaseManagerController
{    

    public $templates;

    public function __construct() {

        $this->set_manager_name('template_manager');        
        
    }

    public function initialize()
    {
      $this->templates = [
        'page-templates/two-column-tpl.php' => 'Two Column Layout'
      ];
      add_filter( 'theme_page_templates', [$this, 'custom_template']);
      add_filter( 'template_include', [$this, 'load_template']);

    }
    
    public function custom_template( $templates )
    {
      $templates = array_merge( $templates, $this->templates);

      return $templates; 
    }
    
    public function load_template( $template )
    {
      global $post;
      $path = $this->get_my_plugin_path();

      if( !$post ) {
        return $template;
      }
      if (is_front_page()) {
        $file = $path . 'page-templates/front-page.php';
        echo $file;
        if (file_exists( $file )) {
          return $file;
        }
      }
      $template_name = get_post_meta( $post->ID, '_wp_page_template', true);

     if( ! isset($this->templates[$template_name] )) {
       return $template;
     }

     $file = $path . $template_name;

     if( file_exists( $file )) {
       return $file;
     }
      return $template;
    }
}