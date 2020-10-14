<?php
/**
 * General setting for Customizer
 *
 * @package weberium
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Accent Colors
$this->sections['weberium_accent_colors'] = array(
	'title' => esc_html__( 'Accent Colors', 'weberium' ),
	'panel' => 'weberium_general',
	'settings' => array(
		array(
			'id' => 'accent_color',
			'default' => '#f54e24',
			'control' => array(
				'label' => esc_html__( 'Accent Color', 'weberium' ),
				'type' => 'color',
			),
		),
		array(
			'id' => 'second_color',
			'default' => '#b9e9e9',
			'control' => array(
				'label' => esc_html__( 'Second Color', 'weberium' ),
				'type' => 'color',
			),
		),
	)
);

// Favicon
$this->sections['weberium_favicon'] = array(
	'title' => esc_html__( 'Favicon', 'weberium' ),
	'panel' => 'weberium_general',
	'settings' => array(
		array(
			'id' => 'favicon',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Site Icon', 'weberium' ),
				'type' => 'image',
				'description' => esc_html__( 'The Site Icon is used as a browser and app icon for your site. Icons must be square, and at least 512 pixels wide and tall.', 'weberium' ),
			),
		),
	)
);

// PreLoader
$this->sections['weberium_preloader'] = array(
	'title' => esc_html__( 'PreLoader', 'weberium' ),
	'panel' => 'weberium_general',
	'settings' => array(
		array(
			'id' => 'preloader',
			'default' => 'animsition',
			'control' => array(
				'label' => esc_html__( 'Preloader Option', 'weberium' ),
				'type' => 'select',
				'choices' => array(
					'animsition' => esc_html__( 'Enable','weberium' ),
					'' => esc_html__( 'Disable','weberium' )
				),
			),
		),
	)
);

// Top Bar Site
$this->sections['weberium_topbar_site'] = array(
	'title' => esc_html__( 'Top Bar Site', 'weberium' ),
	'panel' => 'weberium_general',
	'settings' => array(
		array(
			'id' => 'top_bar_site_style',
			'default' => 'style-4',
			'control' => array(
				'label' => esc_html__( 'Top Bar Style', 'weberium' ),
				'type' => 'select',
				'choices' => array(
					'style-1' => esc_html__( 'Top-Bar Dark', 'weberium' ),
					'style-2' => esc_html__( 'Top-Bar Grey', 'weberium' ),
					'style-3' => esc_html__( 'Top-Bar Accent', 'weberium' ),
					'style-4' => esc_html__( 'Hide Top-Bar', 'weberium' )
				),
				'desc' => esc_html__( 'Top Bar Style for all pages on website. (e.g. pages, blog posts, single post, archives, etc ). Single page can override this setting in Page Settings metabox when edit.', 'weberium' )
			),
		),
	),
);

// Header Site
$this->sections['weberium_header_site'] = array(
	'title' => esc_html__( 'Header Site', 'weberium' ),
	'panel' => 'weberium_general',
	'settings' => array(
		array(
			'id' => 'header_site_style',
			'default' => 'style-1',
			'control' => array(
				'label' => esc_html__( 'Header Style', 'weberium' ),
				'type' => 'select',
				'choices' => array(
					'style-1' => esc_html__( 'Header White', 'weberium' ),
					'style-2' => esc_html__( 'Header Dark', 'weberium' ),
					'style-3' => esc_html__( 'Header Accent', 'weberium' ),
					'style-4' => esc_html__( 'Header Transparent', 'weberium' ),
					'style-5' => esc_html__( 'Header Aside', 'weberium' )
				),
				'desc' => esc_html__( 'Header Style for all pages on website. (e.g. pages, blog posts, single post, archives, etc ). Single page can override this setting in Page Settings metabox when edit.', 'weberium' )
			),
		),
		array(
			'id' => 'header_fixed',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Header Fixed: Enable', 'weberium' ),
				'type' => 'checkbox',
			),
		),
	),
);

// Scroll to top
$this->sections['weberium_scroll_top'] = array(
	'title' => esc_html__( 'Scroll Top Button', 'weberium' ),
	'panel' => 'weberium_general',
	'settings' => array(
		array(
			'id' => 'scroll_top',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'weberium' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'scroll_top_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Width', 'weberium' ),
				'active_callback' => 'weberium_cac_has_scroll_top',
				'description' => esc_html__( 'Example: 30px.', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#scroll-top',
				'alter' => 'width',
			),
		),
		array(
			'id' => 'scroll_top_height',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Height', 'weberium' ),
				'active_callback' => 'weberium_cac_has_scroll_top',
				'description' => esc_html__( 'Example: 30px.', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#scroll-top',
				'alter' => array(
					'height',
					'line-height',
				),
			),
		),
		array(
			'id' => 'scroll_top_icon_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Icon Color', 'weberium' ),
				'active_callback' => 'weberium_cac_has_scroll_top',
			),
			'inline_css' => array(
				'target' => '#scroll-top:after',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'scroll_top_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background Color', 'weberium' ),
				'active_callback' => 'weberium_cac_has_scroll_top',
			),
			'inline_css' => array(
				'target' => '#scroll-top:before',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'scroll_top_rounded',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Rounded', 'weberium' ),
				'active_callback' => 'weberium_cac_has_scroll_top',
				'description' => esc_html__( 'Example: 50%. 0px is square.', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#scroll-top:before',
				'alter' => 'border-radius',
			),
		),
		array(
			'id' => 'scroll_top_icon_size',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Icon Size', 'weberium' ),
				'active_callback' => 'weberium_cac_has_scroll_top',
				'description' => esc_html__( 'Example: 16px.', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#scroll-top:after',
				'alter' => 'font-size',
			),
		),
		array(
			'id' => 'scroll_top_background_hover_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background Color: Hover', 'weberium' ),
				'active_callback' => 'weberium_cac_has_scroll_top',
			),
			'inline_css' => array(
				'target' => '#scroll-top:hover:before',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'scroll_top_icon_hover_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Icon Color: Hover', 'weberium' ),
				'active_callback' => 'weberium_cac_has_scroll_top',
			),
			'inline_css' => array(
				'target' => '#scroll-top:hover:after',
				'alter' => 'color',
			),
		),
	),
);

// Forms
$this->sections['weberium_general_forms'] = array(
	'title' => esc_html__( 'Forms', 'weberium' ),
	'panel' => 'weberium_general',
	'settings' => array(
		array(
			'id' => 'input_border_rounded',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Border Rounded', 'weberium' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'border-radius',
			),
		),
		array(
			'id' => 'input_background_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'weberium' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'input_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Border Color', 'weberium' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'border-color',
			),
		),
		array(
			'id' => 'input_border_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Border Width', 'weberium' ),
				'description' => esc_html__( 'Enter a value in pixels. Example: 20px.', 'weberium' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'border-width',
			),
		),
		array(
			'id' => 'input_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'weberium' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'color',
			),
		),
	),
);

// Responsive
$this->sections['weberium_responsive'] = array(
	'title' => esc_html__( 'Responsive', 'weberium' ),
	'panel' => 'weberium_general',
	'settings' => array(
		// Mobile Button
		array(
			'id' => 'heading_mobile_button',
			'control' => array(
				'type' => 'weberium-heading',
				'label' => esc_html__( 'Mobile Button', 'weberium' ),
			),
		),
		array(
			'id' => 'mobile_button_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Mobile Button Color', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '.mobile-button:before, .mobile-button:after, .mobile-button span',
				'alter' => 'background-color'
			),
		),
		// Mobile Logo
		array(
			'id' => 'heading_mobile_logo',
			'control' => array(
				'type' => 'weberium-heading',
				'label' => esc_html__( 'Mobile Logo', 'weberium' ),
			),
		),
		array(
			'id' => 'mobile_logo_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Mobile Logo: Width', 'weberium' ),
				'description' => esc_html__( 'Default: 200px.', 'weberium' ),
			),
			'inline_css' => array(
				'media_query' => '(max-width: 991px)',
				'target' => '#site-logo',
				'alter' => 'max-width',
			),
		),
		array(
			'id' => 'mobile_logo_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Mobile Logo: Margin', 'weberium' ),
				'description' => esc_html__( 'Example: 10px 0px 10px 0px.', 'weberium' ),
			),
			'inline_css' => array(
				'media_query' => '(max-width: 991px)',
				'target' => '#site-logo-inner',
				'alter' => 'margin',
			),
		),
		// Mobile Menu
		array(
			'id' => 'heading_mobile_menu',
			'control' => array(
				'type' => 'weberium-heading',
				'label' => esc_html__( 'Mobile Menu', 'weberium' ),
			),
		),
		array(
			'id' => 'mobile_menu_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#main-nav-mobi ul > li > a',
				'alter' => 'color'
			),
		),
		array(
			'id' => 'mobile_menu_item_height',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Item Height', 'weberium' ),
				'description' => esc_html__( 'Example: 40px.', 'weberium' ),
			),
			'inline_css' => array(
				'target' => array(
					'#main-nav-mobi ul > li > a',
					'#main-nav-mobi .menu-item-has-children .arrow'
				),
				'alter' => 'line-height'
			),
		),
		array(
			'id' => 'mobile_menu_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Item Background', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#main-nav-mobi ul li',
				'alter' => 'background-color'
			),
		),
		array(
			'id' => 'mobile_menu_border',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Item Border', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#main-nav-mobi ul li',
				'alter' => 'border-color'
			),
		),
	)
);