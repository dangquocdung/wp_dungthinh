<?php
/**
 * Register meta boxes
 *
 * @since 1.0
 *
 * @param array $meta_boxes
 *
 * @return array
 */

function architect_register_meta_boxes( $meta_boxes ) {

	$prefix = '_cmb_';
	$meta_boxes[] = array(
		'id'       => 'format_detail',
		'title'    => esc_html__( 'Format Details', 'architect' ),
		'pages'    => array( 'post' ),
		'context'  => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields'   => array(
			array(
				'name'             => esc_html__( 'Image', 'architect' ),
				'id'               => $prefix . 'image',
				'type'             => 'image_advanced',
				'class'            => 'image',
				'max_file_uploads' => 1,
			),
			array(
				'name'  => esc_html__( 'Gallery', 'architect' ),
				'id'    => $prefix . 'images',
				'type'  => 'image_advanced',
				'class' => 'gallery',
			),
			array(
				'name'  => esc_html__( 'Quote', 'architect' ),
				'id'    => $prefix . 'quote',
				'type'  => 'textarea',
				'cols'  => 20,
				'rows'  => 2,
				'class' => 'quote',
			),
			array(
				'name'  => esc_html__( 'Audio', 'architect' ),
				'id'    => $prefix . 'link_audio',
				'type'  => 'oembed',
				'cols'  => 20,
				'rows'  => 2,
				'class' => 'audio',
				'desc' => 'Ex: https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/139083759',
			),
			array(
				'name'  => esc_html__( 'Video', 'architect' ),
				'id'    => $prefix . 'link_video',
				'type'  => 'oembed',
				'cols'  => 20,
				'rows'  => 2,
				'class' => 'video',
				'desc' => 'Example: <b>http://www.youtube.com/embed/0ecv0bT9DEo</b> or <b>http://player.vimeo.com/video/47355798</b>',
			),			
		),
	);
	$meta_boxes[] = array(
		'id'         => 'info_services',
		'title'      => esc_html__( 'Services Details', 'architect' ),
		'pages'      => array( 'service' ), // Post type
		'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
		//'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
		'fields' => array(
			array(
                'name' => esc_html__( 'Detail', 'architect' ),
                'desc' => esc_html__( 'Enter the Detail', 'architect' ),
                'id'   => $prefix . 'detail_service',
				'type'  => 'textarea',
				'cols'  => 20,
				'rows'  => 2,
				'class' => '',
            ),
		)
	);
	$meta_boxes[] = array(
		'id'         => 'info_page',
		'title'      => esc_html__( 'Page Details', 'architect' ),
		'pages'      => array( 'page','portfolio','service' ), // Post type
		'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
		//'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
		'fields' => array(
			array(
				'name'             => esc_html__( 'background Subheader', 'architect' ),
				'id'               => $prefix . 'bg_header',
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
			),
		)
	);
	$meta_boxes[] = array(
		'id'         => 'info_portfolio',
		'title'      => esc_html__( 'Portfolio Details', 'architect' ),
		'pages'      => array( 'portfolio' ), // Post type
		'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
		//'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
		'fields' => array(
			array(
				'name'  => esc_html__( 'Style Page', 'architect' ),
				'id'    => $prefix . 'style_folio',
                'type' => 'select',
                'options'  => array(
                    'no' 	 => esc_html__( 'Select', 'architect' ),
                    'style1' => esc_html__( 'Sub header', 'architect' ),
                    'style2' => esc_html__( 'No subheader', 'architect' ), 
                    'style3' => esc_html__( 'Fullwidth', 'architect' ),                         
                ),
			),
			array(
				'name'  => esc_html__( 'Link Out', 'architect' ),
				'id'    => $prefix . 'link_out',
				'type'  => 'text',
				'class' => '',
			),
		)
	);
	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'architect_register_meta_boxes' );

