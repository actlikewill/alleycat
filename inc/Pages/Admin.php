<?php
/**
* @package AlleyCat
*/

namespace Inc\Pages;

use \Inc\Base\BaseController;
use \Inc\API\SettingsAPI;
use \Inc\API\Callbacks\AdminCallbacks;


class Admin extends BaseController

{
    public $callbacks;
    public $settings;
    public $pages = array();
    public $subpages = array();  

    public function register() 
    {
      $this->settings = new SettingsAPI();

      $this->callbacks = new AdminCallbacks();
      
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
      $args = [
        [
          'option_group' => 'alleycat_options_group',
          'option_name' => 'text_example',
          'callback' => array( $this->callbacks, 'alleycatOptionsGroup')
        ],
        [
          'option_group' => 'alleycat_options_group',
          'option_name' => 'first_name',          
        ]
      ];

      $this->settings->setSettings( $args );
    }

    public function setSections()
    {
      $args = [
        [
          'id' => 'alleycat_admin_index',
          'title' => 'Settings',
          'callback' => array( $this->callbacks, 'alleycatAdminSection'),
          'page' => 'alleycat_plugin'
        ]
      ];

      $this->settings->setSections( $args );
    }

    public function setFields()
    {
      $args = [
        [
          'id' => 'text_example',
          'title' => 'Text Example',
          'callback' => array( $this->callbacks, 'alleycatTextFieldExample'),
          'page' => 'alleycat_plugin',
          'section' => 'alleycat_admin_index',
          'args' => [
            'label_for' => 'text_example',
            'class' => 'example-class'
          ]
          ],
          [
            'id' => 'first_name',
            'title' => 'First Name',
            'callback' => array( $this->callbacks, 'alleycatFirstName'),
            'page' => 'alleycat_plugin',
            'section' => 'alleycat_admin_index',
            'args' => [
              'label_for' => 'first_name',
              'class' => 'example-class'
            ]
          ]
    
      ];

      $this->settings->setFields( $args );
    }
}

