<?php

class WPBakeryShortCode_Tt_Blog_Posts extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract(shortcode_atts(array(
            'count'         => '2',
            'excerpt_length'  => '7',
            'categories'    => '',
            'blog_style'    => 'grid',
            'extra_class'   => ''
        ), $atts));

        global $paged;
        if( is_front_page() ){
            $paged = get_query_var('page') ? get_query_var('page') : 1;
        }

        $args = array(
            'post_type' => 'post',
            'posts_per_page' => $count,
            'ignore_sticky_posts' => true,
            'paged' => $paged
        );
        if(!empty($categories)){
            $args['category_name'] = $categories;
        }

        $style = $btn = $items = '';
        $posts_query = new WP_Query($args);
        while ( $posts_query->have_posts() ) {
            $posts_query->the_post();
            $excerpt = TPL::clear_urls( wp_trim_words( wp_strip_all_tags(strip_shortcodes(get_the_content())), $excerpt_length ) );
            $postclass = implode(' ',get_post_class());
            $category = '';

            $post_categories = wp_get_post_categories(get_the_id());
            foreach($post_categories as $c){
                $cat = get_category($c);
                $category = "$cat->name";
            }
            if( $blog_style == 'grid' ) {
             
                $image = '';
                if( has_post_thumbnail() ){
                    $image = get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'wpc-back-img cimg-responsive', 'data-s-hidden' => '1'));
                }

                $items .= "<div class='col-sm-12 col-md-6 blog_grid'>
                            <article class='wpc-short-post clearfix'>
                                <div class='post-img'>$image</div>
                                <div class='post-content'>
                                    <section class='post-data'>
                                        <div class='post-cat'><a href='".get_permalink()."' class='wpc-btn style-3 size-4'>".$category."</a></div>
                                        <h3 class='post-title'><a href='".get_permalink()."'>". get_the_title() ."</a></h3>
                                        <div class='post-date'><i class='fa fa-calendar-o'></i>".get_the_time(get_option('date_format')) ." </div>
                                        <p class='post-text'> ". $excerpt ." </p>
                                        <div class='post-author'>".get_avatar($posts_query->post_author, 57 )."
                                            <div class='author-info'>
                                                <div class='author-posted'>".esc_attr__('POSTED BY', 'onetheme')."</div>
                                                <div class='author-name'>".get_the_author()."</div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </article>
                        </div>";
                }else {

                    $image = '';
                    $col_class = 'col-md-9';
                    $col_img_class = 'col-md-3';
                    if( has_post_thumbnail() ){
                        $image = get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'img-responsive', 'data-s-hidden' => '1'));  
                    } else {
                        $col_class = 'col-md-12';
                        $col_img_class = 'col-md-12';
                    }

                    $items .= "<article class='wpc-short-post blog_grid style-2 clearfix'>
                                <div class='col-xs-12 col-sm-12 $col_class'>
                                    <div class='post-img'>
                                        $image
                                    </div>
                                </div>
                                <div class='col-xs-12 col-sm-12 $col_img_class'>
                                    <div class='post-content'>
                                        <section class='post-data'>
                                            <div class='post-cat'><a href='".get_permalink()."' class='wpc-btn style-3 size-4'>".$category."</a></div>
                                            <h3 class='post-title'><a href='".get_permalink()."'>". get_the_title() ."</a></h3>
                                            <div class='post-date'><i class='fa fa-calendar-o'></i>". get_the_time(get_option('date_format')) ."</div>
                                            <p class='post-text'> ". $excerpt ." </p>
                                            <div class='post-author'>
                                                ".get_avatar($posts_query->post_author, 57 )."
                                                <div class='author-info'>
                                                    <div class='author-posted'>".esc_attr__('POSTED BY', 'onetheme')." </div>
                                                    <div class='author-name'>".get_the_author()."</div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </article>";
                }
        }

        wp_reset_postdata();

        if( $blog_style == 'grid' ) {
            return '<div class="row">
                        '.$items.'
                    </div>';    
        }else {
            return '<div class="blog-post">
                        '.$items.'
                    </div>';
        }
        
    
    }
}

vc_map( array(
    "name" => esc_html__('Blog Posts', 'onetheme'),
    "description" => esc_html__("Only post type: Get post here", 'onetheme'),
    "base" => 'tt_blog_posts',
    "icon" => "icon-wpb-themeton",
    "content_element" => true,
    "category" => esc_html__('One', 'onetheme'),
    'params' => array(
        array(
            "type" => 'textfield',
            "param_name" => "count",
            "heading" => esc_html__("Posts Count", 'onetheme'),
            "value" => '2'
        ),
        array(
            "type" => 'textfield',
            "param_name" => "categories",
            "heading" => esc_html__("Categories", 'onetheme'),
            "description" => esc_html__("Specify category SLUG (not name) or leave blank to display items from all categories. Ex: news,image", 'onetheme'),
            "value" => '',
            'holder' => 'div'
        ),
        array(
            'type' => 'dropdown',
            "param_name" => "blog_style",
            "heading" => esc_html__("Style", 'onetheme'),
            "value" => array(
                "Grid" => "grid",
                "List" => "list"
            ),
            "std" => "grid",
        ),
        array(
            "type" => "textfield",
            "param_name" => "excerpt_length",
            "heading" => esc_html__("Excerpt length", 'onetheme'),
            "value" => "7",
            "description" => ""
        ),
        array(
            "type" => "textfield",
            "param_name" => "extra_class",
            "heading" => esc_html__("Extra Class", 'onetheme'),
            "value" => "",
            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'onetheme'),
        )
    )
));