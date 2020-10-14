<?php
/**
 * Redux Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package architect
 */

if ( ! class_exists( 'ReduxFramewrk' ) ) {
    require_once( get_template_directory() . '/framework/sample-config.php' );
	function removeDemoModeLink() { // Be sure to rename this function to something more unique
		if ( class_exists('ReduxFrameworkPlugin') ) {
			remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
		}
		if ( class_exists('ReduxFrameworkPlugin') ) {
			remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
		}
	}
	add_action('init', 'removeDemoModeLink');
}

if ( ! function_exists( 'architect_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function architect_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Redux Theme, use a find and replace
	 * to change 'architect' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'architect', get_template_directory() . '/languages' );

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
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-header' );
	add_theme_support( 'custom-background' ); 

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'architect' ),
		'rightmenu' => esc_html__( 'Right Menu', 'architect' ),
		'leftmenu' => esc_html__( 'Left Menu', 'architect' ),
		'footermenu' => esc_html__( 'Footer Menu', 'architect' ),
		'shopmenu' => esc_html__( 'Shop Menu', 'architect' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'audio',
		'image',
		'video',
		'gallery',
	) );
}
endif; // architect_setup
add_action( 'after_setup_theme', 'architect_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function architect_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'architect_content_width', 640 );
}
add_action( 'after_setup_theme', 'architect_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function architect_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'architect' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Appears in the sidebar section of the site.', 'architect' ),  
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title text-cap">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar custom', 'architect' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Appears in the sidebar section of the site.', 'architect' ),  
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title text-cap">',
		'after_title'   => '</h3>',
	) );
  	register_sidebar( array(
	    'name'          => __( 'Shop Sidebar', 'architect' ),
	    'id'            => 'shop-sidebar',        
	    'description'   => __( 'Appears in the sidebar section of the site.', 'architect' ),        
	    'before_widget' => '<aside id="%1$s" class="widget %2$s">',        
	    'after_widget'  => '</aside>',        
	    'before_title'  => '<h3 class="widget-title">',        
	    'after_title'   => '</h3>'
    ) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer One Widget Area', 'architect' ),
		'id'            => 'footer-area-1',
		'description'   => esc_html__( 'Footer Widget that appears on the Footer.', 'architect' ),
		'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="text-cap">',
		'after_title'   => '</h4>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Two Widget Area', 'architect' ),
		'id'            => 'footer-area-2',
		'description'   => esc_html__( 'Footer Widget that appears on the Footer.', 'architect' ),
		'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="text-cap">',
		'after_title'   => '</h4>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Three Widget Area', 'architect' ),
		'id'            => 'footer-area-3',
		'description'   => esc_html__( 'Footer Widget that appears on the Footer.', 'architect' ),
		'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="text-cap">',
		'after_title'   => '</h4>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Fourth Widget Area', 'architect' ),
		'id'            => 'footer-area-4',
		'description'   => esc_html__( 'Footer Widget that appears on the Footer.', 'architect' ),
		'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="text-cap">',
		'after_title'   => '</h4>',
	) ); 
}
add_action( 'widgets_init', 'architect_widgets_init' );

/**
 * Enqueue Google fonts.
 */
function architect_fonts_url() {
    $fonts_url = '';

    /* Translators: If there are characters in your language that are not
    * supported by Lora, translate this to 'off'. Do not translate
    * into your own language.
    */
    $montserrat = _x( 'on', 'Montserrat font: on or off', 'architect' );
 
    /* Translators: If there are characters in your language that are not
    * supported by Lora, translate this to 'off'. Do not translate
    * into your own language.
    */
    $roboto = _x( 'on', 'Roboto font: on or off', 'architect' );
 
 
    if ( 'off' !== $montserrat || 'off' !== $roboto ) {
        $font_families = array();

        if ( 'off' !== $montserrat ) {
            $font_families[] = 'Montserrat:400,700';
        }        
 
        if ( 'off' !== $roboto ) {
            $font_families[] = 'Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900italic,900&subset=latin,vietnamese';
        }        
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }
 
    return esc_url_raw( $fonts_url );
}


/**
 * Enqueue scripts and styles.
 */
function architect_scripts() {
	global $architect_option;
	$protocol = is_ssl() ? 'https' : 'http';
	$gmap_api = $architect_option['gmap_api'];

	// Add custom fonts, used in the main stylesheet.
    wp_enqueue_style( 'architect-fonts', architect_fonts_url(), array(), null );

    /** All frontend css files **/ 
    wp_enqueue_style( 'architect-bootstrap', get_template_directory_uri().'/css/bootstrap.min.css');
    wp_enqueue_style( 'architect-font-awesome', get_template_directory_uri().'/css/font-awesome.min.css');
	wp_enqueue_style( 'architect-elegant', get_template_directory_uri().'/css/elegant-font.css');
	wp_enqueue_style( 'architect-linearicons', get_template_directory_uri().'/css/linearicons.css');
	wp_enqueue_style( 'architect-switcher-demo', get_template_directory_uri().'/css/owl.carousel.css'); 
    wp_enqueue_style( 'architect-mCustomScrollbar', get_template_directory_uri().'/css/jquery.mCustomScrollbar.css'); 	
	wp_enqueue_style( 'architect-woocommerce', get_template_directory_uri().'/css/woocommerce.css');
	wp_enqueue_style( 'architect-style', get_stylesheet_uri() );

	// Custom color theme.
	wp_enqueue_style( 'architect-color', get_template_directory_uri() . '/framework/color.php', array( ), '1.0.0' );	

	/** All frontend javascript files **/ 
	wp_enqueue_script( 'architect-bootstrap', get_template_directory_uri() . '/js/vendor/bootstrap.min.js', array('jquery'), '20151228', true );
	wp_enqueue_script( 'architect-fancySelect', get_template_directory_uri() . '/js/plugins/fancySelect.js', array('jquery'), '20151228', true );
	wp_enqueue_script( 'architect-mCustomScrollbar', get_template_directory_uri() . '/js/plugins/jquery.mCustomScrollbar.concat.min.js', array('jquery'), '20151228', true );
	wp_enqueue_script( 'architect-waypoints', get_template_directory_uri() . '/js/plugins/jquery.waypoints.min.js', array('jquery'), '20151228', true );
	wp_enqueue_script( 'architect-skrollr', get_template_directory_uri() . '/js/plugins/skrollr.min.js', array('jquery'), '20151228', true );
	wp_enqueue_script( 'architect-mobile', get_template_directory_uri() . '/js/plugins/jquery.mobile-menu.js', array('jquery'), '20151228', true );
	wp_enqueue_script( 'architect-isotope.pkgd', get_template_directory_uri() . '/js/plugins/isotope.pkgd.min.js', array('jquery'), '20151228', true );	
	wp_enqueue_script( 'architect-custom-isotope', get_template_directory_uri() . '/js/plugins/custom-isotope.js', array('jquery'), '20151228', true );
	wp_enqueue_script( 'architect-owl.carousel', get_template_directory_uri() . '/js/plugins/owl.carousel.js', array('jquery'), '20151228', true );
	wp_enqueue_script( 'architect-custom-owl', get_template_directory_uri() . '/js/plugins/custom-owl.js', array('jquery'), '20151228', true );
	wp_enqueue_script( 'architect-counterup', get_template_directory_uri() . '/js/plugins/jquery.counterup.min.js', array(), '20151228', true );
	
	if ($gmap_api != '') {
		wp_enqueue_script( 'architect-maplace', get_template_directory_uri() . '/js/plugins/maplace.js', array(), '20151228', true );
		wp_enqueue_script( "architect-maps-js", "$protocol://maps.googleapis.com/maps/api/js?key=$gmap_api",array('jquery'),true,true);
	}

  	if($architect_option['show_pre'] == true) { 
  		wp_enqueue_script( 'architect-preloader', get_template_directory_uri() . '/js/plugins/royal_preloader.min.js', array('jquery'), '20151228', true );
	}
	wp_enqueue_script( 'architect-custom', get_template_directory_uri() . '/js/plugins/custom.js', array('jquery'), '20151228', true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'architect_scripts' );

if(!function_exists('architect_custom_frontend_scripts')){
  function architect_custom_frontend_scripts(){
    global $architect_option; 
	if($architect_option['show_pre'] == true) { 
	?>
        <script type="text/javascript">
		    window.jQuery = window.$ = jQuery;  
           	(function($) { "use strict";
           		$(document).ready(function(){
		            Royal_Preloader.config({
		                mode:           'logo',
		                logo:           '<?php echo esc_url($architect_option['img_pre']['url']); ?>',
		                timeout:        1,
		                showInfo:       false,
		                opacity:        1,
		                background:     ['<?php echo esc_attr($architect_option['bg_pre']['rgba']); ?>'],
		            });
		        });
			})(jQuery);
        </script>
    	<?php        
	}
  }
}
add_action('wp_footer', 'architect_custom_frontend_scripts');

//Code Visual Composer.
// Add new Param in Row
if(function_exists('vc_add_param')){
	vc_add_param('vc_row',array(
			"type" => "dropdown",
			"heading" => esc_html__('Setup Full width For Row.', 'architect'),
			"param_name" => "fullwidth",
			"value" => array(   
			                esc_html__('No', 'architect') => 'no',  
			                esc_html__('Yes', 'architect') => 'yes',                                                                                
			              ),
			"description" => esc_html__("Select Full width for row : yes or not, Default: No fullwidth", "architect"),      
        )
    );
	vc_add_param('vc_row',array(
			"type" => "checkbox",
			"heading" => esc_html__('Overlay.', 'architect'),
			"param_name" => "overlay",
			"value" => "",
			"description" => esc_html__("Select yes or no. Default: No", "architect"),      
        )
    );
	vc_add_param('vc_row',array(
			"type" => "colorpicker",
			"heading" => esc_html__('Background color.', 'architect'),
			"param_name" => "bgcolor",
			'dependency' => array(
                'element' => 'overlay',
                'not_empty' => true,
            ),     
   			"value" => '',
			"description" => esc_html__("Select background overlay", "architect"),      
        )
    );

  // Add new Param in Column  
  vc_add_param('vc_column',array(
      "type" => "dropdown",
      "heading" => esc_html__('Animate Column', 'architect'),
      "param_name" => "animate",
      "value" => array(   
              esc_html__('None', 'architect') => 'none',              
              esc_html__('Fade In', 'architect') => 'fadein', 
              esc_html__('Fade In Up', 'architect') => 'fadeinup',
              esc_html__('Fade In Down', 'architect') => 'fadeindown',              
              esc_html__('Fade In Left', 'architect') => 'fadeinleft',  
              esc_html__('Fade In Right', 'architect') => 'fadeinright',
              esc_html__('Slide In Up', 'architect') => 'slideinup',
              esc_html__('Slide In Down', 'architect') => 'slideindown',              
              esc_html__('Slide In Left', 'architect') => 'slideinleft',  
              esc_html__('Slide In Right', 'architect') => 'slideinright',
              esc_html__('Zoom In', 'architect') => 'zoomin',
              esc_html__('Zoom In Down', 'architect') => 'zoomindown',
              esc_html__('Zoom In Left', 'architect') => 'zoominleft',
              esc_html__('Zoom In Right', 'architect') => 'zoominright',
              esc_html__('Zoom In Up', 'architect') => 'zoominup', 
              ),
      "description" => esc_html__("Select Animate , Default: None", 'architect'),      
    ) 
  );

  vc_add_param('vc_column',array(
      "type" => "textfield",
      "heading" => esc_html__('Animate delay number.', 'architect'),
      "param_name" => "animate_delay",
      "value" => "",
      "description" => esc_html__("Example : 0.2, 0.6, 1, etc", 'architect'), 
      "dependency"  => array( 'element' => 'animate', 'value' => array( 'fadeinup', 'fadeindown', 'fadein', 'fadeinleft', 'fadeinright', 'slideinup', 'slideindown', 'slideinleft', 'slideinright', 'zoomin', 'zoomindown', 'zoominleft', 'zoominright', 'zoominup') ),       
    ) 
  );  
		  
}

if(function_exists('vc_remove_param')){
	vc_remove_param( "vc_row", "full_width" );
    vc_remove_param( "vc_row", "content_placement" );  
    vc_remove_param( "vc_row", "gap" );  
    vc_remove_param( "vc_row", "full_height" );  
    vc_remove_param( "vc_row", "columns_placement" );  
    vc_remove_param( "vc_row", "video_bg" );  
    vc_remove_param( "vc_row", "video_bg_url" );  
    vc_remove_param( "vc_row", "video_bg_parallax" );  
    vc_remove_param( "vc_row", "parallax" );   
    vc_remove_param( "vc_row", "parallax_image" );  
    vc_remove_param( "vc_row", "parallax_speed_video" );  
    vc_remove_param( "vc_row", "parallax_speed_bg" );
}	

/**
 * Require plugins install for this theme.
 *
 * @since Split Vcard 1.0
 */
require_once get_template_directory() . '/framework/plugin-requires.php';

/**
 * Implement the Custom Meta Boxs.
 */
require get_template_directory() . '/framework/meta-boxes.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/framework/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
/**
 * Custom woocommerce for this theme.
 */
require get_template_directory() . '/framework/woocommerce-customize.php';
/**
 * Customizer Menu.
 */
require get_template_directory() . '/framework/wp_bootstrap_navwalker.php';



