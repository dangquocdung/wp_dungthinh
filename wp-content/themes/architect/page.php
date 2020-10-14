<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package architect
 */
get_header(); ?>

  <!-- Section BreadCrumb -->
  <section>
     <div class="sub-header sub-header-1 sub-header-blog-grid fake-position"
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
  </section><!--  End Section -->

  <section id="content" class="padding">
      <div class="container">
          <div class="row">
            <div class="col-md-9">
              <div id="primary" class="content-area col-md-9 no-padding-right">
                  <main id="main" class="site-main padding-top-50" >

                      <?php while ( have_posts() ) : the_post(); ?>
                      	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        								<?php the_content(); ?>

        								<?php
        									// If comments are open or we have at least one comment, load up the comment template.
        									if ( comments_open() || get_comments_number() ) :
        										comments_template();
        									endif;
        								?>
        								<?php wp_link_pages(); ?>
        							 </div>
        						  <?php endwhile; // End of the loop. ?>

                  </main>
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
