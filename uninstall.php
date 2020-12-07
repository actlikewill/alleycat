<?php

/*
 @package AlleyCat
 */

 if( ! defined('WP_UNINISTALL_PLUGIN') ) {
   die;
 }

 //  Clear Data

 $books = get_posts( array( 'post_type' => 'book', 'numberposts' => -1 ) );

 foreach($books as $book) {
   wp_delete_post( $book->ID, true )
 }

 