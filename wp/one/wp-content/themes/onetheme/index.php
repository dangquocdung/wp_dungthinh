<?php get_header(); ?>
<?php get_template_part( 'tpl', 'page-title' ); ?>
    <!--==========Content============-->
    <div class="container padd-only-sm">
        <div class="row marg-xs-t50 marg-lg-t90">
            <div class="col-sm-12 col-md-8">
                <div class="container-fluid">
                    <div class="row">
                        <?php
                            while ( have_posts() ):
                                the_post();
                                get_template_part('loop','content',get_post_format());
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
            </div>
            <?php get_sidebar();?> 
        </div>
    </div>
<?php get_footer(); ?>