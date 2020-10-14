<?php
/*
* Related Post
*/ ?>

					<?php 
						$related = cordon_related_post( get_the_ID(), 6 );
						if( $related->have_posts() ):
						?>
					
					<div id="related_posts" class="clearfix">
						<h4 class="title-related-post">
							<?php  esc_html_e('You might also like', 'cordon'); ?>
						</h4>
						<div class="row">
							<?php 
						while( $related->have_posts() ):
						$related->the_post();
						?>
							<div class="col-sm-4 col-xs-6"> <a href="<?php  the_permalink()  ?>" rel="bookmark" title="<?php  the_title(); ?>">
								<?php  the_post_thumbnail( 'cordon-related-post' ); ?>
								</a> 
                                <a href="<?php  the_permalink()  ?>" rel="bookmark" title="<?php  the_title(); ?>">
                                    <h3 class="related-title">
                                        <?php  the_title(); ?>
                                    </h3>
                                    <p class="related-cat"><?php the_category(', '); ?></p>
								</a> 
							</div><!--/.col-sm-4-->
							<?php  endwhile; ?>
						</div><!--/.row--> 
					</div><!--related-post-->
					<?php endif;wp_reset_postdata(); ?>