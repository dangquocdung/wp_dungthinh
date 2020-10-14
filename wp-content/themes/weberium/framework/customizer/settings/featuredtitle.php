<?php
/**
 * Featured Title setting for Customizer
 *
 * @package weberium
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Featured Title General
$this->sections['weberium_featuredtitle_general'] = array(
	'title' => esc_html__( 'General', 'weberium' ),
	'panel' => 'weberium_featuredtitle',
	'settings' => array(
		array(
			'id' => 'featured_title',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'weberium' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'featured_title_style',
			'default' => 'heading_breadcrumbs',
			'control' => array(
				'label'  => esc_html__( 'Style', 'weberium' ),
				'type' => 'select',
				'choices' => array(
					'heading_breadcrumbs' => esc_html__( 'Heading & Breadcrumbs', 'weberium' ),
					'breadcrumbs_heading' => esc_html__( 'Breadcrumbs & Heading', 'weberium' ),
					'heading_breadcrumbs_centered' => esc_html__( 'Centered Heading & Breadcrumbs', 'weberium' ),
					'breadcrumbs_heading_centered' => esc_html__( 'Centered Breadcrumbs & Heading', 'weberium' ),
				),
				'active_callback' => 'weberium_cac_has_featured_title',
			),
		),
		array(
			'id' => 'featured_title_top_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Top Padding', 'weberium' ),
				'description' => esc_html__( 'Example: 30px', 'weberium' ),
				'active_callback' => 'weberium_cac_has_featured_title',
			),
			'inline_css' => array(
				'target' => array(
					'#featured-title .featured-title-inner-wrap',
					'.header-style-3 #featured-title .featured-title-inner-wrap',
					'.header-style-4 #featured-title .featured-title-inner-wrap'
				),
				'alter' => 'padding-top',
			),
		),
		array(
			'id' => 'featured_title_bottom_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Bottom Padding', 'weberium' ),
				'description' => esc_html__( 'Example: 30px', 'weberium' ),
				'active_callback' => 'weberium_cac_has_featured_title',
			),
			'inline_css' => array(
				'target' => array(
					'#featured-title .featured-title-inner-wrap',
					'.header-style-3 #featured-title .featured-title-inner-wrap',
					'.header-style-4 #featured-title .featured-title-inner-wrap'
				),
				'alter' => 'padding-bottom',
			),
		),
		array(
			'id' => 'featured_title_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'weberium' ),
				'active_callback' => 'weberium_cac_has_featured_title',
			),
			'inline_css' => array(
				'target' => '#featured-title',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'featured_title_border_width',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Border Width', 'weberium' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 1px 0px 1px 0px', 'weberium' ),
				'active_callback' => 'weberium_cac_has_featured_title',
			),
			'inline_css' => array(
				'target' => '#featured-title',
				'alter' => 'border-width',
			),
		),
		array(
			'id' => 'featured_title_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Border Color', 'weberium' ),
				'active_callback' => 'weberium_cac_has_featured_title',
			),
			'inline_css' => array(
				'target' => '#featured-title',
				'alter' => 'border-color',
			),
		),
		array(
			'id' => 'featured_title_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Background Image', 'weberium' ),
				'active_callback' => 'weberium_cac_has_featured_title',
			),
		),
		array(
			'id' => 'featured_title_background_img_style',
			'default' => 'repeat',
			'control' => array(
				'label' => esc_html__( 'Background Image Style', 'weberium' ),
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
				'active_callback' => 'weberium_cac_has_featured_title',
			),
		),
	),
);

// Featured Title Heading
$this->sections['weberium_featuredtitle_heading'] = array(
	'title' => esc_html__( 'Heading', 'weberium' ),
	'panel' => 'weberium_featuredtitle',
	'settings' => array(
		array(
			'id' => 'featured_title_heading',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'weberium' ),
				'type' => 'checkbox',
				'active_callback' => 'weberium_cac_has_featured_title',
			),
		),
		array(
			'id' => 'featured_title_heading_shadow',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Text Shadow', 'weberium' ),
				'type' => 'checkbox',
				'active_callback' => 'weberium_cac_has_featured_title_heading',
				'description' => esc_html__( 'Make text over image more readable.', 'weberium' ),
			),
		),
		array(
			'id' => 'featured_title_heading_top_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Heading Top Margin', 'weberium' ),
				'active_callback' => 'weberium_cac_has_featured_title_heading_center2',
				'description' => esc_html__( 'Example: 5px.', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#featured-title.featured-title-centered2 .featured-title-heading-wrap',
				'alter' => 'margin-top',
			),
		),
		array(
			'id' => 'featured_title_heading_bottom_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Heading Bottom Margin', 'weberium' ),
				'active_callback' => 'weberium_cac_has_featured_title_heading_center1',
				'description' => esc_html__( 'Example: 5px.', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#featured-title.featured-title-centered1 .featured-title-heading-wrap',
				'alter' => 'margin-bottom',
			),
		),
		array(
			'id' => 'featured_title_heading_padding',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'weberium' ),
				'active_callback' => 'weberium_cac_has_featured_title_heading',
				'description' => esc_html__( 'Top Right Bottom Left. Example: 5px 20px', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#featured-title .featured-title-heading',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'featured_title_heading_rounded',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Rounded', 'weberium' ),
				'active_callback' => 'weberium_cac_has_featured_title_heading',
				'description' => esc_html__( 'Example: 3px. 0px is square.', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#featured-title .featured-title-heading:after',
				'alter' => 'border-radius',
			),
		),
		array(
			'id' => 'featured_title_heading_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background Color', 'weberium' ),
				'active_callback' => 'weberium_cac_has_featured_title_heading',
			),
			'inline_css' => array(
				'target' => '#featured-title .featured-title-heading:after',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'featured_title_heading_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'weberium' ),
				'active_callback' => 'weberium_cac_has_featured_title_heading',
			),
			'inline_css' => array(
				'target' => '#featured-title .featured-title-heading',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'featured_title_heading_background_opacity',
			'transport' => 'postMessage',
			'default' => '1',
			'control' => array(
				'label'  => esc_html__( 'Background Color Opacity', 'weberium' ),
				'active_callback' => 'weberium_cac_has_featured_title_heading',
				'type' => 'select',
				'choices' => array(
					'1' => esc_html__( '1', 'weberium' ),
					'0.9' => esc_html__( '0.9', 'weberium' ),
					'0.8' => esc_html__( '0.8', 'weberium' ),
					'0.7' => esc_html__( '0.7', 'weberium' ),
					'0.6' => esc_html__( '0.6', 'weberium' ),
					'0.5' => esc_html__( '0.5', 'weberium' ),
					'0.4' => esc_html__( '0.4', 'weberium' ),
					'0.3' => esc_html__( '0.3', 'weberium' ),
					'0.2' => esc_html__( '0.2', 'weberium' ),
					'0.1' => esc_html__( '0.1', 'weberium' ),
				),
			),
			'inline_css' => array(
				'target' => '#featured-title .featured-title-heading:after',
				'alter' => 'opacity',
			),
		),
		array(
			'id' => 'featured_title_heading_border_width',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Border Width', 'weberium' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0px 2px 2px 0px', 'weberium' ),
				'active_callback' => 'weberium_cac_has_featured_title_heading',
			),
			'inline_css' => array(
				'target' => '#featured-title .featured-title-heading:after',
				'alter' => 'border-width',
			),
		),
		array(
			'id' => 'featured_title_heading_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Border Color', 'weberium' ),
				'active_callback' => 'weberium_cac_has_featured_title_heading',
			),
			'inline_css' => array(
				'target' => '#featured-title .featured-title-heading:after',
				'alter' => 'border-color',
			),
		),
	),
);

// Featured Title Breadcrumbs
$this->sections['weberium_featuredtitle_breadcrumbs'] = array(
	'title' => esc_html__( 'Breadcrumbs', 'weberium' ),
	'panel' => 'weberium_featuredtitle',
	'settings' => array(
		array(
			'id' => 'featured_title_breadcrumbs',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'weberium' ),
				'type' => 'checkbox',
				'active_callback' => 'weberium_cac_has_featured_title',
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_bottom_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Breadcrumbs Bottom Margin', 'weberium' ),
				'active_callback' => 'weberium_cac_has_featured_title_bcrums_center2',
				'description' => esc_html__( 'Example: 5px.', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#featured-title.featured-title-centered2 #breadcrumbs',
				'alter' => 'margin-bottom',
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_padding',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'weberium' ),
				'active_callback' => 'weberium_cac_has_featured_title_breadcrumbs',
				'description' => esc_html__( 'Top Right Bottom Left. Example: 5px 20px', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#featured-title #breadcrumbs .breadcrumbs-inner',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_rounded',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Rounded', 'weberium' ),
				'active_callback' => 'weberium_cac_has_featured_title_breadcrumbs',
				'description' => esc_html__( 'Example 3px. 0px is square.', 'weberium' ),
			),
			'inline_css' => array(
				'target' => array(
					'#featured-title #breadcrumbs .breadcrumbs-inner:after'
				),
				'alter' => 'border-radius',
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background Color', 'weberium' ),
				'active_callback' => 'weberium_cac_has_featured_title_breadcrumbs',
			),
			'inline_css' => array(
				'target' => '#featured-title #breadcrumbs .breadcrumbs-inner:after',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'weberium' ),
				'active_callback' => 'weberium_cac_has_featured_title_breadcrumbs',
			),
			'inline_css' => array(
				'target' => array(
					'#featured-title #breadcrumbs .breadcrumbs-inner',
					'#featured-title #breadcrumbs .breadcrumbs-inner .sep'
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_background_opacity',
			'transport' => 'postMessage',
			'default' => '1',
			'control' => array(
				'label'  => esc_html__( 'Background Color Opacity', 'weberium' ),
				'active_callback' => 'weberium_cac_has_featured_title_breadcrumbs',
				'type' => 'select',
				'choices' => array(
					'1' => esc_html__( '1', 'weberium' ),
					'0.9' => esc_html__( '0.9', 'weberium' ),
					'0.8' => esc_html__( '0.8', 'weberium' ),
					'0.7' => esc_html__( '0.7', 'weberium' ),
					'0.6' => esc_html__( '0.6', 'weberium' ),
					'0.5' => esc_html__( '0.5', 'weberium' ),
					'0.4' => esc_html__( '0.4', 'weberium' ),
					'0.3' => esc_html__( '0.3', 'weberium' ),
					'0.2' => esc_html__( '0.2', 'weberium' ),
					'0.1' => esc_html__( '0.1', 'weberium' ),
				),
			),
			'inline_css' => array(
				'target' => '#featured-title #breadcrumbs .breadcrumbs-inner:after',
				'alter' => 'opacity',
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_border_width',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Border Width', 'weberium' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0px 2px 2px 0px', 'weberium' ),
				'active_callback' => 'weberium_cac_has_featured_title_breadcrumbs',
			),
			'inline_css' => array(
				'target' => '#featured-title #breadcrumbs .breadcrumbs-inner:after',
				'alter' => 'border-width',
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Border Color', 'weberium' ),
				'active_callback' => 'weberium_cac_has_featured_title_breadcrumbs',
			),
			'inline_css' => array(
				'target' => '#featured-title #breadcrumbs .breadcrumbs-inner:after',
				'alter' => 'border-color',
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'weberium' ),
				'active_callback' => 'weberium_cac_has_featured_title_breadcrumbs',
			),
			'inline_css' => array(
				'target' => '#featured-title #breadcrumbs .breadcrumbs-inner a',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_link_hover_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color: Hover', 'weberium' ),
				'active_callback' => 'weberium_cac_has_featured_title_breadcrumbs',
			),
			'inline_css' => array(
				'target' => '#featured-title #breadcrumbs .breadcrumbs-inner a:hover',
				'alter' => 'color',
			),
		),
	),
);