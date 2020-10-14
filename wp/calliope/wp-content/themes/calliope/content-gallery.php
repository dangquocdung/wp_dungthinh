<?php 
global $theme_option;
?>

<div class="container">
	<div class="six columns">	
		<ul class="bxslider"> 
		
		<?php
 
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		 
		if ( is_plugin_active('meta-box/meta-box.php') ) { ?>
			<?php $images = rwmb_meta( '_cmb_images', "type=image_advanced" ); ?>
            <?php                                                        
            foreach ( $images as $image ) {                      
            ?>
            <?php $params = array( 'width' => 580, 'height' => 330 );
        	$img = bfi_thumb($image['full_url'], $params ); ?>
            	<li class="slide">
					<img src="<?php echo esc_url($img); ?>" alt="">	
				</li>
        <?php } } ?>
			 
		</ul> 
	</div> 
	<div class="six columns">	
		<div class="blog-date"><span><?php the_time('d.m'); ?></span></div>
		<h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
		<p><?php echo calliope_excerpt(); ?></p>
		<?php if(has_tag()) { ?>
		<div class="blog-tag">
			
		    <?php the_tags('','' ); ?>
		    
		</div>	
		<?php } ?>	
		<div class="clear"></div> 
		<div class="link-blog"><div class="cl-effect-5"><a href="<?php the_permalink(); ?>"><span data-hover="<?php if($theme_option['read_more']) { echo esc_attr($theme_option['read_more']); }else{ echo 'read more'; }?>"><?php if($theme_option['read_more']) { echo esc_html($theme_option['read_more']); }else{ echo 'read more'; }?></span></a></div></div>
	</div> 
</div>