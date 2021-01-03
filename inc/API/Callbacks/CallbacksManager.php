<?php
/**
* @package AlleyCat
*/

namespace Inc\API\Callbacks;

class CallbacksManager extends \Inc\Base\BaseController 
{
    public function checkboxSanitize( $input ) 
    {
    //   return ( isset( $input) ? true : false ); 
    
        $output = [];

         foreach(  $this->admin_options as $option ) {
            $output[$option["id"]] = (isset($input[$option["id"]]) && $input[$option["id"]] == 1) ? true : false;
         }

        return $output;
    }

    public function adminSectionManager() 
    {
        echo 'Activate features by checking the boxes.';
    }

    public function checkboxField( $args )
    {   
        $name = $args['label_for'];
        $class = $args['class'];
        $option_name = $args['option_name'];
        $checkbox = get_option( $option_name );
        echo '<div class="' . $class . '"><input type="checkbox" id="' .$name . '" name="' . $option_name .'[' . $name .']" value=1 class="" ' . ($checkbox[$name] ? 'checked' : '') . '><label for="' .$name . '"><div></div></label></div>';
    }
}