<?php
/* Essential Grid support functions
------------------------------------------------------------------------------- */


// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('monyxi_essential_grid_theme_setup9')) {
	add_action( 'after_setup_theme', 'monyxi_essential_grid_theme_setup9', 9 );
	function monyxi_essential_grid_theme_setup9() {
		
		add_filter( 'monyxi_filter_merge_styles',						'monyxi_essential_grid_merge_styles' );

		if (is_admin()) {
			add_filter( 'monyxi_filter_tgmpa_required_plugins',		'monyxi_essential_grid_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'monyxi_essential_grid_tgmpa_required_plugins' ) ) {
	
	function monyxi_essential_grid_tgmpa_required_plugins($list=array()) {
		if (monyxi_storage_isset('required_plugins', 'essential-grid')) {
			$path = monyxi_get_file_dir('plugins/essential-grid/essential-grid.zip');
			if (!empty($path) || monyxi_get_theme_setting('tgmpa_upload')) {
				$list[] = array(
						'name' 		=> monyxi_storage_get_array('required_plugins', 'essential-grid'),
						'slug' 		=> 'essential-grid',
                        'version'	=> '2.3.6',
						'source'	=> !empty($path) ? $path : 'upload://essential-grid.zip',
						'required' 	=> false
				);
			}
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'monyxi_exists_essential_grid' ) ) {
	function monyxi_exists_essential_grid() {
		return defined('EG_PLUGIN_PATH');
	}
}
	
// Merge custom styles
if ( !function_exists( 'monyxi_essential_grid_merge_styles' ) ) {
	
	function monyxi_essential_grid_merge_styles($list) {
		if (monyxi_exists_essential_grid()) {
			$list[] = 'plugins/essential-grid/_essential-grid.scss';
		}
		return $list;
	}
}
?>