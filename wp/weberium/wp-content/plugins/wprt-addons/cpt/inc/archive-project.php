<?php get_header(); ?>

<div id="content-wrap" class="weberium-container">
    <div id="site-content" class="site-content clearfix archive-project">
    	<div id="inner-content" class="inner-content-wrap">
			<?php if ( have_posts() ) : ?>
				<div class="weberium-project-grid" data-layout="grid" data-column="3" data-column2="3" data-column3="2" data-column4="1" data-gaph="30" data-gapv="30">
					<div id="portfolio" class="cbp">
					    <?php while ( have_posts() ) : the_post();
							wp_enqueue_script( 'weberium-cubeportfolio' );

						    global $post;
							$term_list = '';
						    $terms = get_the_terms( $post->ID, 'project_category' );

						    if ( $terms ) {
						        foreach ( $terms as $term ) {
						            $term_list .= $term->slug .' ';
						        }
						    } ?>

				            <div class="cbp-item <?php echo esc_attr( $term_list ); ?>">
								<div class="project-box style-1">
									<div class="inner">
										<?php
											if ( has_post_thumbnail() ) {
										    	$img_size = 'weberium-rectangle2';
					                    	}

					                    	$icon_html = sprintf('<div class="plus-icon"><a href="%1$s" title="%2$s"><span class="nz-plus4"></span></a></div>',
					                    		esc_url( get_the_permalink() ),
					                    		esc_attr( get_the_title() ),
					                    		weberium_get_image( array( 'size' => 'full', 'format' => 'src' ) )
					                    	);

					                    	$text_html = sprintf('<h2><span><a href="%1$s" title="%2$s">%3$s</a></span></h2>', esc_url( get_the_permalink() ), esc_attr( get_the_title() ), get_the_title() );

				                    		echo '<div class="project-wrap"><div class="project-image">'. get_the_post_thumbnail( get_the_ID(), $img_size ) . $icon_html .'</div><div class="project-text">'. $text_html .'<div class="project-term">'. get_the_term_list( $post->ID, 'project_category', '<span>', ', </span><span>', '</span>' ) .'</div></div></div>';
										?>
					                </div>
								</div><!-- /.project-box -->
				            </div><!-- /.cbp-item -->
						<?php endwhile; ?>
					</div><!-- /#galleries -->

					<?php weberium_pagination(); ?>
				</div><!-- /.weberium-project -->
			<?php endif; ?>
    	</div>
    </div><!-- /#site-content -->
</div><!-- /#content-wrap -->

<?php get_footer(); ?>