<?php

class WPBakeryShortCode_tt_pricing extends WPBakeryShortCode {
    protected function content($atts, $content = null) {
        extract(shortcode_atts(array(
            'title' => 'Golden Plan',
            'image'=>'',
            'price' => '99',
            'icon' => 'fa fa-forumbee',
            'icon_type' => 'fontawesome',
            'link' => '',
            'button' => 'Signup now',
            'list' => '',
            "extra_class" => ''
        ), $atts));

        $list = vc_param_group_parse_atts($list);
        $lists = '';
        
        $icon = isset($atts["icon_$icon_type"]) ? $atts["icon_$icon_type"] : $icon;
        $image = wp_get_attachment_image($image, 'full',false , array('class'=> 'wpc-back-img'));

        if (!empty($icon)) {
            wp_enqueue_style("vc_$icon_type");
        }
        if( is_array($list) ){
            foreach ($list as $item) {
               
                $text = isset($item['text']) ? $item['text'] : "";
                $text = !empty($text) ? "$text" : "";

                $lists .= "<li>$text</li>";
            }
        }

        
        $result = "<div class='wpc-pricing'>
                        $image
                        <section class='pricing-heading'>
                            <i class='heading-icon $icon' aria-hidden='true'></i>
                            <h3 class='heading-title'>$title</h3>
                            <div class='heading-price'><sup>$</sup>$price<sub>p/m</sub></div>
                            <ul class='heading-list'>
                                ".$lists."
                            </ul>
                             <a href='$link' class='wpc-btn size-3 style-4'>$button </a>
                        </section>
                    </div>";
        
        return $result;
    }
}
vc_map(array(
    "name" => esc_html__("Pricing element", 'onetheme'),
    "description" => esc_html__("", 'onetheme'),
    "base" => "tt_pricing",
    "class" => "",
    "icon" => "icon-wpb-themeton",
    "category" => 'One',
    "show_settings_on_create" => true,
    "params" => array(
        
        array(
            'type' => 'attach_image',
            "param_name" => "image",
            "heading" => esc_html__("Image", 'onetheme'),
            "value" => '',
            "std" => "show",
        ),
         array(
            'type' => 'dropdown',
            'heading' => esc_html__('Icon library', 'onetheme'),
            'value' => array(
                esc_html__('Font Awesome', 'onetheme') => 'fontawesome',
                esc_html__('Open Iconic', 'onetheme') => 'openiconic',
                esc_html__('Typicons', 'onetheme') => 'typicons',
                esc_html__('Entypo', 'onetheme') => 'entypo',
                esc_html__('Linecons', 'onetheme') => 'linecons'
            ),
            'param_name' => 'icon_type',
            'description' => esc_html__('Select icon library.', 'onetheme'),
            "std" => "show",
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__('Icon', 'onetheme'),
            'param_name' => 'icon_fontawesome',
            'value' => 'fa fa-info-circle',
            'settings' => array(
                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'iconsPerPage' => 4000, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'fontawesome',
            ),
            'description' => esc_html__('Select icon from library.', 'onetheme'),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__('Icon', 'onetheme'),
            'param_name' => 'icon_openiconic',
            'settings' => array(
                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'type' => 'openiconic',
                'iconsPerPage' => 4000, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'openiconic',
            ),
            'description' => esc_html__('Select icon from library.', 'onetheme'),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__('Icon', 'onetheme'),
            'param_name' => 'icon_typicons',
            'settings' => array(
                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'type' => 'typicons',
                'iconsPerPage' => 4000, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'typicons',
            ),
            'description' => esc_html__('Select icon from library.', 'onetheme'),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__('Icon', 'onetheme'),
            'param_name' => 'icon_entypo',
            'settings' => array(
                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'type' => 'entypo',
                'iconsPerPage' => 4000, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'entypo',
            ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__('Icon', 'onetheme'),
            'param_name' => 'icon_linecons',
            'settings' => array(
                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'type' => 'linecons',
                'iconsPerPage' => 4000, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'linecons',
            ),
            'description' => esc_html__('Select icon from library.', 'onetheme'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Title text', 'onetheme'),
            'param_name' => 'title',
            'value' => 'Golden Plan',
            'holder' => 'div'
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Price', 'onetheme'),
            'param_name' => 'price',
            'value' => '99'
        ),
        array(
            'type' => 'param_group',
            'heading' => esc_html__('Service', 'onetheme'),
            'param_name' => 'list',
            'value' => '',
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Text', 'onetheme'),
                    'param_name' => 'text',
                    'value' => 'Unlimited Projects'
                ),
            )
        ),
       

        array(
            'type' => 'textfield',
            'heading' => esc_html__('Button', 'onetheme'),
            'param_name' => 'button',
            'value' => 'Signup now',
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Link url', 'onetheme'),
            'param_name' => 'link',
            'value' => '#',
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