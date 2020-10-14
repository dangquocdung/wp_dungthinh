<?php 
/**
 * @package 	WordPress
 * @subpackage 	Blogosphere
 * @version		1.0.1
 * 
 * Theme Admin Settings
 * Created by CMSMasters
 * 
 */

/* General Settings */
function blogosphere_theme_options_general_fields($options, $tab) {
	$new_options = array();
	
	if ($tab == 'header') {
		foreach ($options as $option) {
			if ($option['id'] == 'blogosphere' . '_header_styles') {
				$option['choices'] = array( 
					esc_html__('Default Style', 'blogosphere') . '|default', 
					esc_html__('Compact Style Left Navigation', 'blogosphere') . '|l_nav', 
					esc_html__('Logo Centered Under Navigation', 'blogosphere') . '|r_nav', 
					esc_html__('Logo Centered Above Navigation', 'blogosphere') . '|c_nav'
				);
				
				$new_options[] = $option;
			} else {
				$new_options[] = $option;
			}
		}
		
		$options = $new_options;
	}
	
	
	return $options;
}

add_filter('cmsmasters_options_general_fields_filter', 'blogosphere_theme_options_general_fields', 10, 2);



/* Single Settings */
function blogosphere_theme_options_single_fields($options, $tab) {
	$new_options = array();

	if ($tab == 'post') {
		foreach ($options as $option) {
			if ($option['id'] == 'blogosphere' . '_blog_post_nav_box') {
				$options_new[] = array( 
					'section' => 'post_section', 
					'id' => 'blogosphere' . '_blog_post_view', 
					'title' => esc_html__('Post Views', 'blogosphere'), 
					'desc' => esc_html__('show', 'blogosphere'), 
					'type' => 'checkbox', 
					'std' => 0 
				);
				
				
				$options_new[] = $option;
			} else {
				$options_new[] = $option;
			}
		}
	} else if ($tab == 'project') {
		foreach ($options as $option) {
			if ($option['id'] == 'blogosphere' . '_portfolio_project_share_box') {
				$options_new[] = array( 
					'section' => 'project_section', 
					'id' => 'blogosphere' . '_portfolio_project_view', 
					'title' => esc_html__('Project Views', 'blogosphere'), 
					'desc' => esc_html__('show', 'blogosphere'), 
					'type' => 'checkbox', 
					'std' => 0 
				);
				
				
				$options_new[] = $option;
			} else {
				$options_new[] = $option;
			}
		}
	} else {
		$options_new = $options;
	}
	
	
	return $options_new;
}

add_filter('cmsmasters_options_single_fields_filter', 'blogosphere_theme_options_single_fields', 10, 2);



/* Font Settings */
function blogosphere_theme_options_font_fields($options, $tab) {
	$new_options = array();
	
	
	if ($tab == 'link') {
		foreach ($options as $option) {
			if ($option['id'] == 'blogosphere' . '_link_hover_decoration') {
				// remove this option
			} else {
				$new_options[] = $option;
			}
		}
		
		$options = $new_options;
	}
	
	
	return $options;
}

add_filter('cmsmasters_options_font_fields_filter', 'blogosphere_theme_options_font_fields', 10, 2);