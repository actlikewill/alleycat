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

    public function initialize()
    {
        $this->taxonomy_callbacks = new TaxonomyCallbacks();
       
        $this->setSettings();

        $this->setSections();

        $this->setFields();
    }
    
    public function activate()
    {
        $this->setCustomTaxonomies();
        
        if( ! empty( $this->taxonomies ) ) {
            add_action( 'init', [$this, 'registerCustomTaxonomy']);
        }
    }
    
    public function registerCustomTaxonomy()
    {
        foreach($this->taxonomies as $taxonomy){
            $objects = isset($taxonomy['objects']) ? array_keys($taxonomy['objects']) : null;
            
            register_taxonomy($taxonomy['rewrite']['slug'], $objects, $taxonomy);
        }
    }

    public function setCustomTaxonomies() 
    {
        $options = get_option('alleycat_plugin_taxonomy') ?: [];

        foreach ($options as $option) {
            $labels = array(
				'name'              => $option['singular_name'],
				'singular_name'     => $option['singular_name'],
				'search_items'      => 'Search ' . $option['singular_name'],
				'all_items'         => 'All ' . $option['singular_name'],
				'parent_item'       => 'Parent ' . $option['singular_name'],
				'parent_item_colon' => 'Parent ' . $option['singular_name'] . ':',
				'edit_item'         => 'Edit ' . $option['singular_name'],
				'update_item'       => 'Update ' . $option['singular_name'],
				'add_new_item'      => 'Add New ' . $option['singular_name'],
				'new_item_name'     => 'New ' . $option['singular_name'] . ' Name',
				'menu_name'         => $option['singular_name'],
			);
            $this->taxonomies[] = [
                'hierarchical'      => isset($option['hierarchical']) ? true : false,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
                'rewrite'           => array( 'slug' => $option['taxonomy'] ),
                'objects'           => isset($option['objects']) ? $option['objects'] : null
            ];
        }
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
        $field_list = 
        [
            [
                'id' => 'taxonomy',
                'title' => 'Taxonomy ID',
                'callback' => [$this->taxonomy_callbacks, 'textfield'],
                'page' => 'alleycat_taxonomy_manager',
                'section' => 'alleycat_taxonomy_index',
                'args' => [
                    'option_name' => 'alleycat_plugin_taxonomy',
                    'label_for' => 'taxonomy',
                    'placeholder' => 'eg. genre',
                    'array' => 'taxonomy'
                ],

            ],
            [          
                'id' => 'singular_name',
                'title' => 'Singular Name',
                'callback' => array( $this->taxonomy_callbacks, 'textField'),
                'page' => 'alleycat_taxonomy_manager',
                'section' => 'alleycat_taxonomy_index',
                'args' => [
                'option_name' => 'alleycat_plugin_taxonomy',
                'label_for' => 'singular_name',
                'placeholder' => 'eg. Genre',
                'array' => 'taxonomy'
                ]          
            ],
            [          
                'id' => 'heirachical',
                'title' => 'Heirachical',
                'callback' => array( $this->taxonomy_callbacks, 'checkboxField'),
                'page' => 'alleycat_taxonomy_manager',
                'section' => 'alleycat_taxonomy_index',
                'args' => [
                'option_name' => 'alleycat_plugin_taxonomy',
                'label_for' => 'heirachical',
                'class' => 'ui-toggle',
                'array' => 'taxonomy'                         
                ]          
            ],
            [          
                'id' => 'objects',
                'title' => 'Post Types',
                'callback' => array( $this->taxonomy_callbacks, 'checkboxPostTypesField'),
                'page' => 'alleycat_taxonomy_manager',
                'section' => 'alleycat_taxonomy_index',
                'args' => [
                'option_name' => 'alleycat_plugin_taxonomy',
                'label_for' => 'objects',
                'class' => 'ui-toggle',
                'array' => 'taxonomy'                         
                ]          
            ],
        ];

        $this->settings->setFields( $field_list );
    }
}