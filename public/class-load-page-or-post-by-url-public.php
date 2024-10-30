<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://wptutorialcoffee.wordpress.com
 * @since      1.0.0
 *
 * @package    Load_Page_Or_Post_By_Url
 * @subpackage Load_Page_Or_Post_By_Url/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Load_Page_Or_Post_By_Url
 * @subpackage Load_Page_Or_Post_By_Url/public
 * @author     wptutorialcoffee <dev103.php@gmail.com>
 */
class Load_Page_Or_Post_By_Url_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_shortcode('duplicate-front-page-by-url', array($this,'laup_shortcode'));
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Load_Page_Or_Post_By_Url_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Load_Page_Or_Post_By_Url_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/load-page-or-post-by-url-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Load_Page_Or_Post_By_Url_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Load_Page_Or_Post_By_Url_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/load-page-or-post-by-url-public.js', array( 'jquery' ), $this->version, false );

	}

	public function laup_shortcode($atts, $content = null) {
		/**
		 * Displaying Shortcode HTML.
		 *
		 * @since    1.2.0
		 * @param    string   $content    the enclosed content (if the shortcode is used in its enclosing form).
		 * @param    array    $atts       an associative array of attributes, or an empty string if no attributes are given.
		 *
		 * The Load_Page_Or_Post_By_Url will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

	    //Pass in shortcode attrbutes
	    
	    $atts = shortcode_atts(
	    array(
			'url' => '',			
			'timeout' => 50,			
		    ), $atts);
		
	    ob_start();
	    ?>

		<?php if (!filter_var($atts['url'], FILTER_VALIDATE_URL)) { get_header(); echo '<div id="laup"><br/><br/>Please enter Valid URL in shortcode. ex [duplicate-front-page-by-url url="https://www.your-domain.com"]</div>'; get_footer(); return false; } ?>

		<?php if( strpos($atts['url'], home_url()) !== 0 ) { get_header(); echo '<div id="laup"><br/><br/>Please enter only your own website URL in shortcode. ex [duplicate-front-page-by-url url="https://www.your-domain.com"]</div>'; get_footer(); return false; } ?>
	    
	    <?php
		$response = wp_remote_get( esc_url($atts['url']), array('timeout'=> 120));

		if ( is_array( $response ) ) {
			  $header = $response['headers']; // array of http header lines
			  $body = $response['body']; // use the content
			  echo $body;
		}else{
			get_header();
			echo '<div id="laup"><br><br><br><b>Error: </b>'.get_post_meta( get_the_ID(), 'laup_shortcode_field', true ); // Bail early
			
			foreach( $response->errors as $errors ){
				//print_r($errors);
				if( is_array($errors) ){

					foreach ($errors as $key => $err) {

						if( is_array($err) ){
							foreach ($err as $k => $er) {
								if( is_array($er) || is_object($er) )
								var_dump($er);
								else
								echo '<br>'.$er;
							}
						}
						else{
							echo '<br>'.$err;
						}
					}
				}
			}

			echo '</div>';
			get_footer();
		}
		?>

	    <?php
		$output = ob_get_clean();
		return $output;
	}

}
