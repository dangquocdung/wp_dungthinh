<?php
/**
 * WP Bakery Options
 *
 * @author Jegtheme
 * @since 1.0.0
 * @package wordpress-virtual-tour
 */

namespace WVT\Integration;

/**
 * Class Options
 *
 * @package wordpress-virtual-tour
 */
class Options {
	/**
	 * Get option of generator
	 *
	 * @return array
	 */
	public static function get_option() {
		return array(
			'id'       => 'wvt',
			'name'     => esc_html__( 'Virtual Tour', 'wvt' ),
			'category' => esc_html__( 'WVT', 'wvt' ),
			'options'  => array(
				'pid' => array(
					'type'        => 'select',
					'options'     => 'wvt_get_panorama_posts',
					'title'       => esc_html__( 'Panorama ID', 'wvt' ),
					'description' => esc_html__( 'Choose your Panorama', 'wvt' ),
					'segment'     => 'general',
					'default'     => '',
				),
			),
			'segments' => array(
				'id'   => 'general',
				'name' => esc_html__( 'General', 'wvt' ),
			),
		);
	}
}
