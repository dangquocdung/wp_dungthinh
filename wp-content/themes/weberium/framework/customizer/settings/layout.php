<?php
/**
 * Layout setting for Customizer
 *
 * @package weberium
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Layout Style
$this->sections['weberium_layout_style'] = array(
	'title' => esc_html__( 'Layout Site', 'weberium' ),
	'panel' => 'weberium_layout',
	'settings' => array(
		array(
			'id' => 'site_layout_style',
			'default' => 'full-width',
			'control' => array(
				'label' => esc_html__( 'Layout Style', 'weberium' ),
				'type' => 'select',
				'choices' => array(
					'full-width' => esc_html__( 'Full Width','weberium' ),
					'boxed' => esc_html__( 'Boxed','weberium' )
				),
			),
		),
		array(
			'id' => 'site_layout_boxed_shadow',
			'control' => array(
				'label' => esc_html__( 'Box Shadow', 'weberium' ),
				'type' => 'checkbox',
				'active_callback' => 'weberium_cac_has_boxed_layout',
			),
		),
		array(
			'id' => 'site_layout_wrapper_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Wrapper Margin', 'weberium' ),
				'desc' => esc_html__( 'Top Right Bottom Left. Default: 30px 0px 30px 0px.', 'weberium' ),
				'active_callback' => 'weberium_cac_has_boxed_layout',
			),
			'inline_css' => array(
				'target' => '.site-layout-boxed #wrapper',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'wrapper_background_color',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Outer Background Color', 'weberium' ),
				'type' => 'color',
				'active_callback' => 'weberium_cac_has_boxed_layout',
			),
			'inline_css' => array(
				'target' => '.site-layout-boxed #wrapper',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'wrapper_background_img',
			'control' => array(
				'label' => esc_html__( 'Outer Background Image', 'weberium' ),
				'type' => 'image',
				'active_callback' => 'weberium_cac_has_boxed_layout',
			),
		),
		array(
			'id' => 'wrapper_background_img_style',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Outer Background Image Style', 'weberium' ),
				'type'  => 'image',
				'type'  => 'select',
				'choices' => array(
					''             => esc_html__( 'Default', 'weberium' ),
					'cover'        => esc_html__( 'Cover', 'weberium' ),
					'center-top'        => esc_html__( 'Center Top', 'weberium' ),
					'fixed-top'    => esc_html__( 'Fixed Top', 'weberium' ),
					'fixed'        => esc_html__( 'Fixed Center', 'weberium' ),
					'fixed-bottom' => esc_html__( 'Fixed Bottom', 'weberium' ),
					'repeat'       => esc_html__( 'Repeat', 'weberium' ),
					'repeat-x'     => esc_html__( 'Repeat-x', 'weberium' ),
					'repeat-y'     => esc_html__( 'Repeat-y', 'weberium' ),
				),
				'active_callback' => 'weberium_cac_has_boxed_layout',
			),
		),
	),
);

// Layout Position
$this->sections['weberium_layout_position'] = array(
	'title' => esc_html__( 'Layout Position', 'weberium' ),
	'panel' => 'weberium_layout',
	'settings' => array(
		array(
			'id' => 'site_layout_position',
			'default' => 'sidebar-right',
			'control' => array(
				'label' => esc_html__( 'Site Layout Position', 'weberium' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'weberium' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'weberium' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'weberium' ),
				),
				'desc' => esc_html__( 'Specify layout for all pages on website. (e.g. pages, blog posts, single post, archives, etc ). Single page can override this setting in Page Settings metabox when edit.', 'weberium' )
			),
		),
		array(
			'id' => 'single_post_layout_position',
			'default' => 'sidebar-right',
			'control' => array(
				'label' => esc_html__( 'Single Post Layout Position', 'weberium' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'weberium' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'weberium' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'weberium' ),
				),
				'desc' => esc_html__( 'Specify layout for all single post pages.', 'weberium' )
			),
		),
	),
);

// Layout Widths
$this->sections['weberium_layout_widths'] = array(
	'title' => esc_html__( 'Layout Widths', 'weberium' ),
	'panel' => 'weberium_layout',
	'settings' => array(
		array(
			'id' => 'site_desktop_container_width',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Container', 'weberium' ),
				'type' => 'text',
				'desc' => esc_html__( 'Default: 1180px', 'weberium' ),
			),
			'inline_css' => array(
				'target' => array( 
					'.site-layout-full-width .weberium-container',
					'.site-layout-boxed #page'
				),
				'alter' => 'width',
			),
		),
		array(
			'id' => 'left_container_width',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Content', 'weberium' ),
				'type' => 'text',
				'desc' => esc_html__( 'Example: 66%', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#site-content',
				'alter' => 'width',
			),
		),
		array(
			'id' => 'sidebar_width',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Sidebar', 'weberium' ),
				'type' => 'text',
				'desc' => esc_html__( 'Example: 23%', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#sidebar',
				'alter' => 'width',
			),
		),
	),
);