<?php

if ( function_exists('vc_map') && class_exists('WPBakeryShortCode') ) {
	if ( !function_exists('studylms_load_event_element')) {
		function studylms_load_event_element() {
			vc_map( array(
				'name'        => esc_html__( 'Apus Events','studylms'),
				'base'        => 'apus_events',
				"category" => esc_html__('Apus Event', 'studylms'),
				'description' => esc_html__( 'Create Events for one Widget', 'studylms' ),
				"params"      => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Title', 'studylms' ),
						'param_name' => 'title',
					),
					array(
						'type' => 'textarea',
						'heading' => esc_html__( 'Description', 'studylms' ),
						'param_name' => 'description',
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Get event By", 'studylms'),
						"param_name" => "orderby",
						'value' 	=> array(
							esc_html__('Featured Events', 'studylms') => 'featured', 
							esc_html__('Lastest Events', 'studylms') => 'most_recent', 
							esc_html__('Randown Events', 'studylms') => 'random', 
						)
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Number', 'studylms' ),
						'param_name' => 'number',
						"admin_label" => true,
						'value' => 4
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'View More Button Text', 'studylms' ),
						'param_name' => 'view_more_text',
						"admin_label" => true,
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'View More Button URL', 'studylms' ),
						'param_name' => 'view_more_url',
						"admin_label" => true,
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'studylms' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'studylms' )
					)
				),
			));
		}
	}
	add_action( 'vc_after_set_mode', 'studylms_load_event_element', 99 );

	class WPBakeryShortCode_apus_events extends WPBakeryShortCode {}
}