<?php
class WPBakeryShortCode_Tt_accordion extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract( shortcode_atts( array(
            "list" => "",
            "extra_class" => ""
        ), $atts ) );
        $list = vc_param_group_parse_atts($list);
        $lists = '';
        if( is_array($list) ){
            foreach ($list as $item) {
                $image = isset($item['image']) ? $item['image'] : "";
                
                $title = isset($item['title']) ? $item['title'] : "";
                $title = !empty($title) ? "$title" : "";

                $panel_letter = isset($item['panel_letter']) ? $item['panel_letter'] : "";
                $panel_letter = !empty($panel_letter) ? "$panel_letter" : "";

                $content_text = isset($item['content_text']) ? $item['content_text'] : "";
                $content_text = !empty($content_text) ? "$content_text" : "";
                $lists .= "<div class='panel-wrap'>
                                    <h5 class='panel-title'>$title</h5>
                                    <div class='panel-collapse clearfix'><span class='panel-letter'>$panel_letter</span>
                                        <p class='panel-text'>$content_text</p>
                                    </div>
                                </div>";
            }
        }
            $result =  "<div class='wpc-accordion style-1'>
                            $lists     
                        </div>";
        return $result;
    }
}

vc_map( array(
    "name" => esc_html__("Accordion", 'onetheme'),
    "description" => esc_html__("Accordion of onetheme", 'onetheme'),
    "base" => "tt_accordion",
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
                //title text
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Title text', 'onetheme'),
                    'param_name' => 'title',
                    'value' => 'How to Buy NumberOne PSD Template?',
                    'holder' => 'div'
                ),
                array(
                    'type' => 'textfield',
                    "description" => esc_html__("Letter", 'onetheme'),
                    'heading' => esc_html__('Panel letter', 'onetheme'),
                    'param_name' => 'panel_letter',
                    'value' => 'H'
                ),
                array(
                    'heading' => esc_html__('Content text', 'onetheme'),
                    'param_name' => 'content_text',
                    'value' => 'Lorem text',
                    'type' => 'textarea',
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
) );