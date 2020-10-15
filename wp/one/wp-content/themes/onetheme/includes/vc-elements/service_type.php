<?php

class WPBakeryShortCode_service_type extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract(shortcode_atts(array(
            'button_text' => 'Read more',
             'button_link' => '#',
            'title' => 'Designing',
            'title_text' => 'Lorem ipsum dolor sit amet, ',
            'float' => 'text-center',
            'number' =>'1',
            'link' => '$link',
            'style' => 'style-1',
            'extra_class' => ''
        ), $atts));

        $return = " <section class='wpc-service type-3 $style $float'>
                        <h3 class='service-number'>$number</h3>
                        <h4 class='service-title'>$title</h4>
                        <p class='service-text'> $title_text </p>
                        <a href='$button_link' class='wpc-btn size-3'>$button_text</a> 
                    </section>";
    return $return;
    }
}

vc_map( array(
    "name" => esc_html__('Service type', 'onetheme'),
    "description" => esc_html__("Simple service types element", 'onetheme'),
    "base" => 'service_type',
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
            "param_name" => "title",
            "heading" => esc_html__("Title", 'onetheme'),
            "value" => 'Designing',
            "holder" => 'div'
        ),
        array(
            "type" => 'textfield',
            "param_name" => "title_text",
            "heading" => esc_html__("Paragraph", 'onetheme'),
            "value" => 'Lorem ipsum',
        ),
         array(
            "type" => 'textfield',
            "param_name" => "number",
            "heading" => esc_html__("number", 'onetheme'),
            "value" => '',
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
            "param_name" => "style",
            "heading" => esc_html__("Style", 'onetheme'),
            "value" => array(
                "Style 1" => "bg-c-6",
                "Style 2" => "bg-c-7",
                "Style 3" => "bg-c-8",
                "Style 4" => "bg-c-9",
            ),
            "std" => "style-1"
        ),
       array(
            "type" => 'textfield',
            "param_name" => "button_link",
            "heading" => esc_html__("Button link", 'onetheme'),
            "value" => '#',
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