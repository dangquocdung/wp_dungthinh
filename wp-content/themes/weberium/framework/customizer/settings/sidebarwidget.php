<?php
/**
 * Sidebar Widget setting for Customizer
 *
 * @package weberium
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Sidebar Widget General
$this->sections['weberium_sidebar_widget_general'] = array(
	'title' => esc_html__( 'Widget General', 'weberium' ),
	'panel' => 'weberium_sidebarwidget',
	'settings' => array(
		array(
			'id' => 'sidebar_widget_bottom_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Widget Bottom Margin', 'weberium' ),
				'description' => esc_html__( 'Example: 30px.', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#sidebar .widget',
				'alter' => 'margin-top',
			),
		),
		// Title Widget
		array(
			'id' => 'heading_widget_title',
			'control' => array(
				'type' => 'weberium-heading',
				'label' => esc_html__( 'Title Widget', 'weberium' ),
			),
		),
		array(
			'id' => 'sidebar_widget_title_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Title Widget: Margin', 'weberium' ),
				'description' => esc_html__( 'Top Right Bottom Left. Ex: 0px 0px 5px 0px', 'weberium' ),
			),
			'inline_css' => array(
				'target' => array(
					'#sidebar.title-style-1 .widget .widget-title',
					'#sidebar.title-style-2 .widget .widget-title'
				),
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'sidebar_widget_title_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Title Widget: Color', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#sidebar .widget .widget-title',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'sidebar_widget_title_line_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Title Widget Line: Width', 'weberium' ),
				'description' => esc_html__( 'Example: 50px. 100% is full-width.', 'weberium' ),
			),
			'inline_css' => array(
				'target' => array(
					'#sidebar.title-style-1 .widget .widget-title > span:after',
					'#sidebar.title-style-2 .widget .widget-title > span:after',
				),
				'alter' => 'width',
			),
		),
		array(
			'id' => 'sidebar_widget_title_line_height',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Title Widget Line: Height', 'weberium' ),
				'description' => esc_html__( 'Ex: 1px.', 'weberium' ),
			),
			'inline_css' => array(
				'target' => array(
					'#sidebar.title-style-1 .widget .widget-title > span:after',
					'#sidebar.title-style-2 .widget .widget-title > span:after',
				),
				'alter' => 'height',
			),
		),
		array(
			'id' => 'sidebar_widget_title_line_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Title Widget Line: Color', 'weberium' ),
			),
			'inline_css' => array(
				'target' => array(
					'#sidebar.title-style-1 .widget .widget-title > span:after',
					'#sidebar.title-style-2 .widget .widget-title > span:after'
				),
				'alter' => 'background-color',
			),
		),
	),
);

// Widget Search
$this->sections['weberium_sidebar_widget_search'] = array(
	'title' => esc_html__( 'Widget: Search', 'weberium' ),
	'panel' => 'weberium_sidebarwidget',
	'settings' => array(
		array(
			'id' => 'sidebar_widget_search_form_icon_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Icon Color', 'weberium' ),
				'active_callback' => 'weberium_cac_hasnt_title_widget_search_three'
			),
			'inline_css' => array(
				'target' => '#sidebar .widget.widget_search .search-form .search-submit:before',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'sidebar_widget_search_form_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Border Color', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#sidebar .widget.widget_search .search-form .search-field',
				'alter' => 'border-color',
			),
		),
		array(
			'id' => 'sidebar_widget_search_form_border_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Border Width', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#sidebar .widget.widget_search .search-form .search-field',
				'alter' => 'border-width',
			),
		),
	),
);

// Widget Built-In
$this->sections['weberium_sidebar_widget_built_in'] = array(
	'title' => esc_html__( 'Widget: Categories, Archives, Meta...', 'weberium' ),
	'panel' => 'weberium_sidebarwidget',
	'settings' => array(
		array(
			'id' => 'sidebar_widget_built_in_list_padding',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Item Padding', 'weberium' ),
				'description' => esc_html__( 'Top Right Bottom Left. Ex: 13px 0px', 'weberium' ),
			),
			'inline_css' => array(
				'target' => array(
					'#sidebar .widget.widget_categories ul li',
					'#sidebar .widget.widget_meta ul li',
					'#sidebar .widget.widget_pages ul li',
					'#sidebar .widget.widget_archive ul li'
				),
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'sidebar_widget_built_in_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Links Color', 'weberium' ),
			),
			'inline_css' => array(
				'target' => array(
					'#sidebar .widget.widget_categories ul li a',
					'#sidebar .widget.widget_meta ul li a',
					'#sidebar .widget.widget_pages ul li a',
					'#sidebar .widget.widget_archive ul li a'
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'sidebar_widget_built_in_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Border Color', 'weberium' ),
			),
			'inline_css' => array(
				'target' => array(
					'#sidebar .widget.widget_categories ul li',
					'#sidebar .widget.widget_meta ul li',
					'#sidebar .widget.widget_pages ul li',
					'#sidebar .widget.widget_archive ul li'
				),
				'alter' => 'border-color',
			),
		),
	),
);

// Widget Tags
$this->sections['weberium_sidebar_widget_tags'] = array(
	'title' => esc_html__( 'Widget: Tags', 'weberium' ),
	'panel' => 'weberium_sidebarwidget',
	'settings' => array(
		array(
			'id' => 'sidebar_widget_tags_padding',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'weberium' ),
				'description' => esc_html__( 'Top Right Bottom Left. Ex: 2px 8px 2px 8px', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#sidebar .widget.widget_tag_cloud .tagcloud a',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'sidebar_widget_tags_rounded',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Rounded', 'weberium' ),
				'description' => esc_html__( '0px is square.', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#sidebar .widget.widget_tag_cloud .tagcloud a:after',
				'alter' => 'border-radius',
			),
		),
		array(
			'id' => 'sidebar_widget_tags_space_between',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Space Between Items', 'weberium' ),
				'description' => esc_html__( 'Example: 6px.', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#sidebar .widget.widget_tag_cloud .tagcloud a',
				'alter' => array(
					'margin-right',
					'margin-bottom'
				),
			),
		),
		array(
			'id' => 'sidebar_widget_tags_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#sidebar .widget.widget_tag_cloud .tagcloud a',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'sidebar_widget_tags_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background Color', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '#sidebar .widget.widget_tag_cloud .tagcloud a:after',
				'alter' => 'background-color',
			),
		),
	),
);