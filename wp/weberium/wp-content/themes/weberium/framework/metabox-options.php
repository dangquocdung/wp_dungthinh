<?php
/**
 * Metabox Options
 *
 * @package weberium
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Return the registered-widget array
function weberium_get_widget_registered() {
	global $wp_registered_sidebars;

	$widgets_areas = array();
	if ( ! empty( $wp_registered_sidebars ) ) {
		foreach ( $wp_registered_sidebars as $widget_area ) {
			$name = isset ( $widget_area['name'] ) ? $widget_area['name'] : '';
			$id = isset ( $widget_area['id'] ) ? $widget_area['id'] : '';
			if ( $name && $id ) {
				$widgets_areas[$id] = $name;
			}
		}
	}

	return $widgets_areas;
}

// Return the all-widget array
function weberium_get_widget_mods() {
	$new_arr = array();
	$widget_areas_mod = weberium_get_mod( 'widget_areas' );
	
	if (is_array($widget_areas_mod) || is_object($widget_areas_mod)) {
		foreach( $widget_areas_mod as $key ) {
			$new_arr[sanitize_key($key)] = $key;
		}
	}
	
	$widget_areas = weberium_get_widget_registered() + $new_arr;

	return $widget_areas;
}

// Registering meta boxes. Using Meta Box plugin: https://metabox.io/
function weberium_register_meta_boxes( $meta_boxes ) {
	// Post Format Gallery
	$meta_boxes[] = array(
		'title'  => esc_html__( 'Post Format: Gallery', 'weberium' ),
		'id'     => 'opt-meta-box-post-format-gallery',
		'pages'  => array( 'post' ),
		'fields' => array(
			array(
				'name' => esc_html__( 'Images', 'weberium' ),
				'id'   => 'gallery_images',
				'type' => 'image_advanced',
			),
		),
	);

	// Post Format Video
	$meta_boxes[] = array(
		'title'  => esc_html__( 'Post Format: Video ( Embeded video from youtube, vimeo...)', 'weberium' ),
		'id'     => 'opt-meta-box-post-format-video',
		'pages'  => array( 'post' ),
		'fields' => array(
			array(
				'name' => esc_html__( 'Video URL or Embeded Code', 'weberium' ),
				'id'   => 'video_url',
				'type' => 'textarea',
			),
		)
	);

	// Partner
	$meta_boxes[] = array(
		'title'  => esc_html__( 'Partner Settings', 'weberium' ),
		'id'     => 'opt-meta-box-partner',
		'pages'  => array( 'partner' ),
		'fields' => array(
			array(
				'name' => esc_html__( 'Hyperlink', 'weberium' ),
				'id'   => 'partner_hyperlink',
				'type'       => 'text',
				'desc'  => esc_html__( "Partne's URL. Leave blank to disable (please 'http://' included).", 'weberium' )
			),
		)
	);

	// Member
	$meta_boxes[] = array(
		'title'  => esc_html__( 'Member Information', 'weberium' ),
		'id'     => 'opt-meta-box-pages',
		'pages'  => array( 'member' ),
		'fields' => array(
			array(
				'name' => esc_html__( 'Name', 'weberium' ),
				'id'   => 'name',
				'type'       => 'text',
			),
			array(
				'name' => esc_html__( 'Position', 'weberium' ),
				'id'   => 'position',
				'type'       => 'text',
			),
			array(
				'name' => esc_html__( 'Facebook', 'weberium' ),
				'id'   => 'facebook',
				'type'       => 'text',
			),
			array(
				'name' => esc_html__( 'Twitter', 'weberium' ),
				'id'   => 'twitter',
				'type'       => 'text',
			),
			array(
				'name' => esc_html__( 'Linkedin', 'weberium' ),
				'id'   => 'linkedin',
				'type'       => 'text',
			),
			array(
				'name' => esc_html__( 'Google +', 'weberium' ),
				'id'   => 'google_plus',
				'type'       => 'text',
			),
			array(
				'name' => esc_html__( 'Instagram', 'weberium' ),
				'id'   => 'instagram',
				'type'       => 'text',
			),
		)
	);

	// Page Settings
	$meta_boxes[] = array(
		'title'  => esc_html__( 'Page Settings', 'weberium' ),
		'id'     => 'opt-meta-box-pages',
		'pages'  => array( 'page', 'project' ),
		'fields' => array(
			array(
				'name'    => esc_html__( 'Top-Bar Option', 'weberium' ),
				'id'      => 'top_bar_style',
				'type'    => 'select',
				'options' => array(
					'style-1' => esc_html__( 'Top-Bar Dark', 'weberium' ),
					'style-2' => esc_html__( 'Top-Bar Grey', 'weberium' ),
					'style-3' => esc_html__( 'Top-Bar Accent', 'weberium' ),
					'style-4' => esc_html__( 'Hide Top-Bar', 'weberium' ),
				),
				'std'     => 'style-1',
			),
			array(
				'name'    => esc_html__( 'Header Option', 'weberium' ),
				'id'      => 'header_style',
				'type'    => 'select',
				'options' => array(
					'style-1' => esc_html__( 'Header White', 'weberium' ),
					'style-2' => esc_html__( 'Header Dark', 'weberium' ),
					'style-3' => esc_html__( 'Header Accent', 'weberium' ),
					'style-4' => esc_html__( 'Header Transparent', 'weberium' ),
					'style-5' => esc_html__( 'Header Aside', 'weberium' )
				),
				'std'     => 'style-1',
			),
			array(
				'name'    => esc_html__( 'Layout Position', 'weberium' ),
				'id'      => 'page_layout',
				'type'    => 'image_select',
				'options' => array(
					'no-sidebar'  => get_template_directory_uri() . '/assets/admin/img/full-content.png',
					'sidebar-left'  => get_template_directory_uri() . '/assets/admin/img/sidebar-left.png',
					'sidebar-right' => get_template_directory_uri() . '/assets/admin/img/sidebar-right.png',
				),
				'std' 		=> 'no-sidebar',
			),
			array(
				'name'    => esc_html__( 'Sidebar', 'weberium' ),
				'id'      => 'page_sidebar',
				'type'    => 'select',
				'options' => weberium_get_widget_mods(),
				'std'     => 'sidebar-page',
				'desc'    => esc_html__( 'This option do not apply if Layout Position is full-width.', 'weberium' )
			),
			array(
				'name' => esc_html__( 'Hide: Featured Title?', 'weberium' ),
				'id'   => 'hide_featured_title',
				'type' => 'checkbox',
			),
			array(
				'name' => esc_html__( 'Remove: Padding Content?', 'weberium' ),
				'id'   => 'hide_padding_content',
				'type' => 'checkbox',
			),
		)
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'weberium_register_meta_boxes' );

// Enqueue script for handling actions with meta boxes
function weberium_admin_filter_meta_box() {
	wp_enqueue_script( 'weberium-metabox-script', get_template_directory_uri() . '/assets/admin/js/meta-boxes.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'admin_enqueue_scripts', 'weberium_admin_filter_meta_box' );