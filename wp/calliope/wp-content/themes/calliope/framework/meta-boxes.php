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
function calliope_register_meta_boxes( $meta_boxes ) {

	$prefix = '_cmb_';
	// Post format
	$meta_boxes[] = array(
		'id'       => 'format_detail',
		'title'    => __( 'Format Details', 'calliope' ),
		'pages'    => array( 'post' ),
		'context'  => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields'   => array(
			array(
				'name'             => __( 'Image', 'calliope' ),
				'id'               => $prefix . 'image',
				'type'             => 'image_advanced',
				'class'            => 'image',
				'max_file_uploads' => 1,
			),
			array(
				'name'  => __( 'Gallery', 'calliope' ),
				'id'    => $prefix . 'images',
				'type'  => 'image_advanced',
				'class' => 'gallery',
			),
			array(
				'name'  => __( 'Quote', 'calliope' ),
				'id'    => $prefix . 'quote',
				'type'  => 'textarea',
				'cols'  => 20,
				'rows'  => 2,
				'class' => 'quote',
			),
			array(
				'name'  => __( 'Author', 'calliope' ),
				'id'    => $prefix . 'quote_author',
				'type'  => 'text',
				'class' => 'quote',
			),
			array(
				'name'  => __( 'Audio', 'calliope' ),
				'id'    => $prefix . 'link_audio',
				'type'  => 'textarea',
				'cols'  => 20,
				'rows'  => 2,
				'class' => 'audio',
				'desc' => 'Ex: https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/139083759',
			),
			array(
				'name'  => __( 'Video', 'calliope' ),
				'id'    => $prefix . 'link_video',
				'type'  => 'textarea',
				'cols'  => 20,
				'rows'  => 2,
				'class' => 'video',
				'desc' => 'Example: <b>http://www.youtube.com/embed/0ecv0bT9DEo</b> or <b>http://player.vimeo.com/video/47355798</b>',
			),			
		),
	);
	$meta_boxes[] = array(
		'id'       => 'pages_st',
		'title'    => __( 'Page Settings', 'calliope' ),
		'pages'    => array( 'page' ),
		'context'  => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields'   => array(			
			array(
				'name'             => __( 'Background Header', 'calliope' ),
				'id'               => $prefix . 'bg_pagehead',
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
			),		
			array(
				'name'  => __( 'Subtitle', 'calliope' ),
				'id'    => $prefix . 'sub_page',
				'type'  => 'textarea',
				'class' => '',
			),		
		),
	);
	$meta_boxes[] = array(
		'id'       => 'testi_st',
		'title'    => __( 'Testimonial Settings', 'calliope' ),
		'pages'    => array( 'testimonial' ),
		'context'  => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields'   => array(			
			array(
				'name'  => __( 'Job', 'calliope' ),
				'id'    => $prefix . 'job_testi',
				'type'  => 'text',
				'class' => '',
			),
			array(
				'name'             => __( 'Image Bottom', 'calliope' ),
				'id'               => $prefix . 'logo_testi',
				'type'             => 'image_advanced',
				'class'            => '',
				'max_file_uploads' => 1,
			),		
		),
	);
	$meta_boxes[] = array(
		'id'       => 'folio_st',
		'title'    => __( 'Work Settings', 'calliope' ),
		'pages'    => array( 'portfolio' ),
		'context'  => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields'   => array(
			array(
				'name'             => __( 'Background Header', 'calliope' ),
				'id'               => $prefix . 'bg_head',
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
			),		
			array(
				'name'  => __( 'Subtitle', 'calliope' ),
				'id'    => $prefix . 'sub_folio',
				'type'  => 'text',
				'class' => '',
			),
			array(
				'name'  => __( 'Subtitle 2', 'calliope' ),
				'id'    => $prefix . 'sub_folio2',
				'type'  => 'text',
				'class' => '',
			),	
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'calliope_register_meta_boxes' );

/**
 * Enqueue scripts for admin
 *
 * @since  1.0
 */
function calliope_admin_enqueue_scripts( $hook ) {
	// Detect to load un-minify scripts when WP_DEBUG is enable
	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	if ( in_array( $hook, array( 'post.php', 'post-new.php' ) ) ) {
		wp_enqueue_script( 'calliope-backend-js', get_template_directory_uri()."/js/admin.js", array( 'jquery' ), THEME_VERSION, true );
	}
}

add_action( 'admin_enqueue_scripts', 'calliope_admin_enqueue_scripts' );
