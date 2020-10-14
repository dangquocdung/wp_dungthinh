<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package architect
 */

global $architect_option;

get_header(); ?>
    <!-- Section BreadCrumb -->
    <section>
       <div class="sub-header sub-header-1 sub-header-blog-grid fake-position" <?php if( !empty( $architect_option['bg_blog'] ) ){ ?> style="background-image:url(<?php echo esc_url($architect_option['bg_blog']['url']); ?>);"<?php } ?> >
         <div class="sub-header-content">
             <h2 class="text-cap white-text"><?php echo get_the_title( get_option( 'page_for_posts' ) ); ?></h2>
          </div>
       </div>
    </section>

   <!--List Blog -->
    <section id="content" class="padding">
        <div class="container">
            <div class="row">
                <?php if($architect_option['blog_layout']=='left_s'){ ?>
                <div class="col-md-3">
                  <div class="main-sidebar">            
                     <?php get_sidebar();?>
                  </div>
                </div>
                <?php } ?>
                <div class="col-md-<?php if($architect_option['blog_layout']=='full'){echo '12';}else{echo '9';} ?>">
                  <div class="blog-list <?php if($architect_option['blog_layout']=='left_s'){echo 'blog-list-left';}elseif($architect_option['blog_layout']=='right_s'){echo 'blog-list-right';}else{'';} ?>">

                      <?php 
	                    while (have_posts()) : the_post();
	                      	get_template_part( 'content', get_post_format() ) ;   // End the loop.
	                    endwhile;
                    ?>

                  </div>

                  <div class="pagination-ourter text-left">
                        <?php echo architect_pagination(); ?>
                  </div>
                </div>
                <?php if($architect_option['blog_layout']=='right_s'){ ?>
                <div class="col-md-3">
                  <div class="main-sidebar">            
                	   <?php get_sidebar();?>
                  </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- content close -->

<?php get_footer(); ?>
