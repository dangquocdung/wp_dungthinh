<?php
class WPBakeryShortCode_Tt_content_testimonial extends WPBakeryShortCode {
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
                $sub_title = !empty($sub_title) ? " <p class='info-position'>$sub_title </p>" : "";

                $title = isset($item['title']) ? $item['title'] : "";
                $title = !empty($title) ? "<h6 class='info-title'>$title</h6>" : "";

                $content_text = isset($item['content_text']) ? $item['content_text'] : "";
                $content_text = !empty($content_text) ? "$content_text" : "";

                $atach_src = wp_get_attachment_image_src($image, 'full');
                $image = is_array($atach_src) ? $atach_src[0] : "";

                    $lists .= "<div class='swiper-slide'>
                                    <section class='testimonial-section'>
                                        <div class='section-head'> 
                                        <img src='".$image."' alt='".esc_attr('person','onetheme')."' class='head-img'>
                                            <div class='head-info'>
                                                $title
                                                $sub_title  
                                            </div>
                                        </div>
                                        <p class='section-content'>$content_text</p>
                                    </section>
                                </div>";
            }
        }
            $result = "<div class='wpc-testimonial'>
                            <div class='swiper-container' data-autoplay='5000' data-loop='1' data-speed='1000' data-slides-per-view='responsive' data-add-slides='1' data-xs-slides='1' data-sm-slides='1' data-md-slides='1' data-lg-slides='1'>
                                <div class='swiper-wrapper'>
                                    $lists
                                </div>
                                <div class='pagination point-style-1'></div>
                            </div>
                        </div>";
        return $result;
    }
}

vc_map( array(
    "name" => esc_html__("Testimonial", 'onetheme'),
    "description" => esc_html__("team of testimonial", 'onetheme'),
    "base" => "tt_content_testimonial",
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
                    'value' => 'William Barel',
                    'holder' => 'div'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Sub title text', 'onetheme'),
                    'param_name' => 'sub_title',
                    'value' => 'Creative Designer'
                ),
                

                array(
                    'heading' => esc_html__('Content text', 'onetheme'),
                    'param_name' => 'content_text',
                    'value' => 'Lorem text',
                    'type' => 'textarea',
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