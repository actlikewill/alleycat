<?php
/**
* @package AlleyCat
*/

namespace Inc\Base;

use \Inc\Base\BaseManagerController;

class TestimonyController extends BaseManagerController
{    

    public function __construct() {

        $this->set_manager_name('testimonial_manager');        
        
    }

    public function initialize()
    {
      add_action( 'init', array( $this, 'testimonial_cpt' ) );
      add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
      add_action( 'save_post', array( $this, 'save_meta_box' ) );
    }
    
    public function testimonial_cpt ()
    {
      $labels = array(
        'name' => 'Testimonials',
        'singular_name' => 'Testimonial'
      );
  
      $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-testimonial',
        'exclude_from_search' => true,
        'publicly_queryable' => false,
        'supports' => array( 'title', 'editor' )
      );
  
      register_post_type ( 'testimonial', $args );
    }

    public function add_meta_boxes()
	{
		add_meta_box(
			'testimonial_author',
			'Author',
			array( $this, 'render_author_box' ),
			'testimonial',
			'side',
			'default'
		);
  }
  

	public function render_author_box($post)
	{
		wp_nonce_field( 'alleycat_testimonial_author', 'alleycat_testimonial_author_nonce' );

		$value = get_post_meta( $post->ID, '_alleycat_testimonial_author_key', true );
		?>
		<label for="alleycat_testimonial_author">Testimonial Author</label>
		<input type="text" id="alleycat_testimonial_author" name="alleycat_testimonial_author" value="<?php echo esc_attr( $value ); ?>">
		<?php
  }
  
  
	public function save_meta_box($post_id)
	{
		if (! isset($_POST['alleycat_testimonial_author_nonce'])) {
			return $post_id;
		}

		$nonce = $_POST['alleycat_testimonial_author_nonce'];
		if (! wp_verify_nonce( $nonce, 'alleycat_testimonial_author' )) {
			return $post_id;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		if (! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}

		$data = sanitize_text_field( $_POST['alleycat_testimonial_author'] );
		update_post_meta( $post_id, '_alleycat_testimonial_author_key', $data );
	}

}