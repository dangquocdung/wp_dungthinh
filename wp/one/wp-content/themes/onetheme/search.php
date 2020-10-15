<?php get_header(); ?>

 <?php get_template_part( 'tpl', 'page-title' ); ?>
    <!--==========Content============-->
    <div class="container padd-only-sm">
        <div class="row marg-xs-t50 marg-lg-t90">
            <div class="col-sm-12 col-md-12">
                <div class="container-fluid">
                    <div class="row search-result-data">
                        <?php
                            if (have_posts()):
                                // Start the loop.
                            get_search_form(); 
                                while (have_posts()) : the_post();
                                    get_template_part('loop','search', get_post_format());
                                endwhile;
                            // If no content, include the "No posts found" template.
                            else :
                                get_template_part('content', 'none');
                            endif;
                        ?>
                    </div> 
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>
