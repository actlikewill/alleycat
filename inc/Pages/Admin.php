<?php
/**
* @package AlleyCat
*/

namespace Inc\Pages;

use \Inc\Base\BaseController;
use \Inc\API\SettingsAPI;
use \Inc\API\Callbacks\AdminCallbacks;
use \Inc\API\Callbacks\CallbacksManager;


class Admin extends BaseController

{
    public $callbacks;
    public $callbacks_manager;
    public $settings;
    public $pages = array();
    public $subpages = array();

    public function register() 
    {
      $this->settings = new SettingsAPI();

      $this->callbacks = new AdminCallbacks();

      $this->callbacks_manager = new CallbacksManager();
      
      $this->setPages();
      
      $this->setSubPages();
      
      $this->setSettings();

      $this->setSections();

      $this->setFields();  

      $this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages( $this->subpages)->register(); 
    }
    
    public function setPages() 
    {
      $this->pages = [
        [
          'page_title' => 'AlleyCat',
          'menu_title' => 'AlleyCat',
          'capability' => 'manage_options',
          'menu_slug' => 'alleycat_plugin',
          'callback' => array( $this->callbacks, 'adminDashboard' ),
          'icon_url' => 'dashicons-store',
          'position' => 110
        ]
      ];
    }

    public function setSubPages()
    {
      $this->subpages = [
        [
          'parent_slug' => 'alleycat_plugin',
          'page_title' => 'Custom Post Types',
          'menu_title' => 'CPT Manager',
          'capability' => 'manage_options',
          'menu_slug' => 'alleycat_cpt',
          'callback' => array( $this->callbacks, 'cptManager' )         
        ],
        [
          'parent_slug' => 'alleycat_plugin',
          'page_title' => 'Custom Taxonomies',
          'menu_title' => 'Taxonomies',
          'capability' => 'manage_options',
          'menu_slug' => 'alleycat_taxonomies',
          'callback' => array( $this->callbacks, 'taxonomyManager' )          
        ],
        [
          'parent_slug' => 'alleycat_plugin',
          'page_title' => 'Custom Widgets',
          'menu_title' => 'Widgets',
          'capability' => 'manage_options',
          'menu_slug' => 'alleycat_widgets',
          'callback' => array( $this->callbacks, 'widgetManager' )          
        ]
      ];
    }

    public function setSettings()
    {

      $option_list = [
        [
          'option_group' => 'alleycat_plugin_settings',
          'option_name' => 'alleycat_plugin',
          'callback' => [$this->callbacks_manager, 'checkboxSanitize']
        ]
      ];      

      // foreach ( $this->admin_options as $option ) {
      //   array_push( $option_list, [
      //     'option_group' => 'alleycat_plugin_settings',
      //     'option_name' => $option["id"],
      //     'callback' => [$this->callbacks_manager, 'checkboxSanitize']
      //   ]);
      // }    

      $this->settings->setSettings( $option_list );
    }

    public function setSections()
    {
      $args = [
        [
          'id' => 'alleycat_admin_index',
          'title' => 'Settings Manager',
          'callback' => array( $this->callbacks_manager,  'adminSectionManager'),
          'page' => 'alleycat_plugin'
        ]
      ];

      $this->settings->setSections( $args );
    }

    public function setFields()
    {
      $fields_list = [];

      foreach ( $this->admin_options as $options) {
        array_push( $fields_list, [          
            'id' => $options["id"],
            'title' => $options["title"],
            'callback' => array( $this->callbacks_manager, 'checkboxField'),
            'page' => 'alleycat_plugin',
            'section' => 'alleycat_admin_index',
            'args' => [
              'option_name' => 'alleycat_plugin',
              'label_for' => $options["id"],
              'class' => 'ui-toggle'            
            ]          
        ]);
      }
     

      $this->settings->setFields( $fields_list );
    }
}

