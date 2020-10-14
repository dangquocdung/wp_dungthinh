<?php
/* Contact Form 7 support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('monyxi_cf7_theme_setup9')) {
	add_action( 'after_setup_theme', 'monyxi_cf7_theme_setup9', 9 );
	function monyxi_cf7_theme_setup9() {
		
		add_filter( 'monyxi_filter_merge_scripts',	'monyxi_cf7_merge_scripts');
		add_filter( 'monyxi_filter_merge_styles',	'monyxi_cf7_merge_styles' );

		if (monyxi_exists_cf7()) {
			add_action( 'wp_enqueue_scripts',		'monyxi_cf7_frontend_scripts', 1100 );
		}

		if (is_admin()) {
			add_filter( 'monyxi_filter_tgmpa_required_plugins',	'monyxi_cf7_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'monyxi_cf7_tgmpa_required_plugins' ) ) {
	
	function monyxi_cf7_tgmpa_required_plugins($list=array()) {
		if (monyxi_storage_isset('required_plugins', 'contact-form-7')) {
			// CF7 plugin
			$list[] = array(
					'name' 		=> monyxi_storage_get_array('required_plugins', 'contact-form-7'),
					'slug' 		=> 'contact-form-7',
					'required' 	=> false
			);
		}
		return $list;
	}
}



// Check if cf7 installed and activated
if ( !function_exists( 'monyxi_exists_cf7' ) ) {
	function monyxi_exists_cf7() {
		return class_exists('WPCF7');
	}
}

// Enqueue custom scripts
if ( !function_exists( 'monyxi_cf7_frontend_scripts' ) ) {
	
	function monyxi_cf7_frontend_scripts() {
		if (monyxi_exists_cf7()) {
			if (monyxi_is_on(monyxi_get_theme_option('debug_mode')) && ($monyxi_url = monyxi_get_file_url('plugins/contact-form-7/contact-form-7.js')) != '')
				wp_enqueue_script( 'monyxi-cf7', $monyxi_url, array('jquery'), null, true );
		}
	}
}
	
// Merge custom scripts
if ( !function_exists( 'monyxi_cf7_merge_scripts' ) ) {
	
	function monyxi_cf7_merge_scripts($list) {
		if (monyxi_exists_cf7()) {
			$list[] = 'plugins/contact-form-7/contact-form-7.js';
		}
		return $list;
	}
}

// Merge custom styles
if ( !function_exists( 'monyxi_cf7_merge_styles' ) ) {
	
	function monyxi_cf7_merge_styles($list) {
		if (monyxi_exists_cf7()) {
			$list[] = 'plugins/contact-form-7/_contact-form-7.scss';
		}
		return $list;
	}
}
?>