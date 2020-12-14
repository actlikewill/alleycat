<?php
/**
* @package AlleyCat
*/

namespace Inc\Base;

use \Inc\API\SettingsAPI;
use \Inc\API\Callbacks\AdminCallbacks;
use \Inc\Base\BaseController;

class BaseManagerController extends BaseController
{    

    public $settings;

    public $subpages = [];  

    public $manager_name; 


    public function register()
    {        

        if ( ! $this->activated( $this->manager_name ) ) return;

        $this->settings = new SettingsAPI();                 

        $this->activate();
        
        $this->settings->addSubPages( $this->subpages )->register(); 


    }

    public function set_manager_name ( string $name )
    {
        $this->manager_name = $name;
    }    
    /**
     * Set subpages
     * @param array $page_title $menu_title $menu_Slug $callback
     */

    

    public function setSubPages( $options )
    {
      if ( ! $options ) return;

      $this->callbacks = new AdminCallbacks(); 
    
      $this->subpages = [
        [
          'parent_slug' => 'alleycat_plugin',
          'page_title' => $options['page_title'],
          'menu_title' => $options['menu_title'],
          'capability' => 'manage_options',
          'menu_slug' => $options['menu_slug'],
          'callback' => array( $this->callbacks, $options['callback'] )         
        ]        
      ];      
    }    
}