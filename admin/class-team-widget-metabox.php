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

class Team_Widget_Metabox {

	/**
	 * Undocumented variable
	 *
	 * @var array
	 */
	private $screen = array( 'team-widget' );

	/**
	 * Undocumented variable
	 *
	 * @var array
	 */
	private $meta_fields = array(
		array(
			'label'   => 'Jobs',
			'id'      => 'job_text',
			'default' => 'Example CEO',
			'type'    => 'text',
		),

		array(
			'label'   => 'Departament',
			'id'      => 'departament_text',
			'default' => 'Departament',
			'type'    => 'text',
		),

		array(
			'label' => 'Information',
			'id'    => 'information_textarea',
			'type'  => 'textarea',
		),

		array(
			'label'   => 'Email',
			'id'      => 'email_email',
			'default' => 'Email Address',
			'type'    => 'email',
		),

		array(
			'label' => 'Contact Number',
			'id'    => 'contact Number_tel',
			'type'  => 'tel',
		),

		array(
			'label'   => 'Facebook User',
			'id'      => 'facebook_user_text',
			'default' => 'Facebook User',
			'type'    => 'text',
		),

		array(
			'label'   => 'Twitter User',
			'id'      => 'twitter_user_text',
			'default' => 'Twitter User',
			'type'    => 'text',
		),

		array(
			'label'   => 'Instagram User',
			'id'      => 'instagram_user_text',
			'default' => 'Instagram User',
			'type'    => 'text',
		),

		array(
			'label'   => 'LinkedIn User',
			'id'      => 'linkedin_user_text',
			'default' => 'LinkedIn User',
			'type'    => 'text',
		),
	);

	/**
	 * Function add_metabox
	 *
	 * @return void
	 */
	public function add_metabox() {
		foreach ( $this->screen as $single_screen ) {
			add_meta_box(
				'team_widget_box',
				__( 'Member Team Information', 'team-widget' ),
				array( $this, 'metabox_callback' ),
				$single_screen,
				'normal',
				'high'
			);
		}
	}

	/**
	 * Function metabox_callback
	 *
	 * @param int $post post id.
	 * @return void
	 */
	public function metabox_callback( $post ) {
		wp_nonce_field( 'team_widget_data', 'team_widget_nonce' );
		// echo 'Member Team Information';
		$this->field_generator( $post );
	}

	/**
	 * Function field_generator
	 *
	 * @param int $post post id.
	 * @return void
	 */
	public function field_generator( $post ) {
		$output = '';

		foreach ( $this->meta_fields as $meta_field ) {

			$label = '<label for="' . $meta_field['id'] . '">' . $meta_field['label'] . '</label>';

			$meta_value = get_post_meta( $post->ID, $meta_field['id'], true );

			if ( empty( $meta_value ) ) {
				if ( isset( $meta_field['default'] ) ) {
					$meta_value = $meta_field['deafault'];
				}
			}

			switch ( $meta_field['type'] ) {
				case 'textarea':
					$input = sprintf(
						'<textarea %s id="%s" name="%s" rows="5">%s</textarea>',
						$meta_field['type'] !== 'color' ? 'style="width: 100%"' : '',
						$meta_field['id'],
						$meta_field['id'],
						$meta_value
					);
					break;

				default:
					$input = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s">',
						$meta_field['type'] !== 'color' ? 'style="width: 100%"' : '',
						$meta_field['id'],
						$meta_field['id'],
						$meta_field['type'],
						$meta_value
					);
			}
			$output .= $this->format_rows( $label, $input );
		}
		echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
	}

	/**
	 * Function format_rows
	 *
	 * @param string $label form.
	 * @param mixed  $input form.
	 * @return mixed
	 */
	public function format_rows( $label, $input ) {
		return '<tr><th>' . $label . '</th><td>' . $input . '</td></tr>';
	}

	/**
	 * Function saved_fields
	 *
	 * @param int $post_id ID Post.
	 * @return mixed
	 */
	public function save_fields( $post_id ) {
		if ( ! isset( $_POST['team_widget_nonce'] ) ) {
			return $post_id;
		}
		$nonce = $_POST['team_widget_nonce'];
		if ( ! wp_verify_nonce( $nonce, 'team_widget_data' ) ) {
			return $post_id;
		}
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}
		foreach ( $this->meta_fields as $meta_field ) {
			if ( isset( $_POST[ $meta_field['id'] ] ) ) {
				switch ( $meta_field['type'] ) {
					case 'email':
						$_POST[ $meta_field['id'] ] = sanitize_email( $_POST[ $meta_field['id'] ] );
						break;
					case 'text':
						$_POST[ $meta_field['id'] ] = sanitize_text_field( $_POST[ $meta_field['id'] ] );
						break;
				}
				update_post_meta( $post_id, $meta_field['id'], $_POST[ $meta_field['id'] ] );
			} elseif ( $meta_field['type'] === 'checkbox' ) {
				update_post_meta( $post_id, $meta_field['id'], '0' );
			}
		}
	}

}
