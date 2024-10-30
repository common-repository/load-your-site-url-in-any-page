<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://wptutorialcoffee.wordpress.com
 * @since      1.0.0
 *
 * @package    Load_Page_Or_Post_By_Url
 * @subpackage Load_Page_Or_Post_By_Url/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Load_Page_Or_Post_By_Url
 * @subpackage Load_Page_Or_Post_By_Url/includes
 * @author     wptutorialcoffee <dev103.php@gmail.com>
 */
class Load_Page_Or_Post_By_Url_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'load-page-or-post-by-url',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
