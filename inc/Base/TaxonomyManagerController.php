<?php
/**
* @package AlleyCat
*/

namespace Inc\Base;

use \Inc\Base\BaseManagerController;

use \Inc\API\Callbacks\TaxonomyCallbacks;

class TaxonomyManagerController extends BaseManagerController
{
    
    public $taxonomies = [];

    public function __construct() {

        $this->set_manager_name('taxonomy_manager');

        $this->setSubpages(
            [
                'page_title' => 'Taxonomy Manager',
                'menu_title' => 'Taxonomy Manager',
                'menu_slug' => 'alleycat_taxonomy_manager',
                'callback' => 'taxonomyManager'
            ]
        );
        
    }

    public function activate()
    {
        $this->taxonomy_callbacks = new TaxonomyCallbacks();
       
        $this->setSettings();

        $this->setSections();
    }   

    public function setSettings() 
    {
        $options_list = [
                [
                    'option_group' => 'alleycat_plugin_taxonomy_settings',
                    'option_name' => 'alleycat_plugin_taxonomy',
                    'callback' => [$this->taxonomy_callbacks, 'taxonomySanitize']
                ]
            ];
        
        $this->settings->setSettings( $options_list );
    }

    public function setSections()
    {
        $args = [
                [
                    'id' => 'alleycat_taxonomy_index',
                    'title' => 'Taxonomy Manager',
                    'callbacks' => [$this->taxonomy_callbacks, 'taxonomySections'],
                    'page' => 'alleycat_taxonomy_manager'
                ]
            ];
        
        $this->settings->setSections( $args );

    }

    public function setFields()
    {
        $field_list = [
            [
                'id' => 'taxonomy',
                'title' => 'Taxonomy ID',
                'callback' => [$this->taxonomy_callbacks, 'textfield'],
                'page' => 'alleycat_taxonomy_manager',
                'section' => 'alleycat_taxonomy_index',
                'args' => '[]',

            ]
        ];
    }
}