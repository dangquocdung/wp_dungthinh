<?php
 /* Template Name: Blog 1 */
 get_header(); 
 ?>
 <?php get_template_part( 'tpl', 'page-title' ); ?>
    <!--==========Content============-->
   <div class="container padd-only-sm">
        <div class="row marg-lg-t90">
            <?php
                $args = array(
                    'post_type' => 'post',
                );
                $posts_query = new WP_Query($args);
                while ( $posts_query->have_posts() ):
                    $posts_query->the_post();
                    get_template_part('loop','content1',get_post_format());
                endwhile;
            ?>
            <?php
                $pagination = TPL::pagination();
                if( !empty($pagination) ){
                    print("<div class='wpc-pagination'>$pagination</div>");
                }
            ?>
        </div>
    </div>
<?php get_footer(); ?>

