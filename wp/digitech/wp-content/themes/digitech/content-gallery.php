<?php
/**
 * The template for displaying posts in the Gallery post format
 *
 * @package WordPress
 * @subpackage Digitech_Theme
 * @since Digitech 1.0
 */
$digitech_opt = get_option( 'digitech_opt' );
$digitech_postthumb = Digitech_Class::digitech_post_thumbnail_size('');
if(Digitech_Class::digitech_post_odd_event() == 1){
	$digitech_postclass='even';
} else {
	$digitech_postclass='odd';
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($digitech_postclass); ?>>
	<?php if ( is_single() ) : ?>
		<div class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php if (do_shortcode(get_post_meta( $post->ID, '_digitech_post_intro', true )) == '') { ?>
				<div class="post-category">
					<?php esc_html_e('Category', 'digitech');?> :
					<?php echo get_the_category_list( ', ' ); ?>
				</div> 
			<?php } ?>
			<div class="post-meta">
				<span class="post-author">
					<?php esc_html_e('Posted by', 'digitech');?> :
					<span class="post-by"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a> </span>
				</span>
				<span class="post-separator">/</span>
				<span class="post-date"> 
					<?php esc_html_e('Posted on', 'digitech');?> : 
					<span class="post-on"><?php echo get_the_date('', $post->ID);?> </span>
				</span>
			</div>
		</div>
	<?php endif; ?>
	<?php if ( ! post_password_required() && ! is_attachment() ) : ?>
		<?php 
			if ( is_single() ) { ?>
				<?php if (do_shortcode(get_post_meta( $post->ID, '_digitech_post_intro', true )) != '') { ?>
					<div class="post-thumbnail-wrapper">
						<div class="post-thumbnail">
							<?php echo do_shortcode(get_post_meta( $post->ID, '_digitech_post_intro', true )); ?>
							<div class="post-category">
								<?php echo get_the_category_list(' '); ?>
							</div> 
						</div>
					</div>
				<?php }?>
			<?php }
		?>
		<?php if ( !is_single() ) { ?>
			<?php if (do_shortcode(get_post_meta( $post->ID, '_digitech_post_intro', true )) != '') { ?>
				<div class="post-thumbnail-wrapper">
					<div class="post-thumbnail">
						<?php echo do_shortcode(get_post_meta( $post->ID, '_digitech_post_intro', true )); ?>
						<div class="post-category">
							<?php echo get_the_category_list(' '); ?>
						</div> 
					</div>
				</div>
			<?php }?>
		<?php } ?>
	<?php endif; ?>
	<div class="postinfo-wrapper <?php if ( !has_post_thumbnail() ) { echo 'no-thumbnail';} ?>">
		<div class="post-info"> 
			<?php if ( is_single() ) : ?>
				<div class="entry-content">
					<?php the_content( wp_kses(__( 'Continue reading <span class="meta-nav">&rarr;</span>', 'digitech' ), array('span'=>array('class'=>array())) )); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'digitech' ), 'after' => '</div>', 'pagelink' => '<span>%</span>' ) ); ?>
				</div>
			<?php else : ?>
				<h1 class="entry-title">
					<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h1>
				<?php if (do_shortcode(get_post_meta( $post->ID, '_digitech_post_intro', true )) == '') { ?>
					<div class="post-category no-thumbnail">
						<?php esc_html_e('Category', 'digitech');?> :
						<?php echo get_the_category_list( ', ' ); ?>
					</div>
				<?php } ?>
				<div class="post-meta">
					<span class="post-author">
						<?php esc_html_e('Posted by', 'digitech');?> :
						<span class="post-by"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a> </span>
					</span>
					<span class="post-separator">/</span>
					<span class="post-date"> 
						<?php esc_html_e('Posted on', 'digitech');?> : 
						<span class="post-on"><?php echo get_the_date('', $post->ID);?> </span>
					</span>
				</div> 
				<?php 
				if ( !is_single() ) {
					// If not a single post, highlight the gallery.
					if ( get_post_gallery() ) {
						echo '<div class="entry-gallery">';
							echo get_post_gallery();
						echo '</div>';
					}; 
				}?>
				<div class="entry-summary">
					<div><?php echo Digitech_Class::digitech_excerpt_by_id($post->ID); ?><div>
					<a class="readmore button" href="<?php the_permalink(); ?>"><?php if(isset($digitech_opt['readmore_text']) && $digitech_opt['readmore_text']!=''){ echo esc_html($digitech_opt['readmore_text']); } else { esc_html_e('Read more', 'digitech');}  ?></a>
				</div>
			<?php endif; ?>
			<?php if ( is_single() ) : ?>
				<div class="entry-meta">
					<?php Digitech_Class::digitech_entry_meta(); ?>
				</div>
				<?php if( function_exists('digitech_blog_sharing') ) { ?>
					<div class="social-sharing"><?php digitech_blog_sharing(); ?></div>
				<?php } ?>
				<?php if(get_the_author_meta()!="") { ?>
				<div class="author-info">
					<div class="author-avatar">
						<?php
						$author_bio_avatar_size = apply_filters( 'digitech_author_bio_avatar_size', 68 );
						echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
						?>
					</div>
					<div class="author-description">
						<h2><?php esc_html_e( 'About the Author:', 'digitech'); printf( '<a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'" rel="author">%s</a>' , get_the_author()); ?></h2>
						<p><?php the_author_meta( 'description' ); ?></p>
					</div>
				</div>
				<?php } ?>
				<?php 
				
				//related posts
				$orig_post = $post;
				global $post;
				$tags = wp_get_post_tags($post->ID);
				if ($tags) { 
					$tag_ids = array();
					foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
					$args=array(
					'tag__in' => $tag_ids,
					'post__not_in' => array($post->ID),
					'posts_per_page'=>3, // Number of related posts to display.
					'ignore_sticky_posts'=>1
					);
					$my_query = new wp_query( $args );$tag_ids = array();
					if($my_query->have_posts()) { ?>
						<div class="relatedposts">
							<h3><?php esc_html_e('Related posts', 'digitech');?></h3>
							<div class="row">
								<?php
								while( $my_query->have_posts() ) {
									$my_query->the_post();
									?>
									<div class="relatedthumb col-lg-4 col-md-6">
										<?php if ( has_post_thumbnail() ) : ?>
											<div class="image">
												<?php the_post_thumbnail('digitech-post-thumb'); ?>
											</div> 
										<?php endif; ?>
										<span class="post-date"> <?php echo get_the_date('', $post->ID);?> </span>
										<h4><a rel="external" href="<?php the_permalink()?>"><?php the_title(); ?></a></h4>
									</div>
								<?php }
								$post = $orig_post;
								wp_reset_postdata();
								?>
							</div> 
						</div>
					<?php } ?>
				<?php } ?>
				
			<?php endif; ?>
		</div>
	</div>
</article>