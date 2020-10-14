<?php
/**
 * Main Content setting for Customizer
 *
 * @package weberium
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Main Content General
$this->sections['weberium_maincontent_general'] = array(
	'title' => esc_html__( 'General', 'weberium' ),
	'panel' => 'weberium_maincontent',
	'settings' => array(
		array(
			'id' => 'main_content_top_padding',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Top Padding', 'weberium' ),
				'description' => esc_html__( 'Example: 30px', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#main-content',
				'alter' => 'padding-top',
			),
		),
		array(
			'id' => 'main_content_bottom_padding',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Bottom Padding', 'weberium' ),
				'description' => esc_html__( 'Example: 30px', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#main-content',
				'alter' => 'padding-bottom',
			),
		),
		array(
			'id' => 'main_content_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background Color', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#main-content',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'main_content_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Background Image', 'weberium' ),
			),
		),
		array(
			'id' => 'main_content_background_img_style',
			'default' => '',
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
			),
		),
	),
);

// Main Content Left
$this->sections['weberium_maincontent_left'] = array(
	'title' => esc_html__( 'Content', 'weberium' ),
	'panel' => 'weberium_maincontent',
	'settings' => array(
		array(
			'id' => 'left_content_padding',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'weberium' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 30px', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#inner-content',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'left_content_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background Color', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#inner-content',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'left_content_border_width',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Border Width', 'weberium' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0px 3px 2px 0px', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#inner-content:after',
				'alter' => 'border-width',
			),
		),
		array(
			'id' => 'left_content_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Border Color', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#inner-content:after',
				'alter' => 'border-color',
			),
		),
	),
);

// Main Content Right
$this->sections['weberium_maincontent_right'] = array(
	'title' => esc_html__( 'Sidebar', 'weberium' ),
	'panel' => 'weberium_maincontent',
	'settings' => array(
		array(
			'id' => 'right_content_padding',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'weberium' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 30px', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#inner-sidebar',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'right_content_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background Color', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#inner-sidebar',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'right_content_border_width',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Border Width', 'weberium' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0px 3px 3px 0px', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#inner-sidebar:after',
				'alter' => 'border-width',
			),
		),
		array(
			'id' => 'right_content_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Border Color', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#inner-sidebar:after',
				'alter' => 'border-color',
			),
		),
	),
);