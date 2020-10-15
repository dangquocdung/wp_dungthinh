<?php

class WPBakeryShortCode_tt_service__slider_element extends WPBakeryShortCode {
    protected function content($atts, $content = null) {
        extract(shortcode_atts(array(
            'list' => '',
            "extra_class" => ""
        ), $atts));
    
        $list = vc_param_group_parse_atts($list);
        $lists = '';

        if( is_array($list) ){
            foreach ($list as $item) {
                $image = isset($item['image']) ? $item['image'] : "";
                $atach_src = wp_get_attachment_image_src($image, 'full');
                $image = is_array($atach_src) ? $atach_src[0] : "";

                $title = isset($item['title']) ? $item['title'] : "";
                $title = !empty($title) ? "<h4 class='service-title'>$title</h4>" : "";

                $icon_type = array_key_exists('icon_type', $item) ? $item['icon_type'] : '';
                $icon = isset($item["icon_$icon_type"]) ? $item["icon_$icon_type"] : $icon;
                $icon = !empty($icon) ? "$icon" : "";

                if (!empty($icon)) {
                    wp_enqueue_style("vc_$icon_type");
                }

                $text = isset($item['text']) ? $item['text'] : "";
                $text = !empty($text) ? "$text" : "";

                $lists .= "<div class='swiper-slide'>
                                    <section class='wpc-service type-1 text-center'>
                                        <div class='service-icon'><i class='$icon'></i></div>
                                        $title
                                        <p class='service-text'>$text</p>
                                    </section>
                                </div>";
            }
        }
        $result = "<div class='wpc-service-slider'>
                        <div class='swiper-container' data-autoplay='5000' data-loop='1' data-speed='1000' data-slides-per-view='responsive' data-add-slides='3' data-xs-slides='1' data-sm-slides='1' data-md-slides='3' data-lg-slides='3'>
                            <div class='swiper-wrapper'>
                                $lists
                            </div>
                            <div class='pagination point-style-1'></div>
                        </div>
                    </div>";
        
        return $result;
    }
}
vc_map(array(
    "name" => esc_html__("Service slider element", 'onetheme'),
    "description" => esc_html__("service element", 'onetheme'),
    "base" => "tt_service__slider_element",
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