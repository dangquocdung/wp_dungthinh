<?php
/*
Template Name: Gallery
 * The template for gallery category pages.
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */
get_header();

if (eunice_is_post_type('eunice')) {
	$eunice_gallery_style = cs_get_option('gallery_style');
	$eunice_gallery_style = $eunice_gallery_style ? $eunice_gallery_style : 'one';
}
?>

<div class="main-content-area">
	<div class="content-warp gallery-page-template">
		<?php
		/* Start the Loop */
		if (have_posts()) : while (have_posts()) : the_post();
			the_content();
		endwhile;
		else :
			get_template_part( 'layouts/post/content', 'none' );
		endif;
		wp_reset_postdata();
		?>
	</div> <!-- Row -->
</div> <!-- Container -->

<?php
get_footer();
