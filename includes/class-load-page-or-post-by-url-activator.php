<?php

/**
 * Fired during plugin activation
 *
 * @link       https://wptutorialcoffee.wordpress.com
 * @since      1.0.0
 *
 * @package    Load_Page_Or_Post_By_Url
 * @subpackage Load_Page_Or_Post_By_Url/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Load_Page_Or_Post_By_Url
 * @subpackage Load_Page_Or_Post_By_Url/includes
 * @author     wptutorialcoffee <dev103.php@gmail.com>
 */
class Load_Page_Or_Post_By_Url_Activator {

	/**
	 * Creating Template. (use period)
	 *
	 * Creating a template file inside an active theme, on plugin active.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		$content = "<?php
/**
* Template Name: Load Your Site URL in any Page
*
* @package laup
*/
echo (strpos(get_post_meta( get_the_ID(), 'laup_shortcode_field', true ), '[duplicate-front-page-by-url') !== false) ? do_shortcode(get_post_meta( get_the_ID(), 'laup_shortcode_field', true )) : '<div id=\"laup\"><br/><br/><h3><i>Please enter valid shortcode( </i>[duplicate-front-page-by-url url=\"https://www.your-domain.com\"]<i> ) in custom field \'Load Your Site URL in any Page\'</i> <a href=\''.get_edit_post_link().'\'>edit</a></h3></div>';
if( (strpos(get_post_meta( get_the_ID(), 'laup_shortcode_field', true ), '[duplicate-front-page-by-url') !== false) )
wp_footer();
?>";
		
		$file = get_stylesheet_directory() . '/laup_page_template.php';
		if(!file_exists($file)) {
			include_once ABSPATH . 'wp-admin/includes/file.php';
			\WP_Filesystem();
			global $wp_filesystem;
			$wp_filesystem->put_contents($file, $content, FS_CHMOD_FILE);
		}
	}

}
