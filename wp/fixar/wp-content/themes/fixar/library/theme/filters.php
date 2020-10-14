<?php
/**
 * The template for registering metabox.
 *
 * @package PixTheme
 * @since 1.0
 */
add_filter( 'rwmb_meta_boxes', 'fixar_register_meta_boxes' );

function fixar_register_meta_boxes( $meta_boxes ) {
	
	$meta_boxes[] = array(

		'id' => 'product_options',
		'title' => esc_html__( 'Additional Title', 'fixar' ),
		'pages' => array( 'services', 'portfolio', 'post', 'page', 'product'),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(

			array(
				'name'    => esc_html__( 'Text', 'fixar' ),
				'id'      => "add_title_text",
				'desc'  => "",
				'type'    => 'textarea',
				'std'   => ''
			),

		)
	);
	
	
	$meta_boxes[] = array(

		'id' => 'excerpt_image',
		'title' => esc_html__( 'Excerpt image', 'fixar' ),
		'pages' => array(  'post'   ),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(

			array(
				'name'    => esc_html__( 'Image', 'fixar' ),
				'id'      => "excerpt_image_img",
				'desc'  => "",
				'type'    => 'image_advanced',
				'max_file_uploads'   => 1
			),

		)
	);

	$meta_boxes[] = array(

		'id' => 'portfolio_description',
		'title' => esc_html__( 'Description for Custom Layout', 'fixar' ),
		'pages' => array('portfolio'),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(

			array(
				'name'    => esc_html__( 'Text', 'fixar' ),
				'id'      => 'portfolio_desc',
				'desc'  => '',
				'type'    => 'wysiwyg',
				'std'   => ''
			),

		)
	);
	
	$meta_boxes[] = array(
		'id' => 'portfolio_meta',
		'title' => esc_html__( 'Portfolio Meta', 'fixar' ),
		'pages' => array( 'portfolio' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name'  => esc_html__( 'Created by', 'fixar' ),
				'id'    => 'portfolio_create',
				'type'  => 'text',
				'desc' => esc_html__( 'Enter author name', 'fixar' )
			),
			array(
				'name'  => esc_html__( 'Completed on', 'fixar' ),
				'id'    => 'portfolio_complete',
				'type'  => 'date',
				'js_options' => array('dateFormat' => 'MM d, yy'),
				'desc' => esc_html__( 'Enter date', 'fixar' )
			),
			array(
				'name'  => esc_html__( 'Skills', 'fixar' ),
				'id'    => 'portfolio_skills',
				'type'  => 'text',
				'desc' => esc_html__( 'Enter skills', 'fixar' )
			),
			array(
				'name'  => esc_html__( 'Client', 'fixar' ),
				'id'    => 'portfolio_client',
				'type'  => 'text',
				'desc' => esc_html__( 'Enter client name', 'fixar' )
			),
			array(
				'name'  => esc_html__( 'Client link', 'fixar' ),
				'id'    => 'portfolio_client_link',
				'type'  => 'text',
				'desc' => esc_html__( 'Enter client link eg (http://wordpress.com/)', 'fixar' )
			),
			array(
				'name'  => esc_html__( 'Project link', 'fixar' ),
				'id'    => 'portfolio_button_link',
				'type'  => 'text',
				'desc' => esc_html__( 'Enter project link eg (http://wordpress.com/). Leave empty to hide button View project', 'fixar' )
			),
		)
	);
	
	$meta_boxes[] = array(
		'id' => 'post_types',
		'title' => esc_html__( 'Portfolio Option', 'fixar' ),
		'pages' => array( 'portfolio' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name'     => esc_html__( 'Post Types', 'fixar' ),
				'id'       => "post_types_select",
				'type'     => 'select',
				'desc' => 'Select post types',
				'options'  => array(
					'image' => 'Image',
					'video' => 'Video',
				)
			),
			array(
				'name' => esc_html__( 'Post Type For Image', 'fixar' ),
				'id'   => 'portfolio_images',
				'type' => 'image_advanced',
				'max_file_uploads' => 25,
				'desc' => esc_html__( 'Upload images for your portfolio post.', 'fixar' ),
			),
			array(
				'name'  => esc_html__( 'Post Type For Video', 'fixar' ),
				'id'    => 'portfolio_video_href',
				'type'  => 'text',
				'desc' => 'Enter video link eg (http://youtu.be/DoRMzGR7ZDA)'
			),
			array(
				'name' => esc_html__( '.', 'fixar' ),
				'id'   => "portfolio_video_width",
				'type' => 'slider',
				'desc' => esc_html__('Range video width', 'fixar'),
				'suffix' => esc_html__( ' px', 'fixar' ),
				'js_options' => array(
					'min'   => 100,
					'max'   => 2000,
					'step'  => 10,
				),
			),
			array(
				'name' => esc_html__( '.', 'fixar' ),
				'id'   => "portfolio_video_height",
				'type' => 'slider',
				'desc' => esc_html__('Range video height', 'fixar'),
				'suffix' => esc_html__( ' px', 'fixar' ),
				'js_options' => array(
					'min'   => 100,
					'max'   => 1000,
					'step'  => 5,
				),
			),
		)
	);
	
	$meta_boxes[] = array(
		
		'id' => 'post_format',
		'title' => esc_html__( 'Post Format Options', 'fixar' ),
		'pages' => array( 'post' ),
		'context' => 'normal',
		'priority' => 'low',
		'autosave' => true,
		'fields' => array(
			array(
				'name' => esc_html__('Post Standared:', 'fixar' ),
				'id'   => "post_standared",
				'type' => 'file_advanced',
				'max_file_uploads' => 4,
				'mime_type' => 'image,application,audio,video',
			),
			array(
				'name' => esc_html__('Post Gallery:','fixar'),
				'id'   => "post_gallery",
				'type' => 'image_advanced',
				'max_file_uploads' => 25,
			),
			array(
				'name'  => esc_html__('Quote Source:', 'fixar'),
				'id'    => "post_quote_source",
				'desc'  => '',
				'type'  => 'text',
				'std'   => '',
			),
			array(
				'name'  => esc_html__('Quote Content:', 'fixar'),
				'id'    => "post_quote_content",
				'desc'  => '',
				'type'  => 'textarea',
				'std'   => '',
			),
			array(
				'name'  => esc_html__('Video','fixar'),
				'id'    => "post_video",
				'desc'  => 'Video URL',
				'type'  => 'textarea',
				'std'   => '',
			)
		)
		
	);

	return $meta_boxes;
}

