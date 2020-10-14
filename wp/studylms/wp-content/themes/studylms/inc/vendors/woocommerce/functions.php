<?php

function studylms_woocommerce_setup() {
    global $pagenow;
    if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
        $catalog = array(
            'width'     => '330',   // px
            'height'    => '330',   // px
            'crop'      => 1        // true
        );

        $single = array(
            'width'     => '660',   // px
            'height'    => '660',   // px
            'crop'      => 1        // true
        );

        $thumbnail = array(
            'width'     => '130',    // px
            'height'    => '130',   // px
            'crop'      => 1        // true
        );

        // Image sizes
        update_option( 'shop_catalog_image_size', $catalog );       // Product category thumbs
        update_option( 'shop_single_image_size', $single );         // Single product image
        update_option( 'shop_thumbnail_image_size', $thumbnail );   // Image gallery thumbs
    }
}

add_action( 'init', 'studylms_woocommerce_setup');

// cart modal
if ( !function_exists('studylms_woocommerce_cart_modal') ) {
    function studylms_woocommerce_cart_modal() {
        wc_get_template( 'content-product-cart-modal.php' , array( 'current_product_id' => (int)$_GET['product_id'] ) );
        die;
    }
}

add_action( 'wp_ajax_studylms_add_to_cart_product', 'studylms_woocommerce_cart_modal' );
add_action( 'wp_ajax_nopriv_studylms_add_to_cart_product', 'studylms_woocommerce_cart_modal' );


// hooks
if ( !function_exists('studylms_woocommerce_enqueue_styles') ) {
    function studylms_woocommerce_enqueue_styles() {
        $css_folder = studylms_get_css_folder();
        $js_folder = studylms_get_js_folder();
        $min = studylms_get_asset_min();

        wp_enqueue_style( 'studylms-woocommerce', $css_folder . '/woocommerce'.$min.'.css' , 'studylms-woocommerce-front' , STUDYLMS_THEME_VERSION, 'all' );
        
        if ( is_singular('product') ) {
            // photoswipe
            wp_enqueue_script( 'photoswipe-js', $js_folder . '/photoswipe/photoswipe'.$min.'.js', array( 'jquery' ), '20150315', true );
            wp_enqueue_script( 'photoswipe-ui-js', $js_folder . '/photoswipe/photoswipe-ui-default'.$min.'.js', array( 'jquery' ), '20150315', true );
            wp_enqueue_script( 'photoswipe-init', $js_folder . '/photoswipe/photoswipe.init'.$min.'.js', array( 'jquery' ), '20150315', true );
            wp_enqueue_style( 'photoswipe-style', $js_folder . '/photoswipe/photoswipe'.$min.'.css', array(), '3.2.0' );
            wp_enqueue_style( 'photoswipe-skin-style', $js_folder . '/photoswipe/default-skin/default-skin'.$min.'.css', array(), '3.2.0' );
        }
        $alert_message = array(
            'success'       => sprintf( '<div class="woocommerce-message">%s <a class="button btn btn-primary btn-inverse wc-forward" href="%s">%s</a></div>', esc_html__( 'Products was successfully added to your cart.', 'studylms' ), wc_get_cart_url(), esc_html__( 'View Cart', 'studylms' ) ),
            'empty'         => sprintf( '<div class="woocommerce-error">%s</div>', esc_html__( 'No Products selected.', 'studylms' ) ),
            'no_variation'  => sprintf( '<div class="woocommerce-error">%s</div>', esc_html__( 'Product Variation does not selected.', 'studylms' ) ),
        );
        wp_register_script( 'studylms-woocommerce', $js_folder . '/woocommerce'.$min.'.js', array( 'jquery' ), '20150330', true );
        wp_localize_script( 'studylms-woocommerce', 'studylms_woo', $alert_message );
        wp_enqueue_script( 'studylms-woocommerce' );

        wp_enqueue_script( 'wc-add-to-cart-variation' );
    }
}
add_action( 'wp_enqueue_scripts', 'studylms_woocommerce_enqueue_styles', 99 );

// cart
if ( !function_exists('studylms_woocommerce_header_add_to_cart_fragment') ) {
    function studylms_woocommerce_header_add_to_cart_fragment( $fragments ){
        global $woocommerce;
        $fragments['#cart .count'] =  sprintf(_n(' <span class="count"> %d  </span> ', ' <span class="count"> %d </span> ', $woocommerce->cart->cart_contents_count, 'studylms'), $woocommerce->cart->cart_contents_count);
        $fragments['#cart .mini-cart-total'] = trim( $woocommerce->cart->get_cart_total() );
        return $fragments;
    }
}
add_filter('woocommerce_add_to_cart_fragments', 'studylms_woocommerce_header_add_to_cart_fragment' );

// breadcrumb for woocommerce page
if ( !function_exists('studylms_woocommerce_breadcrumb_defaults') ) {
    function studylms_woocommerce_breadcrumb_defaults( $args ) {
        $breadcrumb_img = studylms_get_config('woo_breadcrumb_image');
        $breadcrumb_color = studylms_get_config('woo_breadcrumb_color');
        $style = array();
        $breadcrumb_enable = studylms_get_config('show_product_breadcrumbs');
        $archive = '';
        if ( !$breadcrumb_enable ) {
            $style[] = 'display:none';
        }
        if( $breadcrumb_color  ){
            $style[] = 'background-color:'.$breadcrumb_color;
        }
        if ( isset($breadcrumb_img['url']) && !empty($breadcrumb_img['url']) ) {
            $style[] = 'background-image:url(\''.esc_url($breadcrumb_img['url']).'\')';
        }
        $estyle = !empty($style)? ' style="'.implode(";", $style).'"':"";

        if ( is_single() ) {
            $title = esc_html__('Product Detail', 'studylms');
        } else {
            $title = esc_html__('Products List', 'studylms');
            $archive ='woo-archive';
        }
        $args['wrap_before'] = '<section id="apus-breadscrumb" class="apus-breadscrumb '.$archive.'"'.$estyle.'><div class="container"><div class="wrapper-breads"><div class="breadscrumb-inner"><h2 class="bread-title">'.$title.'</h2><ol class="apus-woocommerce-breadcrumb breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>';
        $args['wrap_after'] = '</ol></div></div></div></section>';

        return $args;
    }
}
add_filter( 'woocommerce_breadcrumb_defaults', 'studylms_woocommerce_breadcrumb_defaults' );
add_action( 'studylms_woo_template_main_before', 'woocommerce_breadcrumb', 30, 0 );

// display woocommerce modes
if ( !function_exists('studylms_woocommerce_display_modes') ) {
    function studylms_woocommerce_display_modes(){
        global $wp;
        $current_url = studylms_shop_page_link(true);

        $url_grid = add_query_arg( 'display_mode', 'grid', remove_query_arg( 'display_mode', $current_url ) );
        $url_list = add_query_arg( 'display_mode', 'list', remove_query_arg( 'display_mode', $current_url ) );

        $woo_mode = studylms_woocommerce_get_display_mode();

        echo '<div class="display-mode">';
        echo '<a href="'.  $url_grid  .'" class=" change-view '.($woo_mode == 'grid' ? 'active' : '').'"><i class="mn-icon-99"></i>'.'</a>';
        echo '<a href="'.  $url_list  .'" class=" change-view '.($woo_mode == 'list' ? 'active' : '').'"><i class="mn-icon-105"></i>'.'</a>';
        echo '</div>'; 
    }
}
//add_action( 'woocommerce_before_shop_loop', 'studylms_woocommerce_display_modes' , 2 );

if ( !function_exists('studylms_woocommerce_get_display_mode') ) {
    function studylms_woocommerce_get_display_mode() {
        $woo_mode = studylms_get_config('product_display_mode', 'grid');
        if ( isset($_COOKIE['studylms_woo_mode']) && ($_COOKIE['studylms_woo_mode'] == 'list' || $_COOKIE['studylms_woo_mode'] == 'grid') ) {
            $woo_mode = $_COOKIE['studylms_woo_mode'];
        }
        return $woo_mode;
    }
}

if(!function_exists('studylms_shop_page_link')) {
    function studylms_shop_page_link($keep_query = false ) {
        if ( defined( 'SHOP_IS_ON_FRONT' ) ) {
            $link = home_url();
        } elseif ( is_post_type_archive( 'product' ) || is_page( wc_get_page_id('shop') ) ) {
            $link = get_post_type_archive_link( 'product' );
        } else {
            $link = get_term_link( get_query_var('term'), get_query_var('taxonomy') );
        }

        if( $keep_query ) {
            // Keep query string vars intact
            foreach ( $_GET as $key => $val ) {
                if ( 'orderby' === $key || 'submit' === $key ) {
                    continue;
                }
                $link = add_query_arg( $key, $val, $link );

            }
        }
        return $link;
    }
}


if(!function_exists('studylms_filter_before')){
    function studylms_filter_before(){
        echo '<div class="apus-filter clearfix">';
    }
}
if(!function_exists('studylms_filter_after')){
    function studylms_filter_after(){
        echo '</div>';
    }
}
add_action( 'woocommerce_before_shop_loop', 'studylms_filter_before' , 1 );
add_action( 'woocommerce_before_shop_loop', 'studylms_filter_after' , 40 );

// set display mode to cookie
if ( !function_exists('studylms_before_woocommerce_init') ) {
    function studylms_before_woocommerce_init() {
        if( isset($_GET['display_mode']) && ($_GET['display_mode']=='list' || $_GET['display_mode']=='grid') ){  
            setcookie( 'studylms_woo_mode', trim($_GET['display_mode']) , time()+3600*24*100,'/' );
            $_COOKIE['studylms_woo_mode'] = trim($_GET['display_mode']);
        }
    }
}
add_action( 'init', 'studylms_before_woocommerce_init' );

// Number of products per page
if ( !function_exists('studylms_woocommerce_shop_per_page') ) {
    function studylms_woocommerce_shop_per_page($number) {
        $value = studylms_get_config('number_products_per_page');
        if ( is_numeric( $value ) && $value ) {
            $number = absint( $value );
        }
        return $number;
    }
}
add_filter( 'loop_shop_per_page', 'studylms_woocommerce_shop_per_page' );

// Number of products per row
if ( !function_exists('studylms_woocommerce_shop_columns') ) {
    function studylms_woocommerce_shop_columns($number) {
        $value = studylms_get_config('product_columns');
        if ( in_array( $value, array(2, 3, 4, 6) ) ) {
            $number = $value;
        }
        return $number;
    }
}
add_filter( 'loop_shop_columns', 'studylms_woocommerce_shop_columns' );

// share box
if ( !function_exists('studylms_woocommerce_share_box') ) {
    function studylms_woocommerce_share_box() {
        if ( studylms_get_config('show_product_social_share') ) {
            get_template_part( 'page-templates/parts/sharebox-product' );
        }
    }
}
add_filter( 'woocommerce_single_product_summary', 'studylms_woocommerce_share_box', 100 );

// quickview
if ( !function_exists('studylms_woocommerce_quickview') ) {
    function studylms_woocommerce_quickview() {
        $args = array(
            'post_type'=>'product',
            'product' => $_GET['productslug']
        );
        $query = new WP_Query($args);
        if ( $query->have_posts() ) {
            while ($query->have_posts()): $query->the_post(); global $product;
                wc_get_template_part( 'content', 'product-quickview' );
            endwhile;
        }
        wp_reset_postdata();
        die;
    }
}

if ( studylms_get_global_config('show_quickview') ) {
    add_action( 'wp_ajax_studylms_quickview_product', 'studylms_woocommerce_quickview' );
    add_action( 'wp_ajax_nopriv_studylms_quickview_product', 'studylms_woocommerce_quickview' );
}

// swap effect
if ( !function_exists('studylms_swap_images') ) {
    function studylms_swap_images($size = 'shop_catalog') {
        global $post, $product, $woocommerce;
        
        $output = '';
        $class = 'image-no-effect unveil-image';
        if (has_post_thumbnail()) {
            $product_thumbnail_id = get_post_thumbnail_id();
            $product_thumbnail_title = get_the_title( $product_thumbnail_id );
            $product_thumbnail = wp_get_attachment_image_src( $product_thumbnail_id, $size );
            $placeholder_image = studylms_create_placeholder(array($product_thumbnail[1],$product_thumbnail[2]));

            if ( studylms_get_config('show_swap_image') ) {
                $attachment_ids = $product->get_gallery_image_ids();
                if ($attachment_ids && isset($attachment_ids[0])) {
                    $class = 'image-hover';
                    $product_thumbnail_hover_title = get_the_title( $attachment_ids[0] );
                    $product_thumbnail_hover = wp_get_attachment_image_src( $attachment_ids[0], $size );
                    
                    if ( studylms_get_config('image_lazy_loading') ) {
                        echo '<img src="' . trim( $placeholder_image ) . '" data-src="' . esc_url( $product_thumbnail_hover[0] ) . '" width="' . esc_attr( $product_thumbnail_hover[1] ) . '" height="' . esc_attr( $product_thumbnail_hover[2] ) . '" alt="' . esc_attr( $product_thumbnail_hover_title ) . '" class="attachment-shop-catalog unveil-image image-effect" />';
                    } else {
                        echo '<img src="' . esc_url( $product_thumbnail_hover[0] ) . '" width="' . esc_attr( $product_thumbnail_hover[1] ) . '" height="' . esc_attr( $product_thumbnail_hover[2] ) . '" alt="' . esc_attr( $product_thumbnail_hover_title ) . '" class="attachment-shop-catalog image-effect" />';
                    }
                }
            }
            
            if ( studylms_get_config('image_lazy_loading') ) {
                echo '<img src="' . trim( $placeholder_image ) . '" data-src="' . esc_url( $product_thumbnail[0] ) . '" width="' . esc_attr( $product_thumbnail[1] ) . '" height="' . esc_attr( $product_thumbnail[2] ) . '" alt="' . esc_attr( $product_thumbnail_title ) . '" class="attachment-shop-catalog unveil-image '.esc_attr($class).'" />';
            } else {
                echo '<img src="' . esc_url( $product_thumbnail[0] ) . '" width="' . esc_attr( $product_thumbnail[1] ) . '" height="' . esc_attr( $product_thumbnail[2] ) . '" alt="' . esc_attr( $product_thumbnail_title ) . '" class="attachment-shop-catalog '.esc_attr($class).'" />';
            }
        } else {
            $image_sizes = get_option('shop_catalog_image_size');
            $placeholder_width = $image_sizes['width'];
            $placeholder_height = $image_sizes['height'];

            $output .= '<img src="'.wc_placeholder_img_src().'" alt="'.esc_html__('Placeholder' , 'studylms').'" class="'.$class.'" width="'.$placeholder_width.'" height="'.$placeholder_height.'" />';
        }
        echo trim($output);
    }
}


// get image
if ( !function_exists('studylms_product_get_image') ) {
    function studylms_product_get_image($thumb = 'shop_thumbnail') {
        global $product;

        $product_thumbnail_id = get_post_thumbnail_id();
        $product_thumbnail_title = get_the_title( $product_thumbnail_id );
        $product_thumbnail = wp_get_attachment_image_src( $product_thumbnail_id, $thumb );
        
        $placeholder_image = studylms_create_placeholder(array($product_thumbnail[1],$product_thumbnail[2]));

        echo '<div class="product-image">';
        if ( studylms_get_config('image_lazy_loading') ) {
            echo '<img src="' . trim( $placeholder_image ) . '" data-src="' . esc_url( $product_thumbnail[0] ) . '" width="' . esc_attr( $product_thumbnail[1] ) . '" height="' . esc_attr( $product_thumbnail[2] ) . '" alt="' . esc_attr( $product_thumbnail_title ) . '" class="attachment-'.esc_attr($thumb).' size-'.esc_attr($thumb).' wp-post-image unveil-image" />';
        } else {
            echo '<img src="' . esc_url( $product_thumbnail[0] ) . '" width="' . esc_attr( $product_thumbnail[1] ) . '" height="' . esc_attr( $product_thumbnail[2] ) . '" alt="' . esc_attr( $product_thumbnail_title ) . '" class="attachment-'.esc_attr($thumb).' size-'.esc_attr($thumb).' wp-post-image" />';
        }
        echo '</div>';
    }
}

// layout class for woo page
if ( !function_exists('studylms_woocommerce_content_class') ) {
    function studylms_woocommerce_content_class( $class ) {
        $page = 'archive';
        if ( is_singular( 'product' ) ) {
            $page = 'single';
        }
        if( studylms_get_config('product_'.$page.'_fullwidth') ) {
            return 'container-fluid';
        }
        return $class;
    }
}
add_filter( 'studylms_woocommerce_content_class', 'studylms_woocommerce_content_class' );

// get layout configs
if ( !function_exists('studylms_get_woocommerce_layout_configs') ) {
    function studylms_get_woocommerce_layout_configs() {
        $page = 'archive';
        if ( is_singular( 'product' ) ) {
            $page = 'single';
        }
        $left = studylms_get_config('product_'.$page.'_left_sidebar');
        $right = studylms_get_config('product_'.$page.'_right_sidebar');

        switch ( studylms_get_config('product_'.$page.'_layout') ) {
            case 'left-main':
                $configs['left'] = array( 'sidebar' => $left, 'class' => 'col-md-3'  );
                $configs['main'] = array( 'class' => 'col-md-9 ' );
                break;
            case 'main-right':
                $configs['right'] = array( 'sidebar' => $right,  'class' => 'col-md-3' ); 
                $configs['main'] = array( 'class' => 'col-md-9 ' );
                break;
            case 'main':
                $configs['main'] = array( 'class' => 'col-md-12' );
                break;
            case 'left-main-right':
                $configs['left'] = array( 'sidebar' => $left,  'class' => 'col-md-3'  );
                $configs['right'] = array( 'sidebar' => $right, 'class' => 'col-md-3' ); 
                $configs['main'] = array( 'class' => 'col-md-6 ' );
                break;
            default:
                $configs['main'] = array( 'class' => 'col-md-12' );
                break;
        }

        return $configs; 
    }
}

// Show/Hide related, upsells products
if ( !function_exists('studylms_woocommerce_related_upsells_products') ) {
    function studylms_woocommerce_related_upsells_products($located, $template_name) {
        $content_none = get_template_directory() . '/woocommerce/content-none.php';
        $show_product_releated = studylms_get_config('show_product_releated');
        if ( 'single-product/related.php' == $template_name ) {
            if ( !$show_product_releated  ) {
                $located = $content_none;
            }
        } elseif ( 'single-product/up-sells.php' == $template_name ) {
            $show_product_upsells = studylms_get_config('show_product_upsells');
            if ( !$show_product_upsells ) {
                $located = $content_none;
            }
        }

        return apply_filters( 'studylms_woocommerce_related_upsells_products', $located, $template_name );
    }
}
add_filter( 'wc_get_template', 'studylms_woocommerce_related_upsells_products', 10, 2 );

if ( !function_exists( 'studylms_product_tabs' ) ) {
    function studylms_product_tabs($tabs) {
        global $product, $post;
        
        if ( !studylms_get_config('show_product_review_tab') && isset($tabs['reviews']) ) {
            unset( $tabs['reviews'] ); 
        }
        unset( $tabs['additional_information'] ); 
        return $tabs;
    }
}
add_filter( 'woocommerce_product_tabs', 'studylms_product_tabs', 90 );

if ( !function_exists( 'studylms_minicart') ) {
    function studylms_minicart() {
        $template = apply_filters( 'studylms_minicart_version', '' );
        get_template_part( 'woocommerce/cart/mini-cart-button', $template ); 
    }
}
// Wishlist
add_filter( 'yith_wcwl_button_label', 'studylms_woocomerce_icon_wishlist'  );
add_filter( 'yith-wcwl-browse-wishlist-label', 'studylms_woocomerce_icon_wishlist_add' );
function studylms_woocomerce_icon_wishlist( $value='' ){
    return '<i class="mn-icon-1246"></i>'.'<span class="sub-title">'.esc_html__('Add to Wishlist','studylms').'</span>';
}

function studylms_woocomerce_icon_wishlist_add(){
    return '<i class="mn-icon-2"></i>'.'<span class="sub-title">'.esc_html__('Wishlisted','studylms').'</span>';
}
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );


function studylms_woocommerce_get_ajax_products() {
    $categories = isset($_POST['categories']) ? $_POST['categories'] : '';
    $columns = isset($_POST['columns']) ? $_POST['columns'] : 4;
    $number = isset($_POST['number']) ? $_POST['number'] : 4;
    $product_type = isset($_POST['product_type']) ? $_POST['product_type'] : '';
    $layout_type = isset($_POST['layout_type']) ? $_POST['layout_type'] : '';

    $categories_id = !empty($categories) ? array($categories) : array();
    $loop = apus_themer_get_products( $categories_id, $product_type, 1, $number );
    if ( $loop->have_posts()) {
        wc_get_template( 'layout-products/'.$layout_type.'.php' , array( 'loop' => $loop, 'columns' => $columns, 'number' => $number ) );
    }
    exit();
}
add_action( 'wp_ajax_studylms_get_products', 'studylms_woocommerce_get_ajax_products' );
add_action( 'wp_ajax_nopriv_studylms_get_products', 'studylms_woocommerce_get_ajax_products' );


function studylms_display_accessories() {
    get_template_part( 'woocommerce/single-product/tabs/accessories' );
}

function studylms_display_features() {
    get_template_part( 'woocommerce/single-product/tabs/features' );
}

function studylms_show_percent_disount() {
    global $product;
    $regular_price = $product->get_regular_price();
    $sale_price = $product->get_sale_price();
    
    if ( !empty($sale_price) ) {
        $percentage = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );

        return $percentage.esc_html__('%', 'studylms');
    } else {
        return '';
    }
}
function studylms_show_wooswatches() {
    return 'studylms_show_wooswatches';
}
add_filter( 'apus-wooswatches-show-on-loop', 'studylms_show_wooswatches' );

function studylms_next_product_link($output, $format, $link, $post, $adjacent) {
    if (empty($post) || $post->post_type != 'product') {
        return $output;
    }
    $title = get_the_title( $post->ID );
    $product = wc_get_product( $post->ID );
    return '<div class="next-product product-nav">
        <a class="before-hover" href="'.esc_url(get_permalink($post->ID)).'" title="'.esc_attr($title).'">
            '.get_the_post_thumbnail( $post->ID,'shop_thumbnail' ).'
        </a>
        <a class="on-hover" href="'.esc_url(get_permalink($post->ID)).'" title="'.esc_attr($title).'">
            <span class="nav-product-title">'.$title.'</span>
            <span class="price">'.$product->get_price_html().'</span>
        </a>
        </div>';
}

add_filter( 'next_post_link', 'studylms_next_product_link', 100, 5 );

function studylms_previous_product_link($output, $format, $link, $post, $adjacent) {
    if (empty($post) || $post->post_type != 'product') {
        return $output;
    }
    $title = get_the_title( $post->ID );
    $product = wc_get_product( $post->ID );
    return '<div class="previous-product product-nav">
        <a class="before-hover" href="'.esc_url(get_permalink($post->ID)).'" title="'.esc_attr($title).'">
            '.get_the_post_thumbnail( $post->ID, 'shop_thumbnail' ).'
        </a>
        <a class="on-hover" href="'.esc_url(get_permalink($post->ID)).'" title="'.esc_attr($title).'">
            <span class="nav-product-title">'.$title.'</span>
            <span class="price">'.$product->get_price_html().'</span>
        </a>
        </div>';
    
}
add_filter( 'previous_post_link', 'studylms_previous_product_link', 100, 5 );



function studylms_woocommerce_photoswipe() {
    ?>
    <div class="rating-popover-content woocommerce"></div>
    <?php
    if ( !is_singular('product') ) {
        return;
    }
    ?>
    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="pswp__bg"></div>

        <div class="pswp__scroll-wrap">

          <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
          </div>

          <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">
                <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close" title="<?php echo esc_html__('Close (Esc)', 'studylms'); ?>"></button>
                <button class="pswp__button pswp__button--share" title="<?php echo esc_html__('Share', 'studylms'); ?>"></button>
                <button class="pswp__button pswp__button--fs" title="<?php echo esc_html__('Toggle fullscreen', 'studylms'); ?>"></button>
                <button class="pswp__button pswp__button--zoom" title="<?php echo esc_html__('Zoom in/out', 'studylms'); ?>"></button>
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                      <div class="pswp__preloader__cut">
                        <div class="pswp__preloader__donut"></div>
                      </div>
                    </div>
                </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>
            <button class="pswp__button pswp__button--arrow--left" title="<?php echo esc_html__('Previous (arrow left)', 'studylms'); ?>"></button>
            <button class="pswp__button pswp__button--arrow--right" title="<?php echo esc_html__('Next (arrow right)', 'studylms'); ?>"></button>
            <div class="pswp__caption">
              <div class="pswp__caption__center"></div>
            </div>
          </div>

        </div>
    </div>
    <?php
}
add_action( 'wp_footer', 'studylms_woocommerce_photoswipe' );