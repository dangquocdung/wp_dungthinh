<?php

	function fixar_customize_search_tab($wp_customize, $theme_name){
	
		$wp_customize->add_section( 'fixar_search_settings' , array(
		    'title'      => esc_html__( 'Search', 'fixar' ),
		    'priority'   => 40,
		) );

		
		$wp_customize->add_setting( 'fixar_search_placeholder' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );

		$wp_customize->add_setting( 'fixar_search_description' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );



		$wp_customize->add_control(
			'fixar_search_placeholder',
			array(
				'label'    => esc_html__( 'Search Placeholder', 'fixar' ),
				'section'  => 'fixar_search_settings',
				'settings' => 'fixar_search_placeholder',
				'type'     => 'text',
				'priority'   => 10
			)
		);

		$wp_customize->add_control(
			'fixar_search_description',
			array(
				'label'    => esc_html__( 'Search Description', 'fixar' ),
				'section'  => 'fixar_search_settings',
				'settings' => 'fixar_search_description',
				'type'     => 'text',
				'priority'   => 20
			)
		);
		
	}
		
?>