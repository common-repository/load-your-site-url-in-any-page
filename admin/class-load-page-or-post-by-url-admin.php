<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://wptutorialcoffee.wordpress.com
 * @since      1.0.0
 *
 * @package    Load_Page_Or_Post_By_Url
 * @subpackage Load_Page_Or_Post_By_Url/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Load_Page_Or_Post_By_Url
 * @subpackage Load_Page_Or_Post_By_Url/admin
 * @author     wptutorialcoffee <dev103.php@gmail.com>
 */
class Load_Page_Or_Post_By_Url_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		add_action( 'admin_menu', array( $this, 'loadanyurl_menu_page' ) );
		add_action('add_meta_boxes', array( $this, 'laup_page_template_meta_box' ) );
		add_action( 'save_post', array( $this, 'laup_save_meta_box' ) );
		add_action('admin_head-post.php', array( $this, 'laup_page_template_script' ) );
		add_action('admin_head-post-new.php', array( $this, 'laup_page_template_script' ) );
	}

	/**
	 * Add Menu Pages for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function loadanyurl_menu_page() {
          add_menu_page( 
          	'Load Your Site URL in any Page', 
          	'Load Your Site URL', 
          	'manage_options', 
          	'load-page-or-post-by-url', 
          	array(
                $this,
                'loadanyurl_menu_page_load'
            ), 
          	'dashicons-welcome-widgets-menus', 90 );
    }

    /**
	 * Admin main page or setting page.
	 *
	 * @since    1.0.0
	 */
    public function loadanyurl_menu_page_load() {

        ?>
        <div class="laup_main">			
			<h1 id="settings_laup_title"><?php _e('Load Your Site URL in any Page','load-page-or-post-by-url'); ?></h1>			
			<div id="tabs">
			    <ul>
				    <li><a href="#laup_how-1"><span class="dashicons dashicons-welcome-view-site"></span>&nbsp;<?php _e('How To Display','load-page-or-post-by-url'); ?></a></li>
				    <li><a href="#laup_help-2"><span class="dashicons dashicons-editor-help"></span>&nbsp;<?php _e('Help','load-page-or-post-by-url'); ?></a></li>
			    </ul>
			  	<div class="laup_tab-wrapper">
				  <div id="laup_how-1">
				  	<h3><?php _e('Should follow 2 steps as explain in below screenshot.','load-page-or-post-by-url'); ?></h3>
				  	<label><?php _e('Shortcode','load-page-or-post-by-url'); ?><input type="text" class="aig_howto_shortcode" value='[duplicate-front-page-by-url url="http://your-domain.com/any-page"]' onclick="laup_select_focus_element(this)" size="30" readonly="readonly"></label>
				  	<div style="padding: 2%; margin-right: 4%;">
				  		<img style="border: 2px dashed #0073aa; padding: 2px; max-width: 900px;" width="100%" src="<?php echo plugin_dir_url( dirname(__FILE__) ); ?>laup-steps.png" />				  		
				  	</div>
				  	<script>function laup_select_focus_element(obj) {obj.focus();obj.select();}</script>
				  </div>
				  <div id="laup_help-2">
				  	<h2><?php _e('Why plugin not working or loading URL, In below case :','load-page-or-post-by-url'); ?></h2>
				  	<h4><span class="dashicons dashicons-yes"></span> <?php _e('Plugin will not work on local server. You should have an online website for the plugin to function properly','load-page-or-post-by-url'); ?></h4>
				  	<h4><span class="dashicons dashicons-yes"></span> <?php _e('When you loading any page or url, That page should be public Or everything loading without restriction( like css,js,images ).','load-page-or-post-by-url'); ?></h4>
				  	<h4><span class="dashicons dashicons-yes"></span> <?php _e('Loading same URL in same page will break functionality.','load-page-or-post-by-url'); ?></h4>
				  </div>
			  	</div>
			</div>
		</div>
        <?php
    }

    /**
	 * Adding metabox for enter shortcode.
	 *
	 * @since    1.0.0
	 */
    public function laup_page_template_meta_box(){
	    add_meta_box(
	        'laup_page_template_options',
	        __( 'Load Your Site URL in any Page' ),
	        array( $this, 'laup_page_template_options_callback' ),
	        'page',
	        'normal', 
	        'high'
	    );
	}

	/**
	 * Saving/Upading our custom meta field.
	 *
	 * @since    1.0.0
	 */
	public function laup_save_meta_box($post_id){
		$laup_shortcode_field = sanitize_text_field( $_POST['laup_shortcode_field'] );
		update_post_meta( $post_id, 'laup_shortcode_field', $laup_shortcode_field );
	}

	/**
	 * Showing our custom meta field.
	 *
	 * @since    1.0.0
	 */
	public function laup_page_template_options_callback($post){
	    //Your custom field form goes here	    
	    $value = get_post_meta( $post->ID, 'laup_shortcode_field', true );
	    ?>
        <label for="laup_shortcode_field">
            <?php _e( 'Enter Shortcode here', 'load-page-or-post-by-url' ); ?>
        </label>
        <input type="text" placeholder='[duplicate-front-page-by-url url="https://www.your-domain.com/any-page-or-post-which-you-want-to-copy"]' id="laup_shortcode_field" name="laup_shortcode_field" value="<?php echo $value ? esc_attr( $value ) : ''; ?>" style="width:100%;margin:0;" />
		<div style=" font-style: initial !important; padding: 5px 0; font-family: monospace; overflow-wrap: break-word; ">[duplicate-front-page-by-url url="<?php echo home_url(); ?>/"]</div>
        <?php
	}

	/**
	 * Show our custom metabox only when selected our template.
	 *
	 * @since    1.2.0
	 */
	public function laup_page_template_script(){
	    global $post;

	    # Only use this script for pages
	    if('page' !== $post->post_type)
	        return;

	    #Name of page template file
	    $file = 'laup_page_template.php';

	    $output = "
	        <!-- Hide the Meta Box -->
	        <style type='text/css'>
	            #laup_page_template_options{display:none;}
	        </style>

	        <script type='text/javascript'>
	            jQuery(document).ready(function($){
	                var _file = '$file';
	                var _meta_box = $('#laup_page_template_options');

	                setTimeout(function(){
	                	
		                if( $('#page_template').length )
		                var _page_template = $('#page_template');
		                else
		                var _page_template = $('.editor-page-attributes__template select');


		                //Show meta box on page load
		                if(_file == _page_template.val()){
		                    _meta_box.show();
							$('.wp-editor-expand').hide();
							$('.postarea').hide();
						}

		                //Sniff changes to the page template dropdown
		                _page_template.change(function(){

		                    if(_file == _page_template.val()){
		                        _meta_box.show();
								$('.wp-editor-expand').hide();
								$('.postarea').hide();
							}
		                    else{
		                    	_meta_box.hide();
								$('.wp-editor-expand').show();
								$('.postarea').show();
							}
		                });

	                }, 3000);
	            });
	            
	            
	        </script>
	    ";
	    echo $output;
	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/load-page-or-post-by-url-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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
		wp_enqueue_script('jquery-ui-tabs',array( 'jquery' ), $this->version, false);
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/load-page-or-post-by-url-admin.js', array( 'jquery' ), $this->version, false );

	}

}
