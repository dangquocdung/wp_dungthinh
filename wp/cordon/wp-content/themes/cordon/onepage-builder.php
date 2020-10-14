<?php
/*
* Template Name: One Page Builder
* Description:One Page Builder with container.
*/
get_header(); ?>
        
		<!--HOME START-->
		<div id="home" class="clearfix">
			<!--HEADER START-->
			<?php get_template_part( 'loop/onepage','menu'); ?>
			<!--HEADER END-->
		</div><!--/home end-->
		<!--HOME END--> 
        <?php while (have_posts()) : the_post(); ?>
        
        <div class="page-content-wrapper">
            <div class="container-fluid">
            <?php the_content(); ?>
            </div><!--/.container-->
        </div><!--/.page-content-wrapper-->
		<?php endwhile; ?>
        
<?php  get_footer(); ?>