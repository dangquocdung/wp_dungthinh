<?php

class WPBakeryShortCode_tt_icon_box extends WPBakeryShortCode {
    protected function content($atts, $content = null) {
        extract(shortcode_atts(array(
            'list' => '',
            "extra_class" => ""
        ), $atts));
    
        $list = vc_param_group_parse_atts($list);
        $lists = '';

        if( is_array($list) ){
            foreach ($list as $item) {
                $icon_type = array_key_exists('icon_type', $item) ? $item['icon_type'] : '';
                $icon = isset($item["icon_$icon_type"]) ? $item["icon_$icon_type"] : $icon;
                $icon = !empty($icon) ? "$icon" : "";

                if (!empty($icon)) {
                    wp_enqueue_style("vc_$icon_type");
                }

                $text = isset($item['text']) ? $item['text'] : "";
                $text = !empty($text) ? "$text" : "";
                $lists .= "<div class='icon-box'><i class='$icon'></i>$text</div>";
            }
        }
        $result = "<div class='features-icons'>
                       $lists         
                  </div>";
        
        return $result;
    }
}
vc_map(array(
    "name" => esc_html__("Icon Box", 'onetheme'),
    "description" => esc_html__("service element", 'onetheme'),
    "base" => "tt_icon_box",
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
                    'type' => 'textfield',
                    'heading' => esc_html__('Description', 'onetheme'),
                    'param_name' => 'text',
                    'value' => 'Web designing',
                    'holder' => 'div'
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
                    'heading' => esc_html__('Link url (optional)', 'onetheme'),
                    'param_name' => 'link',
                    'value' => '',
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