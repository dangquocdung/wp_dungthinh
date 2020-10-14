<?php
/**
 * Template part for displaying posts.
 */
$eunice_large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
$eunice_large_image = $eunice_large_image[0];

$eunice_read_more_text = cs_get_option('read_more_text');
$eunice_read_text = $eunice_read_more_text ? $eunice_read_more_text : esc_html__( 'Continue', 'eunice' );
$eunice_post_type = get_post_meta( get_the_ID(), 'post_type_metabox', true );
$eunice_blogs_column = cs_get_option('eunice_blogs_columns');

if( $eunice_blogs_column == 'five-col' ) {
	$col_class = 'single-post-mesonary five-col';
} elseif( $eunice_blogs_column == 'three-col' ) {
	$col_class = 'single-post-mesonary three-col';
} else {
	$col_class = 'single-post-mesonary';
}
if (is_sticky()) {
	$col_class = $col_class . ' sticky';
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($col_class); ?> class="single-post-mesonary">

	<!-- Content -->
	<div class="post-warp">
		<!--  post  header start \-->
		<header class="post-header">
			<!--  post  title start \-->
			<h2 class="post-title">
				<a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_attr(get_the_title()); ?></a>
			</h2><!--/  post  title end-->
			<!--  post  meta start \-->
			<?php echo eunice_post_metas(); ?>
		</header><!--/  post header end-->
		<div class="post-content">
			<?php
			if ( 'gallery' == get_post_format() && ! empty( $eunice_post_type['gallery_post_format'] ) ) { ?>
				<div class="fix post-images post-image-curosel">
					<div class="blog-post-curosel">
					<?php
				  $eunice_ids = explode( ',', $eunice_post_type['gallery_post_format'] );
				  foreach ( $eunice_ids as $id ) {
				    $eunice_attachment = wp_get_attachment_image_src( $id, 'full' );
				    $eunice_alt = get_post_meta($id, '_wp_attachment_image_alt', true);
				    echo '<img class="image-full-width"  src="'. $eunice_attachment[0] .'" alt="'. esc_attr($eunice_alt) .'" />';
				  }
					?>
					</div>
				</div>
			<?php
			} elseif( 'video' == get_post_format() && ! empty( $eunice_post_type['video_post_format_meta'] ) ) { ?>
			<?php if( !post_password_required() ) { ?>
				<div class="fix post-video-4by3">
					<div class="embed-responsive embed-responsive-4by3">
						<iframe class="embed-responsive-item" src="<?php echo esc_url($eunice_post_type['video_post_format_meta']); ?>"></iframe>
					</div>
				</div>
				<?php } else { ?>
					<div class="fix post-images">
						<figure class="post-preview-image">
						<a href='<?php echo esc_url( get_the_permalink() ); ?>' > <img class="image-full-width" src="<?php echo esc_url($eunice_large_image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>"></a>
						</figure>
					</div>
			<?php }
			} elseif($eunice_large_image) { ?>
				<div class="fix post-images">
					<figure class="post-preview-image">
					<a href='<?php echo esc_url( get_the_permalink() ); ?>' > <img class="image-full-width" src="<?php echo esc_url($eunice_large_image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>"></a>
					</figure>
				</div>
			<?php } // Featured Image

			if( 'quote' != get_post_format() ) { ?>
				<p><?php
				$blog_excerpt = cs_get_option('theme_blog_excerpt');
				if ($blog_excerpt) {
					$blog_excerpt = $blog_excerpt;
				} else {
					$blog_excerpt = '20';
				}
				eunice_excerpt($blog_excerpt);
				echo eunice_wp_link_pages();
				?></p>
		</div>
		<?php	} else {  ?>
			<div class="post-content">
				<!--  post quote \-->
				<div class="fix post-quote">
					<blockquote>
						<?php
							$blog_excerpt = cs_get_option('theme_blog_excerpt');
							if ($blog_excerpt) {
								$blog_excerpt = $blog_excerpt;
							} else {
								$blog_excerpt = '20';
							}
							if ($eunice_post_type) {
								echo nl2br($eunice_post_type['quote_post_format_meta_quote'], false);
							}else{
								eunice_excerpt($blog_excerpt);
							}
							
							if($eunice_post_type) {
							?>
							<cite>&#45; <a href="<?php echo esc_url($eunice_post_type['quote_post_format_meta_url']); ?>"><?php echo esc_attr($eunice_post_type['quote_post_format_meta']); ?></a></cite>
						<?php } ?>
					</blockquote>
				</div>
			</div><!--  post content end \-->
		<?php }	?>

		<!--  post footer start \-->
		<footer class="post-footer">
			<!--  Read more btn \-->
			<a href="<?php echo esc_url( get_permalink() ); ?>" class="read-more"><?php echo esc_attr($eunice_read_text); ?></a>
			<!--  post like count btn \-->
			<div class="blog-like">
				<?php
				if( function_exists('zilla_likes') ) {
					zilla_likes();
				} ?>
			</div>
		</footer><!--/  post footer end-->

	</div>
	<!-- Content -->

</article><!-- #post-## -->
