<?php
/**
 * Featured Title setting for Customizer
 *
 * @package gustablo
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Featured Title General
$this->sections['wprt_featuredtitle_general'] = array(
	'title' => esc_html__( 'General', 'gustablo' ),
	'panel' => 'wprt_featuredtitle',
	'settings' => array(
		array(
			'id' => 'featured_title_top_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Top Padding', 'gustablo' ),
				'description' => esc_html__( 'Example: 30px', 'gustablo' ),
			),
			'inline_css' => array(
				'target' => array(
					'#featured-title .featured-title-inner-wrap'
				),
				'alter' => 'padding-top',
			),
		),
		array(
			'id' => 'featured_title_bottom_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Bottom Padding', 'gustablo' ),
				'description' => esc_html__( 'Example: 30px', 'gustablo' ),
			),
			'inline_css' => array(
				'target' => array(
					'#featured-title .featured-title-inner-wrap'
				),
				'alter' => 'padding-bottom',
			),
		),
		array(
			'id' => 'featured_title_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'gustablo' ),
			),
			'inline_css' => array(
				'target' => '#featured-title',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'featured_title_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Background Image', 'gustablo' ),
			),
		),
		array(
			'id' => 'featured_title_background_img_style',
			'default' => 'repeat',
			'control' => array(
				'label' => esc_html__( 'Background Image Style', 'gustablo' ),
				'type'  => 'image',
				'type'  => 'select',
				'choices' => array(
					''             => esc_html__( 'Default', 'gustablo' ),
					'cover'        => esc_html__( 'Cover', 'gustablo' ),
					'center-top'        => esc_html__( 'Center Top', 'gustablo' ),
					'fixed-top'    => esc_html__( 'Fixed Top', 'gustablo' ),
					'fixed'        => esc_html__( 'Fixed Center', 'gustablo' ),
					'fixed-bottom' => esc_html__( 'Fixed Bottom', 'gustablo' ),
					'repeat'       => esc_html__( 'Repeat', 'gustablo' ),
					'repeat-x'     => esc_html__( 'Repeat-x', 'gustablo' ),
					'repeat-y'     => esc_html__( 'Repeat-y', 'gustablo' ),
				),
			),
		),
	),
);

// Featured Title Heading
$this->sections['wprt_featuredtitle_heading'] = array(
	'title' => esc_html__( 'Heading', 'gustablo' ),
	'panel' => 'wprt_featuredtitle',
	'settings' => array(
		array(
			'id' => 'featured_title_heading_shadow',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Text Shadow', 'gustablo' ),
				'type' => 'checkbox',
				'description' => esc_html__( 'Make text over image more readable.', 'gustablo' ),
			),
		),
		array(
			'id' => 'featured_title_heading_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'gustablo' ),
			),
			'inline_css' => array(
				'target' => array(
					'#featured-title .featured-title-heading',
					'#featured-title .featured-title-sub-heading',
					'#featured-title .featured-title-sub-heading:before, #featured-title .featured-title-sub-heading:after',
				),
				'alter' => array(
					'color',
					'border-color',
				),
			),
		),
		array(
			'id' => 'featured_title_subheading',
			'default' => esc_html__( 'WELCOME TO ITALIAN RESTAURANT', 'gustablo' ),
			'control' => array(
				'label' => esc_html__( 'Sub-Heading', 'gustablo' ),
				'type' => 'text',
			),
		),
	),
);

// Featured Title Breadcrumbs
$this->sections['wprt_featuredtitle_breadcrumbs'] = array(
	'title' => esc_html__( 'Breadcrumbs', 'gustablo' ),
	'panel' => 'wprt_featuredtitle',
	'settings' => array(
		array(
			'id' => 'featured_title_breadcrumbs',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'gustablo' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_height',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Height', 'gustablo' ),
				'active_callback' => 'wprt_cac_has_featured_title_breadcrumbs',
				'description' => esc_html__( 'Example: 40px', 'gustablo' ),
			),
			'inline_css' => array(
				'target' => array(
					'#breadcrumbs',
				),
				'alter' => array(
					'height',
					'line-height',
				),
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background Color', 'gustablo' ),
				'active_callback' => 'wprt_cac_has_featured_title_breadcrumbs',
			),
			'inline_css' => array(
				'target' => '#breadcrumbs',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'gustablo' ),
				'active_callback' => 'wprt_cac_has_featured_title_breadcrumbs',
			),
			'inline_css' => array(
				'target' => array(
					'#breadcrumbs',
					'#breadcrumbs a'
				),
				'alter' => 'color',
			),
		),
	),
);