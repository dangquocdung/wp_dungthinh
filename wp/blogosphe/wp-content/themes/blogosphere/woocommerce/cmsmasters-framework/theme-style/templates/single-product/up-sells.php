<?php
/**
 * @cmsmasters_package 	Blogosphere
 * @cmsmasters_version 	1.0.0
 */


if ( $upsells ) : ?>

	<section class="up-sells upsells products">

		<span class="cmsmasters_product_title_wrapper">
			<h2><?php esc_html_e( 'You may also like&hellip;', 'blogosphere' ) ?></h2>
		</span>

		<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $upsells as $upsell ) : ?>

				<?php
				 	$post_object = get_post( $upsell->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object );

					wc_get_template_part( 'content', 'product' ); ?>

			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>

	</section>

<?php endif;

wp_reset_postdata();
