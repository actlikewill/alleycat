<?php
/**
* @package AlleyCat
*/

namespace Inc\Base;

use \Inc\Base\BaseManagerController;

class TaxonomyManagerController extends BaseManagerController
{
    
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
        register_post_type( 'alleycat_taxonomies', 
            [
                'labels' => [
                    'name' => 'Taxoes',
                    'singular_name' => 'Taxo',                
                ],
                'public' => true,
                'has_archive' => true
            ]
        );
    }   
}