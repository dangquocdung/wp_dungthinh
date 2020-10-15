<?php

class TPL{


    public static function get_post_media(){
        global $post;
        $media = '';
        if( has_post_thumbnail() ){
            $thumb_img = wp_get_attachment_image( get_post_thumbnail_id(), 'large' );
            $media = '<a href="'.get_permalink().'" class="el-link">'. $thumb_img .'<div class="entry-overlay"></div></a>';
        }

        $format = get_post_format();

        if( current_theme_supports('post-formats', $format) ){


            // blockquote
            if( $format=='quote' ){
                preg_match("/<blockquote>(.*?)<\/blockquote>/msi", get_the_content(), $matches);
                if( isset($matches[0]) && !empty($matches[0]) ){
                    $media = $matches[0];
                    $media = str_replace("<blockquote", "<blockquote class='quote-element'", $media);
                }
            }

            // link
            if( $format=='link' ){
                preg_match('/<a\s[^>]*href=\"([^\"]*)\"[^>]*>(.*)<\/a>/siU', get_the_content(), $matches);
                if( isset($matches[1],$matches[2]) && !empty($matches[2]) ){
                    $media = "<blockquote class='link-element'>
                                $matches[2]
                                <cite><a href='$matches[1]'>$matches[1]</a></cite>
                              </blockquote>";
                }
            }


            // gallery
            else if( $format=='gallery' && has_shortcode($post->post_content, 'gallery') ){
                $gallery = get_post_gallery( get_the_ID(), false );
                $ids = explode(",", isset($gallery['ids']) ? $gallery['ids'] : "");

                $gallery_id = uniqid();
                $gallery = '';
                $indicators = '';
                $indx = 0;
                foreach ($ids as $gid) {
                    $img = wp_get_attachment_image( $gid, 'large' );
                    $gallery .= "<div class='swiper-slide'>$img</div>";
                    $indx++;
                }


                $media = !empty($gallery) ? "<div class='gallery-slideshow'>
                                                <div class='swiper-container gallery-container'>
                                                    <div class='swiper-wrapper'>$gallery</div>
                                                </div>
                                                <div class='swiper-button-prev'></div>
                                                <div class='swiper-button-next'></div>
                                            </div>" : $media;

                $media = $media;
            }


            // audio
            else if( $format=='audio' ){
                $pattern = get_shortcode_regex();
                preg_match('/'.$pattern.'/s', $post->post_content, $matches);
                if (is_array($matches) && isset($matches[2]) && $matches[2] == 'audio') {
                    $shortcode = $matches[0];
                    $media = '<div class="mejs-wrapper audio">'. do_shortcode($shortcode) . '</div>';
                }
                else{
                    $frame = "frame";
                    $regx = "/<i$frame(.)*<\/i$frame>/msi";
                    preg_match($regx, get_the_content(), $matches);
                    if( isset($matches[0]) && !empty($matches[0]) ){
                        $media = $matches[0];
                    }
                    else{
                        if ( preg_match( '|^\s*(https?://[^\s"]+)\s*$|im', $post->post_content, $matches ) ) {
                            if(isset($matches[1])) {
                                $media = "<div class='audio-post'>".apply_filters( "tt_media_filter", $matches[1] )."</div>";
                            }
                        }
                    }
                }
                $media = $media;
            }



            // video
            else if( $format=='video' ){
                if ( preg_match( '|^\s*(https?://[^\s"]+)\s*$|im', $post->post_content, $matches ) ) {
                    if(isset($matches[1])) {
                        $media = "<div class='video-post'>".apply_filters( "tt_media_filter", $matches[1] )."</div>";
                    }
                }
            }

            
        }

        return !empty($media) ? "<div class='entry-media'>$media</div>" : "";
    }



    public static function get_folio_gallery($fpost){
        if( has_shortcode($fpost->post_content, 'gallery') ):
            $gallery = get_post_gallery( $fpost->ID, false );
            $ids = explode(",", isset($gallery['ids']) ? $gallery['ids'] : "");

            $gallery_items = '';
            foreach ($ids as $a_id):
                $img_full = wp_get_attachment_image( $a_id, 'full' );

                $gallery_items .= '<div class="gallery-item">
                                        '.$img_full.'
                                    </div>';

            endforeach;

            return '<div class="gallery-slider owl-carousel">'.$gallery_items.'</div>';
        endif;

        return '';
    }



    public static function get_author_link(){
        global $post;
        return get_author_posts_url(get_the_author_meta('ID'));
    }


    
    public static function get_author_name(){
        global $post;
        return get_the_author();
    }
 
    public static function pagination( $query=null ) {
        global $wp_query;
        $query = $query ? $query : $wp_query;
        $big = 999999;
        $paginate = paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'type' => 'array',
            'total' => $query->max_num_pages,
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'prev_text' =>esc_html__('Previous', 'onetheme'),
            'next_text' => esc_html__('Next', 'onetheme'),
            )
        );
        //$paginate = paginate_links(array('type' => 'array'));

        $result = '';
        if ($query->max_num_pages > 1) :
            $result .= "<ul>";
            foreach ( $paginate as $page ) {
                $result .= "<li>$page</li>";
            }
            $result .= "</ul>";
        endif;
        return $result;


    }



    public static function build_theme_image_support(){
        add_theme_support('custom-header');
        add_theme_support('custom-background');
        add_editor_style( array('css/editor-style.css') );
    }

    


    public static function getCategories($post_id, $post_type){
        $cats = array();
        $taxonomies = get_object_taxonomies($post_type);
        if( !empty($taxonomies) ){
            $tax = $taxonomies[0];
            if( $post_type=='product' )
                $tax = 'product_cat';
            $terms = wp_get_post_terms($post_id, $tax);
            foreach ($terms as $term){
                $cats[] = array(
                                'term_id' => $term->term_id,
                                'name' => $term->name,
                                'slug' => $term->slug,
                                'link' => get_term_link($term)
                                );
            }
        }

        return $cats;
    }


    public static function get_share_links(){
        $social = array();

        $social['facebook'] = 'http://www.facebook.com/sharer.php?u='.esc_url(get_permalink());
        $social['twitter'] = 'https://twitter.com/share?url='.esc_url(get_permalink()).'&text='.esc_attr(get_the_title());
        $social['instagram'] = 'https://instagram.com/share?url='.esc_url(get_permalink());
        $social['pinterest'] = 'https://pinterest.com/pin/create/bookmarklet/?media='.esc_url(isset($thumb[0]) ? $thumb[0] : '').'&url='.esc_url(get_permalink()).'&description='.esc_attr(get_the_title());

        return $social;
    }

    public static function get_social_links(){
        $social_fb = TT::get_mod('social_fb');
        $social_tw = TT::get_mod('social_tw');
        $social_ins = TT::get_mod('social_ins');
        $social_pin = TT::get_mod('social_pin');
        
        if( !empty($social_fb) ){
            echo '<li><a href="'.esc_attr($social_fb).'">'.esc_attr('Facebook','onetheme').'</a></li>';
        }
       
        if( !empty($social_tw) ){
            echo '<li><a href="'.esc_attr($social_tw).'">'.esc_attr('Twitter','onetheme').'</a></li>';
        }
        if( !empty($social_ins) ){
            echo '<li><a href="'.esc_attr($social_ins).'">'.esc_attr('Instagram','onetheme').'</a></li>';
        }
        if( !empty($social_pin) ){
            echo '<li><a href="'.esc_attr($social_pin).'">'.esc_attr('Pinterest','onetheme').'</a></li>';
        }
    }


    public static function clear_urls($content){
        $pattern = "/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'\".,<>?]))/";
        $content = preg_replace($pattern, "", $content);
        return trim( $content );
    }

    //page title

    public static function get_page_title(){
        global $post;
        if( function_exists('is_shop') && is_shop() ):
            printf( "%s", esc_html__('Shop', 'onetheme') );
        elseif( function_exists('is_shop') && is_product() ):
            printf( "%s", esc_html__('Shop Details', 'onetheme') );
        elseif( is_archive() ):
            if(function_exists('the_archive_title')) :
                the_archive_title();
            else:
                printf( wp_kses( esc_attr__('Category: <span>%s</span>', 'onetheme'), array('span'=>array()) ), single_cat_title( '', false ) );
            endif;

        elseif( is_search() ):
            printf( 'Search Results for: <span>%s</span>', get_search_query() );
        elseif( is_singular('portfolio') ):
            printf( '%s', get_the_title() );
        elseif( is_single() ):
            printf( '%s', get_the_title() );
        elseif( is_front_page() || is_home() ):
            if( get_query_var('post_type')=='portfolio' ):
                printf('%s', esc_html__('Projects', 'onetheme'));
            elseif( !is_front_page() && is_home() ):
                $reading_blog_page = get_option('page_for_posts');
                $po = get_post($reading_blog_page);
                echo apply_filters('the_title', $po->post_title);
            else:
                
            endif;
        elseif( is_404() ):
            printf( "%s", esc_html__('404 Page', 'onetheme') );
        else:
            the_title();
        endif;
    }


    /*related*/
    public static function get_related_posts( $options=array() ){
        $options = array_merge(array(
                    'per_page'=>'3'
                    ),
                    $options);

        global $post;

        $args = array(
            'post__not_in' => array($post->ID),
            'posts_per_page' => $options['per_page']
        );
        $post_type_class = 'blog';

        $categories = get_the_category($post->ID);
        if ($categories) {
            $category_ids = array();
            foreach ($categories as $individual_category) {
                $category_ids[] = $individual_category->term_id;
            }
            $args['category__in'] = $category_ids;
        }

        // For portfolio post and another than Post
        if($post->post_type == 'portfolio') {
            $tax_name = 'portfolio_entries'; //should change it to dynamic and for any custom post types
            $args['post_type'] =  get_post_type(get_the_ID());
            $args['tax_query'] = array(
                array(
                    'taxonomy' => $tax_name,
                    'field' => 'id',
                    'terms' => wp_get_post_terms($post->ID, $tax_name, array('fields'=>'ids'))
                )
            );
            $post_type_class = 'portfolio';
        }

        if(isset($args)) {
            $my_query = new wp_query($args);
            if ($my_query->have_posts()) {

                $html = '';
                $item ='';
                while ($my_query->have_posts()) {
                    $my_query->the_post();

                    //$img = wp_get_attachment_image( get_post_thumbnail_id( $post->ID ), 'full', false, array("class"=>"bg_post") );

                    $img_src = '';
                    $image = '';
                    if( has_post_thumbnail() ){
                        $image = wp_get_attachment_image( get_post_thumbnail_id( get_the_ID() ), 'full', false, array("class"=>"bg-post") );
                        $img_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                        $img_src = $img_src[0];
                    }   
                    $category = '';
                    $post_categories = wp_get_post_categories(get_the_id());
                    foreach($post_categories as $c){
                        $cat = get_category($c);
                        $category = "$cat->name";
                    }
                    $item .= '<div class="swiper-slide">
                                <div class="col-sm-12 no-padd">
                                    <article class="wpc-short-post style-5 clearfix">
                                        <div class="post-img"> 
                                         <img src="'.$img_src.'" alt="'.esc_attr__('image', 'onetheme').'" class="img-responsive wpc-back-img" data-s-hidden="1">
                                        </div>
                                        <div class="post-content">
                                            <section class="post-data">
                                                <div class="post-cat"><a href="'.get_the_permalink().'" class="wpc-btn style-3 size-4">'.$category.'</a></div>
                                                <h3 class="post-title"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3>
                                                <div class="post-date"><i class="fa fa-calendar-o"></i>'.get_the_time(get_option('date_format')).'</div>
                                                <p class="post-text">'.get_the_excerpt().'</p>
                                                <div class="post-author">
                                                    '.get_avatar($my_query->post_author, 57 ).'
                                                    <div class="author-info">
                                                        <div class="author-posted">'.esc_attr__('POSTED BY', 'onetheme').'</div>
                                                        <div class="author-name">'.get_the_author().'</div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </article>
                                </div>
                            </div>';
                    
                }
                $html .= '<section class="wpc-heading-2 marg-lg-t20">
                            <h3 class="heading-title">'.esc_attr__('Related Posts', 'onetheme').'</h3>
                            <p class="heading-text">'.esc_attr__('COOL WIDGETS', 'onetheme').'</p>
                        </section>
                        <div class="wpc-posts-slider">
                            <div class="outer-slider-arrows">
                                <div class="swiper-outer-left-2 fa fa-angle-left"></div>
                                <div class="swiper-outer-right-2 fa fa-angle-right"></div>
                            </div>
                            <div class="swiper-container" data-autoplay="5000" data-loop="1" data-speed="1000" data-slides-per-view="responsive" data-add-slides="2" data-xs-slides="1" data-sm-slides="1" data-md-slides="2" data-lg-slides="2">
                                <div class="swiper-wrapper">
                                    '.$item.'
                                </div>
                                <div class="pagination"></div>
                            </div>
                        </div>';

                printf($html);
            }
        }
        wp_reset_postdata();
    }
    /* end related */

}
