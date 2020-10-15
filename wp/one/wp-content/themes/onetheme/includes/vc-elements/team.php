<?php

class WPBakeryShortCode_Tt_Content_team extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract( shortcode_atts( array(
            'image' => '',
            'title' => 'Sana Borali',
            'desc_position' =>'Designer',
            'link' => '#',
            'extra_class' => '',
        ), $atts ) );

        $atach_src = wp_get_attachment_image_src($image, 'full');
        $image = is_array($atach_src) ? $atach_src[0] : "";

        $result = "<section class='wpc-team'> 
                        <img src='".esc_attr($image)."' alt='".esc_attr__('person', 'onetheme')."' class='wpc-back-img' data-s-hidden='1'>
                        <div class='team-desc'>
                            <h3 class='desc-title'>$title</h3>
                            <h6 class='desc-position'>$desc_position</h6> 
                            <a href='$link' class='team-btn'>+</a>
                        </div>
                    </section>";        

        return $result;
    }
}

vc_map( array(
    "name" => esc_html__("Team ", 'onetheme'),
    "description" => esc_html__("team of person", 'onetheme'),
    "base" => "tt_Content_team",
    "class" => "",
    "icon" => "icon-wpb-themeton",
    "category" => 'One',
    "show_settings_on_create" => true,
    "params" => array(
        array(
            'type' => 'attach_image',
            "param_name" => "image",
            "heading" => esc_html__("Image", 'onetheme')
        ),
        array(
        'type' => 'textfield',
        'heading' => esc_html__('Name: insert the name of person', 'onetheme'),
        'param_name' => 'title',
        'value' => 'Sana Borali',
        'holder' => 'div'
         ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Position', 'onetheme'),
            'param_name' => 'desc_position',
            'value' => 'Designer'
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Link', 'onetheme'),
            'param_name' => 'link',
            'value' => '#'
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