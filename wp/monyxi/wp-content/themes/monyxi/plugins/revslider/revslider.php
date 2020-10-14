<?php
/* Revolution Slider support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('monyxi_revslider_theme_setup9')) {
	add_action( 'after_setup_theme', 'monyxi_revslider_theme_setup9', 9 );
	function monyxi_revslider_theme_setup9() {

		add_filter( 'monyxi_filter_merge_styles',				'monyxi_revslider_merge_styles' );
		
		if (is_admin()) {
			add_filter( 'monyxi_filter_tgmpa_required_plugins','monyxi_revslider_tgmpa_required_plugins' );
		}

        add_action( 'wp_enqueue_scripts', 							'monyxi_anim_scripts' );
	}
}


// Enqueue custom scripts
if ( !function_exists( 'monyxi_anim_scripts' ) ) {
    function monyxi_anim_scripts() {
        if (monyxi_exists_revslider()) {
            wp_enqueue_script( 'particles-anim', monyxi_get_file_url('plugins/revslider/particles.min.js'), array('jquery'), null, true );
        }
    }
}



// Filter to add in the required plugins list
if ( !function_exists( 'monyxi_revslider_tgmpa_required_plugins' ) ) {
	
	function monyxi_revslider_tgmpa_required_plugins($list=array()) {
		if (monyxi_storage_isset('required_plugins', 'revslider')) {
			$path = monyxi_get_file_dir('plugins/revslider/revslider.zip');
			if (!empty($path) || monyxi_get_theme_setting('tgmpa_upload')) {
				$list[] = array(
					'name' 		=> monyxi_storage_get_array('required_plugins', 'revslider'),
					'slug' 		=> 'revslider',
                    'version'	=> '6.2.17',
					'source'	=> !empty($path) ? $path : 'upload://revslider.zip',
					'required' 	=> false
				);
			}
		}
		return $list;
	}
}

// Check if RevSlider installed and activated
if ( !function_exists( 'monyxi_exists_revslider' ) ) {
	function monyxi_exists_revslider() {
		return function_exists('rev_slider_shortcode');
	}
}
	
// Merge custom styles
if ( !function_exists( 'monyxi_revslider_merge_styles' ) ) {
	
	function monyxi_revslider_merge_styles($list) {
		if (monyxi_exists_revslider()) {
			$list[] = 'plugins/revslider/_revslider.scss';
		}
		return $list;
	}
}
?>