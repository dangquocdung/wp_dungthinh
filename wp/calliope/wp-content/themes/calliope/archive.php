<?php

 global $theme_option;
 
get_header(); ?>

	<div class="section blog"> 
		<div class="container">
			<div class="twelve columns"> 
				<h2 id="headline4"></h2>
			</div>
			<div class="twelve columns"> 
				<div class="sep"></div> 
			</div>
		</div>
		<div class="head-page background-blog-head">	
			<div class="container z-index">
				<div class="twelve columns padding-bottom">
					<h1>
						<?php the_archive_title( ); ?>
					</h1> 
					<div class="sep-center"></div>
					<p><?php echo esc_html($theme_option['blog_stitle']); ?></p>
				</div>	
			</div>
		</div>
		<?php if ( have_posts() ) : $i=0; while ( have_posts() ) : the_post(); ?>	
			<div class="blog-wrap <?php if($i%2 != 0) echo 'post2'; ?>">	
			<?php get_template_part( 'content', get_post_format() ) ; ?>
			</div>
		<?php $i++; endwhile;?>
	
		<?php else: ?>
			<h1><?php _e( 'Nothing Found Here!', 'calliope'); ?></h1>
		<?php endif; ?>	
		
		<div class="pagination text-center ">
           <?php echo calliope_pagination(); ?>
        </div>

	</div>

<?php get_footer(); ?>