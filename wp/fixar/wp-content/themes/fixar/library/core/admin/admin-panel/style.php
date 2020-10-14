<?php

function fixar_customize_style_tab($wp_customize, $theme_name) {

	$wp_customize->add_panel('fixar_style_panel',  array(
        'title' => 'Style Settings',
        'priority' => 25,
        )
    );



	/// COLOR SETTINGS ///

	$wp_customize->add_section( 'fixar_style_general_settings' , array(
	    'title'      => esc_html__( 'Layout', 'fixar' ),
	    'priority'   => 10,
		'panel' => 'fixar_style_panel'
	) );


	$wp_customize->add_setting( 'fixar_style_general_settings_layout' , array(
        'default'     => 'normal',
        'transport'   => 'refresh',
	    'sanitize_callback' => 'esc_html',
    ) );
    $wp_customize->add_control(
        'fixar_style_general_settings_layout',
        array(
            'label'    => esc_html__( 'Page Layout', 'fixar' ),
            'section'  => 'fixar_style_general_settings',
            'settings' => 'fixar_style_general_settings_layout',
            'type'     => 'select',
            'choices'  => array(
                'normal'  => esc_html__( 'Normal', 'fixar' ),
                'full-width' => esc_html__( 'Full Width', 'fixar' ),
		        'boxed' => esc_html__( 'Boxed', 'fixar' ),
            ),
            'priority'   => 10,
        )
    );



	/// COLOR SETTINGS ///

	$wp_customize->add_section( 'fixar_style_settings' , array(
	    'title'      => esc_html__( 'Color', 'fixar' ),
	    'priority'   => 20,
		'panel' => 'fixar_style_panel'
	) );


	$wp_customize->add_setting(
		'fixar_style_settings_main_color',
		array(
			'default' => get_option('fixar_default_main_color'),
			'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'fixar_style_settings_main_color',
			array(
				'label' => esc_html__( 'Main Color', 'fixar' ),
				'section' => 'fixar_style_settings',
				'settings' => 'fixar_style_settings_main_color',
				'priority'   => 10
			)
		)
	);

	$wp_customize->add_setting(
		'fixar_style_settings_gradient_color',
		array(
			'default' => get_option('fixar_default_gradient_color'),
			'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'fixar_style_settings_gradient_color',
			array(
				'label' => esc_html__( 'Gradient Color', 'fixar' ),
				'section' => 'fixar_style_settings',
				'settings' => 'fixar_style_settings_gradient_color',
				'priority'   => 15
			)
		)
	);

	$wp_customize->add_setting(
		'fixar_style_settings_additional_color',
		array(
			'default' => get_option('fixar_default_additional_color'),
			'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'fixar_style_settings_additional_color',
			array(
				'label' => esc_html__( 'Additional Color', 'fixar' ),
				'section' => 'fixar_style_settings',
				'settings' => 'fixar_style_settings_additional_color',
				'priority'   => 20
			)
		)
	);

	$wp_customize->add_setting(
		'fixar_style_settings_bg_color',
		array(
			'default' => '',
			'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'fixar_style_settings_bg_color',
			array(
				'label' => esc_html__( 'Background Color', 'fixar' ),
				'section' => 'fixar_style_settings',
				'settings' => 'fixar_style_settings_bg_color',
				'priority'   => 30
			)
		)
	);
	
	



	/// FONT SETTINGS ///

	$wp_customize->add_section( 'fixar_style_font_settings' , array(
		'title'      => esc_html__( 'Fonts', 'fixar' ),
		'priority'   => 30,
		'panel' => 'fixar_style_panel',
	) );


    $wp_customize->add_setting( 'fixar_font_api' , array(
        'default'     => 'AIzaSyB3I4_9SKnm0F1H4dN1A2XWb5NhIxosUgI',
        'transport'   => 'refresh',
        'sanitize_callback' => 'esc_attr'
    ) );
    $wp_customize->add_control(
        'fixar_font_api',
        array(
            'label' => esc_html__( 'Google Font Api Key', 'fixar' ),
            'type' => 'text',
            'section' => 'fixar_style_font_settings',
            'settings' => 'fixar_font_api',
            'priority'   => 10
        )
    );
	
	$wp_customize->add_setting( 'fixar_font' , array(
		'default'     => get_option('fixar_default_font'),
		'transport'   => 'refresh',
		'sanitize_callback' => 'esc_attr'
	) );
    $wp_customize->add_control(
        new fixar_Google_Fonts_Control(
			$wp_customize,
			'fixar_font',
			array(
				'label' => esc_html__( 'Font', 'fixar' ),
				'section' => 'fixar_style_font_settings',
				'settings' => 'fixar_font',
				'priority'   => 20
			)
		)
	);

	$wp_customize->add_setting( 'fixar_font_weights' , array(
		'default'     => get_option('fixar_default_font_weights'),
		'transport'   => 'postMessage',
		'sanitize_callback' => 'esc_attr'
	) );
    $wp_customize->add_control(
        new fixar_Google_Font_Weight_Control(
			$wp_customize,
			'fixar_font_weights',
			array(
				'label' => esc_html__( 'Font Variants to Load', 'fixar' ),
				'section' => 'fixar_style_font_settings',
				'settings' => 'fixar_font_weights',
				'hidden_class' => 'font_value',
				'container_class' => 'font',
				'priority'   => 30
			)
		)
	);

	$wp_customize->add_setting( 'fixar_font_weight' , array(
		'default'     => get_option('fixar_default_font_weight'),
		'transport'   => 'refresh',
		'sanitize_callback' => 'fixar_sanitize_text'
	) );
    $wp_customize->add_control(
        new fixar_Google_Font_Weight_Single_Control(
			$wp_customize,
			'fixar_font_weight',
			array(
			    'label' => esc_html__( 'Font Weight', 'fixar' ),
				'section' => 'fixar_style_font_settings',
				'settings' => 'fixar_font_weight',
				'container_class' => 'font',
				'priority'   => 40
			)
        )
	);


	$wp_customize->add_setting( 'fixar_title_font' , array(
		'default'     => get_option('fixar_default_title'),
		'transport'   => 'refresh',
		'sanitize_callback' => 'fixar_sanitize_text'
	) );
    $wp_customize->add_control(
        new fixar_Google_Fonts_Control(
			$wp_customize,
			'fixar_title_font',
			array(
				'label' => esc_html__( 'Title Font', 'fixar' ),
				'section' => 'fixar_style_font_settings',
				'settings' => 'fixar_title_font',
				'priority'   => 50
			)
		)
	);

	$wp_customize->add_setting( 'fixar_title_font_weights' , array(
		'default'     => get_option('fixar_default_title_weights'),
		'transport'   => 'refresh',
		'sanitize_callback' => 'fixar_sanitize_text'
	) );
    $wp_customize->add_control(
        new fixar_Google_Font_Weight_Control(
			$wp_customize,
			'fixar_title_font_weights',
			array(
				'label' => esc_html__( 'Title Font Variants to Load', 'fixar' ),
				'section' => 'fixar_style_font_settings',
				'settings' => 'fixar_title_font_weights',
				'hidden_class' => 'title_font_value',
				'container_class' => 'title_font',
				'priority'   => 60
			)
		)
	);

	$wp_customize->add_setting( 'fixar_title_font_weight' , array(
		'default'     => get_option('fixar_default_title_weight'),
		'transport'   => 'refresh',
		'sanitize_callback' => 'fixar_sanitize_text'
	) );
    $wp_customize->add_control(
        new fixar_Google_Font_Weight_Single_Control(
			$wp_customize,
			'fixar_title_font_weight',
			array(
			    'label' => esc_html__( 'Title Font Weight', 'fixar' ),
				'section' => 'fixar_style_font_settings',
				'settings' => 'fixar_title_font_weight',
				'container_class' => 'title_font',
				'priority'   => 70
			)
        )
	);


	$wp_customize->add_setting( 'fixar_subtitle_font' , array(
		'default'     => get_option('fixar_default_subtitle'),
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	) );
    $wp_customize->add_control(
        new fixar_Google_Fonts_Control(
			$wp_customize,
			'fixar_subtitle_font',
			array(
				'label' => esc_html__( 'Subtitle Font', 'fixar' ),
				'section' => 'fixar_style_font_settings',
				'settings' => 'fixar_subtitle_font',
				'priority'   => 80
			)
		)
	);

	$wp_customize->add_setting( 'fixar_subtitle_font_weights' , array(
		'default'     => get_option('fixar_default_subtitle_weights'),
		'transport'   => 'refresh',
		'sanitize_callback' => 'fixar_sanitize_text'
	) );
    $wp_customize->add_control(
        new fixar_Google_Font_Weight_Control(
			$wp_customize,
			'fixar_subtitle_font_weights',
			array(
				'label' => esc_html__( 'Subtitle Font Variants to Load', 'fixar' ),
				'section' => 'fixar_style_font_settings',
				'settings' => 'fixar_subtitle_font_weights',
				'hidden_class' => 'subtitle_font_value',
				'container_class' => 'subtitle_font',
				'priority'   => 90
			)
		)
	);

	$wp_customize->add_setting( 'fixar_subtitle_font_weight' , array(
		'default'     => get_option('fixar_default_subtitle_weight'),
		'transport'   => 'refresh',
		'sanitize_callback' => 'fixar_sanitize_text'
	) );
    $wp_customize->add_control(
        new fixar_Google_Font_Weight_Single_Control(
			$wp_customize,
			'fixar_subtitle_font_weight',
			array(
			    'label' => esc_html__( 'Subtitle Font Weight', 'fixar' ),
				'section' => 'fixar_style_font_settings',
				'settings' => 'fixar_subtitle_font_weight',
				'container_class' => 'subtitle_font',
				'priority'   => 100
			)
        )
	);


	
	$wp_customize->add_section( 'fixar_minify_settings' , array(
	    'title'      => esc_html__( 'Speed optimizing', 'fixar' ),
	    'priority'   => 10,
		'panel' => 'fixar_style_panel'
	) );
	 
	$wp_customize->add_setting( 'fixar_minify_styles_scripts' , array(
	    'default'     => 'no',
	    'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	) );
	$wp_customize->add_control(
		'fixar_minify_styles_scripts',
		array(
			'label'    => esc_html__( 'Minify styles & scripts', 'fixar' ),
			'section'  => 'fixar_minify_settings',
			'settings' => 'fixar_minify_styles_scripts',
			'type'     => 'select',
			'choices'  => array(
				'no'  => esc_html__( 'No', 'fixar' ),
				'yes' => esc_html__( 'Yes', 'fixar' ),
			),
			'priority'   => 110
		)
	);
    
  



}

