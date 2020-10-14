<?php
/*
 * The template for displaying all single team.
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */
get_header();

// Metabox
$eunice_id    = ( isset( $post ) ) ? $post->ID : 0;
$eunice_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $eunice_id;
$eunice_meta  = get_post_meta( $eunice_id, 'page_type_metabox', true );
?>

<div class="container ence-content-area <?php echo esc_attr($eunice_content_padding); ?>" style="<?php echo esc_attr($eunice_custom_padding); ?>">
<div class="row">

	<div class="<?php echo esc_attr($eunice_layout_class); ?> sngl-team-cnt">
		<div class="ence-blog-one ence-blog-list ence-blog-col-1">
			<?php
			if (have_posts()) : while (have_posts()) : the_post();
				the_content();
			endwhile;
			endif;
			?>
		</div><!-- Blog Div -->
		<?php
    	wp_reset_postdata();  // avoid errors further down the page
		?>
	</div><!-- Content Area -->

</div>
</div>

<?php
get_footer();