<?php
/* Smash Balloon Instagram Feed
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('monyxi_instagram_feed_theme_setup9')) {
	add_action( 'after_setup_theme', 'monyxi_instagram_feed_theme_setup9', 9 );
	function monyxi_instagram_feed_theme_setup9() {

		if (is_admin()) {
			add_filter( 'monyxi_filter_tgmpa_required_plugins',	'monyxi_instagram_feed_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'monyxi_instagram_feed_tgmpa_required_plugins' ) ) {
	
	function monyxi_instagram_feed_tgmpa_required_plugins($list=array()) {
		if (monyxi_storage_isset('required_plugins', 'instagram-feed')) {
			// Smash Balloon Instagram Feed plugin
			$list[] = array(
					'name' 		=> monyxi_storage_get_array('required_plugins', 'instagram-feed'),
					'slug' 		=> 'instagram-feed',
					'required' 	=> false
			);
		}
		return $list;
	}
}
?>