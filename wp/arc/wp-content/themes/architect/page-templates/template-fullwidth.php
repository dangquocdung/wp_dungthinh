<?php
/**
 * Template Name: Template FullWidth
 */
get_header(); ?>
<section>
  <div class="sub-header sub-header-1 sub-header-portfolio-grid-1 fake-position"  
      <?php if( function_exists( 'rwmb_meta' ) ) { ?>       
        <?php $images = rwmb_meta( '_cmb_bg_header', "type=image" ); ?>
            <?php if($images){ foreach ( $images as $image ) { ?>
            <?php $img =  $image['full_url']; ?>
              style="background-image: url('<?php echo esc_url($img); ?>');"
            <?php } } ?>
        <?php } ?>>
    <div class="sub-header-content">
      <h2 class="text-cap white-text"><?php the_title(); ?></h2>
      <?php if($architect_option['bread-switch']==true){ ?>
      <ol class="breadcrumb breadcrumb-arc text-cap">
          <?php if(function_exists('bcn_display')){
              bcn_display();
          }?>
      </ol>
      <?php } ?>
    </div>
  </div>
</section>

<?php if (have_posts()){ ?>
		<?php while (have_posts()) : the_post()?>
			<?php the_content(); ?>
		<?php endwhile; ?>
	<?php }else {
		esc_html_e('Page Canvas For Page Builder', 'architect'); 
}?>

<?php get_footer(); ?>