<?php
/*
 * The main template file.
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */
get_header();

// Metabox
$eunice_id    = ( isset( $post ) ) ? $post->ID : 0;
$eunice_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $eunice_id;
$eunice_id    = ( eunice_is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $eunice_id;
$eunice_meta  = get_post_meta( $eunice_id, 'page_type_metabox', true );
?>
<div class="main-content-area">
<div class="content-warp">

	<div class="blog-post-warp">
		<div id="blog-post">
			<?php
			if ( have_posts() ) :
			/* Start the Loop */
			while ( have_posts() ) : the_post();
				get_template_part( 'layouts/post/content' );
			endwhile;
			else :
				get_template_part( 'layouts/post/content', 'none' );
			endif; ?>
		</div>
		<?php
			wp_reset_postdata();
			// avoid errors further down the page
		?>
	</div><!-- Content Area -->

	<?php eunice_paging_nav(); ?>

</div>
</div>

<?php
get_footer();
