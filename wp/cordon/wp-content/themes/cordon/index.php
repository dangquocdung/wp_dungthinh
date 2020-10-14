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
				 <div class="row clearfix">
				 	<div class="col-md-8 blog-content">
						
						<?php get_template_part( 'loop/loop', 'post' ); ?>
                        
                        <ul class="pagination clearfix">
                            <li><?php  previous_posts_link(); ?></li>
                            <li><?php next_posts_link(); ?> </li>
                        </ul>
                        
						<div class="spacing40 clearfix"></div>
					</div><!--/.col-md-8-->
					
					<?php get_sidebar(); ?>
                    
				 </div><!--/.row-->
			</div><!--/.container-->
		</div><!--/.blog-wrapper-->
        
<?php  get_footer(); ?>