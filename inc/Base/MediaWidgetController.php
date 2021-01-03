<?php
/**
* @package AlleyCat
*/

namespace Inc\Base;

use \Inc\Base\BaseManagerController;

use \Inc\API\Widgets\MediaWidget;

class MediaWidgetController extends BaseManagerController
{    

    public function __construct() {

        $this->set_manager_name('media_widget');        
        
    }

    public function initialize()
    {
        
    }
    
    public function activate()
    {
      $media_widget = new MediaWidget(); 
      
      $media_widget->register();
    }
}