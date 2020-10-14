<article> 
  <div class="slide-services">
    <div class="customNavigation">
      <a class="btn prev-detail-services"><i class="fa fa-angle-left"></i></a>
      <a class="btn next-detail-services"><i class="fa fa-angle-right"></i></a>
    </div>
  <figure class="latest-blog-post-img effect-zoe">
    <a href="<?php the_permalink(); ?>">
      <?php if( function_exists( 'rwmb_meta' ) ) { ?>
        <?php $images = rwmb_meta( '_cmb_images', "type=image" ); ?>
       
        <div id="sync3" class="owl-carousel owl-detail-services clearfix">
        <?php if($images){ ?>              
            <?php  foreach ( $images as $image ) {  ?>
                <?php $img = $image['full_url']; ?>
                <div class="item">
                  <img src="<?php echo esc_url($img); ?>" class="img-responsive" alt="">
                </div>
            <?php } ?>  
        </div>         
        <?php }else{
            if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
            } 
        } ?>
    <?php } ?>      
    </a>
    <div class="latest-blog-post-date text-cap">
      <span class="day"><?php the_time('d') ?></span>
      <span class="month"><?php the_time('M') ?></span>
    </div>
                  
  </figure>
  </div>     
  <div class="latest-blog-post-description">
      <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
      <p> <?php echo architect_excerpt_length(); ?></p>
      
      <a href="<?php the_permalink(); ?>" class="ot-btn btn-main-color text-cap">
        <?php esc_html_e('Continue Reading...','architect'); ?>
      </a>
  </div>
</article>