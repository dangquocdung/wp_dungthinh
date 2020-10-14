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
			<div class="container-fluid box-align-center clearfix">
			
						<?php while (have_posts()) : the_post(); ?>
								
						
                        <img alt="<?php the_title(); ?>" src="<?php echo esc_url( apply_filters('get_the_content', get_post_meta($post->ID, 'client_img', true))); ?>">
                        <div class="spacing40 clearboth"></div>
                       
								
						<?php endwhile; ?>
							
				
			</div><!--/.container-->
		</div><!--/.blog-wrapper-->


               
    <?php  get_footer(); ?>