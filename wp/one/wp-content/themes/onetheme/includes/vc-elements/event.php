<?php

class WPBakeryShortCode_Tt_events extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract(shortcode_atts(array(
            'columns' => '3',
            'count' => '9',
            'extra_class'   => ''
        ), $atts));
        
        global $post;
        $columns = abs($columns);
        $column_class = '';
        $column_class = $columns==4 ? "col-xs-12 col-sm-6 col-md-3" : $column_class;
        $column_class = $columns==3 ? "col-md-4 col-sm-6 col-xs-12" : $column_class;
        $column_class = $columns==2 ? "col-xs-12 col-sm-6 " : $column_class;
        $column_class = $columns==1 ? "col-xs-12 col-md-12" : $column_class;
        $events ='';
        $event = $format ='';
        $all_events = tribe_get_events(array( 'posts_per_page'=>  $count, ));
        foreach($all_events as $post) {
            setup_postdata($post); 
            $thumb_img = '';
            if( has_post_thumbnail() ){
                $thumb_img = wp_get_attachment_image_url( get_post_thumbnail_id(),'full');
            }

            $event.= "<div class='wpc-event ".$column_class."'>
                            <div class='event-place'>In: <i> ".tribe_get_venue()."</i></div>
                            <a href='".esc_url( tribe_get_event_link() )."' class='event-img'>
                                <img src='".$thumb_img."' class='img-responsive wpc-back-img' data-s-hidden = 1 alt='".esc_attr__('image', 'onetheme')."'>
                                <h5 class='event-title'>".get_the_title()."</h5>
                            </a>
                            <div class='event-info'>
                                <div class='info-date'><i class='fa fa-calendar-check-o'></i> ".tribe_get_start_date()." </div>
                                <div class='info-route'><i class='fa fa-location-arrow'></i> ".tribe_get_address()."</div>
                            </div>
                            <div class='event-counter'>
                                <div class='wpc-coming-soon' data-end='".tribe_get_start_date($post, false, $format = 'Y/m/d')."'></div>
                                <a href='".esc_url( tribe_get_event_link() )."' class='further-btn'>+</a>
                            </div>
                        </div>";
            }
        wp_reset_postdata();
       
        return '<div class="events">
                    '.$event.'
                </div>';
    }
}

vc_map( array(
    "name" => esc_html__('Event', 'onetheme'),
    "description" => esc_html__("Only post type: event", 'onetheme'),
    "base" => 'tt_events',
    "icon" => "icon-wpb-themeton",
    "content_element" => true,
    "category" => esc_html__('One', 'onetheme'),
    'params' => array(
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
            "std" => "3",
            'holder' => 'div'
        ),
        array(
            "type" => 'textfield',
            "param_name" => "count",
            "heading" => esc_html__("Posts per page", 'onetheme'),
            "value" => '8'
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