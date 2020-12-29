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
    
    public function cptSanitize( $input )
    {

        $output = get_option('alleycat_plugin_cpt');

        if( isset($_POST["remove"] ) ) {
            unset( $output[ $_POST[ "remove" ] ] );
            return $output;
        }

        if( ! $output ) {
            $new_input = [$input['post_type'] => $input];
            return $new_input;
        } else {
            foreach ($output as $key => $value) {
                if ($input['post_type'] === $key ) {
                    $output[$key] = $input;
                } else {
                    $output[$input['post_type']] = $input;
                }
            }
            return $output;
        }
    }
        
    public function var_dump_pre($mixed = null) 
    {
        echo '<pre style="margin-left: 15rem">';
        var_dump($mixed);
        echo '</pre>';
        return null;
    }

    public function textField( $args )
    {   
        $name = $args['label_for'];
        // $class = $args['class'];
        $option_name = $args['option_name'];
        $value = '';
        
        if( isset($_POST["edit_post"])) {
            $input = get_option( $option_name );
            $value = $input[$_POST["edit_post"]][$name];            
        }

        echo '<input type="text class="regular-text" id="'. $name .'" name="' . $option_name .'[' . $name .']" value="' . $value . '" placeholder="' . $args['placeholder'] . '"';
    }
    
    public function checkboxField( $args )
    {   
        $name = $args['label_for'];
        $class = $args['class'];
        $option_name = $args['option_name'];
        $checked = false;
        if( isset($_POST["edit_post"])) {
            $checkbox = get_option( $option_name );
            $checked = isset($checkbox[$_POST["edit_post"]][$name]) ?: false;
        }
        echo '<div class="' . $class . '"><input type="checkbox" id="' .$name . '" name="' . $option_name .'[' . $name .']" value=1 class="" ' . ($checked ? 'checked' : '') . '><label for="' .$name . '"><div></div></label></div>';
    }

    
}
