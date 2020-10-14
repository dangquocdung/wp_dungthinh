<?php
/**
 * Single Post.
 */
$eunice_large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
$eunice_large_image = $eunice_large_image[0];

$eunice_post_type = get_post_meta( get_the_ID(), 'post_type_metabox', true );
$eunice_blog_style = cs_get_option('blog_listing_style');
$eunice_single_comment = cs_get_option('single_comment_form');
$eunice_single_featured_image = cs_get_option('single_featured_image');
$eunice_single_author_info = cs_get_option('single_author_info');
$eunice_single_share_option = cs_get_option('single_share_option');
?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('ence-blog-post'); ?>>
			<!-- single post header start\-->
     <header class="text-center single-post-heading">
          <h1><?php echo esc_attr(get_the_title()); ?></h1>
          <?php echo eunice_post_metas();
          ?>
      </header><!--/ end-->
			<?php
			if ($eunice_single_featured_image) {
				if ( 'gallery' == get_post_format() && ! empty( $eunice_post_type['gallery_post_format'] ) ) { ?>
					<!-- single post banner start\-->
          <div id="fullwidth_slider_warp" class="gallery same-controls">
						<!-- gallery full width start\-->
            <div id="gallery-slider" class="owl-carousel">
						<?php
						  $eunice_ids = explode( ',', $eunice_post_type['gallery_post_format'] );
						  foreach ( $eunice_ids as $id ) {
						    $eunice_attachment = wp_get_attachment_image_src( $id, 'full' );
						    $eunice_alt = get_post_meta($id, '_wp_attachment_image_alt', true);
						    	echo '<div class="slide-item"><img src="'. $eunice_attachment[0] .'" alt="'. esc_attr($eunice_alt) .'" /></div>';
						  }
						?>
	          </div><!--/ gallery full width end-->
	          <div class="gallery-slider-length gallary-slider-length"></div><!--/ gallery slider item count-->
	          <div class="clear-both"></div>
	      </div>
				<?php
				} elseif ( 'video' == get_post_format() && ! empty( $eunice_post_type['video_post_format_meta'] ) ) { ?>
				<div class="fix post-video-4by3">
					<div class="embed-responsive embed-responsive-4by3">
						<iframe class="embed-responsive-item" src="<?php echo esc_url($eunice_post_type['video_post_format_meta']); ?>"></iframe>
					</div>
				</div>
			<?php }elseif ($eunice_large_image) { ?>
				<div class="fix post-images">
					<figure class="post-preview-image">
					<img src="<?php echo esc_url($eunice_large_image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
					</figure>
				</div>
			<?php } // Featured Image
			}
			?>
			<!-- Content -->
			<div class="single-post-page container-width-750 entry-content-warp">
				<div class="single-post-page entry-content">
					<?php
							if (get_post_format() == 'quote' ) {
								if ($eunice_post_type) { ?>
									<div class="post-warp">
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
															echo $eunice_post_type['quote_post_format_meta_quote'];
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
									</div>
							<?php	}
							}
							the_content();
							eunice_wp_link_pages();
					?>
				</div>
				<?php
				if( function_exists('zilla_likes') ) {
					$like_class = 'hav-zilla-likes';
				} else {
					$like_class = 'dhav-zilla-likes';
				}
				?>
				<div class="about-page socail-box container-width-750 <?php echo esc_attr($like_class); ?>">
					<div class="fix group-social">
						<div class="col-xs-7 text-left">
						   <div class="single-post-meta">
	                            <!-- like count start\-->
								<div class="single-blog-like about-me-meta-single  single-p-meta single-p-like-coun">
									<?php if( function_exists('zilla_likes') ) {
										$likes = esc_attr(get_post_meta($post->ID, '_zilla_likes', true));
										$likes = (int) $likes;
										if ($likes > 1) {
											echo ' <span class="zila-like-prefix">'. esc_html__('Likes', 'eunice') .' :</span>';
										}else{
											echo ' <span class="zila-like-prefix">'. esc_html__('Like', 'eunice') .' :</span>';
										}
										zilla_likes();
										} ?>
								</div><!--/ end-->
	              <?php
								$tag_list = get_the_tags();
							  if($tag_list){ ?><!-- like count start\-->
								<div class="about-me-meta-single single-p-meta single-post-meta">
									<span>Tags:</span>
									<div class="meta">
										<?php echo the_tags( '#', ' #', '' ); ?>
									</div>
								</div><!--/ end-->
								<?php } ?>
							</div>
						</div>
						<?php
							if($tag_list){
								$padding_top = '';
							}else{
								$padding_top = 'margin-top: 0px;';
							}
						?>
						<div class="col-xs-5 text-right socail-share-box" style="<?php echo esc_attr($padding_top); ?>">
							<?php if($eunice_single_share_option) {
									echo eunice_wp_share_option();
								} ?>
						</div>
	      	</div>
				</div><!--/end-->
				<?php
				  if($eunice_single_author_info){ echo eunice_author_info(); }
					  $blog_pagination = cs_get_option('blog_pagination');
					  $older_post = cs_get_option('older_post');
			      $newer_post = cs_get_option('newer_post');
			      $older_post = $older_post ? $older_post : esc_html__( 'Next Article', 'eunice' );
			      $newer_post = $newer_post ? $newer_post : esc_html__( 'Previous Article', 'eunice' );

			    if($blog_pagination == true){
						$prev = get_previous_post(false);
						$next = get_next_post(false);
						if($next && $prev){
							$class = 'col-sm-6';
						}else{
							$class = 'col-sm-12';
						}
						if ($prev || $next ) {
						?>
							<div class="fix navigation post-navigation single-post-paged-link container-width-750">
								<?php if ($prev) { ?>
								<div class="text-left <?php echo esc_attr($class); ?> nav-previous">
									<!-- prev post-link start\-->
									<a href="<?php echo get_the_permalink( $prev->ID ); ?>" class="s-post-prev-link">
										<i class="fa fa-angle-left link-icon"></i>
									</a><!--/end-->
									<!-- prev post title & text start\-->
									<div class="fix text-center prev-post-info post-navi-info">
											<span class="post-navi-prve-text">
												<?php echo esc_attr($older_post); ?>
											</span>
											<!-- prev post title start\-->
											<?php previous_post_link('<h4 class="post-navi-prve-post-title">%link</h4>'); ?>
									</div><!--/end-->
								</div>
							<?php }
							if($next){ ?>
								<div class="text-right <?php echo esc_attr($class); ?> nav-next">
									<!-- next post title & text start\-->
									<div class="fix text-center prev-post-info post-navi-info">
										<span class="post-navi-next-text">
											<?php echo esc_attr($newer_post); ?>
										</span>
										<!-- next post title start\-->
										<?php next_post_link('<h4 class="post-navi-next-post-title">%link</h4>'); ?>
									</div><!--/end-->
									<!-- next post-link start\-->
									<a href="<?php echo get_the_permalink( $next->ID ); ?>" class="s-post-next-link">
										<i class="fa fa-angle-right link-icon"></i>
									</a><!--/end-->
								</div>
								<?php } ?>

							</div><!--/end-->
						<?php }
						}  ?>
				<div class="container-width-750">
					<?php comments_template(); ?>
				</div>
			</div>
			<!-- Content -->
		</div><!-- #post-## -->
