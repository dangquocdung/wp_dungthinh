<?php
/**
 * Single Product Thumbnails
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.5.1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
$id = rand();
global $post, $product, $woocommerce;

$images = $product->get_gallery_image_ids();
$attachment_ids = array();
if ( in_array(get_post_thumbnail_id(), $images) ) {
  $attachment_ids = $images;
} elseif ( get_post_thumbnail_id() || $images ) {
  $attachment_ids = array_merge_recursive( array( get_post_thumbnail_id() ) , $images ) ;
}

if ( $attachment_ids ) {
    $loop       = 0;
    $columns    = apply_filters( 'woocommerce_product_thumbnails_columns', 6 );
    ?>
    <div class="thumbnails-image">
        <div class="owl-carousel" data-items="<?php echo esc_attr($columns); ?>" data-carousel="owl" data-smallmedium="2" data-extrasmall="1" data-pagination="false" data-nav="true">
            <?php

            foreach ( $attachment_ids as $attachment_id ) {
                $classes = array( 'thumb-link' );

                $image_single_link = wp_get_attachment_image_src( $attachment_id, 'shop_single' );
                $image_full_link = wp_get_attachment_image_src( $attachment_id, 'full' );
                $image_src = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
                $image_link = isset($image_src[0]) ? $image_src[0] : '';
                if ( ! $image_link )
                    continue;

                $image_title    = esc_attr( get_the_title( $attachment_id ) );
                
                $image_class = esc_attr( implode( ' ', $classes ) );

                $image = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0, $attr = array(
                    'title' => $image_title,
                    'alt'   => $image_title,
                    'data-zoom-image'=> $image_link
                ) );
                
                echo '<div class="image-wrapper">';
                echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" data-image="%s" class="%s" data-rel="prettyPhoto[product-gallery]">%s</a>', $image_full_link[0], $image_single_link[0], $image_class, $image ), $attachment_id, $post->ID, $image_class );
                echo '</div>';
                $loop++;
            }

            ?>
        </div>
    </div>
    <?php
}
