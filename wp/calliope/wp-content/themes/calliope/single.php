<?php
 global $theme_option;
 
get_header();
?>


<div class="section blog"> 
	<div class="head-page background-blog-head">	
		<div class="container z-index">
			<div class="twelve columns padding-bottom">
				<h1><?php echo esc_html($theme_option['blog_title']); ?></h1> 
				<div class="sep-center"></div>
				<p><?php echo esc_html($theme_option['blog_stitle']); ?></p>
			</div>	
		</div>
	</div>
	<div class="container">
		<div class="nine columns"> 
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
			<?php $format = get_post_format($post->ID); ?>
			<div class="blog-post">
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
				<?php if($format=='image'){?>
					<?php 
					include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
					 
					if ( is_plugin_active('meta-box/meta-box.php') ) { ?>
					<?php $images = rwmb_meta( '_cmb_image', "type=image" ); ?>
			        <?php                                                        
			        foreach ( $images as $image ) {                              
			        ?>
			        <?php $img = $image['full_url']; ?>
						<img src="<?php echo esc_url($img); ?>" alt="">	
			        <?php } } ?>
				<?php }elseif($format=='gallery'){?>
					<ul class="bxslider"> 
						<?php 
						include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
						 
						if ( is_plugin_active('meta-box/meta-box.php') ) { ?>
						<?php $images = rwmb_meta( '_cmb_images', "type=image_advanced" ); ?>
			            <?php                                                        
			            foreach ( $images as $image ) {                              
			            ?>
			            <?php $img = $image['full_url']; ?>
			            	<li class="slide">
								<img src="<?php echo esc_url($img); ?>" alt="">	
							</li>
			            <?php } } ?>
						 
					</ul>
				<?php }elseif($format=='video'){?>
					<?php 
					include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
					 
					if ( is_plugin_active('meta-box/meta-box.php') ) { ?>
					<?php $link_video = get_post_meta(get_the_ID(),'_cmb_link_video', true);?>
					<?php if($link_video !=''){?>
						<div class="video">
							<iframe height="470" src="<?php echo esc_url($link_video);?>" ></iframe>
						</div>
					<?php } } ?>
				<?php }elseif($format == 'audio'){?>
					<?php 
					include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
					 
					if ( is_plugin_active('meta-box/meta-box.php') ) { ?>
					<?php $link_audio = get_post_meta(get_the_ID(),'_cmb_link_audio', true);?>
					<?php if($link_audio !=''){?>
							<iframe height="166" scrolling="no" frameborder="no" src="<?php echo esc_url($link_audio);?>&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_artwork=true"></iframe>
					<?php } } ?>
				<?php }?>
				
				<h5<?php if($format=='') echo ' class="no-top"';?>><?php the_title(); ?></h5>
				<div class="blog-post-sublinks"><?php the_time('d.m.y'); ?></div>
				<div class="single-article">
					<?php the_content(); ?>
				</div>				
				<?php if(has_tag()) { ?>
				<div class="blog-tag">
					
				    <?php the_tags('','' ); ?>
				    
				</div>	
				<?php } ?>	
			</div>
			</div>	
		<?php endwhile;?>
		<?php comments_template(); ?>
		<?php else: ?>
			<h1><?php _e( 'Nothing Found Here!', 'calliope'); ?></h1>
		<?php endif; ?>	
		</div>
		<div class="three columns">
			<?php get_sidebar(); ?>
		</div>
	</div>	
</div>

<?php get_footer(); ?>						
