<?php 
/**  Theme defaults values  **/

add_action('after_setup_theme', 'fixar_theme_defaults');
function fixar_theme_defaults(){
	
	// Colors and Fonts
	update_option( 'fixar_default_main_color', '#f2480c' );
	update_option( 'fixar_default_gradient_color', '' );
	update_option( 'fixar_default_additional_color', '#f56d3e' );
	update_option( 'fixar_default_font', 'Roboto' );
	update_option( 'fixar_default_font_weights', '300,400,500,700,900' );
	update_option( 'fixar_default_font_weight', '300' );
	update_option( 'fixar_default_title', 'Raleway' );
	update_option( 'fixar_default_title_weights',  '300,400,500,700,900'  );
	update_option( 'fixar_default_title_weight', '300' );
	update_option( 'fixar_default_subtitle', 'Roboto' );
	update_option( 'fixar_default_title_weights',  '300,400,500,700,900'  );
	update_option( 'fixar_default_subtitle_weight', '500' );
	
	// Header Title and Breadcrumbs
	update_option( 'fixar_default_tab_bg_color', '#000000' );
	update_option( 'fixar_default_tab_bg_color_gradient', '' );
	update_option( 'fixar_default_tab_gradient_direction', 'to bottom' );
	update_option( 'fixar_default_tab_bg_opacity', '0.8' );
	update_option( 'fixar_default_tab_padding_top', '200' );
	update_option( 'fixar_default_tab_padding_bottom', '50' );
	update_option( 'fixar_default_tab_margin_bottom', '80' );
	update_option( 'fixar_default_tab_bottom_decor', '1' );
	update_option( 'fixar_default_tab_border', '0' );

}

add_filter( 'fixar_header_settings', 'fixar_header_settings_var' );
function fixar_header_settings_var( $post_ID=0 ){

	if(isset($post_ID) && $post_ID>0) {

		/// Header global parameters
		$fixar['header_type'] = get_post_meta($post_ID, 'header_type', 1) != '' ? get_post_meta($post_ID, 'header_type', 1) : fixar_get_option('header_type', 'header1');
		$fixar['header_sidebar_view'] = $fixar['header_type'] == 'header3' ? (get_post_meta($post_ID, 'header_sidebar_view', 1) != '' ? get_post_meta($post_ID, 'header_sidebar_view', 1) : fixar_get_option('header_sidebar_view', 'fixed')) : '';
		$fixar['header_background'] = get_post_meta($post_ID, 'header_background', 1) != '' ? get_post_meta($post_ID, 'header_background', 1) : (fixar_get_option('header_background', 'trans-black'));
		$fixar['header_transparent'] = get_post_meta($post_ID, 'header_transparent', 1) != '' ? get_post_meta($post_ID, 'header_transparent', 1) : fixar_get_option('header_transparent', '4');
		$fixar['header_hover_effect'] = get_post_meta($post_ID, 'header_hover_effect', 1) != '' ? get_post_meta($post_ID, 'header_hover_effect', 1) : fixar_get_option('header_hover_effect', '0');
		$fixar['header_marker'] = get_post_meta($post_ID, 'header_marker', 1) != '' ? get_post_meta($post_ID, 'header_marker', 1) : fixar_get_option('header_marker', 'menu-marker-arrow');
		$fixar['header_layout'] = get_post_meta($post_ID, 'header_layout', 1) != '' ? get_post_meta($post_ID, 'header_layout', 1) : fixar_get_option('header_layout', 'normal');
		$fixar['header_bar'] = get_post_meta($post_ID, 'header_bar', 1) != '' ? get_post_meta($post_ID, 'header_bar', 1) : fixar_get_option('header_bar', '0');

		$fixar['header_sticky'] = get_post_meta($post_ID, 'header_sticky', 1) != '' ? get_post_meta($post_ID, 'header_sticky', 1) : fixar_get_option('header_sticky', 'sticky');
		$fixar['mobile_sticky'] = get_post_meta($post_ID, 'mobile_sticky', 1) != '' ? get_post_meta($post_ID, 'mobile_sticky', 1) : fixar_get_option('mobile_sticky', '');


		/// Header menu settings
		$fixar['header_menu'] = get_post_meta($post_ID, 'header_menu', 1) != '' ? get_post_meta($post_ID, 'header_menu', 1) : fixar_get_option('header_menu', '1');
		$fixar['header_menu_add'] = get_post_meta($post_ID, 'header_menu_add', 1) != '' ? get_post_meta($post_ID, 'header_menu_add', 1) : fixar_get_option('header_menu_add', '');
		$fixar['header_menu_add_position'] = get_post_meta($post_ID, 'header_menu_add_position', 1) != '' ? get_post_meta($post_ID, 'header_menu_add_position', 1) : fixar_get_option('header_menu_add_position', 'disable');
		$fixar['header_menu_animation'] = get_post_meta($post_ID, 'header_menu_animation', 1) != '' ? get_post_meta($post_ID, 'header_menu_animation', 1) : fixar_get_option('header_menu_animation', 'overlay');

		/// Header widgets
		$fixar['header_minicart'] = get_post_meta($post_ID, 'header_minicart', 0) != '' ? get_post_meta($post_ID, 'header_minicart', 1) : fixar_get_option('header_minicart', '1');
		$fixar['header_search'] = get_post_meta($post_ID, 'header_search', 0) != '' ? get_post_meta($post_ID, 'header_search', 1) : fixar_get_option('header_search', '0');
		$fixar['header_socials'] = get_post_meta($post_ID, 'header_socials', 1) != '' ? get_post_meta($post_ID, 'header_socials', 1) : fixar_get_option('header_socials', '1');


		$class = '';
		foreach ($fixar as $key => $val) {
			if (!in_array($key, array('header_transparent', 'header_sticky', 'mobile_sticky', 'header_menu_animation')))
				$class .= $val . '-';
		}
		$fixar['header_uniq_class'] = substr($class, 0, -1);

		$fixar['header_phone'] = get_post_meta($post_ID, 'header_phone', 1) != '' ? get_post_meta($post_ID, 'header_phone', 1) : fixar_get_option('header_phone', '');
		$fixar['header_email'] = get_post_meta($post_ID, 'header_email', 1) != '' ? get_post_meta($post_ID, 'header_email', 1) : fixar_get_option('header_email', '');

		/// Header elements position
		$fixar['header_topbarbox_1_position'] = get_post_meta($post_ID, 'header_topbarbox_1_position', 1) != '' ? get_post_meta($post_ID, 'header_topbarbox_1_position', 1) : fixar_get_option('header_topbarbox_1_position', 'left', 0);
		$fixar['header_topbarbox_2_position'] = get_post_meta($post_ID, 'header_topbarbox_2_position', 1) != '' ? get_post_meta($post_ID, 'header_topbarbox_2_position', 1) : fixar_get_option('header_topbarbox_2_position', 'right', 0);
		$fixar['header_navibox_1_position'] = get_post_meta($post_ID, 'header_navibox_1_position', 1) != '' ? get_post_meta($post_ID, 'header_navibox_1_position', 1) : fixar_get_option('header_navibox_1_position', 'left');
		$fixar['header_navibox_2_position'] = get_post_meta($post_ID, 'header_navibox_2_position', 1) != '' ? get_post_meta($post_ID, 'header_navibox_2_position', 1) : fixar_get_option('header_navibox_2_position', 'right');
		$fixar['header_navibox_3_position'] = get_post_meta($post_ID, 'header_navibox_3_position', 1) != '' ? get_post_meta($post_ID, 'header_navibox_3_position', 1) : fixar_get_option('header_navibox_3_position', 'right');
		$fixar['header_navibox_4_position'] = get_post_meta($post_ID, 'header_navibox_4_position', 1) != '' ? get_post_meta($post_ID, 'header_navibox_4_position', 1) : fixar_get_option('header_navibox_4_position', 'right');

		/// Responsive
		$fixar['mobile_sticky'] = get_post_meta($post_ID, 'mobile_sticky', 1) != '' ? get_post_meta($post_ID, 'mobile_sticky', 1) : fixar_get_option('mobile_sticky', '');
		$fixar['mobile_topbar'] = get_post_meta($post_ID, 'mobile_topbar', 1) != '' ? get_post_meta($post_ID, 'mobile_topbar', 1) : fixar_get_option('mobile_topbar', '');
		$fixar['tablet_minicart'] = get_post_meta($post_ID, 'tablet_minicart', 1) != '' ? get_post_meta($post_ID, 'tablet_minicart', 1) : fixar_get_option('tablet_minicart', '');
		$fixar['tablet_search'] = get_post_meta($post_ID, 'tablet_search', 1) != '' ? get_post_meta($post_ID, 'tablet_search', 1) : fixar_get_option('tablet_search', '');
		$fixar['tablet_phone'] = get_post_meta($post_ID, 'tablet_phone', 1) != '' ? get_post_meta($post_ID, 'tablet_phone', 1) : fixar_get_option('tablet_phone', '');
		$fixar['tablet_socials'] = get_post_meta($post_ID, 'tablet_socials', 1) != '' ? get_post_meta($post_ID, 'tablet_socials', 1) : fixar_get_option('tablet_socials', '');


		/// Logo
		$fixar['logo'] = get_post_meta($post_ID, 'header_logo', 1) != '' ? get_post_meta($post_ID, 'header_logo', 1) : fixar_get_option('general_settings_logo', '');
		$fixar['logo_inverse'] = get_post_meta($post_ID, 'header_logo_inverse', 1) != '' ? get_post_meta($post_ID, 'header_logo_inverse', 1) : fixar_get_option('general_settings_logo_inverse', '');


		return $fixar;
	} else {

		/// Header global parameters
		$fixar['header_type'] = fixar_get_option('header_type', 'header1');
		$fixar['header_sidebar_view'] = fixar_get_option('header_sidebar_view', 'fixed');
		$fixar['header_background'] = fixar_get_option('header_background', 'trans-black');
		$fixar['header_transparent'] = fixar_get_option('header_transparent', '4');
		$fixar['header_hover_effect'] = fixar_get_option('header_hover_effect', '0');
		$fixar['header_marker'] = fixar_get_option('header_marker', 'menu-marker-arrow');
		$fixar['header_layout'] = fixar_get_option('header_layout', 'normal');
		$fixar['header_bar'] = fixar_get_option('header_bar', '0');

		$fixar['header_sticky'] = fixar_get_option('header_sticky', 'sticky');
		$fixar['mobile_sticky'] = '';

		/// Header menu settings
		$fixar['header_menu'] = '1';
		$fixar['header_menu_add'] = fixar_get_option('header_menu_add', '');
		$fixar['header_menu_add_position'] = fixar_get_option('header_menu_add_position', 'left');
		$fixar['header_menu_animation'] = fixar_get_option('header_menu_animation', 'overlay');

		/// Header widgets
		$fixar['header_minicart'] = fixar_get_option('header_minicart', '1');
		$fixar['header_search'] = fixar_get_option('header_search', '1');
		$fixar['header_socials'] = fixar_get_option('header_socials', '1');

		$class = '';
		foreach ($fixar as $key => $val) {
			if (!in_array($key, array('header_transparent', '', 'mobile_sticky', 'header_menu_animation')))
				$class .= $val . '-';
		}
		$fixar['header_uniq_class'] = substr($class, 0, -1);

		$fixar['header_phone'] = '';
		$fixar['header_email'] = '';

		/// Header elements position
		$fixar['header_topbarbox_1_position'] = 'left';
		$fixar['header_topbarbox_2_position'] = 'right';
		$fixar['header_navibox_1_position'] = 'left';
		$fixar['header_navibox_2_position'] = 'right';
		$fixar['header_navibox_3_position'] = 'right';
		$fixar['header_navibox_4_position'] = 'right';

		/// Responsive
		$fixar['mobile_sticky'] = '';
		$fixar['mobile_topbar'] = '';
		$fixar['tablet_minicart'] = '';
		$fixar['tablet_search'] = '';
		$fixar['tablet_phone'] = '';
		$fixar['tablet_socials'] = '';

		/// Logo
		$fixar['logo'] = '';
		$fixar['logo_inverse'] = '';

		return $fixar;
	}
}