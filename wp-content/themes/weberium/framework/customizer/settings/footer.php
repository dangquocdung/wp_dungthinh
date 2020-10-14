<?php
/**
 * Footer setting for Customizer
 *
 * @package weberium
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Footer General
$this->sections['weberium_footer_general'] = array(
	'title' => esc_html__( 'General', 'weberium' ),
	'panel' => 'weberium_footer',
	'settings' => array(
		array(
			'id' => 'footer_columns',
			'default' => '4',
			'control' => array(
				'label' => esc_html__( 'Footer Column(s)', 'weberium' ),
				'type' => 'select',
				'choices' => array(
					'4' => '4',
					'3' => '3',
					'2' => '2',
					'1' => '1',
				),
			),
		),
		array(
			'id' => 'footer_column_gutter',
			'default' => '30',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Footer Column Gutter', 'weberium' ),
				'type' => 'select',
				'choices' => array(
					'5'    => '5px',
					'10'   => '10px',
					'15'   => '15px',
					'20'   => '20px',
					'25'   => '25px',
					'30'   => '30px',
					'35'   => '35px',
					'40'   => '40px',
					'45'   => '45px',
					'50'   => '50px',
					'60'   => '60px',
					'70'   => '70px',
					'80'   => '80px',
				),
			),
		),
		array(
			'id' => 'footer_text_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#footer-widgets .widget',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'footer_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background Color', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#footer',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'footer_top_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Top Padding', 'weberium' ),
				'description' => esc_html__( 'Example: 60px.', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#footer',
				'alter' => 'padding-top',
			),
		),
		array(
			'id' => 'footer_bottom_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Bottom Padding', 'weberium' ),
				'description' => esc_html__( 'Example: 60px.', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#footer',
				'alter' => 'padding-bottom',
			),
		),
	),
);

// Footer Promotion
$this->sections['weberium_footer_promotion'] = array(
	'title' => esc_html__( 'Promotion Box', 'weberium' ),
	'panel' => 'weberium_footer',
	'settings' => array(
		array(
			'id' => 'promotion',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Enable', 'weberium' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'promotion_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background Color', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '.footer-promotion',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'promotion_title',
			'default' => esc_html__( 'SOME OF THE WORLD\'S BEST DESIN TEAMS INSPECT THE CRAFT SOLUTIONS', 'weberium' ),
			'control' => array(
				'label' => esc_html__( 'Title', 'weberium' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'promotion_button',
			'default' => esc_html__( 'PURCHASE NOW', 'weberium' ),
			'control' => array(
				'label' => esc_html__( 'Button', 'weberium' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'promotion_button_url',
			'default' => esc_html__( '#', 'weberium' ),
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Button URL', 'weberium' ),
				'description' => esc_html__( 'Please \'http://\' included', 'weberium' ),
			),	
		),
	),
);