<?php 
	
	function fixar_customize_general_tab($wp_customize, $theme_name){
	
		$wp_customize->add_section( 'fixar_general_settings' , array(
		    'title'      => esc_html__( 'General Settings', 'fixar' ),
		    'priority'   => 20,
		) );
		
		
		/* logo image */ 
		
		$wp_customize->add_setting( 'fixar_general_settings_logo' , array(
			'default'     => '',
			'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
	        new WP_Customize_Image_Control(
	            $wp_customize,
	            'fixar_general_settings_logo',
				array(
				   'label'      => esc_html__( 'Logo image light', 'fixar' ),
				   'section'    => 'fixar_general_settings',
				   'context'    => 'fixar_general_settings_logo',
				   'settings'   => 'fixar_general_settings_logo',
				   'priority'   => 50
				)
	       )
	    );

		$wp_customize->add_setting( 'fixar_general_settings_logo_inverse' , array(
			'default'     => '',
			'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
	        new WP_Customize_Image_Control(
	            $wp_customize,
	            'fixar_general_settings_logo_inverse',
				array(
				   'label'      => esc_html__( 'Logo image dark', 'fixar' ),
				   'section'    => 'fixar_general_settings',
				   'context'    => 'fixar_general_settings_logo_inverse',
				   'settings'   => 'fixar_general_settings_logo_inverse',
				   'priority'   => 60
				)
	       )
	    );

		$wp_customize->add_setting( 'fixar_general_settings_logo_width' , array(
		    'default'     => '',
		    'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
			'fixar_general_settings_logo_width',
			array(
				'label'    => esc_html__( 'Logo Max Width', 'fixar' ),
				'description'=> esc_html__( 'Retina Logo should be 2x large than max width', 'fixar' ),
				'section'  => 'fixar_general_settings',
				'settings' => 'fixar_general_settings_logo_width',
				'type'     => 'text',
				'priority'   => 62
			)
		);

		$wp_customize->add_setting(	'fixar_general_settings_logo_horizontal_pos', array(
				'default' => '0',
				'transport'   => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control(
			new fixar_Slider_Single_Control(
				$wp_customize,
				'fixar_general_settings_logo_horizontal_pos',
				array(
					'label' => esc_html__( 'Logo Horizontal Position', 'fixar' ),
					'section' => 'fixar_general_settings',
					'settings' => 'fixar_general_settings_logo_horizontal_pos',
					'min' => -100,
					'max' => 100,
					'priority'   => 64
				)
			)
		);

		$wp_customize->add_setting(	'fixar_general_settings_logo_vertical_pos', array(
				'default' => '0',
				'transport'   => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control(
			new fixar_Slider_Single_Control(
				$wp_customize,
				'fixar_general_settings_logo_vertical_pos',
				array(
					'label' => esc_html__( 'Logo Vertical Position', 'fixar' ),
					'section' => 'fixar_general_settings',
					'settings' => 'fixar_general_settings_logo_vertical_pos',
					'min' => -100,
					'max' => 100,
					'priority'   => 66
				)
			)
		);



		$wp_customize->add_setting( 'fixar_general_settings_bg_image' , array(
			'default'     => '',
			'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
	        new WP_Customize_Image_Control(
	            $wp_customize,
	            'fixar_general_settings_bg_image',
				array(
				   'label'      => esc_html__( 'Background Image', 'fixar' ),
				   'description'=> esc_html__( 'for Boxed layout', 'fixar' ),
				   'section'    => 'fixar_general_settings',
				   'context'    => 'fixar_general_settings_bg_image',
				   'settings'   => 'fixar_general_settings_bg_image',
				   'priority'   => 80
				)
	       )
	    );
		
	 

        $wp_customize->add_setting( 'fixar_map_api' , array(
            'default'     => 'AIzaSyBqQ_bBw186KJnMcRByvn5ffZueg88wp1E',
            'transport'   => 'refresh',
            'sanitize_callback' => 'esc_attr'
        ) );
        $wp_customize->add_control(
            'fixar_map_api',
            array(
                'label' => esc_html__( 'Google Map Api Key', 'fixar' ),
                'type' => 'text',
                'section' => 'fixar_general_settings',
                'settings' => 'fixar_map_api',
                'priority'   => 120
            )
        );

		
		
	}
	
	