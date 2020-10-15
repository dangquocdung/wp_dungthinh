<?php

class WPBakeryShortCode_Button extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract(shortcode_atts(array(
            'button_text' => 'Read more',
            'button_link' => '#',
            'style' => 'normal',
            'float' => 'text-left',
            'extra_class' => ''
        ), $atts));

        if($style=='normal'){

        $return = "<a href='$button_link' class='wpc-btn size-2 $float $extra_class'>$button_text</a> ";

        }
        else{
            $return = "<a href='$button_link' class='wpc-btn style-2 $float size-2 $extra_class'>$button_text</a> ";
        }
           return $return;
    }
}

vc_map( array(
    "name" => esc_html__('Button', 'onetheme'),
    "description" => esc_html__("one Button", 'onetheme'),
    "base" => 'button',
    "icon" => "icon-wpb-themeton",
    "content_element" => true,
    "category" => esc_html__('One', 'onetheme'),
    'params' => array(
        array(
            "type" => 'textfield',
            "param_name" => "button_text",
            "heading" => esc_html__("Button text", 'onetheme'),
            "value" => 'READ MORE',
            "holder" => 'div'
        ),
        array(
            "type" => 'textfield',
            "param_name" => "button_link",
            "heading" => esc_html__("Button link", 'onetheme'),
            "value" => '',
        ),
        array(
            "type" => "dropdown",
            "param_name" => "style",
            "heading" => esc_html__("Style", 'onetheme'),
            "value" => array(
                "shutter-in" => "shutter-in",
                "Normal" => "normal"
            ),
            "std" => "normal"
        ),
        array(
            "type" => "dropdown",
            "param_name" => "float",
            "heading" => esc_html__("Float", 'onetheme'),
            "value" => array(
                "Left" => "text-left",
                "Center" => "text-center",
                "Right" => "text-right"
            ),
            "std" => "text-left"
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