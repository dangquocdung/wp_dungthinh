<?php

// Framework functions
require_once( get_template_directory() . '/framework/get_mods.php' );
require_once( get_template_directory() . '/framework/framework-functions.php' );
require_once( get_template_directory() . '/framework/sanitize-data.php' );
require_once( get_template_directory() . '/framework/fonts.php' );
require_once( get_template_directory() . '/framework/accent-color.php' );
require_once( get_template_directory() . '/framework/typography.php' );
require_once( get_template_directory() . '/framework/customizer/customizer.php' );
require_once( get_template_directory() . '/framework/metabox-options.php' );
require_once( get_template_directory() . '/framework/widget-areas.php' );
require_once( get_template_directory() . '/framework/breadcrumbs.php' );
require_once( get_template_directory() . '/framework/plugins.php' );
require_once( get_template_directory() . '/framework/theme-woocommerce.php' );
require_once( get_template_directory() . '/framework/demo-install.php' );

// Visual Composer
if ( class_exists( 'Vc_Manager' ) ) {
	require_once( get_template_directory() . '/framework/visual-composer-config.php' );
}

// Sets up theme defaults and registers support for various WordPress features
add_action( 'after_setup_theme', 'weberium_theme_setup' );
function weberium_theme_setup() {
	// Make theme available for translation
	load_theme_textdomain( 'weberium', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title
	add_theme_support( 'title-tag' );

	// Enable woocommerce support
	add_theme_support( 'woocommerce' );

	// Enable support for Post Thumbnails on posts and pages
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'weberium-post-standard', 770, 400, true );
	add_image_size( 'weberium-post-grid', 480, 470, true );
	add_image_size( 'weberium-post-widget', 150, 150, true );

	// Register menus
	register_nav_menu( 'top', esc_html__( 'Top Menu', 'weberium' ) );
	register_nav_menu( 'primary', esc_html__( 'Primary Menu', 'weberium' ) );
	register_nav_menu( 'about', esc_html__( 'About Menu', 'weberium' ) );
	register_nav_menu( 'service', esc_html__( 'Service Menu', 'weberium' ) );
	register_nav_menu( 'bottom', esc_html__( 'Bottom Menu', 'weberium' ) );

	// Switch default core markup for search form, comment form, and comments to output valid HTML5
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Enable support for Post Formats
	add_theme_support( 'post-formats', array(
		'image',
		'gallery',
		'video'
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width
 	 */
	add_editor_style( array( 'assets/css/editor-style.css' ) );
}

// Enqueues scripts and styles
add_action( 'wp_enqueue_scripts', 'weberium_theme_scripts' );
function weberium_theme_scripts() {
	// Vendor Styles
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/css/animate.css', array(), '3.5.2' );
	wp_enqueue_style( 'animsition', get_template_directory_uri() . '/assets/css/animsition.css', array(), '4.0.1' );
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/css/fontawesome.css', array(), '4.7.0' );
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/css/slick.css', array(), '1.6.0' );
	wp_enqueue_style( 'woocommerce', get_template_directory_uri() . '/assets/css/woocommerce.css', array(), '1.0.0' );

	// Theme Style & Icons
	wp_enqueue_style( 'weberium-theme-style', get_stylesheet_uri(), array(), '1.0.0' );
	wp_enqueue_style( 'weberium-theme-icons', get_template_directory_uri() . '/assets/css/theme-icons.css', array(), '1.0.0' );

	// Vendor Scripts
	wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/assets/js/html5shiv.js', array('jquery'), '3.7.3', true );
	wp_enqueue_script( 'respond', get_template_directory_uri() . '/assets/js/respond.js', array('jquery'), '1.3.0', true );
	wp_enqueue_script( 'matchmedia', get_template_directory_uri() . '/assets/js/matchmedia.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'easing', get_template_directory_uri() . '/assets/js/easing.js', array('jquery'), '1.3.0', true );
	wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/assets/js/fitvids.js', array('jquery'), '1.1.0', true );
	wp_enqueue_script( 'animsition', get_template_directory_uri() . '/assets/js/animsition.js', array('jquery'), '4.0.1', true );
	wp_register_script( 'slick', get_template_directory_uri() . '/assets/js/slick.js', array('jquery'), '1.6.0', true );
	wp_register_script( 'isotope', get_template_directory_uri() . '/assets/js/isotope.js', array('jquery'), '3.1.8', true );

	// Theme Script
	wp_enqueue_script( 'weberium-theme-script', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), '1.0.0', true );

	// Comment JS
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
}

// Register widget areas
add_action( 'widgets_init', 'weberium_sidebars_init' );
function weberium_sidebars_init() {
	// Sidebar for Blog
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Blog', 'weberium' ),
		'id'            => 'sidebar-blog',
		'description'   => esc_html__( 'Add widgets here to appear in Sidebar Blog.', 'weberium' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>'
	) );

	// Sidebar for Pages
	register_sidebar( array(
		'name'			=> esc_html__( 'Sidebar Page', 'weberium' ),
		'id'			=> 'sidebar-page',
		'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Page', 'weberium' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h2 class="widget-title"><span>',
		'after_title'	=> '</span></h2>'
	) );

	// Sidebar for Portfolio
	register_sidebar( array(
		'name'			=> esc_html__( 'Sidebar Portfolio', 'weberium' ),
		'id'			=> 'sidebar-portfolio',
		'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Portfolio', 'weberium' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h2 class="widget-title"><span>',
		'after_title'	=> '</span></h2>'
	) );

	// Sidebar for Shop
	register_sidebar( array(
		'name'			=> esc_html__( 'Sidebar Shop', 'weberium' ),
		'id'			=> 'sidebar-shop',
		'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Shop', 'weberium' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h2 class="widget-title"><span>',
		'after_title'	=> '</span></h2>'
	) );

	// 4 Sidebars for Footer
	register_sidebar( array(
		'name'			=> esc_html__( 'Sidebar Footer 1', 'weberium' ),
		'id'			=> 'sidebar-footer-1',
		'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Footer 1', 'weberium' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h2 class="widget-title"><span>',
		'after_title'	=> '</span></h2>'
	) );
	register_sidebar( array(
		'name'			=> esc_html__( 'Sidebar Footer 2', 'weberium' ),
		'id'			=> 'sidebar-footer-2',
		'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Footer 2', 'weberium' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h2 class="widget-title"><span>',
		'after_title'	=> '</span></h2>'
	) );
	register_sidebar( array(
		'name'			=> esc_html__( 'Sidebar Footer 3', 'weberium' ),
		'id'			=> 'sidebar-footer-3',
		'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Footer 3', 'weberium' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h2 class="widget-title"><span>',
		'after_title'	=> '</span></h2>'
	) );
	register_sidebar( array(
		'name'			=> esc_html__( 'Sidebar Footer 4', 'weberium' ),
		'id'			=> 'sidebar-footer-4',
		'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Footer 4', 'weberium' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h2 class="widget-title"><span>',
		'after_title'	=> '</span></h2>'
	) );
}