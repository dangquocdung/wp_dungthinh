<?php
/**
 * General setting for Customizer
 *
 * @package gustablo
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Accent Colors
$this->sections['wprt_accent_colors'] = array(
	'title' => esc_html__( 'Accent Colors', 'gustablo' ),
	'panel' => 'wprt_general',
	'settings' => array(
		array(
			'id' => 'accent_color',
			'default' => '#fd4100',
			'control' => array(
				'label' => esc_html__( 'Accent Color', 'gustablo' ),
				'type' => 'color',
			),
		),
	)
);

// Favicon
$this->sections['wprt_favicon'] = array(
	'title' => esc_html__( 'Favicon', 'gustablo' ),
	'panel' => 'wprt_general',
	'settings' => array(
		array(
			'id' => 'favicon',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Site Icon', 'gustablo' ),
				'type' => 'image',
				'description' => esc_html__( 'The Site Icon is used as a browser and app icon for your site. Icons must be square, and at least 512 pixels wide and tall.', 'gustablo' ),
			),
		),
	)
);

// PreLoader
$this->sections['wprt_preloader'] = array(
	'title' => esc_html__( 'PreLoader', 'gustablo' ),
	'panel' => 'wprt_general',
	'settings' => array(
		array(
			'id' => 'preloader',
			'default' => 'animsition',
			'control' => array(
				'label' => esc_html__( 'Preloader Option', 'gustablo' ),
				'type' => 'select',
				'choices' => array(
					'animsition' => esc_html__( 'Enable','gustablo' ),
					'' => esc_html__( 'Disable','gustablo' )
				),
			),
		),
	)
);

// Top Bar Site
$this->sections['wprt_topbar_site'] = array(
	'title' => esc_html__( 'Top Bar Site', 'gustablo' ),
	'panel' => 'wprt_general',
	'settings' => array(
		array(
			'id' => 'top_bar_site_style',
			'default' => 'style-4',
			'control' => array(
				'label' => esc_html__( 'Top Bar Style', 'gustablo' ),
				'type' => 'select',
				'choices' => array(
					'style-1' => esc_html__( 'Top-Bar Dark', 'gustablo' ),
					'style-2' => esc_html__( 'Top-Bar Grey', 'gustablo' ),
					'style-3' => esc_html__( 'Top-Bar Accent', 'gustablo' ),
					'style-4' => esc_html__( 'Hide Top-Bar', 'gustablo' )
				),
				'desc' => esc_html__( 'Top Bar Style for all pages on website. (e.g. pages, blog posts, single post, archives, etc ). Single page can override this setting in Page Settings metabox when edit.', 'gustablo' )
			),
		),
	),
);

// Header Site
$this->sections['wprt_header_site'] = array(
	'title' => esc_html__( 'Header Site', 'gustablo' ),
	'panel' => 'wprt_general',
	'settings' => array(
		array(
			'id' => 'header_site_style',
			'default' => 'style-4',
			'control' => array(
				'label' => esc_html__( 'Header Style', 'gustablo' ),
				'type' => 'select',
				'choices' => array(
					'style-1' => esc_html__( 'Header White', 'gustablo' ),
					'style-2' => esc_html__( 'Header Dark', 'gustablo' ),
					'style-3' => esc_html__( 'Header Accent', 'gustablo' ),
					'style-4' => esc_html__( 'Header Transparent', 'gustablo' ),
					'style-5' => esc_html__( 'Header Aside', 'gustablo' )
				),
				'desc' => esc_html__( 'Header Style for all pages on website. (e.g. pages, blog posts, single post, archives, etc ). Single page can override this setting in Page Settings metabox when edit.', 'gustablo' )
			),
		),
		array(
			'id' => 'header_fixed',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Header Fixed: Enable', 'gustablo' ),
				'type' => 'checkbox',
			),
		),
	),
);

// Scroll to top
$this->sections['wprt_scroll_top'] = array(
	'title' => esc_html__( 'Scroll Top Button', 'gustablo' ),
	'panel' => 'wprt_general',
	'settings' => array(
		array(
			'id' => 'scroll_top',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'gustablo' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'scroll_top_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Width', 'gustablo' ),
				'active_callback' => 'wprt_cac_has_scroll_top',
				'description' => esc_html__( 'Example: 30px.', 'gustablo' ),
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
				'label' => esc_html__( 'Height', 'gustablo' ),
				'active_callback' => 'wprt_cac_has_scroll_top',
				'description' => esc_html__( 'Example: 30px.', 'gustablo' ),
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
				'label' => esc_html__( 'Icon Color', 'gustablo' ),
				'active_callback' => 'wprt_cac_has_scroll_top',
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
				'label' => esc_html__( 'Background Color', 'gustablo' ),
				'active_callback' => 'wprt_cac_has_scroll_top',
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
				'label' => esc_html__( 'Rounded', 'gustablo' ),
				'active_callback' => 'wprt_cac_has_scroll_top',
				'description' => esc_html__( 'Example: 50%. 0px is square.', 'gustablo' ),
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
				'label' => esc_html__( 'Icon Size', 'gustablo' ),
				'active_callback' => 'wprt_cac_has_scroll_top',
				'description' => esc_html__( 'Example: 16px.', 'gustablo' ),
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
				'label' => esc_html__( 'Background Color: Hover', 'gustablo' ),
				'active_callback' => 'wprt_cac_has_scroll_top',
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
				'label' => esc_html__( 'Icon Color: Hover', 'gustablo' ),
				'active_callback' => 'wprt_cac_has_scroll_top',
			),
			'inline_css' => array(
				'target' => '#scroll-top:hover:after',
				'alter' => 'color',
			),
		),
	),
);

// Forms
$this->sections['wprt_general_forms'] = array(
	'title' => esc_html__( 'Forms', 'gustablo' ),
	'panel' => 'wprt_general',
	'settings' => array(
		array(
			'id' => 'input_border_rounded',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Border Rounded', 'gustablo' ),
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
				'label' => esc_html__( 'Background', 'gustablo' ),
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
				'label' => esc_html__( 'Border Color', 'gustablo' ),
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
				'label' => esc_html__( 'Border Width', 'gustablo' ),
				'description' => esc_html__( 'Enter a value in pixels. Example: 20px.', 'gustablo' ),
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
				'label' => esc_html__( 'Color', 'gustablo' ),
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
$this->sections['wprt_responsive'] = array(
	'title' => esc_html__( 'Responsive', 'gustablo' ),
	'panel' => 'wprt_general',
	'settings' => array(
		// Mobile Button
		array(
			'id' => 'heading_mobile_button',
			'control' => array(
				'type' => 'wprt-heading',
				'label' => esc_html__( 'Mobile Button', 'gustablo' ),
			),
		),
		array(
			'id' => 'mobile_button_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Mobile Button Color', 'gustablo' ),
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
				'type' => 'wprt-heading',
				'label' => esc_html__( 'Mobile Logo', 'gustablo' ),
			),
		),
		array(
			'id' => 'mobile_logo_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Mobile Logo: Width', 'gustablo' ),
				'description' => esc_html__( 'Default: 200px.', 'gustablo' ),
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
				'label' => esc_html__( 'Mobile Logo: Margin', 'gustablo' ),
				'description' => esc_html__( 'Example: 10px 0px 10px 0px.', 'gustablo' ),
			),
			'inline_css' => array(
				'media_query' => '(max-width: 991px)',
				'target' => '.header-style-1 #site-logo-inner',
				'alter' => 'margin',
			),
		),
		// Mobile Menu
		array(
			'id' => 'heading_mobile_menu',
			'control' => array(
				'type' => 'wprt-heading',
				'label' => esc_html__( 'Mobile Menu', 'gustablo' ),
			),
		),
		array(
			'id' => 'mobile_menu_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'gustablo' ),
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
				'label' => esc_html__( 'Item Height', 'gustablo' ),
				'description' => esc_html__( 'Example: 40px.', 'gustablo' ),
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
				'label' => esc_html__( 'Item Background', 'gustablo' ),
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
				'label' => esc_html__( 'Item Border', 'gustablo' ),
			),
			'inline_css' => array(
				'target' => '#main-nav-mobi ul li',
				'alter' => 'border-color'
			),
		),
	)
);