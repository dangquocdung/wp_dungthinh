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
                	<h3 class="search-title"><?php esc_html_e('Search result for ', 'cordon'); the_search_query(); ?>:</h3>
                	<!--BLOG POST START-->
                    <?php if ( have_posts() ) : ?>
                    
					<?php get_template_part( 'loop/loop', 'post' ); ?>
                    
                    <?php  else: ?>
                    <p><?php esc_html_e('Sorry, no results found. ','cordon'); ?></p>
                    <?php endif; ?>
                    <!--BLOG POST END-->
                    
                    <ul class="pagination clearfix">
                        <li><?php  previous_posts_link();  ?></li>
                        <li><?php next_posts_link(); ?> </li>
                    </ul>
                    <div class="spacing40 clearfix"></div>
                </div><!--/.col-md-8-->
                
                <?php get_sidebar(); ?>
             </div><!--/.row-->
        </div><!--/.container-->
	</div><!--/.blog-wrapper-->

    <?php  get_footer(); ?> 