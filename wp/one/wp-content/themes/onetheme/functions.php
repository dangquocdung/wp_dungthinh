<?php

if ( ! function_exists( 'onetheme_setup' ) ) :
    function onetheme_setup() {

        // load translate file
        load_theme_textdomain( 'one', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        // Let WordPress manage the document title.
        add_theme_support( 'title-tag' );

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 640, 380, true );
        set_post_thumbnail_size( 640, 380, true );

        // Set Image sizes
        add_image_size( 'onetheme-blog-grid', 290, 370, true );
        add_image_size( 'onetheme-blog-list', 840, 450, true );
        add_image_size( 'onetheme-widget-slide', 370, 195, true );
       
    
        // This theme uses wp_nav_menu() in two locations.
         register_nav_menus( array(
            'primary' => esc_html__('Primary Menu', 'onetheme'),
            'footer' => esc_html__('Footer Menu', 'onetheme')
        ) );
        // Switch default core markup for search form, comment form, and comments to output valid HTML5.
        add_theme_support( 'html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ) );

        add_theme_support( 'post-formats', array(
            'quote', 'image', 'gallery', 'audio', 'video', 'link'
        ) );

    }
endif;
add_action( 'after_setup_theme', 'onetheme_setup' );




// default content width
if ( ! isset( $content_width ) ) $content_width = 940;

$onetheme_sidebars = array();
$onetheme_sidebars = array_merge(array(
    'sidebar'=> esc_html__('Post Sidebar Area', 'onetheme'),
    'sidebar-page'=> esc_html__('Page Sidebar Area', 'onetheme')
), $onetheme_sidebars);

// Register widget area.
function onetheme_widgets_init() {
    
    global $onetheme_sidebars;
    if(isset($onetheme_sidebars)) {
        foreach ($onetheme_sidebars as $id => $sidebar) {
            if( !empty($id) ){
                if( $id=='sidebar-portfolio' && !class_exists('TT_Portfolio_PT') )
                    continue;
                
                register_sidebar(array(
                    'name' => $sidebar,
                    'id' => $id,
                    'description' => esc_html__('Add widgets here to appear in your sidebar.', 'onetheme'),
                    'before_widget' => '<section id="%1$s" class="sidebar-section widget %2$s">',
                    'after_widget'  => '</section>',
                    'before_title'  => '<h4 class="sidebar-section-title widget-title">',
                    'after_title'   => '</h4>'
                ));                
            }
        }
    }
    // Footer widget areas
    $footer_widget_num = abs(TT::get_mod('footer_style'));
    
    for($i=1; $i<=$footer_widget_num; $i++ ) {
        register_sidebar(
            array(
                'name'          => esc_html__('Footer Column', 'onetheme') . ' ' .$i,
                'id'            => 'footer'.$i,
                'description'   => esc_html__('Add widgets here to appear in your footer column', 'onetheme') . ' ' .$i,
                'before_widget' => '<section id="%1$s" class="footer-col footer_widget widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h4 class="title">',
                'after_title'   => '</h4>'
            )
        );
    }

}
add_action( 'widgets_init', 'onetheme_widgets_init' );




if ( ! function_exists( 'onetheme_fonts_url' ) ) :
    function onetheme_fonts_url() {
        $fonts_url = '';
        $fonts     = array();
        $subsets   = 'latin,latin-ext';

        if ( $fonts ) {
            $fonts_url = esc_url(add_query_arg( array(
                'family' => implode( '|', $fonts ),
                'subset' => urlencode( $subsets ),
            ), '//fonts.googleapis.com/css' ));
        }

        return $fonts_url;
    }
endif;




function onetheme_enqueue_scripts() {
    
    wp_enqueue_script( 'wp-mediaelement' );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    // Add custom fonts, used in the main stylesheet.
    wp_enqueue_style( 'onetheme-theme-fonts', onetheme_fonts_url(), array(), null );


    // scripts
    wp_enqueue_script('bootstrap', esc_url(get_template_directory_uri() . '/js/bootstrap.min.js'), false, false, true );
    wp_enqueue_script('isotope', esc_url(get_template_directory_uri() . '/js/isotope.pkgd.min.js'), false, false, true );
    wp_enqueue_script('magnific', esc_url(get_template_directory_uri() . '/js/jquery.magnific-popup.min.js'), false, false, true );
    wp_enqueue_script('onetheme-countdown', esc_url(get_template_directory_uri() . '/js/jquery.countdown.min.js'), false, false, true );
    wp_enqueue_script('onetheme-counto', esc_url(get_template_directory_uri() . '/js/jquery.countTo.js'), false, false, true );
    wp_enqueue_script('swiper', esc_url(get_template_directory_uri() . '/js/idangerous.swiper.min.js'), false, false, true );


    // styles
    wp_enqueue_style( 'bootstrap', esc_url(get_template_directory_uri() . '/css/bootstrap.min.css'));
    wp_enqueue_style( 'font-awesome', esc_url(get_template_directory_uri() . '/css/font-awesome.min.css'));
    wp_enqueue_style( 'magnific', esc_url(get_template_directory_uri() . '/css/magnific-popup.css'));
    wp_enqueue_style( 'themify-icons', esc_url(get_template_directory_uri() . '/css/themify-icons.css'));
    wp_enqueue_style( 'onetheme-general-styles', esc_url(get_template_directory_uri() . '/css/general-styles.css'));


    // theme style and scripts   
    wp_enqueue_style( 'onetheme-stylesheet', get_stylesheet_uri() );

    wp_enqueue_script('onetheme-script', esc_url(get_template_directory_uri() . '/js/main.js'), array( 'jquery' ), false, true );

}
add_action( 'wp_enqueue_scripts', 'onetheme_enqueue_scripts' );


add_filter( 'body_class', 'onetheme_body_class_filter' );
function onetheme_body_class_filter( $classes ) {
    global $post;
    if( is_page() ){
        $template = isset($post->ID) ? TT::getmeta('wp_page_template') : '';
        if( $template=="page-maintenance.php" ){
            $classes[] = 'coming-soon';
        }
    }
    return $classes;
}



function onetheme_custom_excerpt_length( $length ) {
    return 7;
}
add_filter( 'excerpt_length', 'onetheme_custom_excerpt_length', 999 );



function onetheme_custom_excerpt_more( $excerpt ) {
    return ' ...';
}
add_filter( 'excerpt_more', 'onetheme_custom_excerpt_length' );



if( ! function_exists('onetheme_print_main_menu') ) :
    function onetheme_print_main_menu($menu_class = ''){
        global $post;
        $po = $post;
        $page_for_posts = get_option('page_for_posts');
        $is_blog_page = is_home() && get_post_type($post) && !empty($page_for_posts) ? true : false;
        if( (is_page() || $is_blog_page) && $is_blog_page )
            $po = get_post($page_for_posts);

        if( isset($po->ID) && TT::getmeta('one_page_menu', $po->ID)=='1' ){
            $content = $po->post_content;
            $pattern = get_shortcode_regex();

            echo "<ul class='".esc_attr($menu_class)." one-page-menu'>";
            if( preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches ) && array_key_exists( 2, $matches ) && in_array( 'vc_row', $matches[2] ) ){
                foreach ($matches[3] as $attr) {
                    $props = array();
                    $sarray = explode('" ', trim($attr));
                    foreach ($sarray as $val) {
                        $el =explode("=", $val);
                        $s1 = str_replace('"', '', trim($el[0]));
                        $s2 = isset($el[1]) ? str_replace('"', '', trim($el[1])) : '';
                        $props[$s1] = $s2;
                    }

                    if( isset($props['one_page_section'], $props['one_page_label']) && $props['one_page_section']=='yes' && !empty($props['one_page_label']) ){
                        $label = $props['one_page_label'];
                        $slug = isset($props['one_page_slug']) && !empty($props['one_page_slug']) ? $props['one_page_slug'] : TT::create_slug($props['one_page_label']);

                        echo "<li class='menu-item'><a class='scroll-to-link' href='#".esc_attr($slug)."'>$label</a></li>";
                    }

                }
            }
            echo "</ul>";
        }
    
    }
endif;
function onetheme_primary_callback(){
    echo '<ul class="main-menu">';
    wp_list_pages( array(
        'sort_column'  => 'menu_order, post_title',
        'title_li' => '') );
    echo '</ul>';
}


add_filter( 'the_content_more_link', 'onetheme_read_more_link' );
function onetheme_read_more_link() {
    return '<br><br><a href="'.get_permalink().'" class="button button-fill button-bordered button-small">'.esc_html__('Read More', 'onetheme').'</a>';
}


//woo commerce 

add_filter( 'woocommerce_product_add_to_cart_text' , 'one_theme_custom_woocommerce_product_add_to_cart_text' );
/**
 * custom_woocommerce_template_loop_add_to_cart
*/
function one_theme_custom_woocommerce_product_add_to_cart_text() {
    global $product;
    
    $product_type = $product->get_type();
    
    switch ( $product_type ) {
        case 'external':
            return esc_html__('Buy product', 'onetheme');
        break;
        case 'grouped':
            return esc_html__('View products', 'onetheme');
        break;
        case 'simple':
            return esc_html__('', 'onetheme');
        break;
        case 'variable':
            return esc_html__('Select options', 'onetheme');
        break;
        default:
            return esc_html__('Read more', 'onetheme');
    }
    
}



// wp_oembedd media filter
global $wp_embed;
add_filter( 'tt_media_filter', array( $wp_embed, 'autoembed' ), 8 ); 




function onetheme_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}

add_filter( 'comment_form_fields', 'onetheme_move_comment_field_to_bottom' );


/*
                                                                    
 _____ _                 _              _____ _                     
|_   _| |_ ___ _____ ___| |_ ___ ___   |     | |___ ___ ___ ___ ___ 
  | | |   | -_|     | -_|  _| . |   |  |   --| | .'|_ -|_ -| -_|_ -|
  |_| |_|_|___|_|_|_|___|_| |___|_|_|  |_____|_|__,|___|___|___|___|
  
*/
  // Themeton Standard Package
require_once get_template_directory() . '/framework/classes/class.themeton.std.php';


// Include current theme customize
require_once TT::file_require(get_template_directory() . '/includes/functions.php');

?>