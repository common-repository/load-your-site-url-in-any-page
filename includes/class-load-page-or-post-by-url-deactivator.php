<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://wptutorialcoffee.wordpress.com
 * @since      1.0.0
 *
 * @package    Load_Page_Or_Post_By_Url
 * @subpackage Load_Page_Or_Post_By_Url/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Load_Page_Or_Post_By_Url
 * @subpackage Load_Page_Or_Post_By_Url/includes
 * @author     wptutorialcoffee <dev103.php@gmail.com>
 */
class Load_Page_Or_Post_By_Url_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
			
		$file = get_stylesheet_directory() . '/laup_page_template.php';
    	unlink($file);
	}

}
