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
 * Class Panorama_Map_Create
 *
 * @package WVT
 */
class Panorama_Map_Create {

	/**
	 * Action Create Panorama
	 *
	 * @var string
	 */
	public static $create_action = 'create-panorama-map';

	/**
	 * Panorama_Map_Create constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'create_panorama_map' ) );
	}

	/**
	 * Handle Submit Action
	 */
	public function create_panorama_map() {
		if ( apply_filters( 'wvt_panorama_sandbox', false ) ) {
			return false;
		}

		if ( isset( $_REQUEST['action'], $_REQUEST['nonce'] ) && wp_verify_nonce( sanitize_key( $_REQUEST['nonce'] ), self::$create_action ) ) {
			$data              = Helper::get_panorama_option_default_setting();
			$to_save           = array();
			$to_save['option'] = array();

			if ( self::$create_action === $_REQUEST['action'] ) {
				$post_id = wp_insert_post( array(
					'post_title'  => $data['title'],
					'post_type'   => 'panorama-map',
					'post_status' => 'publish',
				) );

				$fields = $this->get_fields();
				foreach ( $data as $key => $content ) {
					if ( in_array( $key, $fields, true ) ) {
						$to_save['option'][ $key ] = $content;
					}
				}

				update_post_meta( $post_id, Panorama_Map::$metabox, $to_save );

				// redirect to edit.
				$url = Panorama_Map::generate_edit_url( $post_id, wp_create_nonce( Panorama_Map_Edit::$action ) );
				wp_safe_redirect( $url );
			}
		}
	}

	/**
	 * Get field for single panorama map creation
	 */
	public function get_fields() {
		$fields = [
			'title',
			'map',
		];

		return $fields;
	}
}
