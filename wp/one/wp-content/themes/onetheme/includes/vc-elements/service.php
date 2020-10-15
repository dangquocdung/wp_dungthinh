<?php

class WPBakeryShortCode_tt_service_element extends WPBakeryShortCode {
    protected function content($atts, $content = null) {
        extract(shortcode_atts(array(
            'title' => 'Email',
            'text' => 'Lorem ipsum dolor sit amet, c-r adipiscing elit. In maximus ligula semper metus pellentesque mattis. Maecenas volutpat, diam enim.',
            'image'=>'',
            'layout' => 'font',
            'icon' => 'fa fa-forumbee',
            'icon_type' => 'fontawesome',
            'link' => '',
            "extra_class" => ""
        ), $atts));
        
        $icon = isset($atts["icon_$icon_type"]) ? $atts["icon_$icon_type"] : $icon;

        $image = wp_get_attachment_image($image, 'full',false , array('class'=> 'wpc-back-img'));

        if (!empty($icon)) {
            wp_enqueue_style("vc_$icon_type");
        }

        $link_bef = $link_aft = '';
        if($link != '') {
            $link_bef = "<a href='".esc_url($link)."'>";
            $link_aft = "</a>";
        }
        if ($layout == 'with-image') {
            $result = "<section class='wpc-service type-2 text-center'>
                            $image
                            <div class='service-wrap'>
                             $link_bef
                                <div class='service-icon'><i class='$icon'></i></div>
                                 $link_aft
                                <h4 class='service-title'>$title</h4>
                                <p class='service-text'>$text</p><a href='$link' class='service-btn'>+</a></div>
                        </section>";
                    
        } else {
            $result = "<section class='".$extra_class." wpc-service type-1 text-center'>
                            $link_bef
                            <div class='service-icon'><i class='$icon'></i></div>
                            $link_aft
                            <h4 class='service-title'>$title</h4>
                            <p class='service-text'>$text</p>
                        </section>";
        }
        return $result;
    }
}
vc_map(array(
    "name" => esc_html__("Service element", 'onetheme'),
    "description" => esc_html__("About service element", 'onetheme'),
    "base" => "tt_service_element",
    "class" => "",
    "icon" => "icon-wpb-themeton",
    "category" => 'One',
    "show_settings_on_create" => true,
    "params" => array(
        array(
            "type" => "dropdown",
            "param_name" => "layout",
            "heading" => esc_html__("Logo icon type", 'onetheme'),
            "value" => array(
                "Icon" => "font",
                "with-image" => "with-image"
            ),
            "std" => "font"
        ),
        array(
            'type' => 'attach_image',
            "param_name" => "image",
            "heading" => esc_html__("Image", 'onetheme'),
            "value" => '',
             "std" => "show",
            "dependency" => Array("element" => "layout", "value" => array("with-image"))
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Title text', 'onetheme'),
            'param_name' => 'title',
            'value' => 'PHOTOGRAPHY',
            'holder' => 'div'
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Description', 'onetheme'),
            'param_name' => 'text',
            'value' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, quam!'
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
        array(
            "type" => "textfield",
            "param_name" => "extra_class",
            "heading" => esc_html__("Extra Class", 'onetheme'),
            "value" => "",
            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'onetheme'),
        )
    )
));