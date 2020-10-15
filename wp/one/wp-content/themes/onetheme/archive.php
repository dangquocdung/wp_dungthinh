<?php get_header(); ?>
<?php get_template_part( 'tpl', 'page-title' ); ?>
    <!--==========Content============-->
    <div class="container padd-only-sm">
        <div class="row marg-xs-t50 marg-lg-t90">
            <div class="col-sm-12 col-md-8">
                <div class="container-fluid">
                    <div class="row">
                        <?php
                            $args = array(
                                'post_type' => 'post'
                            );
                            $posts_query = new WP_Query($args);
                            while ( $posts_query->have_posts() ):
                                $posts_query->the_post();
                                get_template_part('loop', 'content2', get_post_format());
                            endwhile;
                        ?>
                        <div class="wpc-pagination">
                            <?php print TPL::pagination(); ?>
                        </div>
                    </div> 
                </div>
            </div>
            <?php get_sidebar();?> 
        </div>
    </div>
<?php get_footer(); ?>