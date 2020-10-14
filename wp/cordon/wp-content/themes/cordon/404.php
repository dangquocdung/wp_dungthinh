<?php

get_header(); ?>
        
		<!--HOME START-->
		<div id="home" class="clearfix">
			<!--HEADER START-->
			<?php get_template_part( 'loop/menu','normal'); ?>
			<!--HEADER END-->
		</div><!--/home end-->
		<!--HOME END--> 
        
			<div class="clearfix content page-content-wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-8 news-list aligncenter">
							<h2 class="error-title"><?php esc_html_e('404', 'cordon'); ?></h2>
							<h3><?php esc_html_e('Oops..!!! Page not found!','cordon') ?></h3>
                            <div class="spacing40 clearboth"></div>
							<a class="content-btn" href="<?php echo esc_url ( home_url() ); ?>"><?php esc_html_e('Go Back Now!','cordon') ?></a>
						</div><!--/.col-md-8-->
						
						<?php get_sidebar(); ?>
					 </div><!--/.row-->
				</div><!--/.container-->
			</div><!--/.content-->
    
    

    
<?php get_footer(); ?> 