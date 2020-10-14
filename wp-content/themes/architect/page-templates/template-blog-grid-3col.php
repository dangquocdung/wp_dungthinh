<?php
/**
 * Template Name: Template Blog Grid 3Col
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
          <?php if(function_exists('bcn_display'))
          {
              bcn_display();
          }?>
      </ol>
      <?php } ?>
    </div>
  </div>
</section>

<!--List Blog -->
<section class="padding">
  <div class="container">
      <div class="row">
        <div class="blog-warp blog-grid-3-col clearfix">
          <div class="blogFilter blog-terms line-effect-2">
            <a href="#" class="current" data-filter="*" title=""> <h4><?php esc_html_e('All Categories','architect'); ?></h4></a>
            <?php 
                      $categories = get_categories();
                       foreach( (array)$categories as $categorie){
                        $cat_name = $categorie->name;
                        $cat_slug = $categorie->slug;
                      ?>
             <a href="#" data-filter=".<?php echo esc_attr($cat_slug); ?>"><h4><?php echo esc_attr($cat_name); ?></h4></a>
            <?php } ?>
          </div>
              <div class="clearfix blogContainer blog-grid-3-col-container">
                  <?php if(have_posts()) : ?>
                    <?php 
                       $args = array(   
                         'post_type' => 'post',   
                         'posts_per_page' => -1,             
                       );  
                       $wp_query = new WP_Query($args);
                       while ($wp_query -> have_posts()) : $wp_query -> the_post(); 
                       $cates = get_the_terms(get_the_ID(),'category');
                       $cate_name ='';
                       $cate_slug = '';
                          foreach((array)$cates as $cate){
                           if(count($cates)>0){
                             $cate_name .= $cate->name.' ' ;
                             $cate_slug .= $cate->slug .' ';     
                           } 
                       }
                    ?>
                        <div class="element-item <?php echo esc_attr($cate_slug); ?>">
                                    
                          <article>
                              <figure class="latest-blog-post-img">
                                <a href="<?php the_permalink(); ?>">     
                                <?php if( function_exists( 'rwmb_meta' ) ) { ?>
                                  <?php $images = rwmb_meta( '_cmb_image', "type=image" ); ?>
                                  <?php if($images){ ?>   
                                    <?php  foreach ( $images as $image ) {  ?>
                                        <?php $img = $image['full_url']; ?>
                                        <img src="<?php echo esc_url($img); ?>" class="img-responsive" alt="">
                                    <?php } }else{    
                                    if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                                        the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
                                    } 
                                    } ?>      
                                <?php } ?> 
                                </a>
                              </figure>
                              <div class="latest-blog-post-description">
                                  <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
                                  <?php if(has_category()) { ?>
                                  <div class="latest-blog-post-data">
                                      <p class="tags text-cap">
                                        <?php the_category( ', '); ?>
                                      </p>
                                  </div>
                                  <?php } ?>
                                  <div class="latest-blog-post-date-2  text-cap">
                                    <span class="month"><?php the_time('M') ?></span>
                                    <span class="day"><?php the_time('d,') ?></span>
                                    <span class="year"><?php the_time('Y') ?></span>
                                  </div>
                                  <p><?php echo architect_excerpt(18); ?></p>
                                  
                             </div>
                          </article>
                        </div> 

                  <?php endwhile;?> 
              </div>


          </div>
          <?php endif; ?> 

      </div>
  </div>
</section>
    <!-- content close -->

<?php get_footer(); ?>