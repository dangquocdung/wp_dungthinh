<?php get_header(); ?>

<div id="content-wrap" class="wprt-container">
    <div id="site-content" class="site-content clearfix archive-gallery">
    	<div id="inner-content" class="inner-content-wrap">
			<?php if ( have_posts() ) : ?>
				<div class="wprt-gallery-grid" data-layout="grid" data-column="3" data-column2="3" data-column3="2" data-column4="1" data-gaph="20" data-gapv="20">
					<div id="galleries" class="cbp">
					    <?php while ( have_posts() ) : the_post();
							wp_enqueue_script( 'wprt-cubeportfolio' ); wp_enqueue_script( 'wprt-magnificpopup' ); ?>

				            <div class="cbp-item">
								<div class="gallery-box style-1">
									<div class="inner">
										<?php
										if ( has_post_thumbnail() ) {
									    	$img_size = 'wprt-rectangle2';
				                    	}

				                    	$icon_html = sprintf('<div class="icon">
				                    		<a class="link" href="%1$s" title="%2$s"><i class="gustablo-link"></i></a>
				                    		<a class="zoom-popup" href="%3$s" data-title="%2$s"><i class="gustablo-magnifier3"></i></a>
				                    		</div>',
				                    		esc_url( get_the_permalink() ),
				                    		esc_attr( get_the_title() ),
				                    		wprt_get_image( array( 'size' => 'full', 'format' => 'src' ) )
				                    	);

				                    	$heading_html = sprintf('<h2><a href="%1$s" title="%2$s">%3$s</a></h2>', esc_url( get_the_permalink() ), esc_attr( get_the_title() ), get_the_title() );

						                echo '<div class="gallery-wrap"><div class="gallery-image">'. get_the_post_thumbnail( get_the_ID(), $img_size ) . $icon_html .'</div><div class="gallery-text">'. $heading_html .'</div></div>';
										?>
					                </div>
								</div><!-- /.gallery-box -->
				            </div><!-- /.cbp-item -->
						<?php endwhile; ?>
					</div><!-- /#galleries -->

					<?php wprt_pagination(); ?>
				</div><!-- /.wprt-gallery -->
			<?php endif; ?>
    	</div>
    </div><!-- /#site-content -->
</div><!-- /#content-wrap -->

<?php get_footer(); ?>