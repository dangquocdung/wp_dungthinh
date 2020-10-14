<?php

/**
 * Template Name: Page FullWidth
 */

global $theme_option;
 
get_header();
?>


<div class="section page">
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
	
	<?php while (have_posts()) : the_post(); 
		the_content();
	endwhile; ?>
</div>

<?php get_footer(); ?>						