<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://gitlab.com/slrondonm
 * @since      1.0.0
 *
 * @package    Team_Widget
 * @subpackage Team_Widget/admin
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Team_Widget
 * @subpackage Team_Widget/admin
 * @author     Sergio Lankaster Rondón Melo <sl.rondon.m@gmail.com>
 */
class Team_Widget_Admin {


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
	 * @since 1.0.0
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version     The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
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
		 * defined in Team_Widget_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Team_Widget_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( 'bootstrap_css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css', array(), '4.1.3' );

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/team-widget-admin.css', array(), $this->version, 'all' );
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
		 * defined in Team_Widget_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Team_Widget_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( 'popper_js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', array(), '1.14.3', true );

		wp_enqueue_script( 'bootstrap_js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js', array( 'jquery', 'popper_js' ), '4.1.3', true );

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/team-widget-admin.js', array( 'jquery' ), $this->version, true );
	}

	/**
	 * Register menu admin link.
	 *
	 * @return void add_menu_page().
	 */
	public function add_admin_menu() {
		/**
		 * Args for add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position )
		 */
		add_submenu_page(
			'edit.php?post_type=team-widget',
			__( 'Team Widget Test Options', 'team-widget' ),
			__( 'Team Widget Options', 'team-widget' ),
			'manage_options',
			'team-widget',
			array( $this, 'add_page_admin' ),
		);

	}

	/**
	 * Display page options.
	 *
	 * @return void
	 */
	public function add_page_admin() {
		include_once plugin_dir_path( __FILE__ ) . 'partials/team-widget-admin-display.php';
	}
}
