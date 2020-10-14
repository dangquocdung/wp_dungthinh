<?php
/**
 * Digitech functions and definitions
 */

/**
* Require files
*/
	//TGM-Plugin-Activation
require_once( get_template_directory().'/class-tgm-plugin-activation.php' );
	//Init the Redux Framework
if ( class_exists( 'ReduxFramework' ) && !isset( $redux_demo ) && file_exists( get_template_directory().'/theme-config.php' ) ) {
	require_once( get_template_directory().'/theme-config.php' );
}
	// Theme files
if ( !class_exists( 'roadthemes_widgets' ) && file_exists( get_template_directory().'/include/roadthemeswidgets.php' ) ) {
	require_once( get_template_directory().'/include/roadthemeswidgets.php' );
}
if ( file_exists( get_template_directory().'/include/wooajax.php' ) ) {
	require_once( get_template_directory().'/include/wooajax.php' );
}
if ( file_exists( get_template_directory().'/include/map_shortcodes.php' ) ) {
	require_once( get_template_directory().'/include/map_shortcodes.php' );
}
if ( file_exists( get_template_directory().'/include/shortcodes.php' ) ) {
	require_once( get_template_directory().'/include/shortcodes.php' );
}
define('PLUGIN_REQUIRED_PATH','http://roadthemes.com/plugins');
Class Digitech_Class {
	
	/**
	* Global values
	*/
	static function digitech_post_odd_event(){
		global $wp_session;
		
		if(!isset($wp_session["digitech_postcount"])){
			$wp_session["digitech_postcount"] = 0;
		}
		
		$wp_session["digitech_postcount"] = 1 - $wp_session["digitech_postcount"];
		
		return $wp_session["digitech_postcount"];
	}
	static function digitech_post_thumbnail_size($size){
		global $wp_session;
		
		if($size!=''){
			$wp_session["digitech_postthumb"] = $size;
		}
		
		return $wp_session["digitech_postthumb"];
	}
	static function digitech_shop_class($class){
		global $wp_session;
		
		if($class!=''){
			$wp_session["digitech_shopclass"] = $class;
		}
		
		return $wp_session["digitech_shopclass"];
	}
	static function digitech_show_view_mode(){

		$digitech_opt = get_option( 'digitech_opt' );
		
		$digitech_viewmode = 'grid-view'; //default value
		
		if(isset($digitech_opt['default_view'])) {
			$digitech_viewmode = $digitech_opt['default_view'];
		}
		if(isset($_GET['view']) && $_GET['view']!=''){
			$digitech_viewmode = $_GET['view'];
		}
		
		return $digitech_viewmode;
	}
	static function digitech_shortcode_products_count(){
		global $wp_session;
		
		$digitech_productsfound = 0;
		if(isset($wp_session["digitech_productsfound"])){
			$digitech_productsfound = $wp_session["digitech_productsfound"];
		}
		
		return $digitech_productsfound;
	}
	
	/**
	* Constructor
	*/
	function __construct() {
		// Register action/filter callbacks
		
			//WooCommerce - action/filter
		add_theme_support( 'woocommerce' );
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
		add_filter( 'get_product_search_form', array($this, 'digitech_woo_search_form'));
		add_filter( 'woocommerce_shortcode_products_query', array($this, 'digitech_woocommerce_shortcode_count'));
		add_action( 'woocommerce_share', array($this, 'digitech_woocommerce_social_share'), 35 );
		add_action( 'woocommerce_archive_description', array($this, 'digitech_woocommerce_category_image'), 2 );

		add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
		    return array(
		        'width'  => 150,
		        'height' => 150,
		        'crop'   => 0,
		    );
		} );
		
			//move message to top
		remove_action( 'woocommerce_before_shop_loop', 'wc_print_notices', 10 );
		add_action( 'woocommerce_show_message', 'wc_print_notices', 10 );

		//remove add to cart button after item
		remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

		// remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
		
			//Single product organize
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 15 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 15 );
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
		
			//Theme actions
		add_action( 'after_setup_theme', array($this, 'digitech_setup'));
		add_action( 'tgmpa_register', array($this, 'digitech_register_required_plugins')); 
		add_action( 'widgets_init', array($this, 'digitech_override_woocommerce_widgets'), 15 );
		
		add_action( 'wp_enqueue_scripts', array($this, 'digitech_scripts_styles') );
		add_action( 'wp_head', array($this, 'digitech_custom_code_header'));
		add_action( 'widgets_init', array($this, 'digitech_widgets_init'));
		add_action( 'save_post', array($this, 'digitech_save_meta_box_data'));
		add_action('comment_form_before_fields', array($this, 'digitech_before_comment_fields'));
		add_action('comment_form_after_fields', array($this, 'digitech_after_comment_fields'));
		add_action( 'customize_register', array($this, 'digitech_customize_register'));
		add_action( 'customize_preview_init', array($this, 'digitech_customize_preview_js'));
		add_action('admin_enqueue_scripts', array($this, 'digitech_admin_style'));
		
			//Theme filters
		add_filter( 'loop_shop_per_page', array($this, 'digitech_woo_change_per_page'), 20 );
		add_filter( 'woocommerce_output_related_products_args', array($this, 'digitech_woo_related_products_limit'));
		add_filter( 'get_search_form', array($this, 'digitech_search_form'));
		add_filter('excerpt_more', array($this, 'digitech_new_excerpt_more'));
		add_filter( 'excerpt_length', array($this, 'digitech_change_excerpt_length'), 999 );
		add_filter('wp_nav_menu_objects', array($this, 'digitech_first_and_last_menu_class'));
		add_filter( 'wp_page_menu_args', array($this, 'digitech_page_menu_args'));
		add_filter('dynamic_sidebar_params', array($this, 'digitech_widget_first_last_class'));
		add_filter('dynamic_sidebar_params', array($this, 'digitech_mega_menu_widget_change'));
		add_filter( 'dynamic_sidebar_params', array($this, 'digitech_put_widget_content'));
		
		//Adding theme support
		if ( ! isset( $content_width ) ) {
			$content_width = 625;
		}
	}
	
	/**
	* Filter callbacks
	* ----------------
	*/
	// Change products per page
	function digitech_woo_change_per_page() {
		$digitech_opt = get_option( 'digitech_opt' );
		
		return $digitech_opt['product_per_page'];
	}
	//Change number of related products on product page. Set your own value for 'posts_per_page'
	function digitech_woo_related_products_limit( $args ) {
		global $product;

		$digitech_opt = get_option( 'digitech_opt' );

		$args['posts_per_page'] = $digitech_opt['related_amount'];

		return $args;
	}
	// Count number of products from shortcode
	function digitech_woocommerce_shortcode_count( $args ) {
		$digitech_productsfound = new WP_Query($args);
		$digitech_productsfound = $digitech_productsfound->post_count;
		
		global $wp_session;
		
		$wp_session["digitech_productsfound"] = $digitech_productsfound;
		
		return $args;
	}
	//Change search form
	function digitech_search_form( $form ) {
		if(get_search_query()!=''){
			$search_str = get_search_query();
		} else {
			$search_str = esc_html__( 'Search... ', 'digitech' );
		}
		
		$form = '<form role="search" method="get" class="searchform blogsearchform" action="' . esc_url(home_url( '/' ) ). '" >
		<div class="form-input">
			<input class="input_text search_input" type="text" placeholder="'.esc_attr($search_str).'" name="s" />
			<button class="button-search blogsearchsubmit" type="submit"><i class="fa fa-search"></i></button>
			<input type="hidden" name="post_type" value="post" />
			</div>
		</form>';
		
		return $form;
	}
	//Change woocommerce search form
	function digitech_woo_search_form( $form ) {
		global $wpdb;
		
		if(get_search_query()!=''){
			$search_str = get_search_query();
		} else {
			$search_str = esc_html__( 'Search product...', 'digitech' );
		}
		
		$form = '<form role="search" method="get" class="searchform productsearchform" action="'.esc_url( home_url( '/'  ) ).'">';
			$form .= '<div class="form-input">';
				$form .= '<input type="text" placeholder="'.esc_attr($search_str).'" name="s" class="ws"/>';
				$form .= '<button class="btn btn-primary wsearchsubmit" type="submit">' . esc_html__('Search', 'digitech') . '</button>';
				$form .= '<input type="hidden" name="post_type" value="product" />';
			$form .= '</div>';
		$form .= '</form>';
		
		return $form;
	}
	// Replaces the excerpt "more" text by a link
	function digitech_new_excerpt_more($more) {
		return '';
	}
	//Change excerpt length
	function digitech_change_excerpt_length( $length ) {
		$digitech_opt = get_option( 'digitech_opt' );
		
		if(isset($digitech_opt['excerpt_length'])){
			return $digitech_opt['excerpt_length'];
		}
		
		return 50;
	}
	//Add 'first, last' class to menu
	function digitech_first_and_last_menu_class($items) {
		$items[1]->classes[] = 'first';
		$items[count($items)]->classes[] = 'last';
		return $items;
	}
	/**
	 * Filter the page menu arguments.
	 *
	 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
	 *
	 * @since Digitech 1.0
	 */
	function digitech_page_menu_args( $args ) {
		if ( ! isset( $args['show_home'] ) )
			$args['show_home'] = true;
		return $args;
	}
	//Add first, last class to widgets
	function digitech_widget_first_last_class($params) {
		global $my_widget_num;
		
		$class = '';
		
		$this_id = $params[0]['id']; // Get the id for the current sidebar we're processing
		$arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets	

		if(!$my_widget_num) {// If the counter array doesn't exist, create it
			$my_widget_num = array();
		}

		if(!isset($arr_registered_widgets[$this_id]) || !is_array($arr_registered_widgets[$this_id])) { // Check if the current sidebar has no widgets
			return $params; // No widgets in this sidebar... bail early.
		}

		if(isset($my_widget_num[$this_id])) { // See if the counter array has an entry for this sidebar
			$my_widget_num[$this_id] ++;
		} else { // If not, create it starting with 1
			$my_widget_num[$this_id] = 1;
		}

		if($my_widget_num[$this_id] == 1) { // If this is the first widget
			$class .= ' widget-first ';
		} elseif($my_widget_num[$this_id] == count($arr_registered_widgets[$this_id])) { // If this is the last widget
			$class .= ' widget-last ';
		}
		
		$params[0]['before_widget'] = str_replace('first_last', ' '.$class.' ', $params[0]['before_widget']);
		
		return $params;
	}
	//Change mega menu widget from div to li tag
	function digitech_mega_menu_widget_change($params) {
		
		$sidebar_id = $params[0]['id'];
		
		$pos = strpos($sidebar_id, '_menu_widgets_area_');
		
		if ( !$pos == false ) {
			$params[0]['before_widget'] = '<li class="widget_mega_menu">'.$params[0]['before_widget'];
			$params[0]['after_widget'] = $params[0]['after_widget'].'</li>';
		}
		
		return $params;
	}
	// Push sidebar widget content into a div
	function digitech_put_widget_content( $params ) {
		global $wp_registered_widgets;

		if( $params[0]['id']=='sidebar-category' ){
			$settings_getter = $wp_registered_widgets[ $params[0]['widget_id'] ]['callback'][0];
			$settings = $settings_getter->get_settings();
			$settings = $settings[ $params[1]['number'] ];
			
			if($params[0]['widget_name']=="Text" && isset($settings['title']) && $settings['text']=="") { // if text widget and no content => don't push content
				return $params;
			}
			if( isset($settings['title']) && $settings['title']!='' ){
				$params[0][ 'after_title' ] .= '<div class="widget_content">';
				$params[0][ 'after_widget' ] = '</div>'.$params[0][ 'after_widget' ];
			} else {
				$params[0][ 'before_widget' ] .= '<div class="widget_content">';
				$params[0][ 'after_widget' ] = '</div>'.$params[0][ 'after_widget' ];
			}
		}
		
		return $params;
	}
	
	/**
	* Action hooks
	* ----------------
	*/
	/**
	 * Digitech setup.
	 *
	 * Sets up theme defaults and registers the various WordPress features that
	 * Digitech supports.
	 *
	 * @uses load_theme_textdomain() For translation/localization support.
	 * @uses add_editor_style() To add a Visual Editor stylesheet.
	 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
	 * 	custom background, and post formats.
	 * @uses register_nav_menu() To add support for navigation menus.
	 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
	 *
	 * @since Digitech 1.0
	 */
	function digitech_setup() {
		/*
		 * Makes Digitech available for translation.
		 *
		 * Translations can be added to the /languages/ directory.
		 * If you're building a theme based on Digitech, use a find and replace
		 * to change 'digitech' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'digitech', get_template_directory() . '/languages' );

		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();

		// Adds RSS feed links to <head> for posts and comments.
		add_theme_support( 'automatic-feed-links' );

		// This theme supports a variety of post formats.
		add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'audio' ) );

		// Register menus
		register_nav_menu( 'primary', esc_html__( 'Primary Menu', 'digitech' ) );
		register_nav_menu( 'mobilemenu', esc_html__( 'Mobile Menu', 'digitech' ) );
		register_nav_menu( 'categories', esc_html__( 'Categories Menu', 'digitech' ) );

		/*
		 * This theme supports custom background color and image,
		 * and here we also set up the default background color.
		 */
		add_theme_support( 'custom-background', array(
			'default-color' => 'e6e6e6',
		) );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		
		// This theme uses a custom image size for featured images, displayed on "standard" posts.
		add_theme_support( 'post-thumbnails' );

		set_post_thumbnail_size( 1170, 9999 ); // Unlimited height, soft crop
		add_image_size( 'digitech-category-thumb', 1170, 700, true ); // (cropped)
		add_image_size( 'digitech-post-thumb', 700, 544, true ); // (cropped)
		add_image_size( 'digitech-post-thumbwide', 1170, 700, true ); // (cropped)
	}
	//Override woocommerce widgets
	function digitech_override_woocommerce_widgets() {
		//Show mini cart on all pages
		if ( class_exists( 'WC_Widget_Cart' ) ) {
			unregister_widget( 'WC_Widget_Cart' ); 
			include_once( get_template_directory().'/woocommerce/class-wc-widget-cart.php' );
			register_widget( 'Custom_WC_Widget_Cart' );
		}
	}
	// Add image to category description
	function digitech_woocommerce_category_image() {
		if ( is_product_category() ){
			global $wp_query;
			
			$cat = $wp_query->get_queried_object();
			$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
			$image = wp_get_attachment_url( $thumbnail_id );
			
			if ( $image ) {
				echo '<p class="category-image-desc"><img src="' . esc_url($image) . '" alt=" ' . esc_attr( $cat->name ) . ' " /></p>';
			}
		}
	}
	//Display social sharing on product page
	function digitech_woocommerce_social_share(){
		$digitech_opt = get_option( 'digitech_opt' );
	?>
		<?php if ($digitech_opt['share_code']!='') { ?>
			<div class="share_buttons">
				<?php 
					echo wp_kses($digitech_opt['share_code'], array(
						'div' => array(
							'class' => array()
						),
						'span' => array(
							'class' => array(),
							'displayText' => array()
						),
					));
				?>
			</div>
		<?php } ?>
	<?php
	}
	/**
	 * Enqueue scripts and styles for front-end.
	 *
	 * @since Digitech 1.0
	 */
	function digitech_scripts_styles() {
		global $wp_styles, $wp_scripts;

		$digitech_opt = get_option( 'digitech_opt' );
		
		/*
		 * Adds JavaScript to pages with the comment form to support
		 * sites with threaded comments (when in use).
		*/
		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );
		
		// Add Bootstrap JavaScript
		wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '4.1.1', true );

		// Add Owl files
		wp_enqueue_script( 'owl-js', get_template_directory_uri() . '/js/owl.carousel.js', array('jquery'), '2.3.4', true );
		wp_enqueue_style( 'owl-css', get_template_directory_uri() . '/css/owl.carousel.min.css', array(), '2.3.4' );
		
		// Add Chosen js files
		wp_enqueue_script( 'chosen-js', get_template_directory_uri() . '/js/chosen/chosen.jquery.min.js', array('jquery'), '1.3.0', true );
		wp_enqueue_script( 'chosenproto-js', get_template_directory_uri() . '/js/chosen/chosen.proto.min.js', array('jquery'), '1.3.0', true );
		wp_enqueue_style( 'chosen-css', get_template_directory_uri() . '/js/chosen/chosen.min.css', array(), '1.3.0' );
		
		// Add parallax script files
		
		// Add Fancybox
		wp_enqueue_script( 'fancybo-jsx', get_template_directory_uri() . '/js/fancybox/jquery.fancybox.pack.js', array('jquery'), '2.1.5', true );
		wp_enqueue_script( 'fancybox-buttons-js', get_template_directory_uri().'/js/fancybox/helpers/jquery.fancybox-buttons.js', array('jquery'), '1.0.5', true );
		wp_enqueue_script( 'fancybox-media-js', get_template_directory_uri() . '/js/fancybox/helpers/jquery.fancybox-media.js', array('jquery'), '1.0.6', true );
		wp_enqueue_script( 'fancybox-thumbs-js', get_template_directory_uri() . '/js/fancybox/helpers/jquery.fancybox-thumbs.js', array('jquery'), '1.0.7', true );
		wp_enqueue_style( 'fancybox-css', get_template_directory_uri() . '/js/fancybox/jquery.fancybox.css', array(), '2.1.5' );
		wp_enqueue_style( 'fancybox-buttons-css', get_template_directory_uri() . '/js/fancybox/helpers/jquery.fancybox-buttons.css', array(), '1.0.5' );
		wp_enqueue_style( 'fancybox-thumbs-css', get_template_directory_uri() . '/js/fancybox/helpers/jquery.fancybox-thumbs.css', array(), '1.0.7' );
		
		//Superfish
		wp_enqueue_script( 'superfish-js', get_template_directory_uri() . '/js/superfish/superfish.min.js', array('jquery'), '1.3.15', true );
		
		//Add Shuffle js
		wp_enqueue_script( 'modernizr-js', get_template_directory_uri() . '/js/modernizr.custom.min.js', array('jquery'), '2.6.2', true );
		wp_enqueue_script( 'shuffle-js', get_template_directory_uri() . '/js/jquery.shuffle.min.js', array('jquery'), '3.0.0', true );

		//Add mousewheel
		wp_enqueue_script( 'mousewheel-js', get_template_directory_uri() . '/js/jquery.mousewheel.min.js', array('jquery'), '3.1.12', true );
		
		// Add jQuery countdown file
		wp_enqueue_script( 'countdown-js', get_template_directory_uri() . '/js/jquery.countdown.min.js', array('jquery'), '2.0.4', true );
		
		// Add jQuery counter files
		wp_enqueue_script( 'waypoints-js', get_template_directory_uri() . '/js/waypoints.min.js', array('jquery'), '1.0', true );
		wp_enqueue_script( 'counterup-js', get_template_directory_uri() . '/js/jquery.counterup.min.js', array('jquery'), '1.0', true );
		
		// Add variables.js file
		wp_enqueue_script( 'variables-js', get_template_directory_uri() . '/js/variables.js', array('jquery'), '20140826', true );
		
		// Add theme-digitech.js file
		wp_enqueue_script( 'theme-digitech-js', get_template_directory_uri() . '/js/theme-digitech.js', array('jquery'), '20140826', true );

		$font_url = $this->digitech_get_font_url();
		if ( ! empty( $font_url ) )
			wp_enqueue_style( 'digitech-fonts', esc_url_raw( $font_url ), array(), null );

		// Loads our main stylesheet.
		wp_enqueue_style( 'digitech-style', get_stylesheet_uri() );
		
		// Mega Main Menu
		wp_enqueue_style( 'megamenu-css', get_template_directory_uri() . '/css/megamenu_style.css', array(), '2.0.4' );
	
		// Load fontawesome css
		wp_enqueue_style( 'fontawesome-css', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.2.0' );

		// Load Ionicons css
		wp_enqueue_style( 'linear-icon-css', get_template_directory_uri() . '/css/ionicons.min.css', array(), '2.0.1' );

		// Load bootstrap css
		wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '4.1.1' );
		
		// Compile Less to CSS
		$previewpreset = (isset($_REQUEST['preset']) ? $_REQUEST['preset'] : null);
			//get preset from url (only for demo/preview)
		if($previewpreset){
			$_SESSION["preset"] = $previewpreset;
		}
		$presetopt = 1;
		if(!isset($_SESSION["preset"])){
			$_SESSION["preset"] = 1;
		}
		if($_SESSION["preset"] != 1) {
			$presetopt = $_SESSION["preset"];
		} else { /* if no preset varialbe found in url, use from theme options */
			if(isset($digitech_opt['preset_option'])){
				$presetopt = $digitech_opt['preset_option'];
			}
		}
		if(!isset($presetopt)) $presetopt = 1; /* in case first time install theme, no options found */
		
		if(isset($digitech_opt['enable_less'])){
			if($digitech_opt['enable_less']){
				$themevariables = array(
					'body_font'=> $digitech_opt['bodyfont']['font-family'],
					'text_color'=> $digitech_opt['bodyfont']['color'],
					'text_selected_bg' => $digitech_opt['text_selected_bg'],
					'text_selected_color' => $digitech_opt['text_selected_color'],
					'text_size'=> $digitech_opt['bodyfont']['font-size'],
					'border_color'=> $digitech_opt['border_color']['border-color'],

					'row_space' => $digitech_opt['row_space'],
					
					'heading_font'=> $digitech_opt['headingfont']['font-family'],
					'heading_color'=> $digitech_opt['headingfont']['color'],
					'heading_font_weight'=> $digitech_opt['headingfont']['font-weight'],

					'dropdown_font'=> $digitech_opt['dropdownfont']['font-family'],
					'dropdown_color'=> $digitech_opt['dropdownfont']['color'],
					'dropdown_font_size'=> $digitech_opt['dropdownfont']['font-size'],
					'dropdown_font_weight'=> $digitech_opt['dropdownfont']['font-weight'],

					'dropdown_bg' => $digitech_opt['dropdown_bg'],
					
					'menu_font'=> $digitech_opt['menufont']['font-family'],
					'menu_color'=> $digitech_opt['menufont']['color'],
					'menu_font_size'=> $digitech_opt['menufont']['font-size'],
					'menu_font_weight'=> $digitech_opt['menufont']['font-weight'],

					'sub_menu_font'=> $digitech_opt['submenufont']['font-family'],
					'sub_menu_color'=> $digitech_opt['submenufont']['color'],
					'sub_menu_font_size'=> $digitech_opt['submenufont']['font-size'],
					'sub_menu_font_weight'=> $digitech_opt['submenufont']['font-weight'],

					'sub_menu_bg' => $digitech_opt['sub_menu_bg'],

					'categories_font'=> $digitech_opt['categoriesfont']['font-family'],
					'categories_font_size'=> $digitech_opt['categoriesfont']['font-size'],
					'categories_font_weight'=> $digitech_opt['categoriesfont']['font-weight'],
					'categories_color'=> $digitech_opt['categoriesfont']['color'],
					'categories_menu_bg' => $digitech_opt['categories_menu_bg'],

					'categories_sub_menu_font'=> $digitech_opt['categoriessubmenufont']['font-family'],
					'categories_sub_menu_font_size'=> $digitech_opt['categoriessubmenufont']['font-size'],
					'categories_sub_menu_font_weight'=> $digitech_opt['categoriessubmenufont']['font-weight'],
					'categories_sub_menu_color'=> $digitech_opt['categoriessubmenufont']['color'],
					'categories_sub_menu_bg' => $digitech_opt['categories_sub_menu_bg'],
					
					'link_color' => $digitech_opt['link_color']['regular'],
					'link_hover_color' => $digitech_opt['link_color']['hover'],
					'link_active_color' => $digitech_opt['link_color']['active'],
					
					'primary_color' => $digitech_opt['primary_color'],
					
					'sale_color' => $digitech_opt['sale_color'],
					'saletext_color' => $digitech_opt['saletext_color'],
					'rate_color' => $digitech_opt['rate_color'],

					'price_font'=> $digitech_opt['pricefont']['font-family'],
					'price_color'=> $digitech_opt['pricefont']['color'],
					'price_font_size'=> $digitech_opt['pricefont']['font-size'],
					'price_font_weight'=> $digitech_opt['pricefont']['font-weight'],

					'topbar_color' => $digitech_opt['topbar_color'],
					'topbar_link_color' => $digitech_opt['topbar_link_color']['regular'],
					'topbar_link_hover_color' => $digitech_opt['topbar_link_color']['hover'],
					'topbar_link_active_color' => $digitech_opt['topbar_link_color']['active'],

					'header_color' => $digitech_opt['header_color'],
					'header_link_color' => $digitech_opt['header_link_color']['regular'],
					'header_link_hover_color' => $digitech_opt['header_link_color']['hover'],
					'header_link_active_color' => $digitech_opt['header_link_color']['active'],

					'footer_color' => $digitech_opt['footer_color'],
					'footer_link_color' => $digitech_opt['footer_link_color']['regular'],
					'footer_link_hover_color' => $digitech_opt['footer_link_color']['hover'],
					'footer_link_active_color' => $digitech_opt['footer_link_color']['active'],
				);
				
				if(isset($digitech_opt['header_sticky_bg']['rgba']) && $digitech_opt['header_sticky_bg']['rgba']!="") {
					$themevariables['header_sticky_bg'] = $digitech_opt['header_sticky_bg']['rgba'];
				} else {
					$themevariables['header_sticky_bg'] = 'rgba(255, 255, 255, 0.95)';
				}
				if(isset($digitech_opt['header_bg']['background-color']) && $digitech_opt['header_bg']['background-color']!="") {
					$themevariables['header_bg'] = $digitech_opt['header_bg']['background-color'];
				} else {
					$themevariables['header_bg'] = '#ffffff';
				}
				if(isset($digitech_opt['footer_bg']['background-color']) && $digitech_opt['footer_bg']['background-color']!="") {
					$themevariables['footer_bg'] = $digitech_opt['footer_bg']['background-color'];
				} else {
					$themevariables['footer_bg'] = '#085293';
				}
				switch ($presetopt) {
					case 2:

					break;
					case 3:
						$themevariables['menu_color'] = '#ffffff';
						
						$themevariables['footer_bg'] = '#ffffff';
						$themevariables['footer_color'] = '#363f4d';
						$themevariables['footer_link_color'] = '#363f4d';
						$themevariables['footer_link_hover_color'] = '#2e6ed5';
						$themevariables['footer_link_active_color'] = '#2e6ed5';
					break;
					case 4:
						$themevariables['row_space'] = '60px';

						$themevariables['footer_bg'] = '#ffffff';
						$themevariables['footer_color'] = '#363f4d';
						$themevariables['footer_link_color'] = '#363f4d';
						$themevariables['footer_link_hover_color'] = '#2e6ed5';
						$themevariables['footer_link_active_color'] = '#2e6ed5';
					break;
				}

				if(function_exists('compileLessFile')){
					compileLessFile('theme.less', 'theme'.$presetopt.'.css', $themevariables);
				}
			}
		}
		
		// Load main theme css style files
		wp_enqueue_style( 'digitechcss-theme', get_template_directory_uri() . '/css/theme'.$presetopt.'.css', array('bootstrap-css'), '1.0.0' );
		wp_enqueue_style( 'digitechcss-custom', get_template_directory_uri() . '/css/opt_css.css', array('digitechcss-theme'), '1.0.0' );
		
		if(function_exists('WP_Filesystem')){
			if ( ! WP_Filesystem() ) {
				$url = wp_nonce_url();
				request_filesystem_credentials($url, '', true, false, null);
			}
			
			global $wp_filesystem;
			//add custom css, sharing code to header
			if($wp_filesystem->exists(get_template_directory(). '/css/opt_css.css')){
				$customcss = $wp_filesystem->get_contents(get_template_directory(). '/css/opt_css.css');
				
				if(isset($digitech_opt['custom_css']) && $customcss!=$digitech_opt['custom_css']){ //if new update, write file content
					$wp_filesystem->put_contents(
						get_template_directory(). '/css/opt_css.css',
						$digitech_opt['custom_css'],
						FS_CHMOD_FILE // predefined mode settings for WP files
					);
				}
			} else {
				$wp_filesystem->put_contents(
					get_template_directory(). '/css/opt_css.css',
					$digitech_opt['custom_css'],
					FS_CHMOD_FILE // predefined mode settings for WP files
				);
			}
		}

		//add javascript variables
		ob_start(); ?>
		"use strict";
		var digitech_brandnumber = <?php if(isset($digitech_opt['brandnumber'])) { echo esc_js($digitech_opt['brandnumber']); } else { echo '6'; } ?>,
			digitech_brandscrollnumber = <?php if(isset($digitech_opt['brandscrollnumber'])) { echo esc_js($digitech_opt['brandscrollnumber']); } else { echo '2';} ?>,
			digitech_brandpause = <?php if(isset($digitech_opt['brandpause'])) { echo esc_js($digitech_opt['brandpause']); } else { echo '3000'; } ?>,
			digitech_brandanimate = <?php if(isset($digitech_opt['brandanimate'])) { echo esc_js($digitech_opt['brandanimate']); } else { echo '700';} ?>;
		var digitech_brandscroll = false;
			<?php if(isset($digitech_opt['brandscroll'])){ ?>
				digitech_brandscroll = <?php echo esc_js($digitech_opt['brandscroll'])==1 ? 'true': 'false'; ?>;
			<?php } ?>
		var digitech_categoriesnumber = <?php if(isset($digitech_opt['categoriesnumber'])) { echo esc_js($digitech_opt['categoriesnumber']); } else { echo '6'; } ?>,
			digitech_categoriesscrollnumber = <?php if(isset($digitech_opt['categoriesscrollnumber'])) { echo esc_js($digitech_opt['categoriesscrollnumber']); } else { echo '2';} ?>,
			digitech_categoriespause = <?php if(isset($digitech_opt['categoriespause'])) { echo esc_js($digitech_opt['categoriespause']); } else { echo '3000'; } ?>,
			digitech_categoriesanimate = <?php if(isset($digitech_opt['categoriesanimate'])) { echo esc_js($digitech_opt['categoriesanimate']); } else { echo '700';} ?>;
		var digitech_categoriesscroll = 'false';
			<?php if(isset($digitech_opt['categoriesscroll'])){ ?>
				digitech_categoriesscroll = <?php echo esc_js($digitech_opt['categoriesscroll'])==1 ? 'true': 'false'; ?>;
			<?php } ?>
		var digitech_blogpause = <?php if(isset($digitech_opt['blogpause'])) { echo esc_js($digitech_opt['blogpause']); } else { echo '3000'; } ?>,
			digitech_bloganimate = <?php if(isset($digitech_opt['bloganimate'])) { echo esc_js($digitech_opt['bloganimate']); } else { echo '700'; } ?>;
		var digitech_blogscroll = false;
			<?php if(isset($digitech_opt['blogscroll'])){ ?>
				digitech_blogscroll = <?php echo esc_js($digitech_opt['blogscroll'])==1 ? 'true': 'false'; ?>;
			<?php } ?>
		var digitech_testipause = <?php if(isset($digitech_opt['testipause'])) { echo esc_js($digitech_opt['testipause']); } else { echo '3000'; } ?>,
			digitech_testianimate = <?php if(isset($digitech_opt['testianimate'])) { echo esc_js($digitech_opt['testianimate']); } else { echo '700'; } ?>;
		var digitech_testiscroll = false;
			<?php if(isset($digitech_opt['testiscroll'])){ ?>
				digitech_testiscroll = <?php echo esc_js($digitech_opt['testiscroll'])==1 ? 'true': 'false'; ?>;
			<?php } ?>
		var digitech_catenumber = <?php if(isset($digitech_opt['catenumber'])) { echo esc_js($digitech_opt['catenumber']); } else { echo '6'; } ?>,
			digitech_catescrollnumber = <?php if(isset($digitech_opt['catescrollnumber'])) { echo esc_js($digitech_opt['catescrollnumber']); } else { echo '2';} ?>,
			digitech_catepause = <?php if(isset($digitech_opt['catepause'])) { echo esc_js($digitech_opt['catepause']); } else { echo '3000'; } ?>,
			digitech_cateanimate = <?php if(isset($digitech_opt['cateanimate'])) { echo esc_js($digitech_opt['cateanimate']); } else { echo '700';} ?>;
		var digitech_catescroll = false;
			<?php if(isset($digitech_opt['catescroll'])){ ?>
				digitech_catescroll = <?php echo esc_js($digitech_opt['catescroll'])==1 ? 'true': 'false'; ?>;
			<?php } ?>
		var digitech_menu_number = <?php if(isset($digitech_opt['categories_menu_items'])) { echo esc_js((int)$digitech_opt['categories_menu_items']); } else { echo '9';} ?>;
		var digitech_sticky_header = false;
			<?php if(isset($digitech_opt['sticky_header'])){ ?>
				digitech_sticky_header = <?php echo esc_js($digitech_opt['sticky_header'])==1 ? 'true': 'false'; ?>;
			<?php } ?>
		jQuery(document).ready(function(){
			jQuery(".ws").on('focus', function(){
				if(jQuery(this).val()=="<?php esc_html__( 'Search product...', 'digitech' );?>"){
					jQuery(this).val("");
				}
			});
			jQuery(".ws").on('focusout', function(){
				if(jQuery(this).val()==""){
					jQuery(this).val("<?php esc_html__( 'Search product...', 'digitech' );?>");
				}
			});
			jQuery(".wsearchsubmit").on('click', function(){
				if(jQuery("#ws").val()=="<?php esc_html__( 'Search product...', 'digitech' );?>" || jQuery("#ws").val()==""){
					jQuery("#ws").focus();
					return false;
				}
			});
			jQuery(".search_input").on('focus', function(){
				if(jQuery(this).val()=="<?php esc_html__( 'Search...', 'digitech' );?>"){
					jQuery(this).val("");
				}
			});
			jQuery(".search_input").on('focusout', function(){
				if(jQuery(this).val()==""){
					jQuery(this).val("<?php esc_html__( 'Search...', 'digitech' );?>");
				}
			});
			jQuery(".blogsearchsubmit").on('click', function(){
				if(jQuery("#search_input").val()=="<?php esc_html__( 'Search...', 'digitech' );?>" || jQuery("#search_input").val()==""){
					jQuery("#search_input").focus();
					return false;
				}
			});
		});
		<?php
		$jsvars = ob_get_contents();
		ob_end_clean();
		
		if(function_exists('WP_Filesystem')){
			if($wp_filesystem->exists(get_template_directory(). '/js/variables.js')){
				$jsvariables = $wp_filesystem->get_contents(get_template_directory(). '/js/variables.js');
				
				if($jsvars!=$jsvariables){ //if new update, write file content
					$wp_filesystem->put_contents(
						get_template_directory(). '/js/variables.js',
						$jsvars,
						FS_CHMOD_FILE // predefined mode settings for WP files
					);
				}
			} else {
				$wp_filesystem->put_contents(
					get_template_directory(). '/js/variables.js',
					$jsvars,
					FS_CHMOD_FILE // predefined mode settings for WP files
				);
			}
		}
		//add css for footer, header templates
		$jscomposer_templates_args = array(
			'orderby'          => 'title',
			'order'            => 'ASC',
			'post_type'        => 'templatera',
			'post_status'      => 'publish',
			'posts_per_page'   => 30,
		);
		$jscomposer_templates = get_posts( $jscomposer_templates_args );

		if(count($jscomposer_templates) > 0) {
			foreach($jscomposer_templates as $jscomposer_template){
				if($jscomposer_template->post_title == $digitech_opt['header_layout'] || $jscomposer_template->post_title == $digitech_opt['footer_layout']){
					$jscomposer_template_css = get_post_meta ( $jscomposer_template->ID, '_wpb_shortcodes_custom_css', false );
					if(isset($jscomposer_template_css[0]))
					wp_add_inline_style( 'digitechcss-custom', $jscomposer_template_css[0] );
				}
			}
		}
		
		//page width
		wp_add_inline_style( 'digitechcss-custom', '.wrapper.box-layout {max-width: '.$digitech_opt['box_layout_width'].'px;}' );
	}
	
	//add sharing code to header
	function digitech_custom_code_header() {
		global $digitech_opt;

		if ( isset($digitech_opt['share_head_code']) && $digitech_opt['share_head_code']!='') {
			echo wp_kses($digitech_opt['share_head_code'], array(
				'script' => array(
					'type' => array(),
					'src' => array(),
					'async' => array()
				),
			));
		}
	}
	/**
	 * Register sidebars.
	 *
	 * Registers our main widget area and the front page widget areas.
	 *
	 * @since Digitech 1.0
	 */
	function digitech_widgets_init() {
		$digitech_opt = get_option( 'digitech_opt' );
		
		register_sidebar( array(
			'name' => esc_html__( 'Blog Sidebar', 'digitech' ),
			'id' => 'sidebar-1',
			'description' => esc_html__( 'Sidebar on blog page', 'digitech' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title"><span>',
			'after_title' => '</span></h3>',
		) );
		
		register_sidebar( array(
			'name' => esc_html__( 'Shop Sidebar', 'digitech' ),
			'id' => 'sidebar-shop',
			'description' => esc_html__( 'Sidebar on shop page (only sidebar shop layout)', 'digitech' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title"><span>',
			'after_title' => '</span></h3>',
		) );

		register_sidebar( array(
			'name' => esc_html__( 'Single product Sidebar', 'digitech' ),
			'id' => 'sidebar-single_product',
			'description' => esc_html__( 'Sidebar on product details page', 'digitech' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title"><span>',
			'after_title' => '</span></h3>',
		) );

		register_sidebar( array(
			'name' => esc_html__( 'Pages Sidebar', 'digitech' ),
			'id' => 'sidebar-page',
			'description' => esc_html__( 'Sidebar on content pages', 'digitech' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title"><span>',
			'after_title' => '</span></h3>',
		) );
		
		if(isset($digitech_opt['custom-sidebars']) && $digitech_opt['custom-sidebars']!=""){
			foreach($digitech_opt['custom-sidebars'] as $sidebar){
				$sidebar_id = str_replace(' ', '-', strtolower($sidebar));
				
				if($sidebar_id!='') {
					register_sidebar( array(
						'name' => $sidebar,
						'id' => $sidebar_id,
						'description' => $sidebar,
						'before_widget' => '<aside id="%1$s" class="widget %2$s">',
						'after_widget' => '</aside>',
						'before_title' => '<h3 class="widget-title"><span>',
						'after_title' => '</span></h3>',
					) );
				}
			}
		}
	}
	static function digitech_meta_box_callback( $post ) {

		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'digitech_meta_box', 'digitech_meta_box_nonce' );

		/*
		 * Use get_post_meta() to retrieve an existing value
		 * from the database and use the value for the form.
		 */
		$value = get_post_meta( $post->ID, '_digitech_post_intro', true );

		echo '<label for="digitech_post_intro">';
		esc_html_e( 'This content will be used to replace the featured image, use shortcode here', 'digitech' );
		echo '</label><br />';
		wp_editor( $value, 'digitech_post_intro', $settings = array() );
	}
	static function digitech_custom_sidebar_callback( $post ) {
		global $wp_registered_sidebars;

		$digitech_opt = get_option( 'digitech_opt' );

		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'digitech_meta_box', 'digitech_meta_box_nonce' );

		/*
		 * Use get_post_meta() to retrieve an existing value
		 * from the database and use the value for the form.
		 */

		//show sidebar dropdown select
		$csidebar = get_post_meta( $post->ID, '_digitech_custom_sidebar', true );

		echo '<label for="digitech_custom_sidebar">';
		esc_html_e( 'Select a custom sidebar for this post/page', 'digitech' );
		echo '</label><br />';

		echo '<select id="digitech_custom_sidebar" name="digitech_custom_sidebar">';
			echo '<option value="">'.esc_html__('- None -', 'digitech').'</option>';
			foreach($wp_registered_sidebars as $sidebar){
				$sidebar_id = $sidebar['id'];
				if($csidebar == $sidebar_id){
					echo '<option value="'.$sidebar_id.'" selected="selected">'.$sidebar['name'].'</option>';
				} else {
					echo '<option value="'.$sidebar_id.'">'.$sidebar['name'].'</option>';
				}
			}
		echo '</select><br />';

		//show custom sidebar position
		$csidebarpos = get_post_meta( $post->ID, '_digitech_custom_sidebar_pos', true );

		echo '<label for="digitech_custom_sidebar_pos">';
		esc_html_e( 'Sidebar position', 'digitech' );
		echo '</label><br />';

		echo '<select id="digitech_custom_sidebar_pos" name="digitech_custom_sidebar_pos">'; ?>
			<option value="left" <?php if($csidebarpos == 'left') {echo 'selected="selected"';}?>><?php echo esc_html__('Left', 'digitech'); ?></option>
			<option value="right" <?php if($csidebarpos == 'right') {echo 'selected="selected"';}?>><?php echo esc_html__('Right', 'digitech'); ?></option>
		<?php echo '</select>';
	}
	
	function digitech_save_meta_box_data( $post_id ) {

		/*
		 * We need to verify this came from our screen and with proper authorization,
		 * because the save_post action can be triggered at other times.
		 */

		// Check if our nonce is set.
		if ( ! isset( $_POST['digitech_meta_box_nonce'] ) ) {
			return;
		}

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $_POST['digitech_meta_box_nonce'], 'digitech_meta_box' ) ) {
			return;
		}

		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// Check the user's permissions.
		if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}

		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
		}

		/* OK, it's safe for us to save the data now. */
		
		// Make sure that it is set.
		if ( ! ( isset( $_POST['digitech_post_intro'] ) || isset( $_POST['digitech_custom_sidebar'] ) ) )  {
			return;
		}

		// Sanitize user input.
		$my_data = sanitize_text_field( $_POST['digitech_post_intro'] );
		// Update the meta field in the database.
		update_post_meta( $post_id, '_digitech_post_intro', $my_data );

		// Sanitize user input.
		$my_data = sanitize_text_field( $_POST['digitech_custom_sidebar'] );
		// Update the meta field in the database.
		update_post_meta( $post_id, '_digitech_custom_sidebar', $my_data );

		// Sanitize user input.
		$my_data = sanitize_text_field( $_POST['digitech_custom_sidebar_pos'] );
		// Update the meta field in the database.
		update_post_meta( $post_id, '_digitech_custom_sidebar_pos', $my_data );
		
	}
	//Change comment form
	function digitech_before_comment_fields() {
		echo '<div class="comment-input">';
	}
	function digitech_after_comment_fields() {
		echo '</div>';
	}
	/**
	 * Register postMessage support.
	 *
	 * Add postMessage support for site title and description for the Customizer.
	 *
	 * @since Digitech 1.0
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer object.
	 */
	function digitech_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	}
	/**
	 * Enqueue Javascript postMessage handlers for the Customizer.
	 *
	 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
	 *
	 * @since Digitech 1.0
	 */
	function digitech_customize_preview_js() {
		wp_enqueue_script( 'digitech-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130301', true );
	}
	function digitech_admin_style() {
	  wp_enqueue_style('admin-styles', get_template_directory_uri().'/css/admin.css');
	}
	/**
	* Utility methods
	* ---------------
	*/
	
	//Add breadcrumbs
	static function digitech_breadcrumb() {
		global $post;

		$digitech_opt = get_option( 'digitech_opt' );
		
		$brseparator = '<span class="separator">/</span>';
		if (!is_home()) {
			echo '<div class="breadcrumbs">';
			
			echo '<a href="';
			echo esc_url( home_url( '/' ));
			echo '">';
			echo esc_html__('Home', 'digitech');
			echo '</a>'.$brseparator;
			if (is_category() || is_single()) {
				$categories = get_the_category();
				if ( count( $categories ) > 0 ) {
					echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
				}
				if (is_single()) {
					if ( count( $categories ) > 0 ) { echo ''.$brseparator; }
					the_title();
				}
			} elseif (is_page()) {
				if($post->post_parent){
					$anc = get_post_ancestors( $post->ID );
					$title = get_the_title();
					foreach ( $anc as $ancestor ) {
						$output = '<a href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a>'.$brseparator;
					}
					echo wp_kses($output, array(
							'a'=>array(
								'href' => array(),
								'title' => array()
							),
							'span'=>array(
								'class'=>array()
							)
						)
					);
					echo '<span title="'.$title.'"> '.$title.'</span>';
				} else {
					echo '<span> '.get_the_title().'</span>';
				}
			}
			elseif (is_tag()) {single_tag_title();}
			elseif (is_day()) {printf( esc_html__( 'Archive for: %s', 'digitech' ), '<span>' . get_the_date() . '</span>' );}
			elseif (is_month()) {printf( esc_html__( 'Archive for: %s', 'digitech' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'digitech' ) ) . '</span>' );}
			elseif (is_year()) {printf( esc_html__( 'Archive for: %s', 'digitech' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'digitech' ) ) . '</span>' );}
			elseif (is_author()) {echo "<span>".esc_html__('Archive for','digitech'); echo'</span>';}
			elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<span>".esc_html__('Blog Archives','digitech'); echo'</span>';}
			elseif (is_search()) {echo "<span>".esc_html__('Search Results','digitech'); echo'</span>';}
			
			echo '</div>';
		} else {
			echo '<div class="breadcrumbs">';
			
			echo '<a href="';
			echo esc_url( home_url( '/' ) );
			echo '">';
			echo esc_html__('Home', 'digitech');
			echo '</a>'.$brseparator;
			
			if(isset($digitech_opt['blog_header_text']) && $digitech_opt['blog_header_text']!=""){
				echo esc_html($digitech_opt['blog_header_text']);
			} else {
				echo esc_html__('Blog', 'digitech');
			}
			
			echo '</div>';
		}
	}
	static function digitech_limitStringByWord ($string, $maxlength, $suffix = '') {

		if(function_exists( 'mb_strlen' )) {
			// use multibyte functions by Iysov
			if(mb_strlen( $string )<=$maxlength) return $string;
			$string = mb_substr( $string, 0, $maxlength );
			$index = mb_strrpos( $string, ' ' );
			if($index === FALSE) {
				return $string;
			} else {
				return mb_substr( $string, 0, $index ).$suffix;
			}
		} else { // original code here
			if(strlen( $string )<=$maxlength) return $string;
			$string = substr( $string, 0, $maxlength );
			$index = strrpos( $string, ' ' );
			if($index === FALSE) {
				return $string;
			} else {
				return substr( $string, 0, $index ).$suffix;
			}
		}
	}
	static function digitech_excerpt_by_id($post, $length = 45, $tags = '<a><em><p><img>') {

		$digitech_opt = get_option( 'digitech_opt' );
		
		if(isset($digitech_opt['excerpt_length']) && $digitech_opt['excerpt_length'] !=''){
			$length = $digitech_opt['excerpt_length'];
		}
 
		if ( is_numeric( $post ) ) {
			$post = get_post( $post );
		} elseif( ! is_object( $post ) ) {
			return false;
		}
		
		if ( has_excerpt( $post->ID ) ) {
			$the_excerpt = $post->post_excerpt;
			return apply_filters( 'the_content', $the_excerpt );
		} else {
			$the_excerpt = $post->post_content;
		}
		
		$the_excerpt = strip_shortcodes( strip_tags( $the_excerpt, $tags ) );
		$the_excerpt = preg_split( '/\b/', $the_excerpt, $length * 2 + 1 );
		$excerpt_waste = array_pop( $the_excerpt );
		$the_excerpt = implode( $the_excerpt );
		
		return apply_filters( 'the_content', $the_excerpt );
	}
	/**
	 * Return the Google font stylesheet URL if available.
	 *
	 * The use of Rubik by default is localized. For languages that use
	 * characters not supported by the font, the font can be disabled.
	 *
	 * @since Digitech 1.2
	 *
	 * @return string Font stylesheet or empty string if disabled.
	 */
	function digitech_get_font_url() {
		$fonts_url = '';
		 
		/* Translators: If there are characters in your language that are not
		* supported by Rubik, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$open_sans = _x( 'on', 'Rubik font: on or off', 'digitech' );
		 
		if ( 'off' !== $open_sans ) {
			$font_families = array();

			if ( 'off' !== $open_sans ) {
				$font_families[] = 'Rubik:400,500,700,900';
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
	 * Displays navigation to next/previous pages when applicable.
	 *
	 * @since Digitech 1.0
	 */
	static function digitech_content_nav( $html_id ) {
		global $wp_query;

		$html_id = esc_attr( $html_id );

		if ( $wp_query->max_num_pages > 1 ) : ?>
			<nav id="<?php echo esc_attr($html_id); ?>" class="navigation" role="navigation">
				<h3 class="assistive-text"><?php esc_html_e( 'Post navigation', 'digitech' ); ?></h3>
				<div class="nav-previous"><?php next_posts_link( wp_kses(__( '<span class="meta-nav">&larr;</span> Older posts', 'digitech' ),array('span'=>array('class'=>array())) )); ?></div>
				<div class="nav-next"><?php previous_posts_link( wp_kses(__( 'Newer posts <span class="meta-nav">&rarr;</span>', 'digitech' ), array('span'=>array('class'=>array())) )); ?></div>
			</nav>
		<?php endif;
	}
	/* Pagination */
	static function digitech_pagination() {
		global $wp_query, $paged;

		if(empty($paged)) $paged = 1;

		$pages = $wp_query->max_num_pages;
			if(!$pages || $pages == '') {
			   	$pages = 1;
			}

		if(1 != $pages) {
			echo '<div class="pagination">';
			echo '<div class="page-numbers">';
			$big = 999999999; // need an unlikely integer

			echo paginate_links( array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format' => '?paged=%#%',
				'current' => max( 1, get_query_var('paged') ),
				'total' => $wp_query->max_num_pages,
				'prev_text'    => esc_html__('Previous', 'digitech'),
				'next_text'    =>esc_html__('Next', 'digitech')
			) );
			echo '</div>';
			echo '</div>';
		}
	}
	/**
	 * Template for comments and pingbacks.
	 *
	 * To override this walker in a child theme without modifying the comments template
	 * simply create your own digitech_comment(), and that function will be used instead.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @since Digitech 1.0
	 */
	static function digitech_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
			// Display trackbacks differently than normal comments.
		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<p><?php esc_html_e( 'Pingback:', 'digitech' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( '(Edit)', 'digitech' ), '<span class="edit-link">', '</span>' ); ?></p>
		<?php
				break;
			default :
			// Proceed with normal comments.
			global $post;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<article id="comment-<?php comment_ID(); ?>" class="comment">
				<div class="comment-avatar">
					<?php echo get_avatar( $comment, 50 ); ?>
				</div>
				<div class="comment-info">
					<header class="comment-meta comment-author vcard">
						<?php
							
							printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
								get_comment_author_link(),
								// If current post author is also comment author, make it known visually.
								( $comment->user_id === $post->post_author ) ? '<span>' . esc_html__( 'Post author', 'digitech' ) . '</span>' : ''
							);
							printf( '<time datetime="%1$s">%2$s</time>',
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( esc_html__( '%1$s at %2$s', 'digitech' ), get_comment_date(), get_comment_time() )
							);
						?>
						<div class="reply">
							<?php comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'digitech' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
						</div><!-- .reply -->
					</header><!-- .comment-meta -->
					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'digitech' ); ?></p>
					<?php endif; ?>

					<section class="comment-content comment">
						<?php comment_text(); ?>
						<?php edit_comment_link( esc_html__( 'Edit', 'digitech' ), '<p class="edit-link">', '</p>' ); ?>
					</section><!-- .comment-content -->
				</div>
			</article><!-- #comment-## -->
		<?php
			break;
		endswitch; // end comment_type check
	}
	/**
	 * Set up post entry meta.
	 *
	 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
	 *
	 * Create your own digitech_entry_meta() to override in a child theme.
	 *
	 * @since Digitech 1.0
	 */
	static function digitech_entry_meta() {

		// Translators: used between list items, there is a space after the comma.

		$tag_list = get_the_tag_list( '', ', ' );
		$num_comments = (int)get_comments_number();
		$write_comments = '';

		if ( comments_open() ) {
			if ( $num_comments == 0 ) {
				$comments = esc_html__('0 comments', 'digitech');
			} elseif ( $num_comments > 1 ) {
				$comments = $num_comments . esc_html__(' comments', 'digitech');
			} else {
				$comments = esc_html__('1 comment', 'digitech');
			}
			$write_comments = '<a href="' . get_comments_link() .'">'. $comments.'</a>';
		}

		$utility_text = null;
		if ( ( post_password_required() || !comments_open() ) && ($tag_list!=false && isset($tag_list) ) ) {
			$utility_text = esc_html__( 'Tags: %2$s', 'digitech' );
		} elseif($tag_list!=false && isset($tag_list) && $num_comments !=0 ){
			$utility_text = esc_html__( '%1$s / Tags: %2$s', 'digitech' );
		} elseif ( ($num_comments ==0 || !isset($num_comments) ) && $tag_list==true ) {
			$utility_text = esc_html__( 'Tags: %2$s', 'digitech' );
		} else {
			$utility_text = esc_html__( '%1$s', 'digitech' );
		}
		
		printf( $utility_text, $write_comments, $tag_list);
	}
	static function digitech_entry_meta_small() {
		
		// Translators: used between list items, there is a space after the comma.
		$categories_list = get_the_category_list(', ');

		$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( wp_kses(__( 'View all posts by %s', 'digitech' ), array('a'=>array())), get_the_author() ) ),
			get_the_author()
		);
		
		$utility_text = esc_html__( 'Posted by %1$s / %2$s', 'digitech' );

		printf( $utility_text, $author, $categories_list );
		
	}
	static function digitech_entry_comments() {
		
		$date = sprintf( '<time class="entry-date" datetime="%3$s">%4$s</time>',
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);

		$num_comments = (int)get_comments_number();
		$write_comments = '';
		if ( comments_open() ) {
			if ( $num_comments == 0 ) {
				$comments = wp_kses(__('<span>0</span> comments', 'digitech'), array('span'=>array()));
			} elseif ( $num_comments > 1 ) {
				$comments = '<span>'.$num_comments .'</span>'. esc_html__(' comments', 'digitech');
			} else {
				$comments = wp_kses(__('<span>1</span> comment', 'digitech'), array('span'=>array()));
			}
			$write_comments = '<a href="' . get_comments_link() .'">'. $comments.'</a>';
		}
		
		$utility_text = esc_html__( '%1$s', 'digitech' );
		
		printf( $utility_text, $write_comments );
	}
	/**
	* TGM-Plugin-Activation
	*/
	function digitech_register_required_plugins() {

		$plugins = array(
			array(
				'name'               => esc_html__('RoadThemes Helper', 'digitech'),
				'slug'               => 'roadthemes-helper',
				'source'             => get_template_directory() . '/plugins/roadthemes-helper.zip',
				'required'           => true,
				'version'            => '1.0.0',
				'force_activation'   => false,
				'force_deactivation' => false,
				'external_url'       => '',
			),
			array(
				'name'               => esc_html__('Mega Main Menu', 'digitech'),
				'slug'               => 'mega_main_menu',
				'source'             => PLUGIN_REQUIRED_PATH . '/mega_main_menu.zip',
				'required'           => true,
				'external_url'       => '',
			),
			array(
				'name'               => esc_html__('Revolution Slider', 'digitech'),
				'slug'               => 'revslider',
				'source'             => PLUGIN_REQUIRED_PATH . '/revslider.zip',
				'required'           => true,
				'external_url'       => '',
			),
			array(
				'name'               => esc_html__('Import Sample Data', 'digitech'),
				'slug'               => 'road-importdata',
				'source'             => get_template_directory() . '/plugins/road-importdata.zip',
				'required'           => true,
				'external_url'       => '',
			),
			array(
				'name'               => esc_html__('Visual Composer', 'digitech'),
				'slug'               => 'js_composer',
				'source'             => PLUGIN_REQUIRED_PATH . '/js_composer.zip',
				'required'           => true,
				'external_url'       => '',
			),
			array(
				'name'               => esc_html__('Templatera', 'digitech'),
				'slug'               => 'templatera',
				'source'             => PLUGIN_REQUIRED_PATH . '/templatera.zip',
				'required'           => true,
				'external_url'       => '',
			),
			array(
				'name'               => esc_html__('Essential Grid', 'digitech'),
				'slug'               => 'essential-grid',
				'source'             => PLUGIN_REQUIRED_PATH . '/essential-grid.zip',
				'required'           => true,
				'external_url'       => '',
			),
			array(
				'name'      => esc_html__('Testimonials', 'digitech'),
				'slug'      => 'testimonials-by-woothemes',
				'source'             => PLUGIN_REQUIRED_PATH . '/testimonials-by-woothemes.zip',
				'required'  => true,
			),
			// Plugins from the WordPress Plugin Repository.
			array(
				'name'               => esc_html__('Redux Framework', 'digitech'),
				'slug'               => 'redux-framework',
				'required'           => true,
				'force_activation'   => false,
				'force_deactivation' => false,
			),
			array(
				'name'      => esc_html__('Contact Form 7', 'digitech'),
				'slug'      => 'contact-form-7',
				'required'  => true,
			),
			array(
				'name'      => esc_html__('MailChimp for WordPress', 'digitech'),
				'slug'      => 'mailchimp-for-wp',
				'required'  => true,
			),
			array(
				'name'      => esc_html__('Shortcodes Ultimate', 'digitech'),
				'slug'      => 'shortcodes-ultimate',
				'required'  => true,
			),
			array(
				'name'      => esc_html__('Simple Local Avatars', 'digitech'),
				'slug'      => 'simple-local-avatars',
				'required'  => false,
			),
			
			array(
				'name'      => esc_html__('TinyMCE Advanced', 'digitech'),
				'slug'      => 'tinymce-advanced',
				'required'  => false,
			),
			array(
				'name'      => esc_html__('Widget Importer & Exporter', 'digitech'),
				'slug'      => 'widget-importer-exporter',
				'required'  => true,
			),
			array(
				'name'      => esc_html__('WooCommerce Menu Extension', 'digitech'),
				'slug'      => 'woocommerce-menu-extension',
				'required'  => false,
			),
			array(
				'name'      => esc_html__('WooCommerce', 'digitech'),
				'slug'      => 'woocommerce',
				'required'  => true,
			),
			array(
				'name'      => esc_html__('YITH WooCommerce Compare', 'digitech'),
				'slug'      => 'yith-woocommerce-compare',
				'required'  => false,
			),
			array(
				'name'      => esc_html__('YITH WooCommerce Wishlist', 'digitech'),
				'slug'      => 'yith-woocommerce-wishlist',
				'required'  => false,
			),
			array(
				'name'      => esc_html__('YITH WooCommerce Zoom Magnifier', 'digitech'),
				'slug'      => 'yith-woocommerce-zoom-magnifier',
				'required'  => false,
			),
		);

		/**
		 * Array of configuration settings. Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */
		$config = array(
			'default_path' => '',                      // Default absolute path to pre-packaged plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
			'strings'      => array(
				'page_title'                      => esc_html__( 'Install Required Plugins', 'digitech' ),
				'menu_title'                      => esc_html__( 'Install Plugins', 'digitech' ),
				'installing'                      => esc_html__( 'Installing Plugin: %s', 'digitech' ), // %s = plugin name.
				'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'digitech' ),
				'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'digitech' ), // %1$s = plugin name(s).
				'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'digitech' ), // %1$s = plugin name(s).
				'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'digitech' ), // %1$s = plugin name(s).
				'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'digitech' ), // %1$s = plugin name(s).
				'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'digitech' ), // %1$s = plugin name(s).
				'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'digitech' ), // %1$s = plugin name(s).
				'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'digitech' ), // %1$s = plugin name(s).
				'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'digitech' ), // %1$s = plugin name(s).
				'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'digitech' ),
				'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'digitech' ),
				'return'                          => esc_html__( 'Return to Required Plugins Installer', 'digitech' ),
				'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'digitech' ),
				'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'digitech' ), // %s = dashboard link.
				'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
			)
		);

		tgmpa( $plugins, $config );

	}
}

// Instantiate theme
$Digitech_Class = new Digitech_Class();

//Fix duplicate id of mega menu
function digitech_mega_menu_id_change($params) {
	ob_start('digitech_mega_menu_id_change_call_back');
}
function digitech_mega_menu_id_change_call_back($html){
	$html = preg_replace('/id="mega_main_menu"/', 'id="mega_main_menu_first"', $html, 1);
	$html = preg_replace('/id="mega_main_menu_ul"/', 'id="mega_main_menu_ul_first"', $html, 1);
	
	return $html;
}
add_action('wp_loaded', 'digitech_mega_menu_id_change');


function theme_prefix_enqueue_script() {
	wp_add_inline_script( 'theme-digitech-js', 'var ajaxurl = "'.admin_url('admin-ajax.php').'";','before' );
}
add_action( 'wp_enqueue_scripts', 'theme_prefix_enqueue_script' );