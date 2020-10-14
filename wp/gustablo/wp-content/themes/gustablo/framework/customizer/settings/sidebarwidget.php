<?php
/**
 * Sidebar Widget setting for Customizer
 *
 * @package gustablo
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Sidebar Widget General
$this->sections['wprt_sidebar_widget_general'] = array(
	'title' => esc_html__( 'Widget General', 'gustablo' ),
	'panel' => 'wprt_sidebarwidget',
	'settings' => array(
		array(
			'id' => 'sidebar_widget_bottom_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Widget Bottom Margin', 'gustablo' ),
				'description' => esc_html__( 'Example: 30px.', 'gustablo' ),
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
				'type' => 'wprt-heading',
				'label' => esc_html__( 'Title Widget', 'gustablo' ),
			),
		),
		array(
			'id' => 'sidebar_widget_title_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Title Widget: Margin', 'gustablo' ),
				'description' => esc_html__( 'Top Right Bottom Left. Ex: 0px 0px 5px 0px', 'gustablo' ),
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
				'label' => esc_html__( 'Title Widget: Color', 'gustablo' ),
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
				'label' => esc_html__( 'Title Widget Line: Width', 'gustablo' ),
				'description' => esc_html__( 'Example: 50px. 100% is full-width.', 'gustablo' ),
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
				'label' => esc_html__( 'Title Widget Line: Height', 'gustablo' ),
				'description' => esc_html__( 'Ex: 1px.', 'gustablo' ),
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
				'label' => esc_html__( 'Title Widget Line: Color', 'gustablo' ),
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
$this->sections['wprt_sidebar_widget_search'] = array(
	'title' => esc_html__( 'Widget: Search', 'gustablo' ),
	'panel' => 'wprt_sidebarwidget',
	'settings' => array(
		array(
			'id' => 'sidebar_widget_search_form_icon_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Icon Color', 'gustablo' ),
				'active_callback' => 'wprt_cac_hasnt_title_widget_search_three'
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
				'label' => esc_html__( 'Border Color', 'gustablo' ),
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
				'label' => esc_html__( 'Border Width', 'gustablo' ),
			),
			'inline_css' => array(
				'target' => '#sidebar .widget.widget_search .search-form .search-field',
				'alter' => 'border-width',
			),
		),
	),
);

// Widget Built-In
$this->sections['wprt_sidebar_widget_built_in'] = array(
	'title' => esc_html__( 'Widget: Categories, Archives, Meta...', 'gustablo' ),
	'panel' => 'wprt_sidebarwidget',
	'settings' => array(
		array(
			'id' => 'sidebar_widget_built_in_list_padding',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Item Padding', 'gustablo' ),
				'description' => esc_html__( 'Top Right Bottom Left. Ex: 13px 0px', 'gustablo' ),
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
				'label' => esc_html__( 'Links Color', 'gustablo' ),
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
				'label' => esc_html__( 'Border Color', 'gustablo' ),
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
$this->sections['wprt_sidebar_widget_tags'] = array(
	'title' => esc_html__( 'Widget: Tags', 'gustablo' ),
	'panel' => 'wprt_sidebarwidget',
	'settings' => array(
		array(
			'id' => 'sidebar_widget_tags_padding',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'gustablo' ),
				'description' => esc_html__( 'Top Right Bottom Left. Ex: 2px 8px 2px 8px', 'gustablo' ),
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
				'label' => esc_html__( 'Rounded', 'gustablo' ),
				'description' => esc_html__( '0px is square.', 'gustablo' ),
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
				'label' => esc_html__( 'Space Between Items', 'gustablo' ),
				'description' => esc_html__( 'Example: 6px.', 'gustablo' ),
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
				'label' => esc_html__( 'Color', 'gustablo' ),
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
				'label' => esc_html__( 'Background Color', 'gustablo' ),
			),
			'inline_css' => array(
				'target' => '#sidebar .widget.widget_tag_cloud .tagcloud a:after',
				'alter' => 'background-color',
			),
		),
	),
);