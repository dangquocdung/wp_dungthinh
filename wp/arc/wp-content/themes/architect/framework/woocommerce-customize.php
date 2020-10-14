<?php 
/**** WooCommerce custom functions ****/

if (class_exists('woocommerce')) {
	
   	add_theme_support( 'woocommerce' );   

    /* Enabling product gallery features (zoom, swipe, lightbox) in 3.0.0 */ 
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );   

    /**
     * Products per page.
     *
     * @return integer number of products.
     */
    function architect_woocommerce_products_per_page() {
        return 12;
    }
    add_filter( 'loop_shop_per_page', 'architect_woocommerce_products_per_page' );

    // breadcrumb woocommerce
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

    // Remove link before and after product
    remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

	add_filter( 'woocommerce_output_related_products_args', 'architect_related_products_args' );
	function architect_related_products_args( $args ) {
		$args['posts_per_page'] = 3; // 4 related products
		$args['columns'] = 3; // arranged in 2 columns
		return $args;
	}

	if (  ! function_exists( 'woocommerce_template_loop_product_title' ) ) {
        /**
         * Show the product title in the product loop. By default this is an H3.
         */
        function woocommerce_template_loop_product_title() {
            echo '<h3>' . get_the_title() . '</h3>';
        }
    }
}
?>