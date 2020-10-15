<?php

class WPBakeryShortCode_tt_project extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract(shortcode_atts(array(
            'title' => 'Expert in Problem saving',
            'image' => '',
            'date_text' => '10 December 2015',
            'image_align' => 'left',
            'list' => '',
            'link' => '#',
            'extra_class' => ''
        ), $atts));
        $image = wp_get_attachment_image($image, 'full',false , array('class'=> 'img-responsive wpc-back-img'));
        $image = str_replace('<img ', '<img data-s-hidden="1" ', $image);
        $image_html ='';
        if($image_align=='left'){
           
        $image_html.="<div class='project-item clearfix'>
                                <div class='item-img'> 
                                    $image
                                </div>
                                <div class='item-info left-arrow'>
                                    <h3 class='info-title'><a href='$link'>$title</a></h3>
                                    <div class='info-date'> 
                                    <i class='fa fa-calendar-o'></i>
                                       $date_text
                                    </div> 
                                    <a href='$link' class='info-btn'><i class='ti-plus'></i></a> 
                                </div>
                        </div>";
        }
        else{
            $image_html.="<div class='project-item clearfix'>
                            <div class='item-info right-arrow'>
                                <h3 class='info-title'><a href='$link'>$title</a></h3>
                                <div class='info-date'> 
                                    <i class='fa fa-calendar-o'></i>
                                     $date_text
                                </div> 
                                    <a href='$link' class='info-btn'><i class='ti-plus'></i></a> 
                            </div>
                            <div class='item-img'> 
                                $image
                            </div>
                        </div>";
        }


        $return = "<div class='wpc-projects'>
                            <div class='equal-height'>
                                $image_html
                            </div>
                        </div>";

       return $return;
    }
}

vc_map( array(
    "name" => esc_html__('Project', 'onetheme'),
    "description" => esc_html__("Simple project element", 'onetheme'),
    "base" => 'tt_project',
    "icon" => "icon-wpb-themeton",
    "content_element" => true,
    "category" => esc_html__('One', 'onetheme'),
    'params' => array(
        array(
            "type" => 'textfield',
            "param_name" => "title",
            "heading" => esc_html__("Title", 'onetheme'),
            "value" => 'Optimized for all Devices',
            "holder" => 'div'
        ),
        array(
            'type' => 'attach_image',
            "param_name" => "image",
            "heading" => esc_html__("Image", 'onetheme')
        ),
        array(
            "type" => 'textfield',
            "param_name" => "date_text",
            "heading" => esc_html__("Date", 'onetheme'),
            "value" => '10 December 2015',
        ),
        array(
            "type" => 'textfield',
            "param_name" => "link",
            "heading" => esc_html__("More link", 'onetheme'),
            "value" => '#',
        ),
        array(
            "type" => "dropdown",
            "param_name" => "image_align",
            "heading" => esc_html__(" Image align", 'onetheme'),
            "value" => array(
                "Left" => "left",
                "Right" => "right"
            ),
            "std" => "left"
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