<?php 
global $theme_option;
?>


<div class="container">
	<div class="six columns">
		<?php 
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		 
		if ( is_plugin_active('meta-box/meta-box.php') ) { ?>
		<?php $link_video = get_post_meta(get_the_ID(),'_cmb_link_video', true);?>
		<?php if($link_video !=''){?>
			<div class="video">
				<iframe height="330" src="<?php echo esc_url($link_video);?>" ></iframe>
			</div>
		<?php } } ?>
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

