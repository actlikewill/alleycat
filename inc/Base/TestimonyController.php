<?php
/**
* @package AlleyCat
*/

namespace Inc\Base;

use \Inc\API\SettingsAPI;
use \Inc\Base\BaseController;
use \Inc\Base\BaseManagerController;
use \Inc\API\Callbacks\TestimonialCallbacks;

class TestimonyController extends BaseManagerController
{   

	public $bc;
	
	public function __construct() {

		$this->set_manager_name('testimonial_manager');        
		
	}
  public function initialize()
    {
			$this->callbacks = new TestimonialCallbacks();

      add_action( 'init', array( $this, 'testimonial_cpt' ) );
      add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
			add_action( 'save_post', array( $this, 'save_meta_box' ) );
			add_action( 'manage_testimonial_posts_columns', [$this, 'set_custom_columns']);
			add_action( 'manage_testimonial_posts_custom_column', [$this, 'set_custom_columns_data'], 10, 2);
			add_filter( 'manage_edit-testimonial_sortable_columns', [$this, 'set_custom_columns_sortable', ]);
		}
		
		public function activate()
		{
			$this->set_short_code_page();
			add_shortcode( 'testimonial-form', [$this, 'testimonial_form']);
		}

		public function testimonial_form()
		{
			$path = $this->get_my_plugin_path();
			$url = $this->get_my_plugin_url();
			ob_start();
			echo "<link href=\"$url/assets/form.css\" rel=\"stylesheet\"></link>";
			require_once("$path/templates/contact-form.php");
			echo "<script src=\"$url/src/form.js\"></script";
			return ob_get_clean();

		}

		public function set_short_code_page()
		{
			$subpage = [
					[
						'parent_slug' => 'edit.php?post_type=testimonial',
						'page_title' => 'Shortcodes',
						'menu_title' => 'Shortcodes',
						'capability' => 'manage_options',
						'menu_slug' => 'alleycat_testimonial_shortcode',
						'callback' => [ $this->callbacks, 'shortcodePage']
					]
				];
				$this->settings->addSubPages( $subpage )->register();
		}


		
		public function  add_email_box()
		{
			add_meta_box(
				'testimonial_author_email',
				'Author Email',
				[$this, 'render_author_email_box'],
				'testimonial',
				'side',
				'default'
			);
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
		$args = [
			[
				'testimonial_author',
				'Testimonial',
				array( $this, 'render_testimonial_meta_box' ),
				'testimonial',
				'side',
				'default'
			],
		];
			foreach( $args as $arg) {
				add_meta_box(...$arg);
			}
	}
	

		public function render_testimonial_meta_box($post)
	{
		wp_nonce_field( 'alleycat_testimonial', 'alleycat_testimonial_nonce' );

		$data = get_post_meta( $post->ID, '_alleycat_testimonial_key', true );
		$name = isset($data['name']) ? $data['name'] : '';
		$email = isset($data['email']) ? $data['email'] : '';
		$approved = isset($data['approved']) ? $data['approved'] : false;
		$featured = isset($data['featured']) ? $data['featured'] : false;
		?>
		<p>
			<label class="meta-label" for="alleycat_testimonial_author">Author Name</label>
			<input type="text" id="alleycat_testimonial_author" name="alleycat_testimonial_author" class="widefat" value="<?php echo esc_attr( $name ); ?>">
		</p>
		<p>
			<label class="meta-label" for="alleycat_testimonial_email">Author Email</label>
			<input type="email" id="alleycat_testimonial_email" name="alleycat_testimonial_email" class="widefat" value="<?php echo esc_attr( $email ); ?>">
		</p>
		<div class="meta-container">
			<label class="meta-label w-50 text-left" for="alleycat_testimonial_approved">Approved</label>
			<div class="text-right w-50 inline">
				<div class="ui-toggle inline"><input type="checkbox" id="alleycat_testimonial_approved" name="alleycat_testimonial_approved" value="1" <?php echo $approved ? 'checked' : ''; ?>>
					<label for="alleycat_testimonial_approved"><div></div></label>
				</div>
			</div>
		</div>
		<div class="meta-container">
			<label class="meta-label w-50 text-left" for="alleycat_testimonial_featured">Featured</label>
			<div class="text-right w-50 inline">
				<div class="ui-toggle inline"><input type="checkbox" id="alleycat_testimonial_featured" name="alleycat_testimonial_featured" value="1" <?php echo $featured ? 'checked' : ''; ?>>
					<label for="alleycat_testimonial_featured"><div></div></label>
				</div>
			</div>
		</div>
		<?php
	}	
  
public function save_meta_box($post_id)
	{
		if (! isset($_POST['alleycat_testimonial_nonce'])) {
			return $post_id;
		}

		$nonce = $_POST['alleycat_testimonial_nonce'];
		if (! wp_verify_nonce( $nonce, 'alleycat_testimonial' )) {
			return $post_id;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		if (! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}

		$data = array(
			'name' => sanitize_text_field( $_POST['alleycat_testimonial_author'] ),
			'email' => sanitize_text_field( $_POST['alleycat_testimonial_email'] ),
			'approved' => isset($_POST['alleycat_testimonial_approved']) ? 1 : 0,
			'featured' => isset($_POST['alleycat_testimonial_featured']) ? 1 : 0,
		);
		update_post_meta( $post_id, '_alleycat_testimonial_key', $data );
	}

	public function set_custom_columns( $columns )
	{
		$title = $columns['title'];
		$date = $columns['date'];

		unset(  $columns['title'], $columns['date']);

		$columns['name'] = 'Author Name';
		$columns['title'] = $title;
		$columns['approved'] = 'Approved';
		$columns['featured'] = 'Featured';
		$columns['date'] = $date;


		return $columns;
	}

	public function set_custom_columns_data( $column, $post_id)
	{

		$data = get_post_meta( $post_id, '_alleycat_testimonial_key', true );
		$name = isset($data['name']) ? $data['name'] : '';
		$email = isset($data['email']) ? $data['email'] : '';
		$approved = isset($data['approved']) && $data['approved'] === 1 ? '<strong>YES</strong>' : 'NO';
		$featured = isset($data['featured']) && $data['featured'] === 1 ? '<strong>YES</strong>' : 'NO';
			
		switch($column)
		{
			case 'name':
				echo '<strong>'. $name . '</strong><br><a href -"mailto:' . $email . '">' .$email . '</a>';
				break;
			case 'approved':
				echo $approved;
				break;
			case 'featured':
				echo $featured;

		}

	}

	public function set_custom_columns_sortable($columns)
	{
		$columns['name'] = 'name';
		$columns['approved'] = 'approved';
		$columns['featured'] = 'featured';
		return $columns;
	}
}