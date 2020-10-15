<?php get_header(); ?>

 <?php get_template_part( 'tpl', 'page-title' ); ?>
    <!--==========Content============-->
    <div class="container padd-only-sm">
        <div class="row marg-xs-t50 marg-lg-t90">
            <div class="col-md-12">
                <?php
                    while ( have_posts() ) : the_post();
                        get_template_part( 'content', get_post_format() );

                        TPL::get_related_posts();
                        
                        if ( comments_open() || get_comments_number() ) : 
                            comments_template();
                        endif;
                    
                    endwhile;
                ?>
            </div>
        </div> 
    </div>
    
<?php get_footer(); ?>