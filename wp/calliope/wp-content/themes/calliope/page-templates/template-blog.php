<?php

/* Template Name: Blog */

global $theme_option;
 
get_header(); ?>

	<div class="section blog"> 
		<?php 
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		 
		if ( is_plugin_active('meta-box/meta-box.php') ) { ?>
		<?php $images = rwmb_meta( '_cmb_bg_pagehead', "type=image_advanced" ); ?>
	    <?php if($images) {                                                  
	    foreach ( $images as $image ) {
	    $bg = $image['full_url']; ?>
		<div class="head-page background-blog-head" style="<?php if($bg) { ?>background-image: url(<?php echo esc_url($bg); ?>);<?php } ?>">	
		<?php } }else{ ?>
		<div class="padding-top"><?php } }else{ ?><div class="padding-top"><?php } ?>
			<div class="container z-index">
				<div class="twelve columns">
					<h1><?php the_title(); ?></h1> 
					<div class="sep-center"></div>
					<?php $sub_page = get_post_meta(get_the_ID(),'_cmb_sub_page', true);?>
					<p><?php echo esc_html($sub_page); ?></p>
				</div>	
			</div>
		</div>
		<?php if ( have_posts() ) : $i=0; 
		$args = array(    		

			'paged' => $paged,
			'post_type' => 'post',

			);

		$wp_query = new WP_Query($args);

		while ($wp_query -> have_posts()): $wp_query -> the_post(); ?>	
			<div class="blog-wrap<?php if($i%2 != 0) echo ' post2'; ?>">	
			<?php get_template_part( 'content', get_post_format() ) ; ?>
			</div>
		<?php $i++; endwhile;?>
	
		<?php else: ?>
			<h1><?php _e( 'Nothing Found Here!', 'calliope'); ?></h1>
		<?php endif; ?>	
		
		<div class="pagination text-center ">
           <?php echo calliope_pagination();?>
        </div>
	</div>

<?php get_footer(); ?>