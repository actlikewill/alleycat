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
     echo 'Create Custom Taxonomy.'
   }

 public function textField( $args )
    {   
        $name = $args['label_for'];
        // $class = $args['class'];
        $option_name = $args['option_name'];
        $value = '';
        
        if( isset($_POST["edit_post"])) {
            $input = get_option( $option_name );
            $value = $input[$_POST["edit_taxonomy"]][$name];            
        }

        echo '<input type="text class="regular-text" id="'. $name .'" name="' . $option_name .'[' . $name .']" value="' . $value . '" placeholder="' . $args['placeholder'] . '"';
    }
    
    
  
}
    