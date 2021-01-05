<?php
/**
* @package AlleyCat
*/

namespace Inc\API\Callbacks;

class AdminCallbacks extends \Inc\Base\BaseController 
{    

    public function adminDashboard()
    {
        return require_once( "$this->plugin_path/templates/dashboard-template.php"); 
    }

    public function mediaWidgetManager()
    {
        return require_once( "$this->plugin_path/templates/widget-manager-template.php"); 
    }

    public function taxonomyManager()
    {
        return require_once( "$this->plugin_path/templates/taxonomy-manager-template.php"); 
    }

    public function cptManager()
    {        
        return require_once( "$this->plugin_path/templates/cpt-manager-template.php"); 
    }    

    public function alleycatTextFieldExample() 
    {   
        $value = esc_attr( get_option( 'text_example' ) );
        echo '<input type="text" class="regular-text" name="text_example" value="' . $value .'" placeholder="Write Something">';
    }

    public function alleycatFirstName() 
    {   
        $value = esc_attr( get_option( 'first_name' ) );
        echo '<input type="text" class="regular-text" name="text_example" value="' . $value .'" placeholder="Write Your First Name">';
    }
}