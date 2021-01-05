<?php 

/**
 * @package AlleyCat
 */

 namespace Inc;

 final class Init

 {
    /**
     * Store all classes in an array
     * @return array Full list of classes
     */
    public static function get_services() 
    {
        return [
            Pages\Dashboard::class,            
            Base\Enqueue::class,
            Base\SettingsLinks::class,
            Base\CustomPostTypeController::class,
            Base\TaxonomyManagerController::class,
            Base\MediaWidgetController::class,
            Base\TestimonyController::class,
            Base\TemplateManagerController::class,
        ];
    }

    /**
     * Loop through all the classes and initialize them.
     * @return 
     */
    public static function register_services() 
    {
       foreach ( self::get_services() as $class) {
            $service = self::instantiate( $class );
            if( method_exists( $service, 'register' ) ) {
                $service->register();
            }
       }
    }

    /**
     * Initialize the class 
     * @param class $class class from services array
     *  @return class
     */  
    private static function instantiate( $class ) 
    {
        return new $class();
    }

 }

