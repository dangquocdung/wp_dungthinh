<?php
 global $theme_option;
 
get_header();
?>

<?php while (have_posts()) : the_post(); ?>
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
	<div class="container">
		<div class="nine columns">
			<div class="blog-post single-article">

			<?php the_content(); wp_link_pages(); ?>
			<?php 
			 // If comments are open or we have at least one comment, load up the comment template.
			 if ( comments_open() || get_comments_number() ) :
			  comments_template();
			 endif; 
			?>
			</div>
		</div>
		<div class="three columns">
			<?php get_sidebar(); ?>
		</div>
	</div>	
</div>
<?php endwhile; ?>

<?php get_footer(); ?>						
