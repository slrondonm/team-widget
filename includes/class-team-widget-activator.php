<?php
/**
 * Fired during plugin activation
 *
 * @link       https://gitlab.com/slrondonm
 * @since      1.0.0
 *
 * @package    Team_Widget
 * @subpackage Team_Widget/includes
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Team_Widget
 * @subpackage Team_Widget/includes
 * @author     Sergio Lankaster Rondón Melo <sl.rondon.m@gmail.com>
 */
class Team_Widget_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . '/admin/class-team-widget-cpt.php';

		$team_widget_cpt = new Team_Widget_CPT();

		$team_widget_cpt->create_cpt();

		flush_rewrite_rules();
	}

}
