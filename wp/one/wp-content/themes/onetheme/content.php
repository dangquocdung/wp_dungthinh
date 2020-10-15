<?php
    $content_class = 'wpc-short-post style-2 clearfix';
    if (is_single()) {
        $content_class .= 'wpc-short-post single-blog-post clearfix style-4';
    } else {
        $content_class .= '';
    }

    $format = get_post_format();

    $loop_quote_link = !is_single() && ($format == 'quote' || $format == 'link');
    $loop_quote_link_media = '';
    if ($loop_quote_link) {
        $loop_quote_link_media = TPL::get_post_media();
        if (strlen($loop_quote_link_media) < 40) {
            $loop_quote_link = false;
        }
    }
    if ($loop_quote_link) {
        $content_class .= 'loop-quote-link';
    }
    $thumb_img = '';
    if( has_post_thumbnail() ){
        $thumb_img = wp_get_attachment_image_url( get_post_thumbnail_id(),'large');
    }
       
?>  
<article <?php post_class($content_class); ?>>
    <?php
       
    ?>   
    <?php if( has_post_thumbnail() ): ?>
            <div class="post-img_single"> 
                <img src="<?php echo esc_url($thumb_img); ?>" alt="<?php esc_attr_e('Thumbnail', 'onetheme'); ?>" class="img-responsive" data-s-hidden="1"/>    
            </div>
        <?php endif;?>
    <div class="post-content"> 
        <section class="post-data clearfix">
            <div class="post-left">
                <div class="post-cat">
                    <?php
                        $categories = get_the_category();
                        $output = '';
                        if (!empty($categories)) {
                            foreach ($categories as $category) {
                                $output .= ' <a href="' . esc_url(get_category_link($category->term_id)) . '" class="wpc-btn style-3 size-4">' .esc_html($category->name) .'</a> ';
                            }
                        }
                     printf($output);?>
                </div>
                <div class="post-date"><i class="fa fa-calendar-o"></i><?php the_time(get_option( 'date_format' )); ?></div>
            </div>
            <div class="post-author">
            <?php global $post; echo get_avatar($post->post_author, 57, '', esc_attr__('Avatar', 'onetheme'), array('class'=>'author-photo')); ?>
                <div class="author-info">
                    <div class="author-posted"><?php esc_attr_e('POSTED BY', 'onetheme');?></div>
                    <div class="author-name"><?php the_author_posts_link(); ?></div>
                </div>
            </div>
        </section>
        <div class="post-text"> 
            <?php the_content();
                wp_link_pages(array(
                    'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'onetheme') . '</span>',
                    'after' => '</div>',
                    'link_before' => '<span>',
                    'link_after' => '</span>',
                    'pagelink' => '<span class="screen-reader-text">' . esc_html__('Page', 'onetheme') . ' </span>%',
                    'separator' => '<span class="screen-reader-text">, </span>',
                ));
            ?>
        </div>
    </div>
    <!-- TAGS -->
    <div class="wpc-post-tags">
        <?php if (get_the_tag_list()):?>
            <h5 class="post-tags-title"><i class="fa fa-tag"></i><?php esc_attr_e('Tags:', 'onetheme');?></h5>
            <ul class="post-tags-list">
                <li>
                    <?php 
                        $tag_list = get_the_tag_list();
                        if( !empty($tag_list) ):
                            echo get_the_tag_list('', ', ');
                        endif;
                    ?>
                 </li>
            </ul>
        <?php endif; ?>
    </div>
</article>