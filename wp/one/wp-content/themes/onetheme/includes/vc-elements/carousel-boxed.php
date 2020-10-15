<?php
class WPBakeryShortCode_Tt_image_carousel extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract( shortcode_atts( array(
            "layout" => 'standard',
            "arrows" => 'show',
            "bullets" => "show",
            "social_facebook" => "",
            "social_twitter" => "",
            "social_linkedin" => "",
            "social_instagram" => "",
            "list" => "",
            "extra_class" => ""
        ), $atts ) );
        $list = vc_param_group_parse_atts($list);
        $lists = '';
        $slider_bullets = "<div class='swiper-pagination'></div>";

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
                                <section class='wpc-gallery'> 
                                    <img src='".esc_attr($image)."' alt='".esc_attr('person','onetheme')."' class='wpc-back-img' data-s-hidden='1'>
                                    <div class='gallery-desc'>
                                        <h6 class='desc-cat'>$title</h6>
                                        <h3 class='desc-title'>$sub_title</h3> 
                                        <a href='$link' class='gallery-btn'>+</a> 
                                    </div>
                                </section>
                            </div>";
            }
        }
            $result = "<div class='featured-image-carousel row'>
                            <div class='col-md-12 no-padd'>
                                <div class='swiper-container wpc-gallery-slider' data-autoplay='0' data-loop='1' data-speed='1000' data-slides-per-view='responsive' data-add-slides='5' data-xs-slides='1' data-sm-slides='3' data-md-slides='5' data-lg-slides='5' data-center='1'>
                                     <div class='swiper-wrapper'>
                                         $lists
                                    </div>
                                    <div class='pagination'></div>
                                </div>
                            </div>
                      </div>";

        return $result;
    }
}

vc_map( array(
    "name" => esc_html__("Image carousel", 'onetheme'),
    "description" => esc_html__("Swiper Slider", 'onetheme'),
    "base" => "tt_image_carousel",
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
                    'value' => '',
                    'holder' => 'div'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Sub title text', 'onetheme'),
                    'param_name' => 'sub_title',
                    'value' => ''
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