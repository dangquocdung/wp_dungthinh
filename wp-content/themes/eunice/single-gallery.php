<?php
/*
 * The template for displaying Gallery Single Item.
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */
global $post;
$eunice_id    = ( isset( $post ) ) ? $post->ID : 0;
$gallery_post_layout  = get_post_meta( $eunice_id, 'gallery_layoutaaa', true );

get_header();
?>
<div class="main-content-area">
	<div class="content-warp">
<?php
if( have_posts() ):
while ( have_posts() ) : the_post();
	if ( ! post_password_required() ) {
		if (  $gallery_post_layout['gallery_layouts'] == 'single-fullwidth' ) {
			get_template_part('layouts/gallery/gallery', 'fullwidth' );
		} elseif (  $gallery_post_layout['gallery_layouts'] == 'single-grid' ) {
			get_template_part('layouts/gallery/gallery', 'grid' );
		} elseif (  $gallery_post_layout['gallery_layouts'] == 'single-masonry' ) {
			get_template_part('layouts/gallery/gallery', 'masonry' );
		} elseif (  $gallery_post_layout['gallery_layouts'] == 'single-sidebar' ) {
			get_template_part('layouts/gallery/gallery', 'sidebar' );
		} elseif (  $gallery_post_layout['gallery_layouts'] == 'single-vertical-list' ) {
			get_template_part('layouts/gallery/gallery', 'vertical_list' );
		}
	} else {
		the_content();
	}

	endwhile; // End of the loop.
 	else:
 		get_template_part('layouts/post/content', 'none' );
 	endif;
 ?>
	</div>
</div>

<?php
get_footer();
