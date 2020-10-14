<?php 
/**
 * @package 	WordPress
 * @subpackage 	Blogosphere
 * @version		1.0.2
 * 
 * Header Bottom Template
 * Created by CMSMasters
 * 
 */


$cmsmasters_option = blogosphere_get_global_options();


if ($cmsmasters_option['blogosphere' . '_header_styles'] != 'default') {
	echo '<div class="header_bot" data-height="' . esc_attr($cmsmasters_option['blogosphere' . '_header_bot_height']) . '">' . 
		'<div class="header_bot_outer">' . 
			'<div class="header_bot_inner">';
				do_action('cmsmasters_before_header_bot', $cmsmasters_option);
			
			
				if ($cmsmasters_option['blogosphere' . '_header_styles'] == 'r_nav') {
					do_action('cmsmasters_before_logo', $cmsmasters_option);
					echo '<div class="logo_wrap">';
						
						blogosphere_logo();
						
					echo '</div>';
					do_action('cmsmasters_after_logo', $cmsmasters_option);
				}
				
				
				if (
					$cmsmasters_option['blogosphere' . '_header_styles'] == 'l_nav'
				) {
					echo '<div class="header_bot_inner_right">';
				}
				
				
				if (
					$cmsmasters_option['blogosphere' . '_header_styles'] == 'l_nav' 
				) {
					echo '<div class="resp_bot_nav_wrap">' . 
						'<div class="resp_bot_nav_outer">' . 
							'<a class="responsive_nav resp_bot_nav cmsmasters_theme_icon_resp_nav" href="' . esc_js("javascript:void(0)") . '"></a>' . 
						'</div>' . 
					'</div>';
				}
				
				
				if (
					$cmsmasters_option['blogosphere' . '_header_search'] && 
					$cmsmasters_option['blogosphere' . '_header_styles'] == 'l_nav'
				) {
					echo '<div class="bot_search_but_wrap">' . 
						'<a href="' . esc_js("javascript:void(0)") . '" class="bot_search_but cmsmasters_header_search_but cmsmasters_theme_icon_search"></a>' . 
					'</div>';
				}
				
				
				if (
					$cmsmasters_option['blogosphere' . '_header_styles'] == 'l_nav' &&
					CMSMASTERS_WOOCOMMERCE
				) {
					blogosphere_woocommerce_cart_dropdown();
					
					blogosphere_woocommerce_header_cart_link();
				}
				
				
				if (
					$cmsmasters_option['blogosphere' . '_header_styles'] == 'l_nav'
				) {
					echo '</div>';
				}
				
				
				if (
					$cmsmasters_option['blogosphere' . '_header_styles'] == 'l_nav' ||
					$cmsmasters_option['blogosphere' . '_header_styles'] == 'c_nav'
				) {
					echo '<!-- Start Navigation -->' . 
					'<div class="bot_nav_wrap">' . 
						'<nav>';
							
							$nav_args = array( 
								'theme_location' => 	'primary', 
								'menu_id' => 			'navigation', 
								'menu_class' => 		'bot_nav navigation', 
								'link_before' => 		'<span class="nav_item_wrap">', 
								'link_after' => 		'</span>', 
								'fallback_cb' => 		false 
							);
							
							
							if (class_exists('Walker_Cmsmasters_Nav_Mega_Menu')) {
								$nav_args['walker'] = new Walker_Cmsmasters_Nav_Mega_Menu();
							}
							
							
							wp_nav_menu($nav_args);
							
						echo '</nav>' . 
					'</div>' . 
					'<!-- Finish Navigation -->';
				}
				
				do_action('cmsmasters_after_header_bot', $cmsmasters_option);
			echo '</div>' . 
		'</div>' . 
	'</div>';
}

