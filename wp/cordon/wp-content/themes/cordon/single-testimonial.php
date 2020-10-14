<?php

get_header(); ?>
        
		<!--HOME START-->
		<div id="home" class="clearfix">
			<!--HEADER START-->
			<?php get_template_part( 'loop/menu','normal'); ?>
			<!--HEADER END-->
		</div><!--/home end-->
		<!--HOME END--> 

		<div class="content blog-wrapper">  
			<div class="container-fluid clearfix">
				<div id="testimonial" >
                	<div>
						<?php while (have_posts()) : the_post(); ?>
								
						
                        <p><?php echo get_the_content(); ?></p>
                        <i class="fa fa-quote-right"></i>
                        <h3><?php the_title(); ?></h3>
                        <p class="testi-from"><?php echo esc_attr( apply_filters('get_the_content', get_post_meta($post->ID, 'testi_post', true))); ?></p>
                       
								
						<?php endwhile; ?>
					</div>			
				</div>	
			</div><!--/.container-->
		</div><!--/.blog-wrapper-->


               
    <?php  get_footer(); ?>