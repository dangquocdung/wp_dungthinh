<?php
/*
 * Template Name: About
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */

// Metabox
global $post;
$eunice_id    = ( isset( $post ) ) ? $post->ID : 0;
$eunice_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $eunice_id;
$eunice_id    = ( eunice_is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $eunice_id;
$eunice_meta  = get_post_meta( $eunice_id, 'page_type_metabox', true );

// Banner Type - Meta Box
if ($eunice_meta && is_page()) {
	$eunice_banner_type = $eunice_meta['banner_type'];
} else { $eunice_banner_type = ''; }

// Page Layout Options
$eunice_page_layout = get_post_meta( get_the_ID(), 'page_layout_options', true );
$inner_fullwidth = 'width-auto';
if ($eunice_page_layout) {
	$eunice_page_layout = $eunice_page_layout['page_layout'];
	if ($eunice_page_layout === 'extra-width') {
		$eunice_column_class = 'fullwidth_page';
		$eunice_page_layout_style = 'width-full';
		$inner_fullwidth = 'width-full';
	} else {
		$eunice_column_class = 'container-width-1170';
	}
} else {
	$eunice_column_class ='container-width-1170';
}

// inner layout
$content_layout_options = get_post_meta( get_the_ID(), 'content_layout_options', true);
if($content_layout_options) {
	$inner_width = $content_layout_options['inner_page_layout'];
}
if ( $inner_width == 'extra-width') {
	$inner_page_class = 'container-width-1130';
} else {
	$inner_page_class = 'container-width-750';
}
if($eunice_meta) {
	$space_top = str_replace('px', '', $eunice_meta['page_top_space']) ;
	$space_top = $space_top;
} else {
	$space_top = 0;
}
if($eunice_meta) {
	$page_title_align = $eunice_meta['page_title_align'];
} else {
	$page_title_align = '';
}

get_header(); ?>

<div class="main-content-area">
	<div class="content-warp">

<?php while ( have_posts() ) : the_post();
if ( ! post_password_required() ) { ?>
	<div class="about-page about-page-two-warp single-post-warp">

		<div class="container <?php echo esc_attr($eunice_column_class); ?> <?php if( isset($eunice_page_layout_style) ){ echo esc_attr($eunice_page_layout_style); } ?> about-page no-padding" style="padding-top:<?php echo esc_attr($space_top); ?>;">
			<div class="full-width-banner">
				<?php
				if( $eunice_banner_type === 'revolution-slider') {
					echo esc_attr(do_shortcode($eunice_meta['page_revslider']));
				} else {
					if( has_post_thumbnail() &&  $eunice_banner_type != 'hide-title-area' ){
						the_post_thumbnail('full');
					}
				?>
			</div>
		<?php } ?>
			<div class="entry-content-warp <?php $post_slug = $post->post_name; echo esc_attr($post_slug); ?>">
				<div class="<?php echo esc_attr($inner_page_class); ?> <?php echo esc_attr($inner_fullwidth); ?> entry-content">
					<div class="about-page entry-content entry-content-text p">
						<?php if( $eunice_banner_type != 'hide-title-area' ) { ?>
						<h2 class="<?php echo esc_attr($page_title_align); ?>"><?php echo eunice_title_area(); ?></h2>
						<?php } }
							the_content();
						if ( ! post_password_required() ) {
						// If comments are open or we have at least one comment, load up the comment template.
						$eunice_theme_page_comments = cs_get_option('theme_page_comments');
						if ( $eunice_theme_page_comments && (comments_open() || get_comments_number()) ) :
							comments_template();
						endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div><!-- Content Area -->

	<?php } endwhile; // End of the loop. ?>

	</div>
</div>

<?php
get_footer();
