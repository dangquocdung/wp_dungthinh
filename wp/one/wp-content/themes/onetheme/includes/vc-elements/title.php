<?php

class WPBakeryShortCode_title extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract(shortcode_atts(array(
            'title' => 'Our blog',
            'title_text' => 'We do very hard',
            'float' => 'text-center',
            'style' => 'style-3',
            'color' => 'dark',
            'extra_class' => ''
        ), $atts));

        $return = "<section class='wpc-heading $style $float $color'>
                        <h2 class='heading-title'>$title</h2>
                        <p class='heading-text'>$title_text </p>
                    </section>";

       return $return;
    }
}

vc_map( array(
    "name" => esc_html__('Title', 'onetheme'),
    "description" => esc_html__("Simple title element", 'onetheme'),
    "base" => 'title',
    "icon" => "icon-wpb-themeton",
    "content_element" => true,
    "category" => esc_html__('One', 'onetheme'),
    'params' => array(
        array(
            "type" => 'textfield',
            "param_name" => "title",
            "heading" => esc_html__("Title", 'onetheme'),
            "value" => 'Our blog',
            "holder" => 'div'
        ),
        array(
            "type" => 'textfield',
            "param_name" => "title_text",
            "heading" => esc_html__("Heading text", 'onetheme'),
            "value" => 'We do very hard',
        ),
        array(
            "type" => "dropdown",
            "param_name" => "float",
            "heading" => esc_html__("Float", 'onetheme'),
            "value" => array(
                "Center" => "text-center",
                "Left" => "text-left",
                "Right" => "text-right"
            ),
            "std" => "text-center"
        ),
        array(
            "type" => "dropdown",
            "param_name" => "color",
            "heading" => esc_html__("Color", 'onetheme'),
            "value" => array(
                "Dark" => "dark",
                "Light" => "light",
            ),
            "std" => "dark"
        ),
         array(
            "type" => "dropdown",
            "param_name" => "style",
            "heading" => esc_html__("Style", 'onetheme'),
            "value" => array(
                "Style 1" => "style-1",
                "Style 2" => "style-2",
                "Style 3" => "style-3"
            ),
            "std" => "style-3"
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