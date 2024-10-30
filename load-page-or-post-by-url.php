<?php

/**
 * The plugin bootstrap file
 *
 *
 * @link              https://wptutorialcoffee.wordpress.com
 * @since             1.2.0
 * @package           Load_Page_Or_Post_By_Url
 *
 * @wordpress-plugin
 * Plugin Name:       Duplicate Front Page
 * Plugin URI:        https://wptutorialcoffee.wordpress.com/2019/09/26/load-your-site-url-in-any-page/
 * Description:       This plugin use for display same 100% duplicate front page in another page.
 * Version:           1.2.0
 * Author:            wptutorialcoffee
 * Author URI:        https://wptutorialcoffee.wordpress.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       load-page-or-post-by-url
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'LOAD_PAGE_OR_POST_BY_URL_VERSION', '1.2.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-load-page-or-post-by-url-activator.php
 */
function activate_load_page_or_post_by_url() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-load-page-or-post-by-url-activator.php';
	Load_Page_Or_Post_By_Url_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-load-page-or-post-by-url-deactivator.php
 */
function deactivate_load_page_or_post_by_url() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-load-page-or-post-by-url-deactivator.php';
	Load_Page_Or_Post_By_Url_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_load_page_or_post_by_url' );
register_deactivation_hook( __FILE__, 'deactivate_load_page_or_post_by_url' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-load-page-or-post-by-url.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_load_page_or_post_by_url() {

	$plugin = new Load_Page_Or_Post_By_Url();
	$plugin->run();

}
run_load_page_or_post_by_url();
