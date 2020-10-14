<?php
 global $architect_option; 

get_header(); ?>
<section>
  <div class="sub-header sub-header-1 sub-header-portfolio-grid-1 fake-position"  
      <?php if($architect_option['bg_blog'] != ''){ ?> style="background-image:url(<?php echo esc_url($architect_option['bg_blog']['url']) ?>)"<?php } ?>>
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
<!-- content begin -->
<section class="padding padding-bottom-0">
        <div class="lastest-project-warp portfolio-grid-2-warp clearfix">
    <div class="clearfix projectContainer portfolio-grid-2-container">
        <?php while (have_posts()) : the_post(); ?>             
        <!-- gallery item -->
        <div class="element-item">
                <a class="portfolio-img-demo" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?></a>
                <div class="project-info">
                   <a href="<?php the_permalink(); ?>">
                      <h4 class="title-project text-cap text-cap"><?php the_title(); ?></h4>
                   </a>
                   <?php       
                        $terms = get_the_terms(get_the_ID(),'categories');
                        //echo '<ul>';
                        foreach ( $terms as $term ) { 
                         $i++;
                            // The $term is an object, so we don't need to specify the $taxonomy.
                            $term_link = get_term_link( $term );
                           
                            // If there was an error, continue to the next term.
                            if ( is_wp_error( $term_link ) ) {
                                continue;
                            }

                            // We successfully got a link. Print it out.          
                            echo '<a class="cateProject" href="' . esc_url( $term_link ) . '">' . $term->name . '</a> ';
                        }

                        //echo '</ul>';
                       ?>
                </div>
            </div>    
        <!-- close gallery item -->
       <?php endwhile; ?>
  </div>
</section>
<!-- content close -->
<?php get_footer(); ?>
