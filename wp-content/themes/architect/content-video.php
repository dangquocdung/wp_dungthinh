<article>
  <figure class="latest-blog-post-img effect-zoe">
    <?php if( function_exists( 'rwmb_meta' ) ) { ?>
        <?php $link_video = get_post_meta(get_the_ID(),'_cmb_link_video', true); ?>
        <?php if($link_video){ ?>  
            <?php echo wp_oembed_get( $link_video ); ?>                       
        <?php } ?>
      <?php } ?>
    <div class="latest-blog-post-date text-cap">
      <span class="day"><?php the_time('d') ?></span>
      <span class="month"><?php the_time('M') ?></span>
    </div>                  
  </figure>
  <div class="latest-blog-post-description">
      <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
      <p> <?php echo architect_excerpt_length(); ?></p>      
      <a href="<?php the_permalink(); ?>" class="ot-btn btn-main-color text-cap">
        <?php esc_html_e('Continue Reading...','architect'); ?>
      </a>
  </div>
</article>