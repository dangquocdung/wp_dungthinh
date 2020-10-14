<?php
/**
 * Top Bar setting for Customizer
 *
 * @package weberium
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Top Bar 1 General
$this->sections['weberium_topbar_general_one'] = array(
	'title' => esc_html__( 'General', 'weberium' ),
	'panel' => 'weberium_topbar',
	'settings' => array(
		array(
			'id' => 'top_bar_one_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'weberium' ),
				'active_callback' => 'weberium_cac_has_topbar_one',
			),
			'inline_css' => array(
				'target' => '.top-bar-style-1 #top-bar',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'top_bar_one_text',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'weberium' ),
				'active_callback' => 'weberium_cac_has_topbar_one',
			),
			'inline_css' => array(
				'target' => '.top-bar-style-1 #top-bar',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'top_bar_one_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'weberium' ),
				'active_callback' => 'weberium_cac_has_topbar_one',
			),
			'inline_css' => array(
				'target' => '.top-bar-style-1 #top-bar a',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'top_bar_one_social_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Socials: Color', 'weberium' ),
				'active_callback' => 'weberium_cac_has_topbar_one',
			),
			'inline_css' => array(
				'target' => '.top-bar-style-1 #top-bar .top-bar-socials .icons a',
				'alter' => 'color',
			),
		),
	),
);

// Top Bar 2 General
$this->sections['weberium_topbar_general_two'] = array(
	'title' => esc_html__( 'General', 'weberium' ),
	'panel' => 'weberium_topbar',
	'settings' => array(
		array(
			'id' => 'top_bar_two_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'weberium' ),
				'active_callback' => 'weberium_cac_has_topbar_two',
			),
			'inline_css' => array(
				'target' => '.top-bar-style-2 #top-bar',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'top_bar_two_text',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'weberium' ),
				'active_callback' => 'weberium_cac_has_topbar_two',
			),
			'inline_css' => array(
				'target' => '.top-bar-style-2 #top-bar',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'top_bar_two_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'weberium' ),
				'active_callback' => 'weberium_cac_has_topbar_two',
			),
			'inline_css' => array(
				'target' => '.top-bar-style-2 #top-bar a',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'top_bar_two_social_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Socials: Color', 'weberium' ),
				'active_callback' => 'weberium_cac_has_topbar_two',
			),
			'inline_css' => array(
				'target' => '.top-bar-style-2 #top-bar .top-bar-socials .icons a',
				'alter' => 'color',
			),
		),
	),
);

// Top Bar 3  General
$this->sections['weberium_topbar_general_three'] = array(
	'title' => esc_html__( 'General', 'weberium' ),
	'panel' => 'weberium_topbar',
	'settings' => array(
		array(
			'id' => 'top_bar_three_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'weberium' ),
				'active_callback' => 'weberium_cac_has_topbar_three',
			),
			'inline_css' => array(
				'target' => '.top-bar-style-3 #top-bar',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'top_bar_three_text',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'weberium' ),
				'active_callback' => 'weberium_cac_has_topbar_three',
			),
			'inline_css' => array(
				'target' => '.top-bar-style-3 #top-bar',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'top_bar_three_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'weberium' ),
				'active_callback' => 'weberium_cac_has_topbar_three',
			),
			'inline_css' => array(
				'target' => '.top-bar-style-3 #top-bar a',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'top_bar_three_social_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Socials: Color', 'weberium' ),
				'active_callback' => 'weberium_cac_has_topbar_three',
			),
			'inline_css' => array(
				'target' => '.top-bar-style-3 #top-bar .top-bar-socials .icons a',
				'alter' => 'color',
			),
		),
	),
);

// Top Bar Content
$this->sections['weberium_topbar_content'] = array(
	'title' => esc_html__( 'Content', 'weberium' ),
	'panel' => 'weberium_topbar',
	'settings' => array(
		array(
			'id' => 'top_bar_content_welcome',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Welcome Text', 'weberium' ),
				'type' => 'weberium_textarea',
				'rows' => 3,
				'active_callback' => 'weberium_cac_has_topbar',
			),
		),
		array(
			'id' => 'top_bar_content_email',
			'default' => 'SUPPORT@NINZIO.COM',
			'control' => array(
				'label' => esc_html__( 'Email', 'weberium' ),
				'type' => 'weberium_textarea',
				'rows' => 3,
				'active_callback' => 'weberium_cac_has_topbar',
			),
		),
		array(
			'id' => 'top_bar_content_phone',
			'default' => 'PHONE +7 (100) 450-460',
			'control' => array(
				'label' => esc_html__( 'Phone', 'weberium' ),
				'type' => 'weberium_textarea',
				'rows' => 3,
				'active_callback' => 'weberium_cac_has_topbar',
			),
		),
		array(
			'id' => 'top_bar_content_address',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Address', 'weberium' ),
				'type' => 'weberium_textarea',
				'rows' => 3,
				'active_callback' => 'weberium_cac_has_topbar',
			),
		),
	),
);

// Button
$this->sections['weberium_topbar_button'] = array(
	'title' => esc_html__( 'Button', 'weberium' ),
	'panel' => 'weberium_topbar',
	'settings' => array(
		array(
			'id' => 'top_bar_button',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Enable', 'weberium' ),
				'type' => 'checkbox',
				'active_callback' => 'weberium_cac_has_topbar',
			),
		),
		array(
			'id' => 'top_bar_button_text',
			'default' => esc_html__( 'FREE TRIAL', 'weberium' ),
			'control' => array(
				'label' => esc_html__( 'Button Text', 'weberium' ),
				'type' => 'text',
				'active_callback' => 'weberium_cac_topbar_has_button',
			),
		),
		array(
			'id' => 'top_bar_button_link',
			'control' => array(
				'label' => esc_html__( 'Button Link', 'weberium' ),
				'type' => 'text',
				'active_callback' => 'weberium_cac_topbar_has_button',
			),
		),
		array(
			'id' => 'top_bar_button_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Button Margin', 'weberium' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0px 0px 0px 30px', 'weberium' ),
				'active_callback' => 'weberium_cac_topbar_has_button',
			),
			'inline_css' => array(
				'target' => '#top-bar .top-bar-button',
				'alter' => 'margin',
			),
		),
	)
);