<?php
/**
 * Blog setting for Customizer
 *
 * @package weberium
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Blog Posts General
$this->sections['weberium_blog_post'] = array(
	'title' => esc_html__( 'General', 'weberium' ),
	'panel' => 'weberium_blog',
	'settings' => array(
		array(
			'id' => 'blog_featured_title',
			'default' => esc_html__( 'BLOG', 'weberium' ),
			'control' => array(
				'label' => esc_html__( 'Blog Featured Title', 'weberium' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'blog_entry_content_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Entry Content Background Color', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '.post-content-wrap',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'blog_entry_content_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Entry Content Border Color', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-content-wrap',
				'alter' => 'border-color',
			),
		),
		array(
			'id' => 'blog_entry_content_border_width',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Entry Content Border Width', 'weberium' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0px 2px 2px 0px', 'weberium' ),
				'active_callback' => '',
			),
			'inline_css' => array(
				'target' => '.hentry .post-content-wrap',
				'alter' => 'border-width',
			),
		),
		array(
			'id' => 'blog_entry_content_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Entry Content Padding', 'weberium' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-content-wrap',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'blog_entry_content_bottom_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Entry Bottom Margin', 'weberium' ),
				'description' => esc_html__( 'Example: 30px.', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '.hentry',
				'alter' => 'margin-top',
			),
		),
		array(
			'id' => 'blog_entry_composer',
			'default' => 'title,meta,excerpt_content,readmore',
			'control' => array(
				'label' => esc_html__( 'Entry Content Elements', 'weberium' ),
				'type' => 'weberium-sortable',
				'object' => 'Weberium_Customize_Control_Sorter',
				'choices' => array(
					'title'           => esc_html__( 'Title', 'weberium' ),
					'meta'            => esc_html__( 'Meta', 'weberium' ),
					'excerpt_content' => esc_html__( 'Excerpt', 'weberium' ),
					'readmore'        => esc_html__( 'Read More', 'weberium' ),
				),
				'desc' => esc_html__( 'Drag and drop elements to re-order.', 'weberium' ),
			),
		),
	),
);

// Blog Custom Date
$this->sections['wprt_blog_post_custom_date'] = array(
	'title' => esc_html__( 'Blog Post - Custom Date', 'weberium' ),
	'panel' => 'weberium_blog',
	'settings' => array(
		array(
			'id' => 'blog_custom_date',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Enable Custom Date on Posts', 'weberium' ),
				'type' => 'checkbox',
			),
		),
	),
);

// Blog Posts Media
$this->sections['weberium_blog_post_media'] = array(
	'title' => esc_html__( 'Blog Post - Media', 'weberium' ),
	'panel' => 'weberium_blog',
	'settings' => array(
		array(
			'id' => 'blog_media_margin_bottom',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Bottom Margin', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-media',
				'alter' => 'margin-bottom',
			),
		),
	),
);

// Blog Posts Title
$this->sections['weberium_blog_post_title'] = array(
	'title' => esc_html__( 'Blog Post - Title', 'weberium' ),
	'panel' => 'weberium_blog',
	'settings' => array(
		array(
			'id' => 'blog_title_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Margin', 'weberium' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-title',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'blog_title_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'weberium' ),
			),
			'inline_css' => array(
				'target' => array(
					'.hentry .post-title',
					'.hentry .post-title a',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_title_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color Hover', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-title a:hover',
				'alter' => 'color',
			),
		),
	),
);

// Blog Posts Meta
$this->sections['weberium_blog_post_meta'] = array(
	'title' => esc_html__( 'Blog Post - Meta', 'weberium' ),
	'panel' => 'weberium_blog',
	'settings' => array(
		array(
			'id' => 'blog_entry_meta_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Meta Margin', 'weberium' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0 0 20px 0.', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta',
				'alter' => 'margin',
			),
		),
		array(
			'id'  => 'blog_entry_meta_items',
			'default' => array( 'date', 'author', 'comments' ),
			'control' => array(
				'label' => esc_html__( 'Meta Items', 'weberium' ),
				'desc' => esc_html__( 'Click and drag and drop elements to re-order them.', 'weberium' ),
				'type' => 'weberium-sortable',
				'object' => 'Weberium_Customize_Control_Sorter',
				'choices' => array(
					'date'       => esc_html__( 'Date', 'weberium' ),
					'author'     => esc_html__( 'Author', 'weberium' ),
					'comments' => esc_html__( 'Comments', 'weberium' ),
					'categories' => esc_html__( 'Categories', 'weberium' ),
				),
			),
		),
		array(
			'id' => 'heading_blog_entry_meta_item',
			'control' => array(
				'type' => 'weberium-heading',
				'label' => esc_html__( 'Item Meta', 'weberium' ),
			),
		),
		array(
			'id' => 'blog_entry_meta_item_style',
			'default' => 'style-1',
			'control' => array(
				'label' => esc_html__( 'Style', 'weberium' ),
				'type' => 'select',
				'choices' => array(
					'style-1' => esc_html__( 'Style 1', 'weberium' ),
					'style-2' => esc_html__( 'Style 2', 'weberium' ),
				),
			),
		),
		array(
			'id' => 'blog_entry_meta_item_icon_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Separate Color', 'weberium' ),
			),
			'inline_css' => array(
				'target' => array(
					'.hentry .post-meta .post-meta-content .item .inner:before',
				),
				'alter' => array(
					'color',
				),
			),
		),
		array(
			'id' => 'blog_entry_meta_item_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta .item',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_entry_meta_item_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta .item a',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_entry_meta_item_link_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color Hover', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta .item a:hover',
				'alter' => 'color',
			),
		),
	),
);

// Blog Posts Excerpt
$this->sections['weberium_blog_post_excerpt'] = array(
	'title' => esc_html__( 'Blog Post - Excerpt', 'weberium' ),
	'panel' => 'weberium_blog',
	'settings' => array(
		array(
			'id' => 'blog_content_style',
			'default' => 'style-1',
			'control' => array(
				'label' => esc_html__( 'Content Style', 'weberium' ),
				'type' => 'select',
				'choices' => array(
					'style-1' => esc_html__( 'Normal', 'weberium' ),
					'style-2' => esc_html__( 'Excerpt', 'weberium' ),
				),
			),
		),
		array(
			'id' => 'blog_excerpt_length',
			'default' => '69',
			'control' => array(
				'label' => esc_html__( 'Excerpt length', 'weberium' ),
				'type' => 'text',
				'active_callback' => 'weberium_cac_has_std_blog',
			),
		),
		array(
			'id' => 'blog_excerpt_length_list',
			'default' => '34',
			'control' => array(
				'label' => esc_html__( 'Excerpt length', 'weberium' ),
				'type' => 'text',
				'active_callback' => 'weberium_cac_has_list_blog',
			),
		),
		array(
			'id' => 'blog_excerpt_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Margin', 'weberium' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0 0 30px 0.', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-excerpt',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'blog_excerpt_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-excerpt',
				'alter' => 'color',
			),
		),
	),
);

// Blog Posts Read More
$this->sections['weberium_blog_post_read_more'] = array(
	'title' => esc_html__( 'Blog Post - Read More', 'weberium' ),
	'panel' => 'weberium_blog',
	'settings' => array(
		array(
			'id' => 'blog_entry_button_read_more_text',
			'default' => esc_html__( 'READ MORE', 'weberium' ),
			'control' => array(
				'label' => esc_html__( 'Button Text', 'weberium' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'blog_entry_read_more_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Read More Margin', 'weberium' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'weberium' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-read-more',
				'alter' => 'margin',
			),
		),
	),
);

