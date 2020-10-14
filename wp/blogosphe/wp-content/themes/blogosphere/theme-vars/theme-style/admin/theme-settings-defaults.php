<?php 
/**
 * @package 	WordPress
 * @subpackage 	Blogosphere
 * @version		1.0.4
 * 
 * Theme Settings Defaults
 * Created by CMSMasters
 * 
 */


/* Theme Settings General Default Values */
if (!function_exists('blogosphere_settings_general_defaults')) {

function blogosphere_settings_general_defaults($id = false) {
	$settings = array( 
		'general' => array( 
			'blogosphere' . '_theme_layout' => 			'liquid', 
			'blogosphere' . '_logo_type' => 			'image', 
			'blogosphere' . '_logo_url' => 				'|' . get_template_directory_uri() . '/theme-vars/theme-style' . CMSMASTERS_THEME_STYLE . '/img/logo.png', 
			'blogosphere' . '_logo_url_retina' => 		'|' . get_template_directory_uri() . '/theme-vars/theme-style' . CMSMASTERS_THEME_STYLE . '/img/logo_retina.png', 
			'blogosphere' . '_logo_title' => 			get_bloginfo('name') ? get_bloginfo('name') : 'Blogosphere', 
			'blogosphere' . '_logo_subtitle' => 		'', 
			'blogosphere' . '_logo_custom_color' => 	0, 
			'blogosphere' . '_logo_title_color' => 		'', 
			'blogosphere' . '_logo_subtitle_color' => 	'' 
		), 
		'bg' => array( 
			'blogosphere' . '_bg_col' => 			'#ffffff', 
			'blogosphere' . '_bg_img_enable' => 	0, 
			'blogosphere' . '_bg_img' => 			'', 
			'blogosphere' . '_bg_rep' => 			'no-repeat', 
			'blogosphere' . '_bg_pos' => 			'top center', 
			'blogosphere' . '_bg_att' => 			'scroll', 
			'blogosphere' . '_bg_size' => 			'cover' 
		), 
		'header' => array( 
			'blogosphere' . '_fixed_header' => 					1, 
			'blogosphere' . '_header_overlaps' => 				0, 
			'blogosphere' . '_header_top_line' => 				0, 
			'blogosphere' . '_header_top_height' => 			'46', 
			'blogosphere' . '_header_top_line_short_info' => 	'', 
			'blogosphere' . '_header_top_line_add_cont' => 		'nav', 
			'blogosphere' . '_header_styles' => 				'r_nav', 
			'blogosphere' . '_header_mid_height' => 			'64', 
			'blogosphere' . '_header_bot_height' => 			'166', 
			'blogosphere' . '_header_search' => 				1, 
			'blogosphere' . '_header_add_cont' => 				'social', 
			'blogosphere' . '_header_add_cont_cust_html' => 	'',
			'blogosphere' . '_woocommerce_cart_dropdown' => 	0 
		), 
		'content' => array( 
			'blogosphere' . '_layout' => 					'r_sidebar', 
			'blogosphere' . '_archives_layout' => 			'r_sidebar', 
			'blogosphere' . '_search_layout' => 			'r_sidebar', 
			'blogosphere' . '_other_layout' => 				'r_sidebar', 
			'blogosphere' . '_heading_alignment' => 		'center', 
			'blogosphere' . '_heading_scheme' => 			'default', 
			'blogosphere' . '_heading_bg_image_enable' => 	0, 
			'blogosphere' . '_heading_bg_image' => 			'', 
			'blogosphere' . '_heading_bg_repeat' => 		'no-repeat', 
			'blogosphere' . '_heading_bg_attachment' => 	'scroll', 
			'blogosphere' . '_heading_bg_size' => 			'cover', 
			'blogosphere' . '_heading_bg_color' => 			'', 
			'blogosphere' . '_heading_height' => 			'80', 
			'blogosphere' . '_breadcrumbs' => 				1, 
			'blogosphere' . '_bottom_scheme' => 			'first', 
			'blogosphere' . '_bottom_sidebar' => 			0, 
			'blogosphere' . '_bottom_sidebar_layout' => 	'14141414' 
		), 
		'footer' => array( 
			'blogosphere' . '_footer_scheme' => 				'footer', 
			'blogosphere' . '_footer_type' => 					'default', 
			'blogosphere' . '_footer_additional_content' => 	'nav', 
			'blogosphere' . '_footer_logo' => 					1, 
			'blogosphere' . '_footer_logo_url' => 				'|' . get_template_directory_uri() . '/theme-vars/theme-style' . CMSMASTERS_THEME_STYLE . '/img/logo_footer.png', 
			'blogosphere' . '_footer_logo_url_retina' => 		'|' . get_template_directory_uri() . '/theme-vars/theme-style' . CMSMASTERS_THEME_STYLE . '/img/logo_footer_retina.png', 
			'blogosphere' . '_footer_nav' => 					0, 
			'blogosphere' . '_footer_social' => 				1, 
			'blogosphere' . '_footer_html' => 					'', 
			'blogosphere' . '_footer_copyright' => 				'Blogosphere' . ' &copy; ' . date('Y') . ' / ' . esc_html__('All Rights Reserved', 'blogosphere') 
		) 
	);
	
	
	$settings = apply_filters('blogosphere_settings_general_defaults_filter', $settings);
	
	
	if ($id) {
		return $settings[$id];
	} else {
		return $settings;
	}
}

}



/* Theme Settings Fonts Default Values */
if (!function_exists('blogosphere_settings_font_defaults')) {

function blogosphere_settings_font_defaults($id = false) {
	$settings = array( 
		'content' => array( 
			'blogosphere' . '_content_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'Overpass:300', 
				'font_size' => 			'15', 
				'line_height' => 		'24', 
				'font_weight' => 		'300', 
				'font_style' => 		'normal' 
			) 
		), 
		'link' => array( 
			'blogosphere' . '_link_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'Overpass:300', 
				'font_size' => 			'15', 
				'line_height' => 		'24', 
				'font_weight' => 		'300', 
				'font_style' => 		'normal', 
				'text_transform' => 	'none', 
				'text_decoration' => 	'none' 
			), 
			'blogosphere' . '_link_hover_decoration' => 	'none' 
		), 
		'nav' => array( 
			'blogosphere' . '_nav_title_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'Karla:400,700', 
				'font_size' => 			'15', 
				'line_height' => 		'26', 
				'font_weight' => 		'700', 
				'font_style' => 		'normal', 
				'text_transform' => 	'uppercase' 
			), 
			'blogosphere' . '_nav_dropdown_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'Karla:400,700', 
				'font_size' => 			'13', 
				'line_height' => 		'20', 
				'font_weight' => 		'400', 
				'font_style' => 		'normal', 
				'text_transform' => 	'uppercase' 
			) 
		), 
		'heading' => array( 
			'blogosphere' . '_h1_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'Montserrat:400,600,700', 
				'font_size' => 			'50', 
				'line_height' => 		'62', 
				'font_weight' => 		'600', 
				'font_style' => 		'normal', 
				'text_transform' => 	'none', 
				'text_decoration' => 	'none' 
			), 
			'blogosphere' . '_h2_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'Montserrat:400,600,700', 
				'font_size' => 			'36', 
				'line_height' => 		'46', 
				'font_weight' => 		'600', 
				'font_style' => 		'normal', 
				'text_transform' => 	'none', 
				'text_decoration' => 	'none' 
			), 
			'blogosphere' . '_h3_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'Montserrat:400,600,700', 
				'font_size' => 			'24', 
				'line_height' => 		'30', 
				'font_weight' => 		'600', 
				'font_style' => 		'normal', 
				'text_transform' => 	'none', 
				'text_decoration' => 	'none' 
			), 
			'blogosphere' . '_h4_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'Montserrat:400,600,700', 
				'font_size' => 			'18', 
				'line_height' => 		'24', 
				'font_weight' => 		'600', 
				'font_style' => 		'normal', 
				'text_transform' => 	'none', 
				'text_decoration' => 	'none' 
			), 
			'blogosphere' . '_h5_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'Karla:400,700', 
				'font_size' => 			'15', 
				'line_height' => 		'20', 
				'font_weight' => 		'700', 
				'font_style' => 		'normal', 
				'text_transform' => 	'uppercase', 
				'text_decoration' => 	'none' 
			), 
			'blogosphere' . '_h6_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'Montserrat:400,600,700', 
				'font_size' => 			'15', 
				'line_height' => 		'20', 
				'font_weight' => 		'600', 
				'font_style' => 		'normal', 
				'text_transform' => 	'none', 
				'text_decoration' => 	'none' 
			) 
		), 
		'other' => array( 
			'blogosphere' . '_button_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'Karla:400,700', 
				'font_size' => 			'14', 
				'line_height' => 		'40', 
				'font_weight' => 		'700', 
				'font_style' => 		'normal', 
				'text_transform' => 	'uppercase' 
			), 
			'blogosphere' . '_small_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'Karla:400,700', 
				'font_size' => 			'14', 
				'line_height' => 		'18', 
				'font_weight' => 		'400', 
				'font_style' => 		'normal', 
				'text_transform' => 	'uppercase' 
			), 
			'blogosphere' . '_input_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'Overpass:300', 
				'font_size' => 			'15', 
				'line_height' => 		'24', 
				'font_weight' => 		'300', 
				'font_style' => 		'normal' 
			), 
			'blogosphere' . '_quote_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'Montserrat:400,600,700', 
				'font_size' => 			'20', 
				'line_height' => 		'32', 
				'font_weight' => 		'700', 
				'font_style' => 		'normal' 
			) 
		), 
		'google' => array( 
			'blogosphere' . '_google_web_fonts' => array( 
				'Montserrat:400,600,700|Montserrat', 
				'Overpass:300|Overpass', 
				'Karla:400,700|Karla', 
				'Arya|Arya', 
				'Playfair+Display|Playfair Display', 
				'Poppins:300,400|Poppins', 
				'EB+Garamond:400,400i,500,500i,600,600i,700,700i,800,800i|EB Garamond', 
				'Roboto:300,300italic,400,400italic,500,500italic,700,700italic|Roboto', 
				'Roboto+Condensed:400,400italic,700,700italic|Roboto Condensed', 
				'Open+Sans:300,300italic,400,400italic,700,700italic|Open Sans', 
				'Open+Sans+Condensed:300,300italic,700|Open Sans Condensed', 
				'Droid+Sans:400,700|Droid Sans', 
				'Droid+Serif:400,400italic,700,700italic|Droid Serif', 
				'PT+Sans:400,400italic,700,700italic|PT Sans', 
				'PT+Sans+Caption:400,700|PT Sans Caption', 
				'PT+Sans+Narrow:400,700|PT Sans Narrow', 
				'PT+Serif:400,400italic,700,700italic|PT Serif', 
				'Ubuntu:400,400italic,700,700italic|Ubuntu', 
				'Ubuntu+Condensed|Ubuntu Condensed', 
				'Headland+One|Headland One', 
				'Source+Sans+Pro:300,300italic,400,400italic,700,700italic|Source Sans Pro', 
				'Lato:400,400italic,700,700italic|Lato', 
				'Cuprum:400,400italic,700,700italic|Cuprum', 
				'Oswald:300,400,700|Oswald', 
				'Yanone+Kaffeesatz:300,400,700|Yanone Kaffeesatz', 
				'Lobster|Lobster', 
				'Lobster+Two:400,400italic,700,700italic|Lobster Two', 
				'Questrial|Questrial', 
				'Raleway:300,400,500,600,700|Raleway', 
				'Dosis:300,400,500,700|Dosis', 
				'Cutive+Mono|Cutive Mono', 
				'Quicksand:300,400,700|Quicksand', 
				'Cookie|Cookie' 
			) 
		) 
	);
	
	
	$settings = apply_filters('blogosphere_settings_font_defaults_filter', $settings);
	
	
	if ($id) {
		return $settings[$id];
	} else {
		return $settings;
	}
}

}



// WP Color Picker Palettes
if (!function_exists('cmsmasters_color_picker_palettes')) {

function cmsmasters_color_picker_palettes() {
	$palettes = array( 
		'#323232', 
		'#aaaaaa', 
		'#000000', 
		'#ffffff', 
		'#959595', 
		'#c0c0c0', 
		'#e0e0e0', 
		'#e1e1e1' 
	);
	
	
	return apply_filters('cmsmasters_color_picker_palettes_filter', $palettes);
}

}



// Theme Settings Color Schemes Default Colors
if (!function_exists('blogosphere_color_schemes_defaults')) {

function blogosphere_color_schemes_defaults($id = false) {
	$settings = array( 
		'default' => array( // content default color scheme
			'color' => 		'#323232', 
			'link' => 		'#aaaaaa', 
			'hover' => 		'#000000', 
			'heading' => 	'#000000', 
			'bg' => 		'#ffffff', 
			'alternate' => 	'#ffffff', 
			'border' => 	'#e0e0e0' 
		), 
		'header' => array( // Header color scheme
			'mid_color' => 		'#000000', 
			'mid_link' => 		'#000000', 
			'mid_hover' => 		'rgba(0,0,0,0.6)', 
			'mid_bg' => 		'#ffffff', 
			'mid_bg_scroll' => 	'#ffffff', 
			'mid_border' => 	'#e0e0e0', 
			'bot_color' => 		'#000000', 
			'bot_link' => 		'#000000', 
			'bot_hover' => 		'rgba(0,0,0,0.6)', 
			'bot_bg' => 		'#ffffff', 
			'bot_bg_scroll' => 	'#ffffff', 
			'bot_border' => 	'#e0e0e0' 
		), 
		'navigation' => array( // Navigation color scheme
			'title_link' => 			'#000000', 
			'title_link_hover' => 		'rgba(0,0,0,0.6)', 
			'title_link_current' => 	'#000000', 
			'title_link_subtitle' => 	'rgba(0,0,0,0.5)', 
			'title_link_bg' => 			'rgba(255,255,255,0)', 
			'title_link_bg_hover' => 	'rgba(255,255,255,0)', 
			'title_link_bg_current' => 	'rgba(255,255,255,0)', 
			'title_link_border' => 		'rgba(255,255,255,0)', 
			'dropdown_text' => 			'#b7b7b7', 
			'dropdown_bg' => 			'#000000', 
			'dropdown_border' => 		'rgba(255,255,255,0)', 
			'dropdown_link' => 			'#b7b7b7', 
			'dropdown_link_hover' => 	'#ffffff', 
			'dropdown_link_subtitle' => '#4f4f4f', 
			'dropdown_link_highlight' => 'rgba(255,255,255,0)', 
			'dropdown_link_border' => 	'rgba(255,255,255,0.15)' 
		), 
		'header_top' => array( // Header Top color scheme
			'color' => 					'#000000', 
			'link' => 					'#000000', 
			'hover' => 					'rgba(0,0,0,0.6)', 
			'bg' => 					'#ffffff', 
			'border' => 				'#e0e0e0', 
			'title_link' => 			'#000000', 
			'title_link_hover' => 		'rgba(0,0,0,0.6)', 
			'title_link_bg' => 			'rgba(255,255,255,0)', 
			'title_link_bg_hover' => 	'rgba(255,255,255,0)', 
			'title_link_border' => 		'rgba(255,255,255,0)', 
			'dropdown_bg' => 			'#000000', 
			'dropdown_border' => 		'rgba(255,255,255,0.15)', 
			'dropdown_link' => 			'#b7b7b7', 
			'dropdown_link_hover' => 	'#ffffff', 
			'dropdown_link_highlight' => 'rgba(255,255,255,0)', 
			'dropdown_link_border' => 	'rgba(255,255,255,0)' 
		), 
		'footer' => array( // Footer color scheme
			'color' => 		'#000000', 
			'link' => 		'#000000', 
			'hover' => 		'rgba(0,0,0,0.6)', 
			'heading' => 	'#000000', 
			'bg' => 		'#ffffff', 
			'alternate' => 	'#ffffff', 
			'border' => 	'#e0e0e0' 
		), 
		'first' => array( // custom color scheme 1
			'color' => 		'#323232', 
			'link' => 		'#aaaaaa', 
			'hover' => 		'#000000', 
			'heading' => 	'#000000', 
			'bg' => 		'#ffffff', 
			'alternate' => 	'#ffffff', 
			'border' => 	'#e0e0e0' 
		), 
		'second' => array( // custom color scheme 2
			'color' => 		'#323232', 
			'link' => 		'#aaaaaa', 
			'hover' => 		'#000000', 
			'heading' => 	'#000000', 
			'bg' => 		'#ffffff', 
			'alternate' => 	'#ffffff', 
			'border' => 	'#e0e0e0' 
		), 
		'third' => array( // custom color scheme 3
			'color' => 		'#323232', 
			'link' => 		'#aaaaaa', 
			'hover' => 		'#000000', 
			'heading' => 	'#000000', 
			'bg' => 		'#ffffff', 
			'alternate' => 	'#ffffff', 
			'border' => 	'#e0e0e0' 
		) 
	);
	
	
	$settings = apply_filters('blogosphere_color_schemes_defaults_filter', $settings);
	
	
	if ($id) {
		return $settings[$id];
	} else {
		return $settings;
	}
}

}



// Theme Settings Elements Default Values
if (!function_exists('blogosphere_settings_element_defaults')) {

function blogosphere_settings_element_defaults($id = false) {
	$settings = array( 
		'sidebar' => array( 
			'blogosphere' . '_sidebar' => 	'' 
		), 
		'icon' => array( 
			'blogosphere' . '_social_icons' => array( 
				'cmsmasters-icon-facebook-1|#|' . esc_html__('Facebook', 'blogosphere') . '|true|#000000|#666666', 
				'cmsmasters-icon-gplus-1|#|' . esc_html__('Google+', 'blogosphere') . '|true|#000000|#666666', 
				'cmsmasters-icon-instagram|#|' . esc_html__('Instagram', 'blogosphere') . '|true|#000000|#666666', 
				'cmsmasters-icon-twitter|#|' . esc_html__('Twitter', 'blogosphere') . '|true|#000000|#666666', 
				'cmsmasters-icon-youtube-play|#|' . esc_html__('YouTube', 'blogosphere') . '|true|#000000|#666666' 
			) 
		), 
		'lightbox' => array( 
			'blogosphere' . '_ilightbox_skin' => 					'dark', 
			'blogosphere' . '_ilightbox_path' => 					'vertical', 
			'blogosphere' . '_ilightbox_infinite' => 				0, 
			'blogosphere' . '_ilightbox_aspect_ratio' => 			1, 
			'blogosphere' . '_ilightbox_mobile_optimizer' => 		1, 
			'blogosphere' . '_ilightbox_max_scale' => 				1, 
			'blogosphere' . '_ilightbox_min_scale' => 				0.2, 
			'blogosphere' . '_ilightbox_inner_toolbar' => 			0, 
			'blogosphere' . '_ilightbox_smart_recognition' => 		0, 
			'blogosphere' . '_ilightbox_fullscreen_one_slide' => 	0, 
			'blogosphere' . '_ilightbox_fullscreen_viewport' => 	'center', 
			'blogosphere' . '_ilightbox_controls_toolbar' => 		1, 
			'blogosphere' . '_ilightbox_controls_arrows' => 		0, 
			'blogosphere' . '_ilightbox_controls_fullscreen' => 	1, 
			'blogosphere' . '_ilightbox_controls_thumbnail' => 		1, 
			'blogosphere' . '_ilightbox_controls_keyboard' => 		1, 
			'blogosphere' . '_ilightbox_controls_mousewheel' => 	1, 
			'blogosphere' . '_ilightbox_controls_swipe' => 			1, 
			'blogosphere' . '_ilightbox_controls_slideshow' => 		0 
		), 
		'sitemap' => array( 
			'blogosphere' . '_sitemap_nav' => 			1, 
			'blogosphere' . '_sitemap_categs' => 		1, 
			'blogosphere' . '_sitemap_tags' => 			1, 
			'blogosphere' . '_sitemap_month' => 		1, 
			'blogosphere' . '_sitemap_pj_categs' => 	1, 
			'blogosphere' . '_sitemap_pj_tags' => 		1 
		), 
		'error' => array( 
			'blogosphere' . '_error_color' => 			'#ffffff', 
			'blogosphere' . '_error_bg_color' => 		'rgba(0,0,0,0)', 
			'blogosphere' . '_error_bg_img_enable' => 	1, 
			'blogosphere' . '_error_bg_image' => 		'|' . get_template_directory_uri() . '/theme-vars/theme-style' . CMSMASTERS_THEME_STYLE . '/img/404.jpg', 
			'blogosphere' . '_error_bg_rep' => 			'no-repeat', 
			'blogosphere' . '_error_bg_pos' => 			'top center', 
			'blogosphere' . '_error_bg_att' => 			'scroll', 
			'blogosphere' . '_error_bg_size' => 		'cover', 
			'blogosphere' . '_error_search' => 			1, 
			'blogosphere' . '_error_sitemap_button' => 	1, 
			'blogosphere' . '_error_sitemap_link' => 	'' 
		), 
		'code' => array( 
			'blogosphere' . '_custom_css' => 			'', 
			'blogosphere' . '_custom_js' => 			'', 
			'blogosphere' . '_gmap_api_key' => 			'', 
			'blogosphere' . '_api_key' => 				'', 
			'blogosphere' . '_api_secret' => 			'', 
			'blogosphere' . '_access_token' => 			'', 
			'blogosphere' . '_access_token_secret' => 	'' 
		), 
		'recaptcha' => array( 
			'blogosphere' . '_recaptcha_public_key' => 	'', 
			'blogosphere' . '_recaptcha_private_key' => '' 
		) 
	);
	
	
	$settings = apply_filters('blogosphere_settings_element_defaults_filter', $settings);
	
	
	if ($id) {
		return $settings[$id];
	} else {
		return $settings;
	}
}

}



// Theme Settings Single Posts Default Values
if (!function_exists('blogosphere_settings_single_defaults')) {

function blogosphere_settings_single_defaults($id = false) {
	$settings = array( 
		'post' => array( 
			'blogosphere' . '_blog_post_layout' => 			'r_sidebar', 
			'blogosphere' . '_blog_post_title' => 			1, 
			'blogosphere' . '_blog_post_date' => 			1, 
			'blogosphere' . '_blog_post_cat' => 			1, 
			'blogosphere' . '_blog_post_author' => 			1, 
			'blogosphere' . '_blog_post_comment' => 		1, 
			'blogosphere' . '_blog_post_tag' => 			1, 
			'blogosphere' . '_blog_post_like' => 			1, 
			'blogosphere' . '_blog_post_nav_box' => 		1, 
			'blogosphere' . '_blog_post_nav_order_cat' => 	0, 
			'blogosphere' . '_blog_post_share_box' => 		1, 
			'blogosphere' . '_blog_post_author_box' => 		1, 
			'blogosphere' . '_blog_more_posts_box' => 		'popular', 
			'blogosphere' . '_blog_more_posts_count' => 	'3', 
			'blogosphere' . '_blog_more_posts_pause' => 	'5' 
		), 
		'project' => array( 
			'blogosphere' . '_portfolio_project_title' => 			1, 
			'blogosphere' . '_portfolio_project_details_title' => 	esc_html__('Project details', 'blogosphere'), 
			'blogosphere' . '_portfolio_project_date' => 			1, 
			'blogosphere' . '_portfolio_project_cat' => 			1, 
			'blogosphere' . '_portfolio_project_author' => 			1, 
			'blogosphere' . '_portfolio_project_comment' => 		0, 
			'blogosphere' . '_portfolio_project_tag' => 			0, 
			'blogosphere' . '_portfolio_project_like' => 			1, 
			'blogosphere' . '_portfolio_project_link' => 			0, 
			'blogosphere' . '_portfolio_project_share_box' => 		1, 
			'blogosphere' . '_portfolio_project_nav_box' => 		1, 
			'blogosphere' . '_portfolio_project_nav_order_cat' => 	0, 
			'blogosphere' . '_portfolio_project_author_box' => 		1, 
			'blogosphere' . '_portfolio_more_projects_box' => 		'popular', 
			'blogosphere' . '_portfolio_more_projects_count' => 	'4', 
			'blogosphere' . '_portfolio_more_projects_pause' => 	'5', 
			'blogosphere' . '_portfolio_project_slug' => 			'project', 
			'blogosphere' . '_portfolio_pj_categs_slug' => 			'pj-categs', 
			'blogosphere' . '_portfolio_pj_tags_slug' => 			'pj-tags' 
		), 
		'profile' => array( 
			'blogosphere' . '_profile_post_title' => 			1, 
			'blogosphere' . '_profile_post_details_title' => 	esc_html__('Profile details', 'blogosphere'), 
			'blogosphere' . '_profile_post_cat' => 				1, 
			'blogosphere' . '_profile_post_comment' => 			1, 
			'blogosphere' . '_profile_post_like' => 			1, 
			'blogosphere' . '_profile_post_nav_box' => 			1, 
			'blogosphere' . '_profile_post_nav_order_cat' => 	0, 
			'blogosphere' . '_profile_post_share_box' => 		1, 
			'blogosphere' . '_profile_post_slug' => 			'profile', 
			'blogosphere' . '_profile_pl_categs_slug' => 		'pl-categs' 
		) 
	);
	
	
	$settings = apply_filters('blogosphere_settings_single_defaults_filter', $settings);
	
	
	if ($id) {
		return $settings[$id];
	} else {
		return $settings;
	}
}

}



/* Project Puzzle Proportion */
if (!function_exists('blogosphere_project_puzzle_proportion')) {

function blogosphere_project_puzzle_proportion() {
	return 1;
}

}


/* Project Puzzle Proportion */
if (!function_exists('blogosphere_project_puzzle_large_gar_parameters')) {

function blogosphere_project_puzzle_large_gar_parameters() {
	$parameter = array ( 
		'container_width' 		=> 1160, 
		'bottomStaticPadding' 	=> 2.6 
	);
	
	
	return $parameter;
}

}


/* Theme Image Thumbnails Size */
if (!function_exists('blogosphere_get_image_thumbnail_list')) {

function blogosphere_get_image_thumbnail_list() {
	$list = array( 
		'cmsmasters-small-thumb' => array( 
			'width' => 		75, 
			'height' => 	75, 
			'crop' => 		true 
		), 
		'cmsmasters-square-thumb' => array( 
			'width' => 		350, 
			'height' => 	350, 
			'crop' => 		true, 
			'title' => 		esc_attr__('Square', 'blogosphere') 
		), 
		'cmsmasters-blog-masonry-thumb' => array( 
			'width' => 		580, 
			'height' => 	469, 
			'crop' => 		true, 
			'title' => 		esc_attr__('Masonry Blog', 'blogosphere') 
		), 
		'cmsmasters-blog-puzzle-thumb' => array( 
			'width' => 		580, 
			'height' => 	580, 
			'crop' => 		true, 
			'title' => 		esc_attr__('Puzzle Blog', 'blogosphere') 
		), 
		'cmsmasters-project-thumb' => array( 
			'width' => 		580, 
			'height' => 	423, 
			'crop' => 		true, 
			'title' => 		esc_attr__('Project', 'blogosphere') 
		),  
		'cmsmasters-post-slider-thumb' => array( 
			'width' => 		580, 
			'height' => 	773, 
			'crop' => 		true, 
			'title' => 		esc_attr__('Post Slider', 'blogosphere') 
		), 
		'cmsmasters-project-masonry-thumb' => array( 
			'width' => 		580, 
			'height' => 	9999, 
			'title' => 		esc_attr__('Masonry Project', 'blogosphere') 
		), 
		'post-thumbnail' => array( 
			'width' => 		860, 
			'height' => 	546, 
			'crop' => 		true, 
			'title' => 		esc_attr__('Featured', 'blogosphere') 
		), 
		'cmsmasters-post-side-thumbnail' => array( 
			'width' => 		860, 
			'height' => 	635, 
			'crop' => 		true, 
			'title' => 		esc_attr__('Side Image', 'blogosphere') 
		), 
		'cmsmasters-masonry-thumb' => array( 
			'width' => 		860, 
			'height' => 	9999, 
			'title' => 		esc_attr__('Masonry', 'blogosphere') 
		), 
		'cmsmasters-full-thumb' => array( 
			'width' => 		1160, 
			'height' => 	750, 
			'crop' => 		true, 
			'title' => 		esc_attr__('Full', 'blogosphere') 
		), 
		'cmsmasters-project-full-thumb' => array( 
			'width' => 		1160, 
			'height' => 	648, 
			'crop' => 		true, 
			'title' => 		esc_attr__('Project Full', 'blogosphere') 
		), 
		'cmsmasters-full-masonry-thumb' => array( 
			'width' => 		1160, 
			'height' => 	9999, 
			'title' => 		esc_attr__('Masonry Full', 'blogosphere') 
		) 
	);
	
	
	return $list;
}

}



/* Project Post Type Registration Rename */
if (!function_exists('blogosphere_project_labels')) {

function blogosphere_project_labels() {
	return array( 
		'name' => 					esc_html__('Projects', 'blogosphere'), 
		'singular_name' => 			esc_html__('Project', 'blogosphere'), 
		'menu_name' => 				esc_html__('Projects', 'blogosphere'), 
		'all_items' => 				esc_html__('All Projects', 'blogosphere'), 
		'add_new' => 				esc_html__('Add New', 'blogosphere'), 
		'add_new_item' => 			esc_html__('Add New Project', 'blogosphere'), 
		'edit_item' => 				esc_html__('Edit Project', 'blogosphere'), 
		'new_item' => 				esc_html__('New Project', 'blogosphere'), 
		'view_item' => 				esc_html__('View Project', 'blogosphere'), 
		'search_items' => 			esc_html__('Search Projects', 'blogosphere'), 
		'not_found' => 				esc_html__('No projects found', 'blogosphere'), 
		'not_found_in_trash' => 	esc_html__('No projects found in Trash', 'blogosphere') 
	);
}

}

// add_filter('cmsmasters_project_labels_filter', 'blogosphere_project_labels');


if (!function_exists('blogosphere_pj_categs_labels')) {

function blogosphere_pj_categs_labels() {
	return array( 
		'name' => 					esc_html__('Project Categories', 'blogosphere'), 
		'singular_name' => 			esc_html__('Project Category', 'blogosphere') 
	);
}

}

// add_filter('cmsmasters_pj_categs_labels_filter', 'blogosphere_pj_categs_labels');


if (!function_exists('blogosphere_pj_tags_labels')) {

function blogosphere_pj_tags_labels() {
	return array( 
		'name' => 					esc_html__('Project Tags', 'blogosphere'), 
		'singular_name' => 			esc_html__('Project Tag', 'blogosphere') 
	);
}

}

// add_filter('cmsmasters_pj_tags_labels_filter', 'blogosphere_pj_tags_labels');



/* Profile Post Type Registration Rename */
if (!function_exists('blogosphere_profile_labels')) {

function blogosphere_profile_labels() {
	return array( 
		'name' => 					esc_html__('Profiles', 'blogosphere'), 
		'singular_name' => 			esc_html__('Profiles', 'blogosphere'), 
		'menu_name' => 				esc_html__('Profiles', 'blogosphere'), 
		'all_items' => 				esc_html__('All Profiles', 'blogosphere'), 
		'add_new' => 				esc_html__('Add New', 'blogosphere'), 
		'add_new_item' => 			esc_html__('Add New Profile', 'blogosphere'), 
		'edit_item' => 				esc_html__('Edit Profile', 'blogosphere'), 
		'new_item' => 				esc_html__('New Profile', 'blogosphere'), 
		'view_item' => 				esc_html__('View Profile', 'blogosphere'), 
		'search_items' => 			esc_html__('Search Profiles', 'blogosphere'), 
		'not_found' => 				esc_html__('No Profiles found', 'blogosphere'), 
		'not_found_in_trash' => 	esc_html__('No Profiles found in Trash', 'blogosphere') 
	);
}

}

// add_filter('cmsmasters_profile_labels_filter', 'blogosphere_profile_labels');


if (!function_exists('blogosphere_pl_categs_labels')) {

function blogosphere_pl_categs_labels() {
	return array( 
		'name' => 					esc_html__('Profile Categories', 'blogosphere'), 
		'singular_name' => 			esc_html__('Profile Category', 'blogosphere') 
	);
}

}

// add_filter('cmsmasters_pl_categs_labels_filter', 'blogosphere_pl_categs_labels');

