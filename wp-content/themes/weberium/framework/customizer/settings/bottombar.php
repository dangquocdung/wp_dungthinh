<?php
/**
 * Bottom Bar setting for Customizer
 *
 * @package weberium
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bottom Bar General
$this->sections['weberium_bottombar_general'] = array(
	'title' => esc_html__( 'General', 'weberium' ),
	'panel' => 'weberium_bottombar',
	'settings' => array(
		array(
			'id' => 'bottom_bar',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'weberium' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'bottom_bar_style',
			'default' => 'style-1',
			'control' => array(
				'label' => esc_html__( 'Style', 'weberium' ),
				'type' => 'select',
				'active_callback' => 'weberium_cac_has_bottombar',
				'choices' => array(
					'style-1' => esc_html__( 'Content & Bottom-Menu', 'weberium' ),
					'style-2' => esc_html__( 'Bottom-Menu & Content', 'weberium' ),
				),
			),
		),
		array(
			'id' => 'bottom_copyright',
			'transport' => 'postMessage',
			'default' => '&copy; Copyright weberium. All rights reserved.',
			'control' => array(
				'label' => esc_html__( 'Copyright', 'weberium' ),
				'type' => 'weberium_textarea',
				'active_callback' => 'weberium_cac_has_bottombar',
			),
		),
		array(
			'id' => 'bottom_padding',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'weberium' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'weberium' ),
				'active_callback'=> 'weberium_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom .bottom-bar-inner-wrap',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'bottom_background',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'weberium' ),
				'active_callback'=> 'weberium_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom',
				'alter' => 'background',
			),
		),
		array(
			'id' => 'bottom_color',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'weberium' ),
				'active_callback'=> 'weberium_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'bottom_link_color',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Links', 'weberium' ),
				'active_callback'=> 'weberium_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => array(
					'#bottom a',
					'#bottom ul.bottom-nav > li > a'
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'bottom_link_color_hover',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Links: Hover', 'weberium' ),
				'active_callback'=> 'weberium_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => array(
					'#bottom a:hover',
					'#bottom ul.bottom-nav > li > a:hover'
				),
				'alter' => 'color',
			),
		),
	),
);

// Bottom Socials
$this->sections['weberium_bottombar_social'] = array(
	'title' => esc_html__( 'Social', 'weberium' ),
	'panel' => 'weberium_bottombar',
	'settings' => array(
		array(
			'id' => 'bottom_social_space_between',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Space Between Items', 'weberium' ),
				'description' => esc_html__( 'Example: 10px.', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#bottom .top-bar-socials .icons a',
				'alter' => 'margin-left',
			),
		),
		array(
			'id' => 'bottom_social_font_size',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Icon Size', 'weberium' ),
				'description' => esc_html__( 'Example: 20px.', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#bottom .top-bar-socials .icons a',
				'alter' => 'font-size',
			),
		),
	),
);

// Social settings
$social_options = weberium_bottom_social_options();
foreach ( $social_options as $key => $val ) {
	$this->sections['weberium_bottombar_social']['settings'][] = array(
		'id' => 'bottom_social_profiles[' . $key .']',
		'control' => array(
			'label' => $val['label'],
			'type' => 'text',
		),
	);
}

// Remove var from memory
unset( $social_options );