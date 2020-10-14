
<?php 
	get_header(); 
$link_out = get_post_meta(get_the_ID(),'_cmb_link_out', true);
$style = get_post_meta(get_the_ID(),'_cmb_style_folio', true);
?>
<?php if($style == 'style1'){ ?>
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
          <?php if(function_exists('bcn_display'))
          {
              bcn_display();
          }?>
      </ol>
      <?php } ?>
    </div>
  </div>
</section>
<?php } ?>
<!-- content begin -->
	<?php while (have_posts()) : the_post()?>
		<?php the_content(); ?>
	<?php endwhile; ?>
<!-- content close -->
<?php if($style != 'style3'){ ?>
<div class="container">
  <div class="row">
    <div class="col-md-12">
    <?php } ?>
    <?php if($style == 'style3'){ ?><div class="detail-folio-3"><?php } ?>
    <p class="arr-pj-container text-center">
      <?php $prev_post = get_adjacent_post(false, '', true); $next_post = get_adjacent_post(false, '', false); ?>
      <?php if($prev_post) { ?><a class="prev-pj-arr text-cap" href="<?php echo get_permalink($prev_post->ID); ?>"><i class="fa fa-angle-left" aria-hidden="true"></i><?php esc_html_e('Prev','architect'); ?></a><?php } ?>
      <a href="<?php echo esc_url($link_out); ?>" class="btn-portfolio"><i class="fa fa-th" aria-hidden="true"></i></a>
      <?php if($next_post) { ?><a class="next-pj-arr text-cap" href="<?php echo get_permalink($next_post->ID); ?>"><?php esc_html_e('Next','architect'); ?><i class="fa fa-angle-right" aria-hidden="true"></i></a><?php } ?>
    </p>
    <?php if($style != 'style3'){ ?><div class="divider-line margin-bot-folio"></div><?php } ?>
    <?php if($style == 'style3'){ ?></div><?php } ?>
    <?php if($style != 'style3'){ ?>
    </div>
  </div>
</div>
<?php } ?>
<?php get_footer(); ?>