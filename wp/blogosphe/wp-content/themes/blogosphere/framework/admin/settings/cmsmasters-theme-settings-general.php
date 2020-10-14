<?php 
/**
 * @package 	WordPress
 * @subpackage 	Blogosphere
 * @version 	1.0.4
 * 
 * Admin Panel General Options
 * Created by CMSMasters
 * 
 */


function blogosphere_options_general_tabs() {
	$cmsmasters_option = blogosphere_get_global_options();
	
	$tabs = array();
	
	$tabs['general'] = esc_attr__('General', 'blogosphere');
	
	if ($cmsmasters_option['blogosphere' . '_theme_layout'] === 'boxed') {
		$tabs['bg'] = esc_attr__('Background', 'blogosphere');
	}
	
	if (CMSMASTERS_THEME_STYLE_COMPATIBILITY) {
		$tabs['theme_style'] = esc_attr__('Theme Style', 'blogosphere');
	}
	
	$tabs['header'] = esc_attr__('Header', 'blogosphere');
	$tabs['content'] = esc_attr__('Content', 'blogosphere');
	$tabs['footer'] = esc_attr__('Footer', 'blogosphere');
	
	return apply_filters('cmsmasters_options_general_tabs_filter', $tabs);
}


function blogosphere_options_general_sections() {
	$tab = blogosphere_get_the_tab();
	
	switch ($tab) {
	case 'general':
		$sections = array();
		
		$sections['general_section'] = esc_attr__('General Options', 'blogosphere');
		
		break;
	case 'bg':
		$sections = array();
		
		$sections['bg_section'] = esc_attr__('Background Options', 'blogosphere');
		
		break;
	case 'theme_style':
		$sections = array();
		
		$sections['theme_style_section'] = esc_attr__('Theme Design Style', 'blogosphere');
		
		break;
	case 'header':
		$sections = array();
		
		$sections['header_section'] = esc_attr__('Header Options', 'blogosphere');
		
		break;
	case 'content':
		$sections = array();
		
		$sections['content_section'] = esc_attr__('Content Options', 'blogosphere');
		
		break;
	case 'footer':
		$sections = array();
		
		$sections['footer_section'] = esc_attr__('Footer Options', 'blogosphere');
		
		break;
	default:
		$sections = array();
		
		
		break;
	}
	
	return apply_filters('cmsmasters_options_general_sections_filter', $sections, $tab);
} 


function blogosphere_options_general_fields($set_tab = false) {
	if ($set_tab) {
		$tab = $set_tab;
	} else {
		$tab = blogosphere_get_the_tab();
	}
	
	$options = array();
	
	
	$defaults = blogosphere_settings_general_defaults();
	
	
	switch ($tab) {
	case 'general':
		$options[] = array( 
			'section' => 'general_section', 
			'id' => 'blogosphere' . '_theme_layout', 
			'title' => esc_html__('Theme Layout', 'blogosphere'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['blogosphere' . '_theme_layout'], 
			'choices' => array( 
				esc_html__('Liquid', 'blogosphere') . '|liquid', 
				esc_html__('Boxed', 'blogosphere') . '|boxed' 
			) 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => 'blogosphere' . '_logo_type', 
			'title' => esc_html__('Logo Type', 'blogosphere'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['blogosphere' . '_logo_type'], 
			'choices' => array( 
				esc_html__('Image', 'blogosphere') . '|image', 
				esc_html__('Text', 'blogosphere') . '|text' 
			) 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => 'blogosphere' . '_logo_url', 
			'title' => esc_html__('Logo Image', 'blogosphere'), 
			'desc' => esc_html__('Choose your website logo image.', 'blogosphere'), 
			'type' => 'upload', 
			'std' => $defaults[$tab]['blogosphere' . '_logo_url'], 
			'frame' => 'select', 
			'multiple' => false 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => 'blogosphere' . '_logo_url_retina', 
			'title' => esc_html__('Retina Logo Image', 'blogosphere'), 
			'desc' => esc_html__('Choose logo image for retina displays. Logo for Retina displays should be twice the size of the default one.', 'blogosphere'), 
			'type' => 'upload', 
			'std' => $defaults[$tab]['blogosphere' . '_logo_url_retina'], 
			'frame' => 'select', 
			'multiple' => false 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => 'blogosphere' . '_logo_title', 
			'title' => esc_html__('Logo Title', 'blogosphere'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => $defaults[$tab]['blogosphere' . '_logo_title'], 
			'class' => 'nohtml' 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => 'blogosphere' . '_logo_subtitle', 
			'title' => esc_html__('Logo Subtitle', 'blogosphere'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => $defaults[$tab]['blogosphere' . '_logo_subtitle'], 
			'class' => 'nohtml' 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => 'blogosphere' . '_logo_custom_color', 
			'title' => esc_html__('Custom Text Colors', 'blogosphere'), 
			'desc' => esc_html__('enable', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_logo_custom_color'] 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => 'blogosphere' . '_logo_title_color', 
			'title' => esc_html__('Logo Title Color', 'blogosphere'), 
			'desc' => '', 
			'type' => 'rgba', 
			'std' => $defaults[$tab]['blogosphere' . '_logo_title_color'] 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => 'blogosphere' . '_logo_subtitle_color', 
			'title' => esc_html__('Logo Subtitle Color', 'blogosphere'), 
			'desc' => '', 
			'type' => 'rgba', 
			'std' => $defaults[$tab]['blogosphere' . '_logo_subtitle_color'] 
		);
		
		break;
	case 'bg':
		$options[] = array( 
			'section' => 'bg_section', 
			'id' => 'blogosphere' . '_bg_col', 
			'title' => esc_html__('Background Color', 'blogosphere'), 
			'desc' => '', 
			'type' => 'color', 
			'std' => $defaults[$tab]['blogosphere' . '_bg_col'] 
		);
		
		$options[] = array( 
			'section' => 'bg_section', 
			'id' => 'blogosphere' . '_bg_img_enable', 
			'title' => esc_html__('Background Image Visibility', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_bg_img_enable'] 
		);
		
		$options[] = array( 
			'section' => 'bg_section', 
			'id' => 'blogosphere' . '_bg_img', 
			'title' => esc_html__('Background Image', 'blogosphere'), 
			'desc' => esc_html__('Choose your custom website background image url.', 'blogosphere'), 
			'type' => 'upload', 
			'std' => $defaults[$tab]['blogosphere' . '_bg_img'], 
			'frame' => 'select', 
			'multiple' => false 
		);
		
		$options[] = array( 
			'section' => 'bg_section', 
			'id' => 'blogosphere' . '_bg_rep', 
			'title' => esc_html__('Background Repeat', 'blogosphere'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['blogosphere' . '_bg_rep'], 
			'choices' => array( 
				esc_html__('No Repeat', 'blogosphere') . '|no-repeat', 
				esc_html__('Repeat Horizontally', 'blogosphere') . '|repeat-x', 
				esc_html__('Repeat Vertically', 'blogosphere') . '|repeat-y', 
				esc_html__('Repeat', 'blogosphere') . '|repeat' 
			) 
		);
		
		$options[] = array( 
			'section' => 'bg_section', 
			'id' => 'blogosphere' . '_bg_pos', 
			'title' => esc_html__('Background Position', 'blogosphere'), 
			'desc' => '', 
			'type' => 'select', 
			'std' => $defaults[$tab]['blogosphere' . '_bg_pos'], 
			'choices' => array( 
				esc_html__('Top Left', 'blogosphere') . '|top left', 
				esc_html__('Top Center', 'blogosphere') . '|top center', 
				esc_html__('Top Right', 'blogosphere') . '|top right', 
				esc_html__('Center Left', 'blogosphere') . '|center left', 
				esc_html__('Center Center', 'blogosphere') . '|center center', 
				esc_html__('Center Right', 'blogosphere') . '|center right', 
				esc_html__('Bottom Left', 'blogosphere') . '|bottom left', 
				esc_html__('Bottom Center', 'blogosphere') . '|bottom center', 
				esc_html__('Bottom Right', 'blogosphere') . '|bottom right' 
			) 
		);
		
		$options[] = array( 
			'section' => 'bg_section', 
			'id' => 'blogosphere' . '_bg_att', 
			'title' => esc_html__('Background Attachment', 'blogosphere'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['blogosphere' . '_bg_att'], 
			'choices' => array( 
				esc_html__('Scroll', 'blogosphere') . '|scroll', 
				esc_html__('Fixed', 'blogosphere') . '|fixed' 
			) 
		);
		
		$options[] = array( 
			'section' => 'bg_section', 
			'id' => 'blogosphere' . '_bg_size', 
			'title' => esc_html__('Background Size', 'blogosphere'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['blogosphere' . '_bg_size'], 
			'choices' => array( 
				esc_html__('Auto', 'blogosphere') . '|auto', 
				esc_html__('Cover', 'blogosphere') . '|cover', 
				esc_html__('Contain', 'blogosphere') . '|contain' 
			) 
		);
		
		break;
	case 'theme_style':
		$options[] = array( 
			'section' => 'theme_style_section', 
			'id' => 'blogosphere' . '_theme_style', 
			'title' => esc_html__('Choose Theme Style', 'blogosphere'), 
			'desc' => '', 
			'type' => 'select_theme_style', 
			'std' => '', 
			'choices' => blogosphere_all_theme_styles() 
		);
		
		break;
	case 'header':
		$options[] = array( 
			'section' => 'header_section', 
			'id' => 'blogosphere' . '_fixed_header', 
			'title' => esc_html__('Fixed Header', 'blogosphere'), 
			'desc' => esc_html__('enable', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_fixed_header'] 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => 'blogosphere' . '_header_overlaps', 
			'title' => esc_html__('Header Overlaps Content by Default', 'blogosphere'), 
			'desc' => esc_html__('enable', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_header_overlaps'] 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => 'blogosphere' . '_header_top_line', 
			'title' => esc_html__('Top Line', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_header_top_line'] 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => 'blogosphere' . '_header_top_height', 
			'title' => esc_html__('Top Height', 'blogosphere'), 
			'desc' => esc_html__('pixels', 'blogosphere'), 
			'type' => 'number', 
			'std' => $defaults[$tab]['blogosphere' . '_header_top_height'], 
			'min' => '10' 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => 'blogosphere' . '_header_top_line_short_info', 
			'title' => esc_html__('Top Short Info', 'blogosphere'), 
			'desc' => '<strong>' . esc_html__('HTML tags are allowed!', 'blogosphere') . '</strong>', 
			'type' => 'textarea', 
			'std' => $defaults[$tab]['blogosphere' . '_header_top_line_short_info'], 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => 'blogosphere' . '_header_top_line_add_cont', 
			'title' => esc_html__('Top Additional Content', 'blogosphere'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['blogosphere' . '_header_top_line_add_cont'], 
			'choices' => array( 
				esc_html__('None', 'blogosphere') . '|none', 
				esc_html__('Top Line Social Icons (will be shown if Cmsmasters Content Composer plugin is active)', 'blogosphere') . '|social', 
				esc_html__('Top Line Navigation (will be shown if set in Appearance - Menus tab)', 'blogosphere') . '|nav' 
			) 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => 'blogosphere' . '_header_styles', 
			'title' => esc_html__('Header Styles', 'blogosphere'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['blogosphere' . '_header_styles'], 
			'choices' => array( 
				esc_html__('Default Style', 'blogosphere') . '|default', 
				esc_html__('Compact Style Left Navigation', 'blogosphere') . '|l_nav', 
				esc_html__('Compact Style Right Navigation', 'blogosphere') . '|r_nav', 
				esc_html__('Compact Style Center Navigation', 'blogosphere') . '|c_nav'
			) 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => 'blogosphere' . '_header_mid_height', 
			'title' => esc_html__('Header Middle Height', 'blogosphere'), 
			'desc' => esc_html__('pixels', 'blogosphere'), 
			'type' => 'number', 
			'std' => $defaults[$tab]['blogosphere' . '_header_mid_height'], 
			'min' => '40' 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => 'blogosphere' . '_header_bot_height', 
			'title' => esc_html__('Header Bottom Height', 'blogosphere'), 
			'desc' => esc_html__('pixels', 'blogosphere'), 
			'type' => 'number', 
			'std' => $defaults[$tab]['blogosphere' . '_header_bot_height'], 
			'min' => '20' 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => 'blogosphere' . '_header_search', 
			'title' => esc_html__('Header Search', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_header_search'] 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => 'blogosphere' . '_header_add_cont', 
			'title' => esc_html__('Header Additional Content', 'blogosphere'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['blogosphere' . '_header_add_cont'], 
			'choices' => array( 
				esc_html__('None', 'blogosphere') . '|none', 
				esc_html__('Header Social Icons (will be shown if Cmsmasters Content Composer plugin is active)', 'blogosphere') . '|social', 
				esc_html__('Header Custom HTML', 'blogosphere') . '|cust_html' 
			) 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => 'blogosphere' . '_header_add_cont_cust_html', 
			'title' => esc_html__('Header Custom HTML', 'blogosphere'), 
			'desc' => '<strong>' . esc_html__('HTML tags are allowed!', 'blogosphere') . '</strong>', 
			'type' => 'textarea', 
			'std' => $defaults[$tab]['blogosphere' . '_header_add_cont_cust_html'], 
			'class' => '' 
		);
		
		break;
	case 'content':
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'blogosphere' . '_layout', 
			'title' => esc_html__('Layout Type by Default', 'blogosphere'), 
			'desc' => esc_html__('Choosing layout with a sidebar please make sure to add widgets to the Sidebar in the Appearance - Widgets tab. The empty sidebar won\'t be displayed.', 'blogosphere'), 
			'type' => 'radio_img', 
			'std' => $defaults[$tab]['blogosphere' . '_layout'], 
			'choices' => array( 
				esc_html__('Right Sidebar', 'blogosphere') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_r.jpg' . '|r_sidebar', 
				esc_html__('Left Sidebar', 'blogosphere') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_l.jpg' . '|l_sidebar', 
				esc_html__('Full Width', 'blogosphere') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/fullwidth.jpg' . '|fullwidth' 
			) 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'blogosphere' . '_archives_layout', 
			'title' => esc_html__('Archives Layout Type', 'blogosphere'), 
			'desc' => esc_html__('Choosing layout with a sidebar please make sure to add widgets to the Archive Sidebar in the Appearance - Widgets tab. The empty sidebar won\'t be displayed.', 'blogosphere'), 
			'type' => 'radio_img', 
			'std' => $defaults[$tab]['blogosphere' . '_archives_layout'], 
			'choices' => array( 
				esc_html__('Right Sidebar', 'blogosphere') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_r.jpg' . '|r_sidebar', 
				esc_html__('Left Sidebar', 'blogosphere') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_l.jpg' . '|l_sidebar', 
				esc_html__('Full Width', 'blogosphere') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/fullwidth.jpg' . '|fullwidth' 
			) 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'blogosphere' . '_search_layout', 
			'title' => esc_html__('Search Layout Type', 'blogosphere'), 
			'desc' => esc_html__('Choosing layout with a sidebar please make sure to add widgets to the Search Sidebar in the Appearance - Widgets tab. The empty sidebar won\'t be displayed.', 'blogosphere'),
			'type' => 'radio_img', 
			'std' => $defaults[$tab]['blogosphere' . '_search_layout'], 
			'choices' => array( 
				esc_html__('Right Sidebar', 'blogosphere') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_r.jpg' . '|r_sidebar', 
				esc_html__('Left Sidebar', 'blogosphere') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_l.jpg' . '|l_sidebar', 
				esc_html__('Full Width', 'blogosphere') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/fullwidth.jpg' . '|fullwidth' 
			) 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'blogosphere' . '_other_layout', 
			'title' => esc_html__('Other Layout Type', 'blogosphere'), 
			'desc' => esc_html__('Layout for pages of non-listed types. Choosing layout with a sidebar please make sure to add widgets to the Sidebar in the Appearance - Widgets tab. The empty sidebar won\'t be displayed.', 'blogosphere'), 
			'type' => 'radio_img', 
			'std' => $defaults[$tab]['blogosphere' . '_other_layout'], 
			'choices' => array( 
				esc_html__('Right Sidebar', 'blogosphere') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_r.jpg' . '|r_sidebar', 
				esc_html__('Left Sidebar', 'blogosphere') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_l.jpg' . '|l_sidebar', 
				esc_html__('Full Width', 'blogosphere') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/fullwidth.jpg' . '|fullwidth' 
			) 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'blogosphere' . '_heading_alignment', 
			'title' => esc_html__('Heading Alignment by Default', 'blogosphere'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['blogosphere' . '_heading_alignment'], 
			'choices' => array( 
				esc_html__('Left', 'blogosphere') . '|left', 
				esc_html__('Right', 'blogosphere') . '|right', 
				esc_html__('Center', 'blogosphere') . '|center' 
			) 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'blogosphere' . '_heading_scheme', 
			'title' => esc_html__('Heading Color Scheme by Default', 'blogosphere'), 
			'desc' => '', 
			'type' => 'select_scheme', 
			'std' => $defaults[$tab]['blogosphere' . '_heading_scheme'], 
			'choices' => cmsmasters_color_schemes_list() 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'blogosphere' . '_heading_bg_image_enable', 
			'title' => esc_html__('Heading Background Image Visibility by Default', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_heading_bg_image_enable'] 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'blogosphere' . '_heading_bg_image', 
			'title' => esc_html__('Heading Background Image by Default', 'blogosphere'), 
			'desc' => esc_html__('Choose your custom heading background image by default.', 'blogosphere'), 
			'type' => 'upload', 
			'std' => $defaults[$tab]['blogosphere' . '_heading_bg_image'], 
			'frame' => 'select', 
			'multiple' => false 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'blogosphere' . '_heading_bg_repeat', 
			'title' => esc_html__('Heading Background Repeat by Default', 'blogosphere'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['blogosphere' . '_heading_bg_repeat'], 
			'choices' => array( 
				esc_html__('No Repeat', 'blogosphere') . '|no-repeat', 
				esc_html__('Repeat Horizontally', 'blogosphere') . '|repeat-x', 
				esc_html__('Repeat Vertically', 'blogosphere') . '|repeat-y', 
				esc_html__('Repeat', 'blogosphere') . '|repeat' 
			) 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'blogosphere' . '_heading_bg_attachment', 
			'title' => esc_html__('Heading Background Attachment by Default', 'blogosphere'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['blogosphere' . '_heading_bg_attachment'], 
			'choices' => array( 
				esc_html__('Scroll', 'blogosphere') . '|scroll', 
				esc_html__('Fixed', 'blogosphere') . '|fixed' 
			) 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'blogosphere' . '_heading_bg_size', 
			'title' => esc_html__('Heading Background Size by Default', 'blogosphere'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['blogosphere' . '_heading_bg_size'], 
			'choices' => array( 
				esc_html__('Auto', 'blogosphere') . '|auto', 
				esc_html__('Cover', 'blogosphere') . '|cover', 
				esc_html__('Contain', 'blogosphere') . '|contain' 
			) 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'blogosphere' . '_heading_bg_color', 
			'title' => esc_html__('Heading Background Color Overlay by Default', 'blogosphere'), 
			'desc' => '',  
			'type' => 'rgba', 
			'std' => $defaults[$tab]['blogosphere' . '_heading_bg_color'] 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'blogosphere' . '_heading_height', 
			'title' => esc_html__('Heading Height by Default', 'blogosphere'), 
			'desc' => esc_html__('pixels', 'blogosphere'), 
			'type' => 'number', 
			'std' => $defaults[$tab]['blogosphere' . '_heading_height'], 
			'min' => '0' 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'blogosphere' . '_breadcrumbs', 
			'title' => esc_html__('Breadcrumbs Visibility by Default', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_breadcrumbs'] 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'blogosphere' . '_bottom_scheme', 
			'title' => esc_html__('Bottom Color Scheme', 'blogosphere'), 
			'desc' => '', 
			'type' => 'select_scheme', 
			'std' => $defaults[$tab]['blogosphere' . '_bottom_scheme'], 
			'choices' => cmsmasters_color_schemes_list() 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'blogosphere' . '_bottom_sidebar', 
			'title' => esc_html__('Bottom Sidebar Visibility by Default', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere') . '<br><br>' . esc_html__('Please make sure to add widgets in the Appearance - Widgets tab. The empty sidebar won\'t be displayed.', 'blogosphere'),
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_bottom_sidebar'] 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'blogosphere' . '_bottom_sidebar_layout', 
			'title' => esc_html__('Bottom Sidebar Layout by Default', 'blogosphere'), 
			'desc' => '', 
			'type' => 'select', 
			'std' => $defaults[$tab]['blogosphere' . '_bottom_sidebar_layout'], 
			'choices' => array( 
				'1/1|11', 
				'1/2 + 1/2|1212', 
				'1/3 + 2/3|1323', 
				'2/3 + 1/3|2313', 
				'1/4 + 3/4|1434', 
				'3/4 + 1/4|3414', 
				'1/3 + 1/3 + 1/3|131313', 
				'1/2 + 1/4 + 1/4|121414', 
				'1/4 + 1/2 + 1/4|141214', 
				'1/4 + 1/4 + 1/2|141412', 
				'1/4 + 1/4 + 1/4 + 1/4|14141414' 
			) 
		);
		
		break;
	case 'footer':
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => 'blogosphere' . '_footer_scheme', 
			'title' => esc_html__('Footer Color Scheme', 'blogosphere'), 
			'desc' => '', 
			'type' => 'select_scheme', 
			'std' => $defaults[$tab]['blogosphere' . '_footer_scheme'], 
			'choices' => cmsmasters_color_schemes_list() 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => 'blogosphere' . '_footer_type', 
			'title' => esc_html__('Footer Type', 'blogosphere'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['blogosphere' . '_footer_type'], 
			'choices' => array( 
				esc_html__('Default', 'blogosphere') . '|default', 
				esc_html__('Small', 'blogosphere') . '|small' 
			) 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => 'blogosphere' . '_footer_additional_content', 
			'title' => esc_html__('Footer Additional Content', 'blogosphere'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['blogosphere' . '_footer_additional_content'], 
			'choices' => array( 
				esc_html__('None', 'blogosphere') . '|none', 
				esc_html__('Footer Navigation (will be shown if set in Appearance - Menus tab)', 'blogosphere') . '|nav', 
				esc_html__('Social Icons (will be shown if Cmsmasters Content Composer plugin is active)', 'blogosphere') . '|social', 
				esc_html__('Custom HTML', 'blogosphere') . '|text' 
			) 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => 'blogosphere' . '_footer_logo', 
			'title' => esc_html__('Footer Logo', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_footer_logo'] 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => 'blogosphere' . '_footer_logo_url', 
			'title' => esc_html__('Footer Logo', 'blogosphere'), 
			'desc' => esc_html__('Choose your website footer logo image.', 'blogosphere'), 
			'type' => 'upload', 
			'std' => $defaults[$tab]['blogosphere' . '_footer_logo_url'], 
			'frame' => 'select', 
			'multiple' => false 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => 'blogosphere' . '_footer_logo_url_retina', 
			'title' => esc_html__('Footer Logo for Retina', 'blogosphere'), 
			'desc' => esc_html__('Choose your website footer logo image for retina.', 'blogosphere'), 
			'type' => 'upload', 
			'std' => $defaults[$tab]['blogosphere' . '_footer_logo_url_retina'], 
			'frame' => 'select', 
			'multiple' => false 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => 'blogosphere' . '_footer_nav', 
			'title' => esc_html__('Footer Navigation', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_footer_nav'] 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => 'blogosphere' . '_footer_social', 
			'title' => esc_html__('Footer Social Icons (will be shown if Cmsmasters Content Composer plugin is active)', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_footer_social'] 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => 'blogosphere' . '_footer_html', 
			'title' => esc_html__('Footer Custom HTML', 'blogosphere'), 
			'desc' => '<strong>' . esc_html__('HTML tags are allowed!', 'blogosphere') . '</strong>', 
			'type' => 'textarea', 
			'std' => $defaults[$tab]['blogosphere' . '_footer_html'], 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => 'blogosphere' . '_footer_copyright', 
			'title' => esc_html__('Copyright Text', 'blogosphere'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => $defaults[$tab]['blogosphere' . '_footer_copyright'], 
			'class' => '' 
		);
		
		break;
	}
	
	return apply_filters('cmsmasters_options_general_fields_filter', $options, $tab);
}

