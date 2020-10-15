 <?php
        $content_class = 'wpc-short-post post_content style-3 clearfix marg-lg-b40';
        if (is_single()) {
            $content_class .= 'wpc-short-post clearfix style';
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
    <!-- entry- cover -->
    <?php if( has_post_thumbnail() ): ?>
        <div class="post-img"> 
            <img src="<?php echo esc_url($thumb_img); ?>" alt="<?php esc_attr_e('Thumbnail', 'onetheme'); ?>" class="img-responsive wpc-back-img" data-s-hidden="1"/>    
        </div>
    <?php endif;?>
    <div class="post-content">
        <section class="post-data">
            <div class="post-cat">
                <?php
                    $categories = get_the_category();
                    $output = '';
                    if (!empty($categories)) {
                        foreach ($categories as $category) {
                        $output .= '<a href="'.get_permalink().'" class="wpc-btn style-3 size-4">' .esc_html($category->name) .'</a> ';
                        }
                    }
                    printf($output); ?>
            </div>
            <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <div class="post-date"><i class="fa fa-calendar-o"></i><?php the_time(get_option('date_format')); ?></div>
            <div class="post-text"><?php the_excerpt(); ?></div>
            <div class="post-author">
                <?php global $post; echo get_avatar($post->post_author, 57, '', esc_attr__('Avatar', 'onetheme'), array('class'=>'author-photo')); ?>
                <div class="author-info">
                    <div class="author-posted"><?php esc_attr_e('POSTED BY', 'onetheme');?></div>
                    <div class="author-name"><?php the_author_posts_link(); ?></div>
                </div>
            </div>
        </section>
     </div>
</article>
            <!-- entry-detail-->
