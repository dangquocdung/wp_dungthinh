<?php

	function fixar_customize_responsive_tab($wp_customize, $theme_name){
	
		$wp_customize->add_section( 'fixar_responsive_settings' , array(
		    'title'      => esc_html__( 'Responsive', 'fixar' ),
		    'priority'   => 35,
		) );

		$wp_customize->add_setting( 'fixar_general_settings_responsive' , array(
		    'default'     => '',
		    'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		) );

		$wp_customize->add_setting( 'fixar_mobile_sticky' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );

		$wp_customize->add_setting( 'fixar_mobile_topbar' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );

		$wp_customize->add_setting( 'fixar_tablet_minicart' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );

		$wp_customize->add_setting( 'fixar_tablet_search' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );

		$wp_customize->add_setting( 'fixar_tablet_phone' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );

		$wp_customize->add_setting( 'fixar_tablet_socials' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );

		

		$wp_customize->add_control(
			'fixar_general_settings_responsive',
			array(
				'label'    => esc_html__( 'Responsive', 'fixar' ),
				'section'  => 'fixar_responsive_settings',
				'settings' => 'fixar_general_settings_responsive',
				'type'     => 'select',
				'choices'  => array(
					'off'  => esc_html__( 'Off', 'fixar' ),
					'on'   => esc_html__( 'On', 'fixar' ),
				),
				'priority'   => 5
			)
		);

		$wp_customize->add_control(
            'fixar_mobile_sticky',
            array(
                'label'    => esc_html__( 'Header Mobile Behavior', 'fixar' ),
                'description'   => esc_html__( 'Off header sticky or fixed on mobile', 'fixar' ),
                'section'  => 'fixar_responsive_settings',
                'settings' => 'fixar_mobile_sticky',
                'type'     => 'select',
                'choices'  => array(
                    ''  => esc_html__( 'Global', 'fixar' ),
                    'mobile-no-sticky' => esc_html__( 'No Sticky', 'fixar' ),
		            'mobile-no-fixed' => esc_html__( 'No Fixed', 'fixar' ),
                ),
                'priority'   => 10
            )
        );

        $wp_customize->add_control(
            'fixar_mobile_topbar',
            array(
                'label'    => esc_html__( 'Header Mobile Behavior', 'fixar' ),
                'description'   => esc_html__( 'Off header top bar on mobile', 'fixar' ),
                'section'  => 'fixar_responsive_settings',
                'settings' => 'fixar_mobile_sticky',
                'type'     => 'select',
                'choices'  => array(
                    ''  => esc_html__( 'Global', 'fixar' ),
                    'no-mobile-topbar' => esc_html__( 'Off', 'fixar' ),
                ),
                'priority'   => 20
            )
        );

        $wp_customize->add_control(
            'fixar_tablet_minicart',
            array(
                'label'    => esc_html__( 'Tablet Minicart', 'fixar' ),
                'description'   => esc_html__( 'Off header cart on tablet', 'fixar' ),
                'section'  => 'fixar_responsive_settings',
                'settings' => 'fixar_tablet_minicart',
                'type'     => 'select',
                'choices'  => array(
                    ''  => esc_html__( 'Global', 'fixar' ),
                    'no-tablet-minicart' => esc_html__( 'Off', 'fixar' ),
                ),
                'priority'   => 30
            )
        );

        $wp_customize->add_control(
            'fixar_tablet_search',
            array(
                'label'    => esc_html__( 'Tablet Search', 'fixar' ),
                'description'   => esc_html__( 'Off header search on tablet', 'fixar' ),
                'section'  => 'fixar_responsive_settings',
                'settings' => 'fixar_tablet_search',
                'type'     => 'select',
                'choices'  => array(
                    ''  => esc_html__( 'Global', 'fixar' ),
                    'no-tablet-search' => esc_html__( 'Off', 'fixar' ),
                ),
                'priority'   => 40
            )
        );

        $wp_customize->add_control(
            'fixar_tablet_phone',
            array(
                'label'    => esc_html__( 'Tablet Header Phone', 'fixar' ),
                'description'   => esc_html__( 'Off header phone on tablet', 'fixar' ),
                'section'  => 'fixar_responsive_settings',
                'settings' => 'fixar_tablet_phone',
                'type'     => 'select',
                'choices'  => array(
                    ''  => esc_html__( 'Global', 'fixar' ),
                    'no-tablet-phone' => esc_html__( 'Off', 'fixar' ),
                ),
                'priority'   => 50
            )
        );

        $wp_customize->add_control(
            'fixar_tablet_socials',
            array(
                'label'    => esc_html__( 'Tablet Socials', 'fixar' ),
                'description'   => esc_html__( 'Off header social icons on tablet', 'fixar' ),
                'section'  => 'fixar_responsive_settings',
                'settings' => 'fixar_tablet_socials',
                'type'     => 'select',
                'choices'  => array(
                    ''  => esc_html__( 'Global', 'fixar' ),
                    'no-tablet-socials' => esc_html__( 'Off', 'fixar' ),
                ),
                'priority'   => 60
            )
        );
		
	}
		
?>