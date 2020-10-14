<?php
/**
 * @cmsmasters_package 	Blogosphere
 * @cmsmasters_version 	1.0.0
 */


if ( $related_products ) : ?>

	<section class="related products">

		<span class="cmsmasters_product_title_wrapper">
			<h2><?php esc_html_e( 'Related products', 'blogosphere' ); ?></h2>
		</span>

		<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $related_products as $related_product ) : ?>

				<?php
				 	$post_object = get_post( $related_product->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object );

					wc_get_template_part( 'content', 'product' ); ?>

			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>

	</section>

<?php endif;

wp_reset_postdata();
