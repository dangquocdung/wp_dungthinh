<?php
/**
 * studylms functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Studylms
 * @since Studylms 1.18
 */

define( 'STUDYLMS_THEME_VERSION', '1.18' );
define( 'STUDYLMS_DEMO_MODE', false );

if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

if ( ! function_exists( 'studylms_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Studylms 1.0
 */
function studylms_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on studylms, use a find and replace
	 * to change 'studylms' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'studylms', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 825, 510, true );

	add_image_size( 'studylms-event-thumb', 220, 130, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'studylms' ),
		'topmenu'  => esc_html__( 'Top Menu', 'studylms' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	add_theme_support( "woocommerce" );
	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	) );

	$color_scheme  = studylms_get_color_scheme();
	$default_color = trim( $color_scheme[0], '#' );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'studylms_custom_background_args', array(
		'default-color'      => $default_color,
		'default-attachment' => 'fixed',
	) ) );

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	add_theme_support( 'responsive-embeds' );
	
	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	// Enqueue editor styles.
	add_editor_style( array( 'css/style-editor.css', studylms_fonts_url() ) );
	
	studylms_get_load_plugins();
}
endif; // studylms_setup
add_action( 'after_setup_theme', 'studylms_setup' );


/**
 * Load Google Front
 */
function studylms_fonts_url() {
    $fonts_url = '';

    /* Translators: If there are characters in your language that are not
    * supported by Montserrat, translate this to 'off'. Do not translate
    * into your own language.
    */
    $roboto = _x( 'on', 'Roboto+Slab font: on or off', 'studylms' );
    $opensans = _x( 'on', 'Open+Sans font: on or off', 'studylms' );
    $lato    = _x( 'on', 'Lato font: on or off', 'studylms' );
 
    if ( 'off' !== $opensans || 'off' !== $lato || 'off' !== $roboto ) {
        $font_families = array();
 
        if ( 'off' !== $opensans ) {
            $font_families[] = 'Open+Sans:300,400,600,700,800';
        }
        if ( 'off' !== $lato ) {
            $font_families[] = 'Lato:300,400,500,700,900';
        }
 		if ( 'off' !== $roboto ) {
            $font_families[] = 'Roboto+Slab:300,400,700';
        }

        $query_args = array(
            'family' => ( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 		
 		$protocol = is_ssl() ? 'https:' : 'http:';
        $fonts_url = add_query_arg( $query_args, $protocol .'//fonts.googleapis.com/css' );
    }
 
    return esc_url_raw( $fonts_url );
}

function studylms_full_fonts_url() {  
	$protocol = is_ssl() ? 'https:' : 'http:';
	wp_enqueue_style( 'studylms-theme-fonts', studylms_fonts_url(), array(), null );
}
add_action('wp_enqueue_scripts', 'studylms_full_fonts_url');

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Studylms 1.1
 */
function studylms_javascript_detection() {
	wp_add_inline_script( 'studylms-typekit', "(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);" );
}
add_action( 'wp_enqueue_scripts', 'studylms_javascript_detection', 0 );

/**
 * Enqueue scripts and styles.
 *
 * @since Studylms 1.0
 */
function studylms_scripts() {
	// Load our main stylesheet.
	$css_folder = studylms_get_css_folder();
	$js_folder = studylms_get_js_folder();
	$min = studylms_get_asset_min();
	// load bootstrap style
	if( is_rtl() ){
		wp_enqueue_style( 'bootstrap', $css_folder . '/bootstrap-rtl'.$min.'.css', array(), '3.2.0' );
	}else{
		wp_enqueue_style( 'bootstrap', $css_folder . '/bootstrap'.$min.'.css', array(), '3.2.0' );
	}
	$css_path = $css_folder . '/template'.$min.'.css';
	wp_enqueue_style( 'studylms-template', $css_path, array(), '3.2' );
	wp_enqueue_style( 'studylms-style', get_template_directory_uri() . '/style.css', array(), '3.2' );
	//load font awesome
	wp_enqueue_style( 'font-awesomes', $css_folder . '/font-awesome'.$min.'.css', array(), '4.7.0' );

	//load font monia
	wp_enqueue_style( 'font-monia', $css_folder . '/font-monia'.$min.'.css', array(), '1.8.0' );

	// load animate version 3.5.0
	wp_enqueue_style( 'animate-style', $css_folder . '/animate'.$min.'.css', array(), '3.5.0' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_style( 'perfect-scrollbar', $css_folder . '/perfect-scrollbar'.$min.'.css', array(), '2.3.2' );

	wp_enqueue_script( 'bootstrap', $js_folder . '/bootstrap'.$min.'.js', array( 'jquery' ), '20150330', true );
	wp_enqueue_script( 'owl-carousel', $js_folder . '/owl.carousel'.$min.'.js', array( 'jquery' ), '2.0.0', true );
	wp_enqueue_script( 'perfect-scrollbar-jquery', $js_folder . '/perfect-scrollbar.jquery'.$min.'.js', array( 'jquery' ), '2.0.0', true );

	wp_enqueue_script( 'jquery-magnific-popup', $js_folder . '/magnific/jquery.magnific-popup'.$min.'.js', array( 'jquery' ), '1.1.0', true );
	wp_enqueue_style( 'magnific-popup', $js_folder . '/magnific/magnific-popup'.$min.'.css', array(), '1.1.0' );
	
	// lazyload image
	wp_enqueue_script( 'jquery-unveil', $js_folder . '/jquery.unveil'.$min.'.js', array( 'jquery' ), '20150330', true );

	wp_enqueue_script( 'sticky-kit', $js_folder . '/sticky-kit'.$min.'.js', array( 'jquery' ), '1.1.2', true );
	wp_enqueue_script( 'studylms-countdown', $js_folder . '/countdown'.$min.'.js', array( 'jquery' ), '20150330', true );
	
	wp_register_script( 'studylms-functions', $js_folder . '/functions'.$min.'.js', array( 'jquery' ), '20150330', true );
	wp_localize_script( 'studylms-functions', 'studylms_ajax',
		array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'bookmark_view_text' => esc_html__( 'View Your Bookmark ', 'studylms' )
		)
	);
	wp_enqueue_script( 'studylms-functions' );

	if ( studylms_get_config('header_js') != "" ) {
		wp_add_inline_script( 'studylms-header', studylms_get_config('header_js') );
	}
}
add_action( 'wp_enqueue_scripts', 'studylms_scripts', 100 );

function studylms_footer_scripts() {
	if ( studylms_get_config('footer_js') != "" ) {
		wp_add_inline_script( 'studylms-footer', studylms_get_config('footer_js') );
	}
}
add_action('wp_footer', 'studylms_footer_scripts');
/**
 * Display descriptions in main navigation.
 *
 * @since Studylms 1.0
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function studylms_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'studylms_nav_description', 10, 4 );

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since Studylms 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function studylms_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'studylms_search_form_modify' );

/**
 * Function for remove srcset (WP4.4)
 *
 */
function studylms_disable_srcset( $sources ) {
    return false;
}
add_filter( 'wp_calculate_image_srcset', 'studylms_disable_srcset' );

/**
 * Function get opt_name
 *
 */
function studylms_get_opt_name() {
	return 'studylms_theme_options';
}
add_filter( 'apus_framework_get_opt_name', 'studylms_get_opt_name' );

function studylms_register_demo_mode() {
	if ( defined('STUDYLMS_DEMO_MODE') && STUDYLMS_DEMO_MODE ) {
		return true;
	}
	return false;
}
add_filter( 'apus_framework_register_demo_mode', 'studylms_register_demo_mode' );

function studylms_get_demo_preset() {
	$preset = '';
    if ( defined('STUDYLMS_DEMO_MODE') && STUDYLMS_DEMO_MODE ) {
        if ( isset($_GET['_preset']) && $_GET['_preset'] ) {
            $presets = get_option( 'apus_framework_presets' );
            if ( is_array($presets) && isset($presets[$_GET['_preset']]) ) {
                $preset = $_GET['_preset'];
            }
        } else {
            $preset = get_option( 'apus_framework_preset_default' );
        }
    }
    return $preset;
}

function studylms_exporter_settings_option_keys($options) {
	return array_merge($options, array('edr_student_registered', 'edr_quiz_grade', 'edr_membership_register', 'edr_membership_renew', 'edr_tax_classes', 'edr_permalinks', 'edr_settings', 'edr_payment_gateways'));
}
add_filter( 'apus_exporter_settings_option_keys', 'studylms_exporter_settings_option_keys' );

function studylms_get_config($name, $default = '') {
	global $studylms_options;
    if ( isset($studylms_options[$name]) ) {
        return $studylms_options[$name];
    }
    return $default;
}

function studylms_get_global_config($name, $default = '') {
	$options = get_option( 'studylms_theme_options', array() );
	if ( isset($options[$name]) ) {
        return $options[$name];
    }
    return $default;
}

function studylms_get_image_lazy_loading() {
	return studylms_get_config('image_lazy_loading');
}

add_filter( 'apus_framework_get_image_lazy_loading', 'studylms_get_image_lazy_loading');

function studylms_register_sidebar() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Default', 'studylms' ),
		'id'            => 'sidebar-default',
		'description'   => esc_html__( 'Add widgets here to appear in your Sidebar.', 'studylms' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Socials Sidebar', 'studylms' ),
		'id'            => 'socials-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'studylms' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Blog sidebar', 'studylms' ),
		'id'            => 'blog-right-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'studylms' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Product sidebar', 'studylms' ),
		'id'            => 'product-right-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'studylms' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Courses Sidebar', 'studylms' ),
		'id'            => 'course-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'studylms' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Single Course Sidebar', 'studylms' ),
		'id'            => 'single-course-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'studylms' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Event Sidebar', 'studylms' ),
		'id'            => 'single-event-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'studylms' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
}
add_action( 'widgets_init', 'studylms_register_sidebar' );

function studylms_get_load_plugins() {
	// framework
	$plugins[] =(array(
		'name'                     => esc_html__( 'Apus Framework For Themes', 'studylms' ),
        'slug'                     => 'apus-framework',
        'required'                 => true,
        'source'				   => get_template_directory(). '/inc/plugins/apus-framework.zip'
	));

	$plugins[] =(array(
		'name'                     => esc_html__( 'Cmb2', 'studylms' ),
	    'slug'                     => 'cmb2',
	    'required'                 => true,
	));
	
	$plugins[] =(array(
		'name'                     => esc_html__( 'Visual Composer', 'studylms' ),
        'slug'                     => 'js_composer',
        'required'                 => true,
        'source'				   => get_template_directory(). '/inc/plugins/js_composer.zip'
	));

	$plugins[] =(array(
		'name'                     => esc_html__( 'Revolution Slider', 'studylms' ),
        'slug'                     => 'revslider',
        'required'                 => true,
        'source'				   => get_template_directory(). '/inc/plugins/revslider.zip'
	));

	// for woocommerce
	$plugins[] =(array(
		'name'                     => esc_html__( 'WooCommerce', 'studylms' ),
	    'slug'                     => 'woocommerce',
	    'required'                 => true,
	));

	// for other plugins
	$plugins[] =(array(
		'name'                     => esc_html__( 'MailChimp for WordPress', 'studylms' ),
	    'slug'                     => 'mailchimp-for-wp',
	    'required'                 =>  true
	));

	$plugins[] =(array(
		'name'                     => esc_html__( 'Contact Form 7', 'studylms' ),
	    'slug'                     => 'contact-form-7',
	    'required'                 => true,
	));

	$plugins[] =(array(
		'name'                     => esc_html__( 'Educator 2', 'studylms' ),
	    'slug'                     => 'educator',
	    'required'                 => true,
	    'source'				   => get_template_directory(). '/inc/plugins/educator.zip'
	));
	
	$plugins[] =(array(
		'name'                     => esc_html__( 'The Events Calendar', 'studylms' ),
	    'slug'                     => 'the-events-calendar',
	    'required'                 => true,
	));

	$plugins[] =(array(
		'name'                     => esc_html__( 'WP User Avatars', 'studylms' ),
	    'slug'                     => 'wp-user-avatars',
	    'required'                 => true,
	));
	
	tgmpa( $plugins );
}

require get_template_directory() . '/inc/plugins/class-tgm-plugin-activation.php';
require get_template_directory() . '/inc/functions-helper.php';
require get_template_directory() . '/inc/functions-frontend.php';

/**
 * Implement the Custom Header feature.
 *
 */
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/classes/megamenu.php';
require get_template_directory() . '/inc/classes/mobilemenu.php';

/**
 * Custom template tags for this theme.
 *
 */
require get_template_directory() . '/inc/template-tags.php';


if ( defined( 'APUS_FRAMEWORK_REDUX_ACTIVED' ) ) {
	require get_template_directory() . '/inc/vendors/redux-framework/redux-config.php';
	define( 'STUDYLMS_REDUX_FRAMEWORK_ACTIVED', true );
}
if( in_array( 'cmb2/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require get_template_directory() . '/inc/vendors/cmb2/page.php';
	require get_template_directory() . '/inc/vendors/cmb2/footer.php';
	require get_template_directory() . '/inc/vendors/cmb2/educator.php';
	require get_template_directory() . '/inc/vendors/cmb2/event.php';
	define( 'STUDYLMS_CMB2_ACTIVED', true );
}
if( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require get_template_directory() . '/inc/vendors/woocommerce/functions.php';
	define( 'STUDYLMS_WOOCOMMERCE_ACTIVED', true );
}
if( in_array( 'js_composer/js_composer.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require get_template_directory() . '/inc/vendors/visualcomposer/functions.php';
	require get_template_directory() . '/inc/vendors/visualcomposer/google-maps-styles.php';
	if ( defined('WPB_VC_VERSION') && version_compare( WPB_VC_VERSION, '6.0', '>=' ) ) {
		require get_template_directory() . '/inc/vendors/visualcomposer/vc-map-posts2.php';
	} else {
		require get_template_directory() . '/inc/vendors/visualcomposer/vc-map-posts.php';
	}
	require get_template_directory() . '/inc/vendors/visualcomposer/vc-map-theme.php';
	define( 'STUDYLMS_JS_COMPOSER_ACTIVED', true );
}
if( in_array( 'educator/educator.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require get_template_directory() . '/inc/vendors/educator/functions.php';
	require get_template_directory() . '/inc/vendors/educator/functions-user.php';
	require get_template_directory() . '/inc/vendors/educator/functions-review.php';
	require get_template_directory() . '/inc/vendors/educator/vc-map.php';
	require get_template_directory() . '/inc/vendors/educator/functions-bookmark.php';
	define( 'STUDYLMS_EDUCATOR_ACTIVED', true );
}
if( in_array( 'the-events-calendar/the-events-calendar.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require get_template_directory() . '/inc/vendors/the-events-calendar/functions.php';
	require get_template_directory() . '/inc/vendors/the-events-calendar/vc-map.php';
	define( 'STUDYLMS_EVENT_ACTIVED', true );
}
if( in_array( 'apus-framework/apus-framework.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require get_template_directory() . '/inc/widgets/contact-info.php';
	require get_template_directory() . '/inc/widgets/custom_menu.php';
	require get_template_directory() . '/inc/widgets/recent_comment.php';
	require get_template_directory() . '/inc/widgets/recent_post.php';
	require get_template_directory() . '/inc/widgets/search.php';
	require get_template_directory() . '/inc/widgets/single_image.php';
	require get_template_directory() . '/inc/widgets/socials.php';
	require get_template_directory() . '/inc/widgets/course-category.php';
	require get_template_directory() . '/inc/widgets/courses.php';
	define( 'STUDYLMS_FRAMEWORK_ACTIVED', true );
}
/**
 * Customizer additions.
 *
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom Styles
 *
 */
require get_template_directory() . '/inc/custom-styles.php';