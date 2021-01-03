<?php
/**
* @package AlleyCat
*/

namespace Inc\API\Callbacks;

class TaxonomyCallbacks  
{
   public function taxonomySanitize( $input )
    {

        $output = get_option('alleycat_plugin_taxonomy');

        if( isset($_POST["remove"] ) ) {
            unset( $output[ $_POST[ "remove" ] ] );
            return $output;
        }

        if( ! $output ) {
            $new_input = [$input['taxonomy'] => $input];
            return $new_input;
        } else {
            foreach ($output as $key => $value) {
                if ($input['taxonomy'] === $key ) {
                    $output[$key] = $input;
                } else {
                    $output[$input['taxonomy']] = $input;
                }
            }
            return $output;
        }
   }

   public function taxonomySections()
    {
        echo 'Create Custom Taxonomy.';
    }

   public function textField( $args )
    {   
        $name = $args['label_for'];
        $option_name = $args['option_name'];
        $value = '';
        
        if( isset($_POST["edit_taxonomy"])) {
            $input = get_option( $option_name );
            $value = $input[$_POST["edit_taxonomy"]][$name];            
        }

        echo '<input type="text class="regular-text" id="'. $name .'" name="' . $option_name .'[' . $name .']" value="' . $value . '" placeholder="' . $args['placeholder'] . '"';
    }
    
    public function checkboxField( $args )
     {   
        $name = $args['label_for'];
        $class = $args['class'];
        $option_name = $args['option_name'];
        $checked = false;
        if( isset($_POST["edit_taxonomy"])) {
            $checkbox = get_option( $option_name );
            $checked = isset($checkbox[$_POST["edit_taxonomy"]][$name]) ?: false;
        }
        echo '<div class="' . $class . '"><input type="checkbox" id="' .$name . '" name="' . $option_name .'[' . $name .']" value=1 class="" ' . ($checked ? 'checked' : '') . '><label for="' .$name . '"><div></div></label></div>';
     }
     
    public function checkboxPostTypesField( $args )
    {   
        $output = '';
        $name = $args['label_for'];
        $class = $args['class'];
        $option_name = $args['option_name'];
        $checked = false;
        if( isset($_POST["edit_taxonomy"])) {
            $checkbox = get_option( $option_name );
            $checked = isset($checkbox[$_POST["edit_taxonomy"]][$name]) ?: false;
        }
        $post_types = get_post_types( [ 'show_ui' => true ] );
        foreach ($post_types as $post) {
            if ( isset($_POST["edit_taxonomy"])) {
            $checked = isset($checkbox[$_POST["edit_taxonomy"]][$name][$post]) ?: false;
            }
            $output .='<div class="' . $class . ' mb-10"><input type="checkbox" id="' .$post . '" name="' . $option_name .'[' . $name .']['. $post .']" value=1 class="" ' . ($checked ? 'checked' : '') . '><label for="' .$post . '"><div></div></label> <strong>' . $post . '</strong></div>';
        }

        echo $output;
    }  
}
    