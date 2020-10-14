<?php
/* Mail Chimp support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('monyxi_searchfilter_theme_setup9')) {
	add_action( 'after_setup_theme', 'monyxi_searchfilter_theme_setup9', 9 );
	function monyxi_searchfilter_theme_setup9() {
		if (monyxi_exists_searchfilter()) {

		}
		if (is_admin()) {
			add_filter( 'monyxi_filter_tgmpa_required_plugins',		'monyxi_searchfilter_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'monyxi_searchfilter_tgmpa_required_plugins' ) ) {
	
	function monyxi_searchfilter_tgmpa_required_plugins($list=array()) {
		if (monyxi_storage_isset('required_plugins', 'search-filter')) {
			$list[] = array(
				'name' 		=> monyxi_storage_get_array('required_plugins', 'search-filter'),
				'slug' 		=> 'search-filter',
				'required' 	=> false
			);
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'monyxi_exists_searchfilter' ) ) {
	function monyxi_exists_searchfilter() {
		return function_exists('cp_shortcode_widget_init');
	}
}


?>