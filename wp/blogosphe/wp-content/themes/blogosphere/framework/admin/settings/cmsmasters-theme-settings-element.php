<?php 
/**
 * @package 	WordPress
 * @subpackage 	Blogosphere
 * @version 	1.0.0
 * 
 * Admin Panel Element Options
 * Created by CMSMasters
 * 
 */


function blogosphere_options_element_tabs() {
	$tabs = array();
	
	$tabs['sidebar'] = esc_attr__('Sidebars', 'blogosphere');
	
	if (class_exists('Cmsmasters_Content_Composer')) {
		$tabs['icon'] = esc_attr__('Social Icons', 'blogosphere');
	}
	
	$tabs['lightbox'] = esc_attr__('Lightbox', 'blogosphere');
	$tabs['sitemap'] = esc_attr__('Sitemap', 'blogosphere');
	$tabs['error'] = esc_attr__('404', 'blogosphere');
	$tabs['code'] = esc_attr__('Custom Codes', 'blogosphere');
	
	if (class_exists('Cmsmasters_Form_Builder')) {
		$tabs['recaptcha'] = esc_attr__('reCAPTCHA', 'blogosphere');
	}
	
	return apply_filters('cmsmasters_options_element_tabs_filter', $tabs);
}


function blogosphere_options_element_sections() {
	$tab = blogosphere_get_the_tab();
	
	switch ($tab) {
	case 'sidebar':
		$sections = array();
		
		$sections['sidebar_section'] = esc_attr__('Custom Sidebars', 'blogosphere');
		
		break;
	case 'icon':
		$sections = array();
		
		$sections['icon_section'] = esc_attr__('Social Icons', 'blogosphere');
		
		break;
	case 'lightbox':
		$sections = array();
		
		$sections['lightbox_section'] = esc_attr__('Theme Lightbox Options', 'blogosphere');
		
		break;
	case 'sitemap':
		$sections = array();
		
		$sections['sitemap_section'] = esc_attr__('Sitemap Page Options', 'blogosphere');
		
		break;
	case 'error':
		$sections = array();
		
		$sections['error_section'] = esc_attr__('404 Error Page Options', 'blogosphere');
		
		break;
	case 'code':
		$sections = array();
		
		$sections['code_section'] = esc_attr__('Custom Codes', 'blogosphere');
		
		break;
	case 'recaptcha':
		$sections = array();
		
		$sections['recaptcha_section'] = esc_attr__('Form Builder Plugin reCAPTCHA Keys', 'blogosphere');
		
		break;
	default:
		$sections = array();
		
		
		break;
	}
	
	return apply_filters('cmsmasters_options_element_sections_filter', $sections, $tab);	
} 


function blogosphere_options_element_fields($set_tab = false) {
	if ($set_tab) {
		$tab = $set_tab;
	} else {
		$tab = blogosphere_get_the_tab();
	}
	
	
	$options = array();
	
	
	$defaults = blogosphere_settings_element_defaults();
	
	
	switch ($tab) {
	case 'sidebar':
		$options[] = array( 
			'section' => 'sidebar_section', 
			'id' => 'blogosphere' . '_sidebar', 
			'title' => esc_html__('Custom Sidebars', 'blogosphere'), 
			'desc' => '', 
			'type' => 'sidebar', 
			'std' => $defaults[$tab]['blogosphere' . '_sidebar'] 
		);
		
		break;
	case 'icon':
		$options[] = array( 
			'section' => 'icon_section', 
			'id' => 'blogosphere' . '_social_icons', 
			'title' => esc_html__('Social Icons', 'blogosphere'), 
			'desc' => '', 
			'type' => 'social', 
			'std' => $defaults[$tab]['blogosphere' . '_social_icons'] 
		);
		
		break;
	case 'lightbox':
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'blogosphere' . '_ilightbox_skin', 
			'title' => esc_html__('Skin', 'blogosphere'), 
			'desc' => '', 
			'type' => 'select', 
			'std' => $defaults[$tab]['blogosphere' . '_ilightbox_skin'], 
			'choices' => array( 
				esc_html__('Dark', 'blogosphere') . '|dark', 
				esc_html__('Light', 'blogosphere') . '|light', 
				esc_html__('Mac', 'blogosphere') . '|mac', 
				esc_html__('Metro Black', 'blogosphere') . '|metro-black', 
				esc_html__('Metro White', 'blogosphere') . '|metro-white', 
				esc_html__('Parade', 'blogosphere') . '|parade', 
				esc_html__('Smooth', 'blogosphere') . '|smooth' 
			) 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'blogosphere' . '_ilightbox_path', 
			'title' => esc_html__('Path', 'blogosphere'), 
			'desc' => esc_html__('Sets path for switching windows', 'blogosphere'), 
			'type' => 'radio', 
			'std' => $defaults[$tab]['blogosphere' . '_ilightbox_path'], 
			'choices' => array( 
				esc_html__('Vertical', 'blogosphere') . '|vertical', 
				esc_html__('Horizontal', 'blogosphere') . '|horizontal' 
			) 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'blogosphere' . '_ilightbox_infinite', 
			'title' => esc_html__('Infinite', 'blogosphere'), 
			'desc' => esc_html__('Sets the ability to infinite the group', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_ilightbox_infinite'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'blogosphere' . '_ilightbox_aspect_ratio', 
			'title' => esc_html__('Keep Aspect Ratio', 'blogosphere'), 
			'desc' => esc_html__('Sets the resizing method used to keep aspect ratio within the viewport', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_ilightbox_aspect_ratio'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'blogosphere' . '_ilightbox_mobile_optimizer', 
			'title' => esc_html__('Mobile Optimizer', 'blogosphere'), 
			'desc' => esc_html__('Make lightboxes optimized for giving better experience with mobile devices', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_ilightbox_mobile_optimizer'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'blogosphere' . '_ilightbox_max_scale', 
			'title' => esc_html__('Max Scale', 'blogosphere'), 
			'desc' => esc_html__('Sets the maximum viewport scale of the content', 'blogosphere'), 
			'type' => 'number', 
			'std' => $defaults[$tab]['blogosphere' . '_ilightbox_max_scale'], 
			'min' => 0.1, 
			'max' => 2, 
			'step' => 0.05 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'blogosphere' . '_ilightbox_min_scale', 
			'title' => esc_html__('Min Scale', 'blogosphere'), 
			'desc' => esc_html__('Sets the minimum viewport scale of the content', 'blogosphere'), 
			'type' => 'number', 
			'std' => $defaults[$tab]['blogosphere' . '_ilightbox_min_scale'], 
			'min' => 0.1, 
			'max' => 2, 
			'step' => 0.05 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'blogosphere' . '_ilightbox_inner_toolbar', 
			'title' => esc_html__('Inner Toolbar', 'blogosphere'), 
			'desc' => esc_html__('Bring buttons into windows, or let them be over the overlay', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_ilightbox_inner_toolbar'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'blogosphere' . '_ilightbox_smart_recognition', 
			'title' => esc_html__('Smart Recognition', 'blogosphere'), 
			'desc' => esc_html__('Sets content auto recognize from web pages', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_ilightbox_smart_recognition'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'blogosphere' . '_ilightbox_fullscreen_one_slide', 
			'title' => esc_html__('Fullscreen One Slide', 'blogosphere'), 
			'desc' => esc_html__('Decide to fullscreen only one slide or hole gallery the fullscreen mode', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_ilightbox_fullscreen_one_slide'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'blogosphere' . '_ilightbox_fullscreen_viewport', 
			'title' => esc_html__('Fullscreen Viewport', 'blogosphere'), 
			'desc' => esc_html__('Sets the resizing method used to fit content within the fullscreen mode', 'blogosphere'), 
			'type' => 'select', 
			'std' => $defaults[$tab]['blogosphere' . '_ilightbox_fullscreen_viewport'], 
			'choices' => array( 
				esc_html__('Center', 'blogosphere') . '|center', 
				esc_html__('Fit', 'blogosphere') . '|fit', 
				esc_html__('Fill', 'blogosphere') . '|fill', 
				esc_html__('Stretch', 'blogosphere') . '|stretch' 
			) 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'blogosphere' . '_ilightbox_controls_toolbar', 
			'title' => esc_html__('Toolbar Controls', 'blogosphere'), 
			'desc' => esc_html__('Sets buttons be available or not', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_ilightbox_controls_toolbar'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'blogosphere' . '_ilightbox_controls_arrows', 
			'title' => esc_html__('Arrow Controls', 'blogosphere'), 
			'desc' => esc_html__('Enable the arrow buttons', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_ilightbox_controls_arrows'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'blogosphere' . '_ilightbox_controls_fullscreen', 
			'title' => esc_html__('Fullscreen Controls', 'blogosphere'), 
			'desc' => esc_html__('Sets the fullscreen button', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_ilightbox_controls_fullscreen'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'blogosphere' . '_ilightbox_controls_thumbnail', 
			'title' => esc_html__('Thumbnails Controls', 'blogosphere'), 
			'desc' => esc_html__('Sets the thumbnail navigation', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_ilightbox_controls_thumbnail'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'blogosphere' . '_ilightbox_controls_keyboard', 
			'title' => esc_html__('Keyboard Controls', 'blogosphere'), 
			'desc' => esc_html__('Sets the keyboard navigation', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_ilightbox_controls_keyboard'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'blogosphere' . '_ilightbox_controls_mousewheel', 
			'title' => esc_html__('Mouse Wheel Controls', 'blogosphere'), 
			'desc' => esc_html__('Sets the mousewheel navigation', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_ilightbox_controls_mousewheel'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'blogosphere' . '_ilightbox_controls_swipe', 
			'title' => esc_html__('Swipe Controls', 'blogosphere'), 
			'desc' => esc_html__('Sets the swipe navigation', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_ilightbox_controls_swipe'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'blogosphere' . '_ilightbox_controls_slideshow', 
			'title' => esc_html__('Slideshow Controls', 'blogosphere'), 
			'desc' => esc_html__('Enable the slideshow feature and button', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_ilightbox_controls_slideshow'] 
		);
		
		break;
	case 'sitemap':
		$options[] = array( 
			'section' => 'sitemap_section', 
			'id' => 'blogosphere' . '_sitemap_nav', 
			'title' => esc_html__('Website Pages', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_sitemap_nav'] 
		);
		
		$options[] = array( 
			'section' => 'sitemap_section', 
			'id' => 'blogosphere' . '_sitemap_categs', 
			'title' => esc_html__('Blog Archives by Categories', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_sitemap_categs'] 
		);
		
		$options[] = array( 
			'section' => 'sitemap_section', 
			'id' => 'blogosphere' . '_sitemap_tags', 
			'title' => esc_html__('Blog Archives by Tags', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_sitemap_tags'] 
		);
		
		$options[] = array( 
			'section' => 'sitemap_section', 
			'id' => 'blogosphere' . '_sitemap_month', 
			'title' => esc_html__('Blog Archives by Month', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_sitemap_month'] 
		);
		
		$options[] = array( 
			'section' => 'sitemap_section', 
			'id' => 'blogosphere' . '_sitemap_pj_categs', 
			'title' => esc_html__('Portfolio Archives by Categories', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_sitemap_pj_categs'] 
		);
		
		$options[] = array( 
			'section' => 'sitemap_section', 
			'id' => 'blogosphere' . '_sitemap_pj_tags', 
			'title' => esc_html__('Portfolio Archives by Tags', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_sitemap_pj_tags'] 
		);
		
		break;
	case 'error':
		$options[] = array( 
			'section' => 'error_section', 
			'id' => 'blogosphere' . '_error_color', 
			'title' => esc_html__('Text Color', 'blogosphere'), 
			'desc' => '', 
			'type' => 'rgba', 
			'std' => $defaults[$tab]['blogosphere' . '_error_color'] 
		);
		
		$options[] = array( 
			'section' => 'error_section', 
			'id' => 'blogosphere' . '_error_bg_color', 
			'title' => esc_html__('Background Color', 'blogosphere'), 
			'desc' => '', 
			'type' => 'rgba', 
			'std' => $defaults[$tab]['blogosphere' . '_error_bg_color'] 
		);
		
		$options[] = array( 
			'section' => 'error_section', 
			'id' => 'blogosphere' . '_error_bg_img_enable', 
			'title' => esc_html__('Background Image Visibility', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_error_bg_img_enable'] 
		);
		
		$options[] = array( 
			'section' => 'error_section', 
			'id' => 'blogosphere' . '_error_bg_image', 
			'title' => esc_html__('Background Image', 'blogosphere'), 
			'desc' => esc_html__('Choose your custom error page background image.', 'blogosphere'), 
			'type' => 'upload', 
			'std' => $defaults[$tab]['blogosphere' . '_error_bg_image'], 
			'frame' => 'select', 
			'multiple' => false 
		);
		
		$options[] = array( 
			'section' => 'error_section', 
			'id' => 'blogosphere' . '_error_bg_rep', 
			'title' => esc_html__('Background Repeat', 'blogosphere'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['blogosphere' . '_error_bg_rep'], 
			'choices' => array( 
				esc_html__('No Repeat', 'blogosphere') . '|no-repeat', 
				esc_html__('Repeat Horizontally', 'blogosphere') . '|repeat-x', 
				esc_html__('Repeat Vertically', 'blogosphere') . '|repeat-y', 
				esc_html__('Repeat', 'blogosphere') . '|repeat' 
			) 
		);
		
		$options[] = array( 
			'section' => 'error_section', 
			'id' => 'blogosphere' . '_error_bg_pos', 
			'title' => esc_html__('Background Position', 'blogosphere'), 
			'desc' => '', 
			'type' => 'select', 
			'std' => $defaults[$tab]['blogosphere' . '_error_bg_pos'], 
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
			'section' => 'error_section', 
			'id' => 'blogosphere' . '_error_bg_att', 
			'title' => esc_html__('Background Attachment', 'blogosphere'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['blogosphere' . '_error_bg_att'], 
			'choices' => array( 
				esc_html__('Scroll', 'blogosphere') . '|scroll', 
				esc_html__('Fixed', 'blogosphere') . '|fixed' 
			) 
		);
		
		$options[] = array( 
			'section' => 'error_section', 
			'id' => 'blogosphere' . '_error_bg_size', 
			'title' => esc_html__('Background Size', 'blogosphere'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['blogosphere' . '_error_bg_size'], 
			'choices' => array( 
				esc_html__('Auto', 'blogosphere') . '|auto', 
				esc_html__('Cover', 'blogosphere') . '|cover', 
				esc_html__('Contain', 'blogosphere') . '|contain' 
			) 
		);
		
		$options[] = array( 
			'section' => 'error_section', 
			'id' => 'blogosphere' . '_error_search', 
			'title' => esc_html__('Search Line', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_error_search'] 
		);
		
		$options[] = array( 
			'section' => 'error_section', 
			'id' => 'blogosphere' . '_error_sitemap_button', 
			'title' => esc_html__('Sitemap Button', 'blogosphere'), 
			'desc' => esc_html__('show', 'blogosphere'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['blogosphere' . '_error_sitemap_button'] 
		);
		
		$options[] = array( 
			'section' => 'error_section', 
			'id' => 'blogosphere' . '_error_sitemap_link', 
			'title' => esc_html__('Sitemap Page URL', 'blogosphere'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => $defaults[$tab]['blogosphere' . '_error_sitemap_link'], 
			'class' => '' 
		);
		
		break;
	case 'code':
		$options[] = array( 
			'section' => 'code_section', 
			'id' => 'blogosphere' . '_custom_css', 
			'title' => esc_html__('Custom CSS', 'blogosphere'), 
			'desc' => '', 
			'type' => 'textarea', 
			'std' => $defaults[$tab]['blogosphere' . '_custom_css'], 
			'class' => 'allowlinebreaks' 
		);
		
		$options[] = array( 
			'section' => 'code_section', 
			'id' => 'blogosphere' . '_custom_js', 
			'title' => esc_html__('Custom JavaScript', 'blogosphere'), 
			'desc' => '', 
			'type' => 'textarea', 
			'std' => $defaults[$tab]['blogosphere' . '_custom_js'], 
			'class' => 'allowlinebreaks' 
		);
		
		$options[] = array( 
			'section' => 'code_section', 
			'id' => 'blogosphere' . '_gmap_api_key', 
			'title' => esc_html__('Google Maps API key', 'blogosphere'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => $defaults[$tab]['blogosphere' . '_gmap_api_key'], 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'code_section', 
			'id' => 'blogosphere' . '_api_key', 
			'title' => esc_html__('Twitter API key', 'blogosphere'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => $defaults[$tab]['blogosphere' . '_api_key'], 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'code_section', 
			'id' => 'blogosphere' . '_api_secret', 
			'title' => esc_html__('Twitter API secret', 'blogosphere'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => $defaults[$tab]['blogosphere' . '_api_secret'], 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'code_section', 
			'id' => 'blogosphere' . '_access_token', 
			'title' => esc_html__('Twitter Access token', 'blogosphere'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => $defaults[$tab]['blogosphere' . '_access_token'], 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'code_section', 
			'id' => 'blogosphere' . '_access_token_secret', 
			'title' => esc_html__('Twitter Access token secret', 'blogosphere'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => $defaults[$tab]['blogosphere' . '_access_token_secret'], 
			'class' => '' 
		);
		
		break;
	case 'recaptcha':
		$options[] = array( 
			'section' => 'recaptcha_section', 
			'id' => 'blogosphere' . '_recaptcha_public_key', 
			'title' => esc_html__('reCAPTCHA Public Key', 'blogosphere'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => $defaults[$tab]['blogosphere' . '_recaptcha_public_key'], 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'recaptcha_section', 
			'id' => 'blogosphere' . '_recaptcha_private_key', 
			'title' => esc_html__('reCAPTCHA Private Key', 'blogosphere'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => $defaults[$tab]['blogosphere' . '_recaptcha_private_key'], 
			'class' => '' 
		);
		
		break;
	}
	
	return apply_filters('cmsmasters_options_element_fields_filter', $options, $tab);	
}

