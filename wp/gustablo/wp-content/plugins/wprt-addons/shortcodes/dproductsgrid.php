<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
    'number' => '6',
    'column'        => '3c',
), $atts ) );
$content = wpb_js_remove_wpautop($content, true);

if ( ! class_exists( 'woocommerce' ) ) { return; }

$number = intval( $number );
$column = intval( $column );

$cls = 'col-'. $column;

// Define vars
$atts['post_type'] = 'product';
$atts['taxonomy']  = 'product_cat';
$atts['tax_query'] = '';
$atts['posts_per_page'] = $number;

// Build the WordPress query
$wpex_query = new WP_Query( $atts );
ob_start();

// Output posts
if ( $wpex_query->have_posts() ) :

    echo '<div class="wprt-products-grid clearfix '. $cls .'"><ul class="products">';
    while ( $wpex_query->have_posts() ) :
        // Get post from query
        $wpex_query->the_post();

        // Get woocommerce template part
        echo wc_get_template_part( 'content', 'product' );
    endwhile;
    echo '</ul></div>';
endif;
wp_reset_postdata(); ?>

<?php
$return = ob_get_clean();
echo $return;
