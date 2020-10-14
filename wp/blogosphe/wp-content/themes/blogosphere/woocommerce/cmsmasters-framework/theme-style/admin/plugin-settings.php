<?php
/**
 * @package 	WordPress
 * @subpackage 	Blogosphere
 * @version 	1.0.4
 *
 * CMSMasters WooCommerce Admin Settings
 * Created by CMSMasters
 *
 */


/* Single Settings */
function blogosphere_woocommerce_options_general_fields($options, $tab) {
	if ($tab == 'header') {
		$options[] = array(
			'section' => 'header_section',
			'id' => 'blogosphere' . '_woocommerce_cart_dropdown',
			'title' => esc_html__('Disable WooCommerce Cart', 'blogosphere'),
			'desc' => '',
			'type' => 'checkbox',
			'std' => 0
		);
	}

	return $options;
}

add_filter('cmsmasters_options_general_fields_filter', 'blogosphere_woocommerce_options_general_fields', 10, 2);


