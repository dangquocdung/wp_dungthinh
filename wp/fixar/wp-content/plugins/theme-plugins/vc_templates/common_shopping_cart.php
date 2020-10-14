<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $product_id
 * Shortcode class
 * @var $this WPBakeryShortCode_Box_Amount
 */
$product_id = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$args = array(
    'post_type' => 'product',
    'p' => $product_id,
);
$wp_query = new WP_Query( $args );

if ($wp_query->have_posts()):
    while ($wp_query->have_posts()) :
        $wp_query->the_post();
        global $product;

        // Enqueue variation scripts
        wp_enqueue_script( 'wc-single-product' );
        if( $product->get_type() != 'simple' ) {
            wp_enqueue_script('wc-add-to-cart-variation');

            // Get Available variations?
            $get_variations = sizeof($product->get_children()) <= apply_filters('woocommerce_ajax_variation_threshold', 30, $product);

            // Load the template
            wc_get_template('variable-product-add-to-cart.php', array(
                'available_variations' => $get_variations ? $product->get_available_variations() : false,
                'attributes' => $product->get_variation_attributes(),
                'selected_attributes' => $product->get_default_attributes()
            ));
        } else {
            wc_get_template('single-product-add-to-cart.php', array());
        }

    endwhile;
endif;
