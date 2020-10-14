<?php
global $theme_option;

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

//Custom fields:
require_once dirname( __FILE__ ) . '/framework/bfi_thumb-master/BFI_Thumb.php';
require_once dirname( __FILE__ ) . '/framework/meta-boxes.php';
require_once dirname( __FILE__ ) . '/shortcodes.php';
require_once dirname( __FILE__ ) . '/framework/wp_bootstrap_navwalker.php';
//Theme Set up:
function calliope_theme_setup() {

	/*

	 * Make theme available for translation.

	 * Translations can be filed in the /languages/ directory.

	 * If you're building a theme based on cubic, use a find and replace

	 * to change 'cubic' to the name of your theme in all the template files

	 */

	load_theme_textdomain( 'calliope', get_template_directory() . '/languages' );

    /*
     * This theme uses a custom image size for featured images, displayed on
     * "standard" posts and pages.
     */
	add_theme_support( 'custom-header' ); 
	add_theme_support( 'custom-background' );
	
    add_theme_support( 'post-thumbnails' );
    // Adds RSS feed links to <head> for posts and comments.
    add_theme_support( 'automatic-feed-links' );
    // Switches default core markup for search form, comment form, and comments
    // to output valid HTML5.
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
    //Post formats
    add_theme_support( 'post-formats', array(
        'audio',  'gallery', 'image', 'video'
    ) );
    // This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
	'other'   => __('Primary Menu','calliope'),
	'primary'   => __('Onepage Menu(use for Canvas Template)','calliope'),
	) );
    // This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
    add_shortcode('gallery', '__return_false');
}
add_action( 'after_setup_theme', 'calliope_theme_setup' );
if ( ! isset( $content_width ) ) $content_width = 900;

function calliope_theme_scripts_styles() {
	global $theme_option;
	$protocol = is_ssl() ? 'https' : 'http';	
	wp_enqueue_style( 'fonts-Lato', "$protocol://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic", true);
	wp_enqueue_style( 'fonts-Satisfy', "$protocol://fonts.googleapis.com/css?family=Satisfy", true);
	wp_enqueue_style( 'fonts-Montserrat', "$protocol://fonts.googleapis.com/css?family=Montserrat:400,700", true);
	wp_enqueue_style( 'fonts-OpenSans', "$protocol://fonts.googleapis.com/css?family=Open+Sans&subset=latin,cyrillic-ext,greek-ext,greek,vietnamese,latin-ext,cyrillic", true);
	wp_enqueue_style( 'base', get_template_directory_uri().'/css/base.css"');
	wp_enqueue_style( 'skeleton', get_template_directory_uri().'/css/skeleton.css');
	wp_enqueue_style( 'fontawesome', get_template_directory_uri().'/css/font-awesome.css');	
	wp_enqueue_style( 'carousel', get_template_directory_uri().'/css/owl.carousel.css');
	wp_enqueue_style( 'colorbox', get_template_directory_uri().'/css/colorbox.css"');
	wp_enqueue_style( 'retina', get_template_directory_uri().'/css/retina.css');
	wp_enqueue_style( 'style', get_stylesheet_uri(), array(), '2015-05-05' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ){
    	wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_style( 'color', get_template_directory_uri().'/framework/color.php');

	wp_enqueue_script("jquery");		
	wp_enqueue_script("modernizr", get_template_directory_uri()."/js/modernizr.custom.js",array(),false,true);
	wp_enqueue_script("slimmenu", get_template_directory_uri()."/js/jquery.slimmenu.js",array(),false,true);
	wp_enqueue_script("retina", get_template_directory_uri()."/js/retina-1.1.0.min.js",array(),false,true);
	wp_enqueue_script("easing", get_template_directory_uri()."/js/jquery.easing.js",array(),false,true);		
	wp_enqueue_script("flippy", get_template_directory_uri()."/js/flippy.js",array(),false,true);
	wp_enqueue_script("bxslider", get_template_directory_uri()."/js/jquery.bxslider.min.js",array(),false,true);
	wp_enqueue_script("parallax", get_template_directory_uri()."/js/jquery.parallax-1.1.3.js",array(),false,true);
	
	wp_enqueue_script("fitvids", get_template_directory_uri()."/js/jquery.fitvids.js",array(),false,true);  
	
	if ( !is_home() && !is_single() ) {
	wp_enqueue_script("mapapi", "$protocol://maps.google.com/maps/api/js?key=AIzaSyAvpnlHRidMIU374bKM5-sx8ruc01OvDjI",array(),false,false); 
	wp_enqueue_script("bgndGallery", get_template_directory_uri()."/js/mb.bgndGallery.js",array(),false,false);
	wp_enqueue_script("colorbox", get_template_directory_uri()."/js/jquery.colorbox.js",array(),false,true);  
	wp_enqueue_script("localscroll", get_template_directory_uri()."/js/jquery.localscroll-1.2.7-min.js",array(),false,true);
	wp_enqueue_script("ascensor", get_template_directory_uri()."/js/jquery.ascensor.js",array(),false,true);    
	wp_enqueue_script("carousel", get_template_directory_uri()."/js/owl.carousel.js",array(),false,true);
	wp_enqueue_script("nicescroll", get_template_directory_uri()."/js/jquery.nicescroll.min.js",array(),false,true);
	wp_enqueue_script("custombox", get_template_directory_uri()."/js/jquery.fs.tipper.min.js",array(),false,true);
	wp_enqueue_script("typer", get_template_directory_uri()."/js/jquery.typer.js",array(),false,true);
	wp_enqueue_script("isotope-js", get_template_directory_uri()."/js/jquery.isotope.min.js",array(),false,true);
	wp_enqueue_script("template", get_template_directory_uri()."/js/template.js",array(),false,true);
	}else{
	wp_enqueue_script("blog-custom", get_template_directory_uri()."/js/blog.js",array(),false,true);
	}
}
add_action( 'wp_enqueue_scripts', 'calliope_theme_scripts_styles');

if(!function_exists('calliope_custom_frontend_style')){
	function calliope_custom_frontend_style(){
	global $theme_option;
	echo '<style type="text/css">'.$theme_option['custom-css'].'</style>';
}
}
add_action('wp_head', 'calliope_custom_frontend_style');

//Custom Excerpt Function
function calliope_do_shortcode($content) {
    global $shortcode_tags;
    if (empty($shortcode_tags) || !is_array($shortcode_tags))
        return $content;
    $pattern = get_shortcode_regex();
    return preg_replace_callback( "/$pattern/s", 'do_shortcode_tag', $content );
}
// Widget Sidebar
function calliope_widgets_init() {
	register_sidebar( array(
        'name'          => __( 'Primary Sidebar', 'calliope' ),
        'id'            => 'sidebar-1',        
		'description'   => __( 'Appears in the sidebar section of the site.', 'calliope' ),        
		'before_widget' => '<div id="%1$s" class="widget %2$s">',        
		'after_widget'  => '</div>',        
		'before_title'  => '<h6>',        
		'after_title'   => '</h6>'
    ) );
}
add_action( 'widgets_init', 'calliope_widgets_init' );

//Create a nicely formatted and more specific title element text for output
function calliope_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}
	
	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'calliope' ), max( $paged, $page ) );
	}
	
	return $title;
}
add_filter( 'wp_title', 'calliope_wp_title', 10, 2 );

//function tag widgets
function calliope_tag_cloud_widget($args) {
	$args['number'] = 0; //adding a 0 will display all tags
	$args['largest'] = 18; //largest tag
	$args['smallest'] = 11; //smallest tag
	$args['unit'] = 'px'; //tag font unit
	$args['format'] = 'list'; //ul with a class of wp-tag-cloud
	$args['exclude'] = array(20, 80, 92); //exclude tags by ID
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'calliope_tag_cloud_widget' );
function calliope_excerpt() {
  global $theme_option;
  if($theme_option['blog_excerpt'] && is_int($theme_option['blog_excerpt'])){
    $limit = $theme_option['blog_excerpt'];
  }else{
    $limit = 30;
  }
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}

// Excerpt Section Blog Post
function calliope_blog_excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}

//pagination
function calliope_pagination($prev = '<i class="fa fa-angle-double-left"></i>', $next = '<i class="fa fa-angle-double-right"></i>', $pages='') {
    global $wp_query, $wp_rewrite;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    if($pages==''){
        global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
    }
    $pagination = array(
		'base' 			=> str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
		'format' 		=> '',
		'current' 		=> max( 1, get_query_var('paged') ),
		'total' 		=> $pages,
		'prev_text' => __($prev,'calliope'),
    	'next_text' => __($next,'calliope'),		'type'			=> 'list',
		'end_size'		=> 3,
		'mid_size'		=> 3
);
    $return =  paginate_links( $pagination );
	echo str_replace( "<ul class='page-numbers'>", '<ul>', $return );
}
//Get thumbnail url
function calliope_thumbnail_url($size){
    global $post;
    //$url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()),$size );
    if($size==''){
        $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
         return $url;
    }else{
        $url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), $size);
         return $url[0];
    }
}

function calliope_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" class="search_form" action="' . home_url( '/' ) . '" >  
    	<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="'.__('type to search and hit enter', 'calliope').'" />
    </form>';
    return $form;
}
add_filter( 'get_search_form', 'calliope_search_form' );
//Custom comment List:

// Comment Form
function calliope_theme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <div class="post-down">
		<div class="rpl-but"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div> 
		<?php echo get_avatar($comment,$size='70',$default='http://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=70' ); ?>
		<h6><?php printf(__('%s','calliope'), get_comment_author_link()) ?> <span>on <?php $d = "F j, Y \A\T h a"; printf(get_comment_date($d)) ?></span></h6>
		<?php if ($comment->comment_approved == '0'){ ?>
			 <p><em><?php _e('Your comment is awaiting moderation.','calliope') ?></em></p>
		<?php }else{ ?>
        <?php comment_text() ?>
		<?php } ?>
	  	<div class="clearfix"></div>	
	</div>  
<?php
}

//Code Visual Compurso.
require_once dirname( __FILE__ ) . '/vc_shortcode.php';
//if(class_exists('WPBakeryVisualComposerSetup')){
function calliope_custom_css_classes_for_vc_row_and_vc_column($class_string, $tag) {
    if($tag=='vc_row' || $tag=='vc_row_inner') {
        $class_string = str_replace('vc_row-fluid', '', $class_string);
    }
    if($tag=='vc_column' || $tag=='vc_column_inner') {
		$class_string = preg_replace('/vc_col-sm-12/', 'twelve columns', $class_string);
		$class_string = preg_replace('/vc_col-sm-6/', 'six columns', $class_string);
		$class_string = preg_replace('/vc_col-sm-4/', 'four columns', $class_string);
		$class_string = preg_replace('/vc_col-sm-3/', 'three columns', $class_string);
		$class_string = preg_replace('/vc_col-sm-5/', 'five columns', $class_string);
		$class_string = preg_replace('/vc_col-sm-7/', 'seven columns', $class_string);
		$class_string = preg_replace('/vc_col-sm-8/', 'eight columns', $class_string);
		$class_string = preg_replace('/vc_col-sm-9/', 'nine columns', $class_string);
		$class_string = preg_replace('/vc_col-sm-10/', 'ten columns', $class_string);
		$class_string = preg_replace('/vc_col-sm-11/', 'eleven columns', $class_string);
		$class_string = preg_replace('/vc_col-sm-1/', 'one columns', $class_string);
		$class_string = preg_replace('/vc_col-sm-2/', 'two columns', $class_string);
    }
    return $class_string;
}
// Filter to Replace default css class for vc_row shortcode and vc_column
add_filter('vc_shortcodes_css_class', 'calliope_custom_css_classes_for_vc_row_and_vc_column', 10, 2); 
// Add new Param in Row
if(function_exists('vc_add_param')){

vc_add_param('vc_row',array(
                              "type" => "dropdown",
                              "heading" => __('Parent Section', 'wpb'),
                              "param_name" => "page",
                              "value" => array(   
                                                __('Yes', 'wpb') => 'yes',
                                                __('No', 'wpb') => 'no',  
                                                                                                                                
                                              ),
                              "description" => __("Select 'Yes' when creat a page scroll, Default: No ", "wpb"),      
                            ) 
    );
vc_add_param('vc_row',array(
                              "type" => "dropdown",
                              "heading" => __('Show Footer In Bottom', 'wpb'),
                              "param_name" => "foot",
                              "value" => array(  
                                                __('No', 'wpb') => 'no',
                                                __('Yes', 'wpb') => 'yes',                                                 
                                                                                                                               
                                              ),
                              "description" => __("Use when Parent Section choose 'Yes'.", "wpb"),      
                            ) 
    );
vc_add_param('vc_row',array(
                              "type" => "checkbox",
                              "heading" => __('Fullwidth?', 'wpb'),
                              "param_name" => "fullwidth",
                              "description" => __("Select Fullwidth or not, Default: No fullwidth", "wpb"),      
                            ) 
    );
vc_add_param('vc_row_inner',array(
                              "type" => "checkbox",
                              "heading" => __('Fullwidth?', 'wpb'),
                              "param_name" => "fullwidth",
                              "description" => __("Select Fullwidth or not, Default: No fullwidth", "wpb"),      
                            ) 
    );

vc_remove_param( "vc_row", "parallax" );
vc_remove_param( "vc_row", "parallax_image" );
vc_remove_param( "vc_row", "full_width" );
vc_remove_param( "vc_row", "full_height" );
vc_remove_param( "vc_row", "video_bg" );
vc_remove_param( "vc_row", "video_bg_parallax" );
vc_remove_param( "vc_row", "content_placement" );
vc_remove_param( "vc_row", "video_bg_url" );
vc_remove_param( "vc_row", "columns_placement" );
vc_remove_param( "vc_row", "gap" );
vc_remove_param( "vc_row", "equal_height" );
vc_remove_param( "vc_row", "parallax_speed_video" );
vc_remove_param( "vc_row", "parallax_speed_bg" );
vc_remove_param( "vc_row", "disable_element" );
vc_remove_element( "vc_basic_grid" );
vc_remove_element( "vc_masonry_grid" );
vc_remove_element( "vc_media_grid" );
vc_remove_element( "vc_masonry_media_grid" );
}
//}


require_once dirname( __FILE__ ) . '/framework/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'calliope_theme_register_required_plugins' );

function calliope_theme_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$protocol = is_ssl() ? 'http' : 'http';
	$plugins = array(

		// This is an example of how to include a plugin from a private repo in your theme.
		array(            
			'name'               => 'WPBakery Visual Composer', // The plugin name.
            'slug'               => 'js_composer', // The plugin slug (typically the folder name).
            'source'             => esc_url($protocol.'://oceanthemes.net/plugins-required/js_composer.zip'), // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ),         
        array(
            'name'      => 'Redux Framework',
            'slug'      => 'redux-framework',
            'required'           => true,
			'force_activation'   => false,
            'force_deactivation' => false,
        ),
		array(            
			'name'               => 'OT Portfolio', // The plugin name.
            'slug'               => 'ot-portfolio', // The plugin slug (typically the folder name).
            'source'             => get_template_directory_uri() . '/framework/plugins/ot-portfolio.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),
        array(            
			'name'               => 'OT Testimonial', // The plugin name.
            'slug'               => 'ot-testimonial', // The plugin slug (typically the folder name).
            'source'             => get_template_directory_uri() . '/framework/plugins/ot-testimonial.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ), 
        // This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
            'name'      => 'Contact Form 7',
            'slug'      => 'contact-form-7',
            'required'  => false,
        ),
        // This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
            'name'      => 'Meta Box',
            'slug'      => 'meta-box',
            'required'  => true,
        ),

	);

	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to pre-packaged plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'theme-slug' ),
			'menu_title'                      => __( 'Install Plugins', 'theme-slug' ),
			'installing'                      => __( 'Installing Plugin: %s', 'theme-slug' ), // %s = plugin name.
			'oops'                            => __( 'Something went wrong with the plugin API.', 'theme-slug' ),
			'notice_can_install_required'     => _n_noop(
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_can_install_recommended'  => _n_noop(
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_cannot_install'           => _n_noop(
				'Sorry, but you do not have the correct permissions to install the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to install the %1$s plugins.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_ask_to_update'            => _n_noop(
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_ask_to_update_maybe'      => _n_noop(
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_cannot_update'            => _n_noop(
				'Sorry, but you do not have the correct permissions to update the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to update the %1$s plugins.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_can_activate_required'    => _n_noop(
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_can_activate_recommended' => _n_noop(
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_cannot_activate'          => _n_noop(
				'Sorry, but you do not have the correct permissions to activate the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to activate the %1$s plugins.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'theme-slug'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'theme-slug'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'theme-slug'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'theme-slug' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'theme-slug' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'theme-slug' ),
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'theme-slug' ),  // %1$s = plugin name(s).
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'theme-slug' ),  // %1$s = plugin name(s).
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'theme-slug' ), // %s = dashboard link.
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'tgmpa' ),

			'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		)
	);

	tgmpa( $plugins, $config );

}
?>