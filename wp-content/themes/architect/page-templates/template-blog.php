<?php
/**
 * Template Name: Template Blog
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
<section id="content" class="padding">
  <div class="container">
      <div class="row">
          <div class="col-md-9">
              <div class="blog-list">
                   <?php 
                      $args = array(    
                        'paged' => $paged,
                        'post_type' => 'post',
                        );
                      $wp_query = new WP_Query($args);
                      while ($wp_query -> have_posts()): $wp_query -> the_post();                         
                          get_template_part( 'content', get_post_format() ) ; ?> 
                  <?php endwhile;?> 
              </div>

              <div class="pagination-ourter text-left">
                  <?php echo architect_pagination(); ?>
              </div>

          </div>
          
          <div class="col-md-3">
            <div class="main-sidebar">            
               <?php get_sidebar();?>
            </div>
          </div>

      </div>
  </div>
</section>
    <!-- content close -->

<?php get_footer(); ?>