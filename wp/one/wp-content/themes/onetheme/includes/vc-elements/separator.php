<?php

class WPBakeryShortCode_tt_stuffs extends WPBakeryShortCode
{
	protected function content($atts, $content = null)
	{
		extract(shortcode_atts(array(
			'style' => 'style-1',
			"extra_class" => ""
		), $atts));

		$result = "<div class='wpc-separator $style'>
                        <div class='separator-helper'></div>
                    </div>";
			
	
		return $result;
	}
}
vc_map(array(
	"name" => esc_html__("Separator", 'onetheme'),
	"description" => esc_html__("content title text element", 'onetheme'),
	"base" => "tt_stuffs",
	"class" => "",
	"icon" => "icon-wpb-themeton",
	"category" => 'One',
	"show_settings_on_create" => true,
	"params" => array(
		array(
			"type" => "dropdown",
			"param_name" => "style",
			"heading" => esc_html__("Style", 'onetheme'),
			"value" => array(
				"Style 1" => "style-1",
				"Style 2" => "style-2"
				
			),
			"std" => "style1",
			'holder' => 'div'
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