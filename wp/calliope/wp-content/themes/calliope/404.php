<?php
/**
 * The template for displaying 404 pages (Not Found)
 */
global $theme_option; 
$textdoimain = 'ananke';
get_header(); ?>

<div class="section page404"> 
	<div class="container">
    	<div class="twelve columns">
			<div class="content-404">	
				<h1><?php echo esc_html($theme_option['404_title']); ?></h1>			
				<div class="text-404">
				<?php echo esc_html($theme_option['404_content']); ?>
				</div>
				<div class="home-link"><a href="<?php echo esc_url(home_url()); ?>"><i class="icon-long-arrow-left"></i> <?php echo esc_html( $theme_option['back_404'] ); ?></a></div>
			</div>
       </div> 	
    </div><!-- end container -->
</div><!-- end postwrapper -->

<?php
get_footer();
