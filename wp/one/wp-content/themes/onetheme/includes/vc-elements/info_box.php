<?php

class WPBakeryShortCode_Tt_Info_Box extends WPBakeryShortCode {
    protected function content($atts, $content = null) {
        extract(shortcode_atts(array(
            'title' => 'Email',
            'text' => 'Lorem ipsum dolor',
            'icon' => 'fa fa-map-marker',
            'icon_type' => 'fontawesome',
            "extra_class" => ""
        ), $atts));
        $icon = isset($atts["icon_$icon_type"]) ? $atts["icon_$icon_type"] : $icon;
        if (!empty($icon)) {
            wp_enqueue_style("vc_$icon_type");
        }
    
            $result = "<section class='wpc-contacts'>
                            <h4 class='contacts-title'><i class='$icon'></i> $title</h4>
                            <div class='contacts-info'> $text </div>
                        </section>";
        
        return $result;
    }
}
vc_map(array(
    "name" => esc_html__("Info box", 'onetheme'),
    "description" => esc_html__("Contact detial element", 'onetheme'),
    "base" => "tt_info_box",
    "class" => "",
    "icon" => "icon-wpb-themeton",
    "category" => 'One',
    "show_settings_on_create" => true,
    "params" => array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Title text', 'onetheme'),
            'param_name' => 'title',
            'value' => 'Fax/Email',
            'holder' => 'div'
        ), array(
            'type' => 'textfield',
            'heading' => esc_html__('Description', 'onetheme'),
            'param_name' => 'text',
            'value' => '674-475-0, 234-297-1 yourmail@email.com'
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
            "type" => "textfield",
            "param_name" => "extra_class",
            "heading" => esc_html__("Extra Class", 'onetheme'),
            "value" => "",
            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'onetheme'),
        )
    )
));