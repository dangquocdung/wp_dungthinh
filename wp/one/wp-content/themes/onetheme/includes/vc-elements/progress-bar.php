<?php

class WPBakeryShortCode_Progress_Bar extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract(shortcode_atts(array(
            'description' => '',
            'percentage' => '',
            'extra_class' => '',
            'list' =>'',
        ), $atts));

        $list = vc_param_group_parse_atts($list);
        $lists = '';

        if (is_array($list)) {
            foreach ($list as $item) {
                

                $detail_text = isset($item['detail_text']) ? $item['detail_text'] : "";
                $percentage = isset($item['percentage']) ? $item['percentage'] : "";

                $lists .= "<div class='skill-block'>
                                <h5 class='timer' data-to='$percentage' data-speed='500'>0</h5>
                                <h6>".$detail_text."</h6>
                                <div class='skill-line'>
                                    <div class='line-fill' data-width-pb='$percentage%'></div>
                                </div>
                            </div>";
            
            }
        }
            
        $result = "<div class='wpc-skills'>$lists</div>";
        
        return $result;
    }
}

vc_map( array(
    "name" => esc_attr__('Progress Bar', 'onetheme'),
    "description" => esc_attr__("Vertical line bar", 'onetheme'),
    "base" => 'progress_bar',
    "icon" => "icon-wpb-one",
    "category" => esc_attr__('One', 'onetheme'),
    'params' => array(
       array(
            'type' => 'param_group',
            'heading' => esc_html__('Values', 'onetheme'),
            'param_name' => 'list',
            'value' => '',
            'params' => array(
                // title text
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Title', 'onetheme'),
                    'param_name' => 'detail_text',
                    'value' => 'HTML',
                    'holder' => 'div'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Percentage', 'onetheme'),
                    'param_name' => 'percentage',
                    'value' => '60'
                ),
                
            )
        ),
        array(
            "type" => "textfield",
            "param_name" => "extra_class",
            "heading" => esc_attr__("Extra Class", 'onetheme'),
            "value" => "",
            "description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'onetheme'),
        )
    )
));