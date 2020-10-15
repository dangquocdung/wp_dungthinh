<?php

class WPBakeryShortCode_Tt_Portfolio extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract(shortcode_atts(array(
            'filter' => 'yes',
            'columns' => '4',
            'count' => '8',
            'space' => 'yes',
            'heading_title' => 'standard',
            'style' => 'style-1',
            'categories' => '',
            'extra_class' => ''
        ), $atts));

        // Build category ids
        global $paged;
        if( is_front_page() ){
            $paged = get_query_var('page') ? get_query_var('page') : 1;
        }

        // build category ids
        $cats = array();
        if( !empty($categories) ){
            $exps = explode(",", $categories);
            foreach($exps as $val){
                if( (int)$val>-1 ){
                    $cats[]=(int)$val;
                }
            }
        }
        // build query
        $args = array(
                        'post_type' => 'portfolio',
                        'posts_per_page' => $count,
                        'ignore_sticky_posts' => true,
                        'paged' => $paged
                    );
        if(!empty($cats)){
            $args['tax_query'] = array(
                                    'relation' => 'IN',
                                    array(
                                        'taxonomy' => 'portfolio_entries',
                                        'field' => 'id',
                                        'terms' => $cats
                                    )
                                );
        }

        $columns = abs($columns);
        $column_class = '';
        $column_class = $columns==4 ? "col-xs-12 col-sm-6 col-md-3" : $column_class;
        $column_class = $columns==3 ? "col-md-4 col-sm-6 col-xs-12" : $column_class;
        $column_class = $columns==2 ? "col-xs-12 col-sm-6 " : $column_class;
        $column_class = $columns==1 ? "col-xs-12 col-md-12" : $column_class;

        $filter_html = '';
        $cat_array = array();
        $items = '';
        $grid_class = '';
        $posts_query = new WP_Query($args);
        while ( $posts_query->have_posts() ) {
            $posts_query->the_post();

             $img = '';
            $thumb = '';
            if( has_post_thumbnail() ){
                $thumb = wp_get_attachment_image( get_post_thumbnail_id( get_the_ID() ), "full" ,false, array("class"=>"img-responsive") );
                $img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'one-portfolio' );
                $img = !empty($img) ? $img[0] : '';
            }


            // Categories
            $cats = '';
            $last_cat = '';
            $cat_titles = array();
            $terms = wp_get_post_terms(get_the_ID(), 'portfolio_entries');
            foreach ($terms as $term){
                $cat_title = $term->name;
                $cat_slug = $term->slug;

                $cat_titles []= $cat_title;
                if( $filter=='yes' && !in_array($term->term_id, $cat_array) ){
                    $filter_html .= "<li><button class='but' data-filter='.".$cat_slug."'>".$cat_title."</button></li>";

                    $cat_array[] = $term->term_id;
                }

                $cats .= "$cat_slug ";
                $last_cat = $cat_title;
            }
            
             $space_active='';
                if ($space != 'yes') {
                        $space_active = "padd-only-xs";
                    }
                    else{
                         $space_active = " ";
                    }

             $heading_html='';
             if($heading_title != 'with_icon'){
                $heading_html = "<section class='item-content'>
                                    <div class='wrap-center'>
                                        <h6 class='content-cat'>$cat_title</h6>
                                        <h4 class='content-title'>".get_the_title()." </h4>
                                    </div>
                                    <div class='content-options'>
                                        <a href='$img' class='fa fa-search view-item'></a>
                                        <a href='".get_permalink()."' class='fa fa-link'></a>
                                    </div>
                                </section>";
             } else{
                $heading_html ="<section class='item-content'>
                                    <div class='wrap-center'>
                                        <h6 class='content-icon'><i class='fa fa-heart-o'></i></h6>
                                        <h4 class='content-title'>".get_the_title()." </h4>
                                        <div class='content-options'>
                                            <a href='$img' class='fa fa-search view-item'></a>
                                        </div>
                                    </div>
                                </section>";
             }    
        

            $items .= "<div class='$column_class item  $space_active $cats'>
                            <div class='wpc-portfolio-item $style'>
                                <img src='$img' alt='".esc_attr__('image', 'onetheme')."' class='wpc-back-img' data-s-hidden='1'>
                                $heading_html
                            </div>
                        </div>";
        }

        // reset query
        wp_reset_postdata();
        // filter
        if( $filter=='yes' ){
            $filter_html = " <div class='row'><div class='col-md-12 marg-lg-t50'>
                                <ul id='filters' class='marg-lg-b50  wpc-filters text-center'>
                                    <li><button class='but activbut' data-filter='*'>".esc_attr__('View all', 'onetheme')."</button></li>
                                    $filter_html
                                </ul>
                            </div></div>";
        }
        else{
            $filter_html = "";
        } 

        return "<div class='marg-xs-t40  padd-only-xs'>
                    $filter_html
                    <!-- PORTFOLIO -->
                    <div class='row marg-xs-t30'>
                            <div class='wpc-isotope izotope-container popup-gallery' data-layout='fitRows'>
                                <div class='grid-sizer'></div>
                                <!-- PORTFOLIO  ITEM-->
                                $items
                            </div>
                    </div>
                </div>";
    }
}

vc_map( array(
    "name" => esc_html__('Portfolio', 'onetheme'),
    "description" => esc_html__("post type: portfolio", 'onetheme'),
    "base" => 'tt_portfolio',
    "icon" => "icon-wpb-themeton",
    "content_element" => true,
    "category" => esc_html__('One', 'onetheme'),
    'params' => array(

        
        array(
            "type" => "dropdown",
            "param_name" => "filter",
            "heading" => esc_html__("Filter", 'onetheme'),
            "value" => array(
                "Yes" => "yes",
                "No" => "no"
            ),
            "std" => "yes"
        ),
        array(
            "type" => "dropdown",
            "param_name" => "columns",
            "heading" => esc_html__("Columns", 'onetheme'),
            "value" => array(
                "4 Columns" => "4",
                "3 Columns" => "3",
                "2 Columns" => "2",
                "1 Column" => "1"
                
            ),
            "std" => "4"
        ),
        array(
            "type" => "dropdown",
            "param_name" => "style",
            "heading" => esc_html__("Image style", 'onetheme'),
            "value" => array(
                "Style - 1" => "style-1",
                "Style - 2 : grid" => "style-2",
                "Style - 3 -Masonry" => "style-3",
                "Style - 4 grid long image " => "gallery-item style-4",
                "Style - 5 grid small image" => "gallery-item style-5",
                "Style - 6 : large " => "gallery-item style-4 full-w",
            ),
            "std" => "style-4",
            'holder' => 'div'
        ),
        array(
            "type" => "dropdown",
            "param_name" => "heading_title",
            "heading" => esc_html__("Heading style", 'onetheme'),
            "value" => array(
                "Style 1: with categories" => "standard",
                "style 2 : with icon" => "with_icon"
            ),
            "std" => "standard"
        ),
        array(
            "type" => "dropdown",
            "param_name" => "space",
            "heading" => esc_html__("Space", 'onetheme'),
            "value" => array(
                "Yes" => "yes",
                "No" => "no"
            ),
            "std" => "yes"
        ),

        array(
            "type" => 'textfield',
            "param_name" => "count",
            "heading" => esc_html__("Posts per page", 'onetheme'),
            "value" => '8'
        ),
        array(
            "type" => 'textfield',
            "param_name" => "categories",
            "heading" => esc_html__("Categories", 'onetheme'),
            "description" => esc_html__("Specify category Id or leave blank to display items from all categories.", 'onetheme'),
            'holder' => 'div',
            "value" => ''
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