<?php
/**
 * Create Single Panorama
 *
 * @author Jegtheme
 * @since 1.0.0
 * @package wordpress-virtual-tour
 */

namespace WVT;

/**
 * Class Single_Panorama_Create
 *
 * @package WVT
 */
class Single_Panorama_Create {

	/**
	 * Action Create Panorama
	 *
	 * @var string
	 */
	public static $create_action = 'create-panorama';

	/**
	 * Single_Panorama_Create constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'create_panorama' ) );
	}

	/**
	 * Handle Submit Action
	 */
	public function create_panorama() {
		if ( apply_filters( 'wvt_panorama_sandbox', false ) ) {
			return false;
		}

		if ( isset( $_REQUEST['action'], $_REQUEST['nonce'] ) && wp_verify_nonce( sanitize_key( $_REQUEST['nonce'] ), self::$create_action ) ) {
			$data              = Helper::get_option_default_setting();
			$to_save           = array();
			$to_save['option'] = array();

			if ( self::$create_action === $_REQUEST['action'] ) {
				$post_id = wp_insert_post( array(
					'post_title'  => $data['title'],
					'post_type'   => 'single-panorama',
					'post_status' => 'publish',
				) );

				$fields = $this->get_fields();
				foreach ( $data as $key => $content ) {
					if ( in_array( $key, $fields, true ) ) {
						$to_save['option'][ $key ] = $content;
					}
				}

				update_post_meta( $post_id, Single_Panorama::$metabox, $to_save );

				// redirect to edit.
				$url = Single_Panorama::generate_edit_url( $post_id, wp_create_nonce( Single_Panorama_Edit::$action ) );
				wp_safe_redirect( $url );
			}
		}
	}

	/**
	 * Get field for single panorama creation
	 */
	public function get_fields() {
		$fields = [
			'title',
			'type',
			'equirectangular',
			'cubemap'
		];

		return $fields;
	}
}
