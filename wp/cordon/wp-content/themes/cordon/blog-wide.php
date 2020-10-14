<?php
/*
* Template Name: Blog Wide 
* Description: Blog page wide style without sidebar
*/

get_header(); ?>
        
		<!--HOME START-->
		<div id="home" class="clearfix">
			<!--HEADER START-->
			<?php get_template_part( 'loop/menu','normal'); ?>
			<!--HEADER END-->
		</div><!--/home end-->
		<!--HOME END--> 
        	

		<div class="content blog-wrapper">  
			<div class="container-fluid clearfix blog-content">

				<?php $cordon_post_per_page = get_option('posts_per_page');
                      $cordon_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                      $cordon_args = array(
                          'posts_per_page' => $cordon_post_per_page,
                          'paged' => $cordon_paged,
                          'post_type' => 'post'
                        ); 
                        query_posts($cordon_args);
                        
                 get_template_part( 'loop/loop', 'post' ); ?>
                
                 <?php  cordon_pagination(); ?>
                <div class="spacing40 clearfix"></div>
	
			</div><!--/.container-fluid-->
		</div><!--/.blog-wrapper-->


               
    <?php  get_footer(); ?>