<?php
/**
 * The Custom Post Type specific functionality of the plugin.
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
 * Undocumented class
 */
class Team_Widget_CPT {

	/**
	 * Register custom post type
	 *
	 * @link https://codex.wordpress.org/Function_Reference/register_post_type
	 *
	 * @param  array $fields Optional. Array of arguments for registering a post type.
	 *                              Default empty array.
	 * @return void
	 */
	private function register_single_cpt( $fields ) {
		$labels = array(
			'name'          => $fields['plural'],
			'singular_name' => $fields['singular'],
			'menu_name'     => $fields['menu_name'],
			'new_item'      => sprintf( /* translators: %s: title */
				__( 'New %s', 'team-widget' ),
				$fields['singular']
			),
			'add_new_item'  => sprintf( /* translators: %s: title */
				__( 'Add New %s', 'team-widget' ),
				$fields['singular']
			),
			'edit_item'     => sprintf( /* translators: %s: title */
				__( 'Edit %s', 'team-widget' ),
				$fields['singular']
			),
			'view_item'     => sprintf( /* translators: %s: title */
				__( 'View %s', 'team-widget' ),
				$fields['singular']
			),
			'search_items'  => sprintf( /* translators: %s: title */
				__( 'Search %s', 'team-widget' ),
				$fields['plural']
			),
			'all_items'     => sprintf( /* translators: %s: title */
				__( 'All %s', 'team-widget' ),
				$fields['plural']
			),
		);

		$args = array(
			'labels'          => $labels,
			'description'     => ( isset( $fields['description'] ) ) ? $fields['description'] : '',
			'public'          => ( isset( $fields['public'] ) ) ? $fields['public'] : true,
			'capability_type' => ( isset( $fields['capability_type'] ) ) ? $fields['capability_type'] : 'post',
			'has_archive'     => ( isset( $fields['has_archive'] ) ) ? $fields['has_archive'] : true,
			'hierarchical'    => ( isset( $fields['hierarchical'] ) ) ? $fields['hierarchical'] : true,
			'supports'        => ( isset( $fields['supports'] ) ) ? $fields['supports'] : array(
				'title',
				'thumbnail',
				// 'custom-fields',
			),
			'menu_position'   => ( isset( $fields['menu_position'] ) ) ? $fields['menu_position'] : 21,
			'menu_icon'       => ( isset( $fields['menu_icon'] ) ) ? $fields['menu_icon'] : 'dashicons-admin-generic',
		);

		register_post_type( $fields['slug'], $args );
	}

	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	public function create_cpt() {
		$post_types_fields = array(
			array(
				'slug'        => 'team-widget',
				'plural'      => 'Sliders',
				'singular'    => 'Slider',
				'menu_name'   => 'Sliders',
				'description' => 'Add New Slider contents',
			),
		);

		foreach ( $post_types_fields as $fields ) {
			$this->register_single_cpt( $fields );
		}
	}

	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	public function create_metabox() {
		add_meta_box(
			'team_widget_box',
			__( 'Team Widget Content', 'team-widget' ),
			array( $this, 'metabox_fields' ),
			'team-widget',
			'normal',
			'default',
		);
	}

	/**
	 * Undocumented function
	 *
	 * @return mixed
	 */
	public function metabox_fields() {

		global $post;

		wp_nonce_field( basename( __FILE__ ), 'team_widget_nonce' );

		$stored_meta = get_post_meta( $post->ID );

		include_once plugin_dir_path( __FILE__ ) . 'partials/team-widget-admin-display.php';
	}

	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	public function save_metabox() {
		// Post.
		global $post;

		if ( ! current_user_can( 'edit_post' ) ) {
			return;
		}

		update_post_meta(
			'team_widget_box',
			'employment',
			! empty( $_POST['employment'] ),
		);

		update_post_meta(
			'team_widget_box',
			'department',
			! empty( $_POST['department'] ),
		);

		update_post_meta(
			'team_widget_box',
			'description',
			! empty( $_POST['description'] ),
		);

		update_post_meta(
			'team_widget_box',
			'email',
			! empty( $_POST['email'] ),
		);

		update_post_meta(
			'team_widget_box',
			'contact_no',
			! empty( $_POST['contact_no'] ),
		);

	}
}
