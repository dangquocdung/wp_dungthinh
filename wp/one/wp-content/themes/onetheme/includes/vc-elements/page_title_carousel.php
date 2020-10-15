<?php

class WPBakeryShortCode_Tt_header_carousel extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract( shortcode_atts( array(
            "list" => "",
            "extra_class" => ""
        ), $atts ) );


        $list = vc_param_group_parse_atts($list);
        $lists = '';
        if( is_array($list) ){
            foreach ($list as $item) {
                $image = isset($item['image']) ? $item['image'] : "";
                
                $sub_title = isset($item['sub_title']) ? $item['sub_title'] : "";
                $sub_title = !empty($sub_title) ? "<h3 class='heading-subtitle'>$sub_title</h3>" : "";

                $title = isset($item['title']) ? $item['title'] : "";
                $title = !empty($title) ? "<h1 class='heading-title'>$title</h1>" : "";

                $link = isset($item['link']) ? $item['link'] : "";
                $link = !empty($link) ? "$link" : "";

                $button_link = isset($item['button_link']) ? $item['button_link'] : "";
                $button_link = !empty($button_link) ? "$button_link" : "";

                $atach_src = wp_get_attachment_image_src($image, 'full');
                $image = is_array($atach_src) ? $atach_src[0] : "";

                    $lists .= "<div class='swiper-slide'>
                                    <div class='wpc-banner wpc-carousel style-5 text-center'> 
                                        <img src='$image' alt='".esc_attr('banner','onetheme')."' class='wpc-back-img'>
                                        <section class='banner-heading style-2'>
                                            <i class='fa fa-connectdevelop'></i>
                                            $sub_title
                                            $title
                                            <a href='$link' class='wpc-btn size-3'>$button_link</a>
                                        </section>
                                    </div>
                                </div>";
            }
        }
            $result =  "<div class='container'>
                            <div class='row'>
                                <div class='col-md-12 no-padd'>
                                    <div class='swiper-container wpc-main-slider-7' data-autoplay='5000' data-loop='1' data-speed='1000' data-slides-per-view='1' data-center='1'>
                                        <div class='swiper-wrapper'>
                                            $lists
                                        </div>
                                        <div class='pagination'></div>
                                    </div>
                                </div>
                            </div>
                        </div>";
        return $result;
    }
}

vc_map( array(
    "name" => esc_html__("Heading carousel", 'onetheme'),
    "description" => esc_html__("desc", 'onetheme'),
    "base" => "tt_header_carousel",
    "class" => "",
    "icon" => "icon-wpb-themeton",
    "category" => 'One',
    "show_settings_on_create" => true,
    "params" => array(

        array(
            'type' => 'param_group',
            'heading' => esc_html__('Values', 'onetheme'),
            'param_name' => 'list',
            'value' => '',
            'params' => array(
                array(
                    'type' => 'attach_image',
                    "param_name" => "image",
                    "heading" => esc_html__("Image", 'onetheme')
                ),

                // title text
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Title text', 'onetheme'),
                    'param_name' => 'title',
                    'value' => 'POSSIBILITIES',
                    'holder' => 'div'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Sub title text', 'onetheme'),
                    'param_name' => 'sub_title',
                    'value' => 'Unlimited'
                ),
                 array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Button name', 'onetheme'),
                    'param_name' => 'button_link',
                    'value' => 'read more'
                ),

                array(
                    'heading' => esc_html__('link', 'onetheme'),
                    'param_name' => 'link',
                    'label' => 'URL:',
                    'value' => '#',
                    'type' => 'textfield',
                ),
               
            )
        ),
        array(
            "type" => "textfield",
            "param_name" => "extra_class",
            "heading" => esc_html__("Extra Class", 'onetheme'),
            "value" => "",
            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'onetheme'),
        )
    )
) );