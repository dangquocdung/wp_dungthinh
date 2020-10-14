<?php
/*
Template Name: Contact
 * The template for gallery category pages.
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */
get_header();
?>

<div class="main-content-area">
    <div class="content-warp">
	   <div class="contact-page contact-page-warp">

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
		</div>
	</div> <!-- content-warp -->
</div> <!-- main-content-area -->

<?php
get_footer();