<?php
/**
 * Change theme config
 *
 */
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}
if (!class_exists('G5ThemeAddons_Setup_Theme_Config')) {
	class G5ThemeAddons_Setup_Theme_Config {
		private static $_instance;
		public static function getInstance()
		{
			if (self::$_instance == NULL) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		public function init() {

			add_filter( 'g5core_header_options', array($this, 'change_change_g5core_header_options_config'), 20 );
			add_filter( 'g5core_default_options_g5core_header_options', array($this, 'change_default_options_g5core_header_options') );
			add_filter( 'g5core_default_options_g5core_color_options', array($this, 'change_default_options_g5core_color_options' ) );
			add_filter( 'g5core_default_options_g5blog_options', array($this, 'change_default_options_g5blog_options') );
			add_filter( 'g5core_default_options_g5shop_options', array($this, 'change_default_options_g5shop_options'));
			add_filter( 'g5core_default_options_g5core_typography_options', array($this, 'change_default_options_g5core_typography_options') );
			add_filter( 'g5core_default_options_g5portfolio_options', array($this, 'change_default_options_g5portfolio_options'));
		}

		public function change_change_g5core_header_options_config( $options_config ) {
			$options_config['section_color']['fields']['menu_color_group']['fields']['submenu_scheme']['preset'] = array(
				array(
					'op'     => '=',
					'value'  => 'light',
					'fields' => array(
						array( 'submenu_background_color', '#fff' ),
						array( 'submenu_heading_color', '#222' ),
						array( 'submenu_text_color', '#666' ),
						array( 'submenu_item_bg_hover_color', '#fafafa' ),
						array( 'submenu_text_hover_color', '#0073aa' ),
						array( 'submenu_border_color', '#fff' ),
					)
				),
				array(
					'op'     => '=',
					'value'  => 'dark',
					'fields' => array(
						array( 'submenu_background_color', '#1b1b1b' ),
						array( 'submenu_heading_color', '#fff' ),
						array( 'submenu_text_color', '#fff' ),
						array( 'submenu_item_bg_hover_color', '#242424' ),
						array( 'submenu_text_hover_color', '#999' ),
						array( 'submenu_border_color', '#1b1b1b' ),
					)
				),
			);

			$options_config['section_color']['fields']['navigation_scheme']['fields']['submenu_scheme']['preset'] = array(
				array(
					'op'     => '=',
					'value'  => 'light',
					'fields' => array(
						array( 'navigation_background_color', '#fff' ),
						array( 'navigation_text_color', '#1b1b1b' ),
						array( 'navigation_text_hover_color', '#999' ),
						array( 'navigation_border_color', '#eee' ),
						array( 'navigation_disable_color', '#888' ),
					)
				),
				array(
					'op'     => '=',
					'value'  => 'dark',
					'fields' => array(
						array( 'navigation_background_color', '#1b1b1b' ),
						array( 'navigation_text_color', '#fff' ),
						array( 'navigation_text_hover_color', '#999' ),
						array( 'navigation_border_color', '#343434' ),
						array( 'navigation_disable_color', '#aaa' ),
					)
				),
			);
			return $options_config;
		}

		public function change_default_options_g5core_header_options( $defaults ) {
			$defaults = wp_parse_args( array(
				'logo'                        => get_template_directory_uri() . '/assets/images/logo.png',
				'logo_font'                   => wp_parse_args(
					array(
						'font_family' => 'Poppins',
					), $defaults['logo_font'] ),
				'top_bar_font'                => wp_parse_args(
					array(
						'font_family' => 'Poppins',
					), $defaults['top_bar_font'] ),
				'menu_font'                   => wp_parse_args(
					array(
						'font_family'    => 'Poppins',
						'font_size'      => '12px',
						'font_weight'    => '600',
						'letter_spacing' => '0'
					), $defaults['menu_font'] ),
				'sub_menu_font'               => wp_parse_args(
					array(
						'font_family'    => 'Poppins',
						'font_weight'    => '600',
						'font_size'      => '12px',
						'letter_spacing' => '0'
					), $defaults['sub_menu_font'] ),

				'header_background_color'                => '#fff',
				'header_text_color'                      => '#1b1b1b',
				'header_text_hover_color'                => '#999',
				'header_border_color'                    => '#eee',
				'header_disable_color'                   => '#888',

				'header_sticky_background_color'         => '#fff',
				'header_sticky_text_color'               => '#1b1b1b',
				'header_sticky_text_hover_color'         => '#999',
				'header_sticky_border_color'             => '#eee',
				'header_sticky_disable_color'            => '#888',

				'top_bar_text_hover_color'               => '#485cc7',

				'navigation_background_color' => '#fff',
				'navigation_text_color'       => '#1b1b1b',
				'navigation_text_hover_color' => '#999',
				'navigation_border_color'     => '#eee',
				'navigation_disable_color'    => '#888',

				'submenu_scheme'              => 'dark',
				'submenu_background_color'    => '#1b1b1b',
				'submenu_heading_color'       => '#fff',
				'submenu_text_color'          => '#fff',
				'submenu_item_bg_hover_color' => '#242424',
				'submenu_text_hover_color'    => '#999',
				'submenu_border_color'        => '#1b1b1b',

				'header_mobile_top_bar_background_color' => '#f6f6f6',
				'header_mobile_top_bar_text_color'       => '#1b1b1b',
				'header_mobile_top_bar_text_hover_color' => '#485cc7',
				'header_mobile_top_bar_border_color'     => '#eee',

				'header_mobile_background_color'         => '#fff',
				'header_mobile_text_color'               => '#1b1b1b',
				'header_mobile_text_hover_color'         => '#222',
				'header_mobile_border_color'             => '#eee',

				'header_mobile_sticky_background_color'  => '#fff',
				'header_mobile_sticky_text_color'        => '#1b1b1b',
				'header_mobile_sticky_text_hover_color'  => '#999',
				'header_mobile_sticky_border_color'      => '#eee',

			), $defaults );


			return $defaults;
		}

		public function change_default_options_g5core_color_options( $defaults ) {
			return wp_parse_args( array(
				'site_text_color'         => '#999',
				'accent_color'            => '#485cc7',
				'link_color'              => '#0073aa',
				'border_color'            => '#ececec',
				'heading_color'           => '#1b1b1b',
				'caption_color'           => '#ababab',
				'placeholder_color'       => '#b6b6b6',
				'primary_color'           => '#d64c35',
				'secondary_color'         => '#35b0d6',
				'dark_color'              => '#1b1b1b',
				'light_color'             => '#fafafa',
				'gray_color'              => '#aaaaaa',
			), $defaults );
		}

		public function change_default_options_g5blog_options( $defaults ) {
			return wp_parse_args( array(
				'post_columns_gutter' => '20',
				'single_post_layout' => 'layout-2',
				'single_post_related_columns_gutter' => '20',
				'single_post_related_columns_xl'     => 2,
				'single_post_related_columns_lg'     => 2,




			), $defaults );
		}

		public function change_default_options_g5shop_options($defaults) {
			return wp_parse_args( array(
				'post_columns_gutter' => '20',
				'post_columns_xl' => 2,
				'post_columns_lg' =>  2,
				'single_product_tab' => 'layout-2',
				'product_related_columns_gutter' => '20',
				'product_related_columns_xl' => 3,
				'product_up_sells_columns_gutter' => '20',
				'product_up_sells_columns_xl' => 3,
				'product_cross_sells_columns_gutter' => '20',
				'product_cross_sells_columns_xl' => 2,
				'product_cross_sells_columns_lg' => 2,

			), $defaults );
		}

		public function change_default_options_g5core_typography_options( $defaults ) {
			$defaults['body_font']['font_family'] = 'Arimo';
			$defaults['body_font']['font_size']   = '14px';

			$defaults['primary_font']['font_family'] = 'Poppins';

			$defaults['h1_font']['font_family'] = 'Poppins';
			$defaults['h1_font']['font_size']   = '38px';

			$defaults['h2_font']['font_family'] = 'Poppins';
			$defaults['h2_font']['font_size']   = '30px';

			$defaults['h3_font']['font_family'] = 'Poppins';
			$defaults['h3_font']['font_weight'] = '600';
			$defaults['h3_font']['font_size']   = '20px';

			$defaults['h4_font']['font_family'] = 'Poppins';
			$defaults['h4_font']['font_weight'] = '600';
			$defaults['h4_font']['font_size']   = '16px';

			$defaults['h5_font']['font_family'] = 'Poppins';
			$defaults['h5_font']['font_weight'] = '600';
			$defaults['h5_font']['font_size']   = '14px';

			$defaults['h6_font']['font_family'] = 'Poppins';
			$defaults['h6_font']['font_weight'] = '600';
			$defaults['h6_font']['font_size']   = '12px';

			$defaults['display_1']['font_family'] = 'Poppins';
			$defaults['display_2']['font_family'] = 'Poppins';
			$defaults['display_3']['font_family'] = 'Poppins';
			$defaults['display_4']['font_family'] = 'Poppins';

			return $defaults;
		}

		public function change_default_options_g5portfolio_options($defaults) {
			return wp_parse_args( array(
				'post_image_size' => '300x355',
				'post_columns_gutter' => '20',
				'category_filter_enable' => 'on',
				'single_gallery_image_size' => '940x550'
			), $defaults );
		}
	}
}