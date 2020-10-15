<?php

class WPBakeryShortCode_category_title extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract( shortcode_atts( array(
            "image" => '',
            "link" => '',
            "title" => '',
            "subtitle" => "",
            "extra_class" => ""
        ), $atts ) );
        
        $atach = wp_get_attachment_image($image, 'full', false, array('class'=> 'img-responsive wpc-back-img') );
        $atach = str_replace('<img ', '<img data-s-hidden="1" ', $atach);
        $title = !empty($title) ? "<span class='title'>$title</span>" : "";
        $subtitle = !empty($subtitle) ? "<span class='subtitle'>$subtitle</span>" : "";
        $link = !empty($link) ? "$link" : "";

        $result = "<div class='container'>
                        <div class='row marg-xs-t50 marg-lg-t90'>
                             <div class='col-xs-12 col-sm-4 padd-only-xs marg-xs-t40'>
                                <div class='wpc-category'> 
                                $atach
                                    <a href='$link' class='category-title'> 
                                       <span class='title'>$title</span>
                                       <span class='subtitle'>$subtitle</span>
                                    </a>
                                </div>
                             </div>
                        </div>
                    </div>";
        return $result;
    }
}
vc_map(array(
    "name" => esc_html__("Category title", 'onetheme'),
    "description" => esc_html__("Category title with background picture", 'onetheme'),
    "base" => "category_title",
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
                    'heading' => esc_html__('link', 'onetheme'),
                    'param_name' => 'link',
                    'label' => 'URL:',
                    'value' => '',
                    'type' => 'textarea',
                ),

                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Title', 'onetheme'),
                    'param_name' => 'title',
                    'value' => '',
                    'holder' => 'div'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Subtitle', 'onetheme'),
                    'param_name' => 'subtitle',
                    'value' => ''
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