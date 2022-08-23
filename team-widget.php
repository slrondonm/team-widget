<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/slrondonm
 * @since             1.2.1
 * @package           Team_Widget
 *
 * @wordpress-plugin
 * Plugin Name:       Team Widget
 * Plugin URI:        https://github.com/slrondonm/team-widget
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.2.1
 * Author:            Sergio Lankaster Rondón Melo
 * Author URI:        https://github.com/slrondonm
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       team-widget
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 */
if ( ! defined( 'TEAM_WIDGET_VERSION' ) ) {
	define( 'TEAM_WIDGET_VERSION', '1.0.0' );
}

if ( ! defined( 'TEAM_WIDGET_NAME' ) ) {
	define( 'TEAM_WIDGET_NAME', 'team-widget' );
}

$dir_path = dirname( __FILE__ );
define( 'TEAM_WIDGET_DIR', $dir_path );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-team-widget-activator.php
 */
function activate_team_widget() {
	require_once plugin_dir_path( __FILE__ )

	. 'includes/class-team-widget-activator.php';
	Team_Widget_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-team-widget-deactivator.php
 */
function deactivate_team_widget() {
	require_once plugin_dir_path( __FILE__ )
	. 'includes/class-team-widget-deactivator.php';
	Team_Widget_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_team_widget' );
register_deactivation_hook( __FILE__, 'deactivate_team_widget' );


if ( is_admin() ) {
	if ( ! class_exists( 'Puc_v4_Factory' ) ) {
		require_once $dir_path . '/includes/plugin-update-checker/plugin-update-checker.php';
	}

	$my_update_checker = Puc_v4_Factory::buildUpdateChecker(
		'https://github.com/slrondonm/' . TEAM_WIDGET_NAME,
		__FILE__,
		TEAM_WIDGET_NAME
	);

	// Set the branch that contains the stable release.
	$my_update_checker->setBranch( 'main' );

}

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . '/includes/class-team-widget.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_team_widget() {

	$plugin = new Team_Widget();
	$plugin->run();

}
run_team_widget();
