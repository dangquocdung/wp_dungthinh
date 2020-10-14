<?php 
/**
 * @package 	WordPress
 * @subpackage 	Blogosphere
 * @version		1.0.3
 * 
 * Admin Panel Fonts Options
 * Created by CMSMasters
 * 
 */


function blogosphere_options_font_tabs() {
	$tabs = array();
	
	$tabs['content'] = esc_attr__('Content', 'blogosphere');
	$tabs['link'] = esc_attr__('Links', 'blogosphere');
	$tabs['nav'] = esc_attr__('Navigation', 'blogosphere');
	$tabs['heading'] = esc_attr__('Heading', 'blogosphere');
	$tabs['other'] = esc_attr__('Other', 'blogosphere');
	$tabs['google'] = esc_attr__('Google Fonts', 'blogosphere');
	
	return apply_filters('cmsmasters_options_font_tabs_filter', $tabs);
}


function blogosphere_options_font_sections() {
	$tab = blogosphere_get_the_tab();
	
	switch ($tab) {
	case 'content':
		$sections = array();
		
		$sections['content_section'] = esc_html__('Content Font Options', 'blogosphere');
		
		break;
	case 'link':
		$sections = array();
		
		$sections['link_section'] = esc_html__('Links Font Options', 'blogosphere');
		
		break;
	case 'nav':
		$sections = array();
		
		$sections['nav_section'] = esc_html__('Navigation Font Options', 'blogosphere');
		
		break;
	case 'heading':
		$sections = array();
		
		$sections['heading_section'] = esc_html__('Headings Font Options', 'blogosphere');
		
		break;
	case 'other':
		$sections = array();
		
		$sections['other_section'] = esc_html__('Other Fonts Options', 'blogosphere');
		
		break;
	case 'google':
		$sections = array();
		
		$sections['google_section'] = esc_html__('Serving Google Fonts from CDN', 'blogosphere');
		
		break;
	default:
		$sections = array();
		
		
		break;
	}
	
	return apply_filters('cmsmasters_options_font_sections_filter', $sections, $tab);
} 


function blogosphere_options_font_fields($set_tab = false) {
	if ($set_tab) {
		$tab = $set_tab;
	} else {
		$tab = blogosphere_get_the_tab();
	}
	
	
	$options = array();
	
	
	$defaults = blogosphere_settings_font_defaults();
	
	
	switch ($tab) {
	case 'content':
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'blogosphere' . '_content_font', 
			'title' => esc_html__('Main Content Font', 'blogosphere'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['blogosphere' . '_content_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style' 
			) 
		);
		
		break;
	case 'link':
		$options[] = array( 
			'section' => 'link_section', 
			'id' => 'blogosphere' . '_link_font', 
			'title' => esc_html__('Links Font', 'blogosphere'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['blogosphere' . '_link_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style', 
				'text_transform', 
				'text_decoration' 
			) 
		);
		
		$options[] = array( 
			'section' => 'link_section', 
			'id' => 'blogosphere' . '_link_hover_decoration', 
			'title' => esc_html__('Links Hover Text Decoration', 'blogosphere'), 
			'desc' => '', 
			'type' => 'select_scheme', 
			'std' => $defaults[$tab]['blogosphere' . '_link_hover_decoration'], 
			'choices' => blogosphere_text_decoration_list() 
		);
		
		break;
	case 'nav':
		$options[] = array( 
			'section' => 'nav_section', 
			'id' => 'blogosphere' . '_nav_title_font', 
			'title' => esc_html__('Navigation Title Font', 'blogosphere'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['blogosphere' . '_nav_title_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style', 
				'text_transform' 
			) 
		);
		
		$options[] = array( 
			'section' => 'nav_section', 
			'id' => 'blogosphere' . '_nav_dropdown_font', 
			'title' => esc_html__('Navigation Dropdown Font', 'blogosphere'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['blogosphere' . '_nav_dropdown_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style', 
				'text_transform' 
			) 
		);
		
		break;
	case 'heading':
		$options[] = array( 
			'section' => 'heading_section', 
			'id' => 'blogosphere' . '_h1_font', 
			'title' => esc_html__('H1 Tag Font', 'blogosphere'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['blogosphere' . '_h1_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style', 
				'text_transform', 
				'text_decoration' 
			) 
		);
		
		$options[] = array( 
			'section' => 'heading_section', 
			'id' => 'blogosphere' . '_h2_font', 
			'title' => esc_html__('H2 Tag Font', 'blogosphere'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['blogosphere' . '_h2_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style', 
				'text_transform', 
				'text_decoration' 
			) 
		);
		
		$options[] = array( 
			'section' => 'heading_section', 
			'id' => 'blogosphere' . '_h3_font', 
			'title' => esc_html__('H3 Tag Font', 'blogosphere'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['blogosphere' . '_h3_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style', 
				'text_transform', 
				'text_decoration' 
			) 
		);
		
		$options[] = array( 
			'section' => 'heading_section', 
			'id' => 'blogosphere' . '_h4_font', 
			'title' => esc_html__('H4 Tag Font', 'blogosphere'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['blogosphere' . '_h4_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style', 
				'text_transform', 
				'text_decoration' 
			) 
		);
		
		$options[] = array( 
			'section' => 'heading_section', 
			'id' => 'blogosphere' . '_h5_font', 
			'title' => esc_html__('H5 Tag Font', 'blogosphere'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['blogosphere' . '_h5_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style', 
				'text_transform', 
				'text_decoration' 
			) 
		);
		
		$options[] = array( 
			'section' => 'heading_section', 
			'id' => 'blogosphere' . '_h6_font', 
			'title' => esc_html__('H6 Tag Font', 'blogosphere'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['blogosphere' . '_h6_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style', 
				'text_transform', 
				'text_decoration' 
			) 
		);
		
		break;
	case 'other':
		$options[] = array( 
			'section' => 'other_section', 
			'id' => 'blogosphere' . '_button_font', 
			'title' => esc_html__('Button Font', 'blogosphere'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['blogosphere' . '_button_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style', 
				'text_transform' 
			) 
		);
		
		$options[] = array( 
			'section' => 'other_section', 
			'id' => 'blogosphere' . '_small_font', 
			'title' => esc_html__('Small Tag Font', 'blogosphere'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['blogosphere' . '_small_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style', 
				'text_transform' 
			) 
		);
		
		$options[] = array( 
			'section' => 'other_section', 
			'id' => 'blogosphere' . '_input_font', 
			'title' => esc_html__('Text Fields Font', 'blogosphere'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['blogosphere' . '_input_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style' 
			) 
		);
		
		$options[] = array( 
			'section' => 'other_section', 
			'id' => 'blogosphere' . '_quote_font', 
			'title' => esc_html__('Blockquote Font', 'blogosphere'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['blogosphere' . '_quote_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style' 
			) 
		);

		break;
	case 'google':
		$options[] = array( 
			'section' => 'google_section', 
			'id' => 'blogosphere' . '_google_web_fonts', 
			'title' => esc_html__('Google Fonts', 'blogosphere'), 
			'desc' => '', 
			'type' => 'google_web_fonts', 
			'std' => $defaults[$tab]['blogosphere' . '_google_web_fonts'] 
		);
		
		$options[] = array( 
			'section' => 'google_section', 
			'id' => 'blogosphere' . '_google_web_fonts_subset', 
			'title' => esc_html__('Google Fonts Subset', 'blogosphere'), 
			'desc' => '', 
			'type' => 'select_multiple', 
			'std' => '', 
			'choices' => array( 
				esc_html__('Latin Extended', 'blogosphere') . '|' . 'latin-ext', 
				esc_html__('Arabic', 'blogosphere') . '|' . 'arabic', 
				esc_html__('Cyrillic', 'blogosphere') . '|' . 'cyrillic', 
				esc_html__('Cyrillic Extended', 'blogosphere') . '|' . 'cyrillic-ext', 
				esc_html__('Greek', 'blogosphere') . '|' . 'greek', 
				esc_html__('Greek Extended', 'blogosphere') . '|' . 'greek-ext', 
				esc_html__('Vietnamese', 'blogosphere') . '|' . 'vietnamese', 
				esc_html__('Japanese', 'blogosphere') . '|' . 'japanese', 
				esc_html__('Korean', 'blogosphere') . '|' . 'korean', 
				esc_html__('Thai', 'blogosphere') . '|' . 'thai', 
				esc_html__('Bengali', 'blogosphere') . '|' . 'bengali', 
				esc_html__('Devanagari', 'blogosphere') . '|' . 'devanagari', 
				esc_html__('Gujarati', 'blogosphere') . '|' . 'gujarati', 
				esc_html__('Gurmukhi', 'blogosphere') . '|' . 'gurmukhi', 
				esc_html__('Hebrew', 'blogosphere') . '|' . 'hebrew', 
				esc_html__('Kannada', 'blogosphere') . '|' . 'kannada', 
				esc_html__('Khmer', 'blogosphere') . '|' . 'khmer', 
				esc_html__('Malayalam', 'blogosphere') . '|' . 'malayalam', 
				esc_html__('Myanmar', 'blogosphere') . '|' . 'myanmar', 
				esc_html__('Oriya', 'blogosphere') . '|' . 'oriya', 
				esc_html__('Sinhala', 'blogosphere') . '|' . 'sinhala', 
				esc_html__('Tamil', 'blogosphere') . '|' . 'tamil', 
				esc_html__('Telugu', 'blogosphere') . '|' . 'telugu' 
			) 
		);
		
		break;
	}
	
	return apply_filters('cmsmasters_options_font_fields_filter', $options, $tab);	
}

