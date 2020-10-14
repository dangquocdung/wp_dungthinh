<?php
/*
 * All customizer related options for Eunice theme.
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */

if( ! function_exists( 'eunice_vt_customizer' ) ) {
  function eunice_vt_customizer( $options ) {

	$options        = array(); // remove old options

	// Primary Color
	$options[]      = array(
	  'name'        => 'body_color_section',
	  'title'       => esc_html__('01. Primary Color', 'eunice'),
	  'settings'    => array(

	    // Fields Start
			array(
				'name'      => 'body_bg',
				'default'   => '#ffffff',
				'control'   => array(
					'type'  => 'color',
					'label' => esc_html__('Body Background', 'eunice'),
				),
			),
			array(
				'name'      => 'entry_content_color',
				'default'   => '#333',
				'control'   => array(
					'type'  => 'color',
					'label' => esc_html__('Color', 'eunice'),
				),
			),
	    // Fields End
	  )
	);
	// Primary Color

	// Header Color
	$options[]      = array(
	  'name'        => 'header_color_section',
	  'title'       => esc_html__('02. Header Colors', 'eunice'),
	  'settings'    => array(

	    // Fields Start
			array(
				'name'          => 'header_main_menu_heading',
				'control'       => array(
					'type'        => 'cs_field',
					'options'     => array(
						'type'      => 'notice',
						'class'     => 'info',
						'content'   => esc_html__('Main Menu Colors', 'eunice'),
					),
				),
			),
			array(
				'name'      => 'header_area_bg_color',
				'control'   => array(
					'type'  => 'color',
					'label' => esc_html__('Background Color', 'eunice'),
				),
			),
			array(
				'name'      => 'header_content_bg_color',
				'control'   => array(
					'type'  => 'color',
					'label' => esc_html__('Background Color', 'eunice'),
				),
			),
			array(
				'name'      => 'header_menu_color',
				'control'   => array(
					'type'  => 'color',
					'label' => esc_html__('Menu Color', 'eunice'),
				),
			),
			array(
				'name'      => 'header_menu_hover_color',
				'control'   => array(
					'type'  => 'color',
					'label' => esc_html__('Hover Color', 'eunice'),
				),
			),

			// Sub Menu Color
			array(
				'name'          => 'header_submenu_heading',
				'control'       => array(
					'type'        => 'cs_field',
					'options'     => array(
						'type'      => 'notice',
						'class'     => 'info',
						'content'   => esc_html__('Sub-Menu Colors', 'eunice'),
					),
				),
			),
			array(
				'name'      => 'submenu_color',
				'control'   => array(
					'type'  => 'color',
					'label' => esc_html__('Submenu Color', 'eunice'),
				),
			),
			array(
				'name'      => 'submenu_hover_color',
				'control'   => array(
					'type'  => 'color',
					'label' => esc_html__('Hover Color', 'eunice'),
				),
			),
	    // Fields End

	  )
	);
	// Header Color

	// Content Color
	$options[]      = array(
	  'name'        => 'content_section',
	  'title'       => esc_html__('04. Content Colors', 'eunice'),
	  'description' => esc_html__('This is all about content area text and heading colors.', 'eunice'),
	  'sections'    => array(

	  	array(
	      'name'          => 'content_text_section',
	      'title'         => esc_html__('Content Text', 'eunice'),
	      'settings'      => array(

			    // Fields Start
			    array(
						'name'      => 'body_color',
						'control'   => array(
							'type'  => 'color',
							'label' => esc_html__('Content Color', 'eunice'),
						),
					),
					array(
						'name'      => 'body_links_color',
						'control'   => array(
							'type'  => 'color',
							'label' => esc_html__('Body Links Color', 'eunice'),
						),
					),
					array(
						'name'      => 'body_link_hover_color',
						'control'   => array(
							'type'  => 'color',
							'label' => esc_html__('Body Links Hover Color', 'eunice'),
						),
					),

			    // Fields End
			  )
			),

	  )
	);
	// Content Color

	return $options;

  }
  add_filter( 'cs_customize_options', 'eunice_vt_customizer' );
}