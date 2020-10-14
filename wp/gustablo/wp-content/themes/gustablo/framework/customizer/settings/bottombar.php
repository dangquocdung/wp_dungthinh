<?php
/**
 * Bottom Bar setting for Customizer
 *
 * @package gustablo
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bottom Bar General
$this->sections['wprt_bottombar_general'] = array(
	'title' => esc_html__( 'General', 'gustablo' ),
	'panel' => 'wprt_bottombar',
	'settings' => array(
		array(
			'id' => 'bottom_bar',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'gustablo' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'bottom_bar_style',
			'default' => 'style-1',
			'control' => array(
				'label' => esc_html__( 'Style', 'gustablo' ),
				'type' => 'select',
				'active_callback' => 'wprt_cac_has_bottombar',
				'choices' => array(
					'style-1' => esc_html__( 'Content & Bottom-Menu', 'gustablo' ),
					'style-2' => esc_html__( 'Bottom-Menu & Content', 'gustablo' ),
				),
			),
		),
		array(
			'id' => 'bottom_copyright',
			'transport' => 'postMessage',
			'default' => '&copy; Copyright <span class="text-white">Gustablo.</span> All rights reserved.',
			'control' => array(
				'label' => esc_html__( 'Copyright', 'gustablo' ),
				'type' => 'wprt_textarea',
				'active_callback' => 'wprt_cac_has_bottombar',
			),
		),
		array(
			'id' => 'bottom_padding',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'gustablo' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'gustablo' ),
				'active_callback'=> 'wprt_cac_has_bottombar',
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
				'label' => esc_html__( 'Background', 'gustablo' ),
				'active_callback'=> 'wprt_cac_has_bottombar',
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
				'label' => esc_html__( 'Color', 'gustablo' ),
				'active_callback'=> 'wprt_cac_has_bottombar',
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
				'label' => esc_html__( 'Links', 'gustablo' ),
				'active_callback'=> 'wprt_cac_has_bottombar',
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
				'label' => esc_html__( 'Links: Hover', 'gustablo' ),
				'active_callback'=> 'wprt_cac_has_bottombar',
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