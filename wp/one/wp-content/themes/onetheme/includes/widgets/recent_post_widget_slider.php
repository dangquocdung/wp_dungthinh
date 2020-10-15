<?php

class tt_PopularPostsWidgetSlide extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'latest_blogs', 'description' => 'LatestPost');
        parent::__construct(false, ':Latest Post Slider', $widget_ops);
    }
    function widget($args, $instance) {
        global $post;
        extract($args);
        extract(array_merge(array(
                    'title' => 'post_slider',
                    'number_posts' =>3,
                    'exclude_posts' => '',
                        ), $instance));
        print($before_widget);
        if ($title != ''){
            print "" . $args['before_title'] . $title . $args['after_title'];
        }
        // build query
        $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => $number_posts,
                        'ignore_sticky_posts' => true,
                        'category__not_in' => explode(',', $exclude_posts)
                    );
        $featured_item = '';
        $post_items = '';
        $post_index = 0;
        $posts_query = new WP_Query($args);
        while ( $posts_query->have_posts() ) {
            $posts_query->the_post();
            $post_index++;
            $cat_link = '';
            $cat_title = '';
            $post_categories = wp_get_post_categories(get_the_id());
            foreach($post_categories as $c){
                $cat = get_category($c);
                $cat_link = esc_attr(get_term_link($cat));
                $cat_title = $cat->name;
            }

            $thumb_img = get_template_directory_uri().'/images/post-image.jpg';
            
            if( has_post_thumbnail() ){
                $thumb_img = wp_get_attachment_image_url( get_post_thumbnail_id(), 'one-widget-slide');
            }
            $featured_item .= '<div class="swiper-slide">
                                    <article class="footer-post">
                                        <div class="post-img"> 
                                            <img src="'.$thumb_img.'" class="img-responsive wpc-back-img" data-s-hidden = "1" alt="'.esc_attr__('image', 'onetheme').'">
                                        </div>
                                        <h3 class="post-title">'.get_the_title().'</h3>
                                        <div class="post-data">'.get_the_time(get_option( 'date_format' )).' - '.get_comments_number('0', '1', '%').'</div>
                                    </article>
                                </div>';
        }
        echo '<section class="footer-col marg-sm-t40">
                    <div class="swiper-container footer-slider" data-autoplay="5000" data-loop="1" data-speed="1000" data-slides-per-view="1" data-add-slides="1" data-xs-slides="1" data-sm-slides="1" data-md-slides="1" data-lg-slides="1">
                        <div class="swiper-wrapper">
                            '.$featured_item.'
                        </div>
                        <div class="pagination point-style-1 text-left"></div>
                    </div>
                </section>';
        print($after_widget);
        wp_reset_postdata();
        /* <span>On '.the_time('D M Y').'</span>*/

    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['number_posts'] = sanitize_text_field($new_instance['number_posts']);
        $instance['exclude_posts'] = sanitize_text_field($new_instance['exclude_posts']);
        return $instance;
    }
    function form($instance) {
        //Output admin widget options form
        extract(shortcode_atts(array(
                    'title' => '',
                    'number_posts' => 3,
                    'exclude_posts' => '',
                        ), $instance));
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e("Title:", 'onetheme'); ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($title); ?>"  />
        </p>
        <p>
            <input type="text" id="<?php echo esc_attr($this->get_field_id('number_posts')); ?>" name="<?php echo esc_attr($this->get_field_name('number_posts')); ?>" value="<?php echo esc_attr($number_posts); ?>" size="3" />
            <label for="<?php echo esc_attr($this->get_field_id('number_posts')); ?>">Number of posts to show</label>
        </p>
        <p>
            <input type="text" id="<?php echo esc_attr($this->get_field_id('exclude_posts')); ?>" name="<?php echo esc_attr($this->get_field_name('exclude_posts')); ?>" value="<?php echo esc_attr($exclude_posts); ?>" size="3" />
            <label for="<?php echo esc_attr($this->get_field_id('exclude_posts')); ?>">Exclude category ID (optional)</label>
            <br><small>You can include multiple categories with comma separation.</small>
        </p>
        <?php
    }
}
add_action('widgets_init', create_function('', 'return register_widget("tt_PopularPostsWidgetSlide");'));
