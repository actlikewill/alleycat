<?php
/**
* @package AlleyCat
*/

namespace Inc\API\Callbacks;

class CPTCallbacks  
{
    
    public function cptSectionManager() 
    {
        echo 'Create your custom post types.';
    }
    
    public function cptSanitze( $input )
    {
        var_dump($input);
        die();
        return $input;
    }
    
    public function textField( $args )
    {   
        $name = $args['label_for'];
        $class = $args['class'];
        $option_name = $args['option_name'];
        $input = get_option( $option_name );
        $value = $input[$name];

        echo '<input type="text class="regular-text" id="'. $name .'" name="' . $option_name .'[second-test][' . $name .']" value="' . $value . '" placeholder="' . $args['placeholder'] . '"';
    }
    
    public function checkboxField( $args )
    {   
        $name = $args['label_for'];
        $class = $args['class'];
        $option_name = $args['option_name'];
        $checkbox = get_option( $option_name );
        echo '<div class="' . $class . '"><input type="checkbox" id="' .$name . '" name="' . $option_name .'[second-test][' . $name .']" value=1 class="" ' . ($checkbox[$name] ? 'checked' : '') . '><label for="' .$name . '"><div></div></label></div>';
    }


}