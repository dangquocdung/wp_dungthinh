<?php
function fixar_customize_services_tab($wp_customize, $theme_name) {

	$wp_customize->add_section( 'fixar_services_settings' , array(
        'title'      => esc_html__( 'Services', 'fixar' ),
        'priority'   => 60,
    ) );

	$wp_customize->add_setting( 'fixar_services_settings_page', array(
		'default'           => '0',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint'
	) );

	$wp_customize->add_setting( 'fixar_services_settings_related', array(
			'default'           => 1,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_attr'
	) );

	$wp_customize->add_setting( 'fixar_services_settings_share', array(
		'default'           => 1,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_attr'
	) );


	$wp_customize->add_control( 'fixar_services_settings_page', array(
		'label'    => esc_html__( 'Select Page For All Services', 'fixar' ),
		'section'  => 'fixar_services_settings',
		'type'     => 'dropdown-pages'
	) );

	$wp_customize->add_control( 'fixar_services_settings_related', array(
        'label'    => esc_html__( 'Display Related Services', 'fixar' ),
        'section'  => 'fixar_services_settings',
        'settings' => 'fixar_services_settings_related',
        'type'     => 'select',
        'choices'  => array(
            '1' => esc_html__( 'On', 'fixar' ),
            '0'  => esc_html__( 'Off', 'fixar' ),
        ),
        'priority'   => 20
	) );

    $wp_customize->add_control( 'fixar_services_settings_share', array(
            'label'    => esc_html__( 'Display Share on Services', 'fixar' ),
            'section'  => 'fixar_services_settings',
            'settings' => 'fixar_services_settings_share',
            'type'     => 'select',
            'choices'  => array(
                '1' => esc_html__( 'On', 'fixar' ),
                '0'  => esc_html__( 'Off', 'fixar' ),
            ),
            'priority'   => 30
    ) );

}