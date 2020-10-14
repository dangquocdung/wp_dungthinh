<?php
/* learnpress support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 3 - add/remove Theme Options elements
if (!function_exists('monyxi_learnpress_theme_setup3')) {
	add_action( 'after_setup_theme', 'monyxi_learnpress_theme_setup3', 3 );
	function monyxi_learnpress_theme_setup3() {
		if (monyxi_exists_learnpress()) {
			// Section 'learnpress'
			monyxi_storage_set_array_before('options', 'fonts', array_merge(
				array(
					'learnpress' => array(
						"title" => esc_html__('Learnpress', 'monyxi'),
						"desc" => wp_kses_data( __('Select parameters to display the learnpress pages', 'monyxi') ),
						"priority" => 80,
						"type" => "section"
						),
				),
				monyxi_options_get_list_cpt_options('learnpress')
			));
		}
	}
}




// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('monyxi_learnpress_theme_setup9')) {
	add_action( 'after_setup_theme', 'monyxi_learnpress_theme_setup9', 9 );
	function monyxi_learnpress_theme_setup9() {

		if (monyxi_exists_learnpress()) {
			
			add_action( 'monyxi_action_override_theme_options',			'monyxi_learnpress_override_theme_options');
			if (!is_admin()) {
				add_filter( 'monyxi_filter_detect_blog_mode',				'monyxi_learnpress_detect_blog_mode');
				add_filter( 'trx_addons_filter_get_blog_title',				'monyxi_learnpress_get_blog_title');
			}
		}
		if (is_admin()) {
			add_filter( 'monyxi_filter_tgmpa_required_plugins',			'monyxi_learnpress_tgmpa_required_plugins' );
		}
	}
}


// Filter to add in the required plugins list
if ( !function_exists( 'monyxi_learnpress_tgmpa_required_plugins' ) ) {
	function monyxi_learnpress_tgmpa_required_plugins($list=array()) {
		if (monyxi_storage_isset('required_plugins', 'learnpress')) {
			$list[] = array(
					'name' 		=> monyxi_storage_get_array('required_plugins', 'learnpress'),
					'slug' 		=> 'learnpress',
					'required' 	=> false
				);
		}
		return $list;
	}
}


// Check if learnpress installed and activated
if ( !function_exists( 'monyxi_exists_learnpress' ) ) {
	function monyxi_exists_learnpress() {
		return class_exists('LearnPress');
	}
}

// Return true, if current page is any learnpress page
if ( !function_exists( 'monyxi_is_learnpress_page' ) ) {
	function monyxi_is_learnpress_page() {
		$rez = false;
		if (monyxi_exists_learnpress())
			$rez = is_learnpress();
		return $rez;
	}
}


// Override options with stored page meta on 'learnpress' pages
if ( !function_exists('monyxi_learnpress_override_theme_options') ) {
	function monyxi_learnpress_override_theme_options() {
		if (is_learnpress()) {
			if (($id = monyxi_learnpress_get_learnpress_page_id()) > 0)
				monyxi_storage_set('options_meta', get_post_meta($id, 'monyxi_options', true));
		}
	}
}

// Return current page title
if ( !function_exists( 'monyxi_learnpress_get_blog_title' ) ) {
	function monyxi_learnpress_get_blog_title($title='') {
		if (monyxi_exists_learnpress() && monyxi_is_learnpress_page()
			&& learn_press_is_courses() // if on page courses
		) {
			$id = monyxi_learnpress_get_learnpress_page_id();
			$title = $id ? get_the_title($id) : esc_html__('LearnPress', 'monyxi');
		}
		return $title;
	}
}


// Return learnpress page ID
if ( !function_exists( 'monyxi_learnpress_get_learnpress_page_id' ) ) {
	function monyxi_learnpress_get_learnpress_page_id() {
		return get_option('learn_press_courses_page_id');
	}
}

// Decorate learnpress output: Loop
//------------------------------------------------------------------------

// Detect current blog mode
if ( !function_exists( 'monyxi_learnpress_detect_blog_mode' ) ) {
	function monyxi_learnpress_detect_blog_mode($mode='') {
		if (is_learnpress())
			$mode = 'learnpress';
		return $mode;
	}
}

?>