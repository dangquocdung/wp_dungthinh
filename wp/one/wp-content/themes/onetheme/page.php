<?php
    $page_header = TT::getmeta('page_header');
    if( !empty($page_header) && $page_header!='default' ){
        global $onetheme_header_layout;
        $onetheme_header_layout = $page_header;
    }

    $header_color = TT::getmeta('header_dark');
    if( !empty($header_color) && $header_color!='default' ){
        global $onetheme_header_layout_color;
        $onetheme_header_layout_color = $header_color;
    }
    // get header
    get_header();
?>
    <?php
        if( TT::getmeta('title_show')!='0' ){
            get_template_part("tpl", "page-title");
        }
        $page_class = '';

        if( TT::getmeta('remove_padding')=='1' ){
            $page_class .= 'nopaddding';
        }
        
    ?>
    <?php
        while ( have_posts() ) : the_post();
        $layout_class = 'col-sm-8 col-md-8 ';
        $page_layout = TT::getmeta('page_layout');
        if( $page_layout=='full' ){
            $layout_class = 'col-sm-12';
        }
        if( $page_layout=='left' ){
            $layout_class = 'col-sm-8 col-md-8 pull-right';
        }
    ?>
        <section id="work-section" class="work-section <?php echo esc_attr($page_class); ?> ">
            <div class="container">
               <div class="row">
                   <div class="<?php echo esc_attr($layout_class); ?>">
                      <?php
                       the_content();
                         if (TT::get_mod('page_nextprev') == '1') {
                            wp_link_pages(array(
                                'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'onetheme') . '</span>',
                                'after' => '</div>',
                                'link_before' => '<span>',
                                'link_after' => '</span>',
                                'pagelink' => '<span class="screen-reader-text">' . esc_html__('Page', 'onetheme') . ' </span>%',
                                'separator' => '<span class="screen-reader-text">, </span>',
                            ));
                        }
                       // If comments are open or we have at least one comment, load up the comment template.
                       ?>
                   </div>
                    <?php
                        if( $page_layout!='full' ){
                            global $onetheme_sidebar;
                            $onetheme_sidebar = 'page';
                            get_sidebar();
                        }
                    ?>
                </div>
                <?php
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                ?>
           </div>
        </section>
        <?php endwhile; ?>
<?php 
 // get footer
  get_footer();
?>
