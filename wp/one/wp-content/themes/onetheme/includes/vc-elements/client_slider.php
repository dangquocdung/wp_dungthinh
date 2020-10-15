<?php

class WPBakeryShortCode_client_slider extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract( shortcode_atts( array(
            "arrows" => 'show',
            "bullets" => "show",
            "image" => "",
            "list" => "",
            "extra_class" => ""
        ), $atts ) );
        
        $list = vc_param_group_parse_atts($list);
        $lists = '';
        
        $slider_arrows = " <div class='swiper-outer-left'><i class='fa fa-angle-left' aria-hidden='true'></i></div>
                           <div class='swiper-outer-right'><i class='fa fa-angle-right' aria-hidden='true'></i></div>";
        $slider_bullets = "<div class='pagination'></div>";
        
        if( is_array($list) ){
            foreach ($list as $item) {
                $image = isset($item['image']) ? $item['image'] : "";
                $atach = wp_get_attachment_image($image, 'small', false, array('class'=> 'img-responsive') );
               
                    $lists .= "<div class='swiper-slide'>
                                    <div class='wpc-client'> 
                                        $atach
                                     </div>
                               </div>";               
            }                        
        }
            $result = " <div class='container padd-only-xs'>
                            <div class='row marg-lg-t90'>
                                <div class='col-xs-12 col-md-10 col-md-offset-1 no-padd'>
                                     <div class='wpc-clients'>
                                         <div class='swiper-container wpc-main-slider' data-autoplay='5000' data-loop='1' data-speed='1000' data-slides-per-view='responsive' data-add-slides='5' data-xs-slides='1' data-sm-slides='3' data-md-slides='3' data-lg-slides='5'>
                                            <div class='swiper-wrapper'>
                                                $lists                                         
                                            </div>
                                            $slider_bullets
                                         </div>
                                        $slider_arrows                       
                                    </div>
                                </div>
                            </div>
                         </div>";
        return $result;
    }
}
vc_map(array(
    "name" => esc_html__("Client slider", 'onetheme'),
    "description" => esc_html__("client slider element", 'onetheme'),
    "base" => "client_slider",
    "class" => "",
    "icon" => "icon-wpb-themeton",
    "category" => 'One',
    "show_settings_on_create" => true,
    "params" => array(

        array(
            "type" => "dropdown",
            "param_name" => "arrows",
            "heading" => esc_html__("Slider Arrows", 'onetheme'),
            "value" => array(
                "Show" => "show",
                "Hide" => "hide"
            ),
            "std" => "show",
        ),
        array(
            "type" => "dropdown",
            "param_name" => "bullets",
            "heading" => esc_html__("Slider Bullets", 'onetheme'),
            "value" => array(
                "Show" => "show",
                "Hide" => "hide"
            ),
            "std" => "show",
        ),
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
));