<?php
/* Mail Chimp support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('monyxi_wpgo_power_charts_lite_theme_setup9')) {
	add_action( 'after_setup_theme', 'monyxi_wpgo_power_charts_lite_theme_setup9', 9 );
	function monyxi_wpgo_power_charts_lite_theme_setup9() {
		if (monyxi_exists_wpgo_power_charts_lite()) {

		}
		if (is_admin()) {
			add_filter( 'monyxi_filter_tgmpa_required_plugins',		'monyxi_wpgo_power_charts_lite_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'monyxi_wpgo_power_charts_lite_tgmpa_required_plugins' ) ) {
	
	function monyxi_wpgo_power_charts_lite_tgmpa_required_plugins($list=array()) {
		if (monyxi_storage_isset('required_plugins', 'wpgo-power-charts-lite')) {
			$list[] = array(
				'name' 		=> monyxi_storage_get_array('required_plugins', 'wpgo-power-charts-lite'),
				'slug' 		=> 'wpgo-power-charts-lite',
				'required' 	=> false
			);
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'monyxi_exists_wpgo_power_charts_lite' ) ) {
	function monyxi_exists_wpgo_power_charts_lite() {
		return class_exists('WPGO_Power_Charts');
	}
}


?>