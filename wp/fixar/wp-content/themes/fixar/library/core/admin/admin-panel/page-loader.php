<?php

 
	
	function fixar_customize_page_loader_tab($wp_customize, $theme_name){
	
		$wp_customize->add_section( 'fixar_page_loader_settings' , array(
		    'title'      => esc_html__( 'Page Loader', 'fixar' ),
		    'priority'   => 20,
		) );
		
		
 
 		/**
		 * 
		 * loader
		 * 
		 */
		 
		 $wp_customize->add_setting( 'fixar_page_loader_img' , array(
			'default'     => '',
			'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
	        new WP_Customize_Image_Control(
	            $wp_customize,
	            'fixar_page_loader_img',
				array(
				   'label'      => esc_html__( 'Image', 'fixar' ),
				   'section'    => 'fixar_page_loader_settings',
				   'context'    => 'fixar_page_loader_img',
				   'settings'   => 'fixar_page_loader_img',
				   'priority'   => 60
				)
	       )
	    );
	    
	    $wp_customize->add_setting( 'fixar_page_loader_img_width' , array(
		    'default'     => '',
		    'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
			'fixar_page_loader_img_width',
			array(
				'label'    => esc_html__( 'Image width', 'fixar' ),
				'section'  => 'fixar_page_loader_settings',
				'settings' => 'fixar_page_loader_img_width',
				'type'     => 'text',
				 
				'priority'   => 110
			)
		);
		
		$wp_customize->add_setting( 'fixar_page_loader_img_height' , array(
		    'default'     => '',
		    'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
			'fixar_page_loader_img_height',
			array(
				'label'    => esc_html__( 'Image height', 'fixar' ),
				'section'  => 'fixar_page_loader_settings',
				'settings' => 'fixar_page_loader_img_height',
				'type'     => 'text',
				 
				'priority'   => 110
			)
		);
		
		
		$wp_customize->add_setting( 'fixar_page_loader_settings_use' , array(
		    'default'     => 'off',
		    'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
			'fixar_page_loader_settings_use',
			array(
				'label'    => esc_html__( 'Loader', 'fixar' ),
				'section'  => 'fixar_page_loader_settings',
				'settings' => 'fixar_page_loader_settings_use',
				'type'     => 'select',
				'choices'  => array(
					'off'  => esc_html__( 'Off', 'fixar' ),
					'usemain' => esc_html__( 'Use on main', 'fixar' ),
					'useall' => esc_html__( 'Use on all pages', 'fixar' ),
				),
				'priority'   => 110
			)
		);
		
		/**
		 * 
		 * Animation In
		 * 
		 */
		
		$wp_customize->add_setting( 'fixar_page_loader_animation_in' , array(
		    'default'     => 'fade-in',
		    'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
			'fixar_page_loader_animation_in',
			array(
				'label'    => esc_html__( 'Animation In', 'fixar' ),
				'section'  => 'fixar_page_loader_settings',
				'settings' => 'fixar_page_loader_animation_in',
				'type'     => 'select',
				'choices'  => array(
                    'fade-in' => esc_html__( 'Fade', 'fixar' ),
                    'fade-in-down-sm' => esc_html__( 'Fade Down', 'fixar' ),
                    'fade-in-up-sm' => esc_html__( 'Fade Up', 'fixar' ),
                    'fade-in-left-sm' => esc_html__( 'Fade Left', 'fixar' ),
                    'fade-in-right-sm' => esc_html__( 'Fade Right', 'fixar' ),
                    'rotate-in-sm' => esc_html__( 'Rotate', 'fixar' ),
                    'overlay-slide-in-top' => esc_html__( 'Slide top', 'fixar' ),
                    'overlay-slide-in-bottom' => esc_html__( 'Slide bottom', 'fixar' ),
                    'overlay-slide-in-left' => esc_html__( 'Slide left', 'fixar' ),
                    'overlay-slide-in-right' => esc_html__( 'Slide right', 'fixar' ),
                    
                    
                    
                    
					
                    
                    
					 
				),
				'priority'   => 110
			)
		);
         
		/**
		 * 
		 *  Animation Out
		 * 
		 */
		
		$wp_customize->add_setting( 'fixar_page_loader_animation_out' , array(
		    'default'     => 'fade-out',
		    'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
			'fixar_page_loader_animation_out',
			array(
				'label'    => esc_html__( 'Animation Out', 'fixar' ),
				'section'  => 'fixar_page_loader_settings',
				'settings' => 'fixar_page_loader_animation_out',
				'type'     => 'select',
				'choices'  => array(
					'none' => esc_html__( 'None', 'fixar' ),
                    'fade-out' => esc_html__( 'Fade', 'fixar' ),
                    'fade-out-down-sm' => esc_html__( 'Fade Down', 'fixar' ),
                    'fade-out-up-sm' => esc_html__( 'Fade Up', 'fixar' ),
					'fade-out-left-sm' => esc_html__( 'Fade Left', 'fixar' ),
                    'fade-out-right-sm' => esc_html__( 'Fade Right', 'fixar' ),
                    'rotate-out-sm' => esc_html__( 'Rotate', 'fixar' ),
                    'overlay-slide-out-top' => esc_html__( 'Slide top', 'fixar' ),
                    'overlay-slide-out-bottom' => esc_html__( 'Slide bottom', 'fixar' ),
                    'overlay-slide-out-left' => esc_html__( 'Slide left', 'fixar' ),
                    'overlay-slide-out-right' => esc_html__( 'Slide right', 'fixar' ),
					 
				),
				'priority'   => 110
			)
		);
		
		/**
		 * 
		 *  Duration In
		 * 
		 */
		
		$wp_customize->add_setting( 'fixar_page_loader_duration_in' , array(
		    'default'     => '800',
		    'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
			'fixar_page_loader_duration_in',
			array(
				'label'    => esc_html__( 'Duration In', 'fixar' ),
				'section'  => 'fixar_page_loader_settings',
				'settings' => 'fixar_page_loader_duration_in',
				'type' => 'text',
				'priority'   => 110
			)
		);
		
		/**
		 * 
		 *  Duration Out
		 * 
		 */
		
		$wp_customize->add_setting( 'fixar_page_loader_duration_out' , array(
		    'default'     => '800',
		    'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
			'fixar_page_loader_duration_out',
			array(
				'label'    => esc_html__( 'Duration Out', 'fixar' ),
				'section'  => 'fixar_page_loader_settings',
				'settings' => 'fixar_page_loader_duration_out',
				'type' => 'text',
				'priority'   => 110
			)
		);

		/* Loader color */
		$wp_customize->add_setting( 'fixar_page_loader_bg_color' , array(
		    'default'     => get_option('fixar_page_loader_bg_color'),
		    'transport'   => 'refresh',
			'sanitize_callback' => 'esc_attr'
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
	            $wp_customize,
	            'fixar_page_loader_bg_color',
				array(
				   'label'      => esc_html__( 'Loader Background', 'fixar' ),
				   'section'    => 'fixar_page_loader_settings',
				   'settings'   => 'fixar_page_loader_bg_color',
				   'priority'   => 110
				)
	       )
		);

	}
	
	