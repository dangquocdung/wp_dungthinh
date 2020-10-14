<?php
	
	function fixar_customize_shop_tab($wp_customize, $theme_name){

		$fixar_pix_slider = array( 0 => esc_html__( 'No RevSlider', 'fixar' ) );
		if (class_exists('RevSlider')) {
			$arr = array( 0 => esc_html__( 'No RevSlider', 'fixar' ) );

			$pix_sliders 	= new RevSlider();
			$pix_arrSliders = $pix_sliders->getArrSliders();

			foreach($pix_arrSliders as $slider){
			  $arr[$slider->getAlias()] = $slider->getTitle();
			}
			if($arr){
			  $fixar_pix_slider = $arr;
			}

		}

		$wp_customize->add_section( 'fixar_shop_settings' , array(
		    'title'      => esc_html__( 'Shop', 'fixar' ),
		    'priority'   => 50,
		) );



		$wp_customize->add_setting( 'fixar_shop_header_slider' , array(
			'default'     => 0,
			'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
			'fixar_shop_header_slider',
			array(
					'label'    => esc_html__( 'Header RevSlider On Main Shop Page', 'fixar' ),
					'section'  => 'fixar_shop_settings',
					'settings' => 'fixar_shop_header_slider',
					'type'     => 'select',
					'choices'  => $fixar_pix_slider,
					'priority' => 10
			)
		);

		$wp_customize->add_setting( 'fixar_shop_header_image' , array(
			'default'     => '',
			'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		) );
        $wp_customize->add_control(
	        new WP_Customize_Image_Control(
	            $wp_customize,
	            'fixar_shop_header_image',
				array(
				   'label'      => esc_html__( 'Header Image', 'fixar' ),
				   'section'    => 'fixar_shop_settings',
				   'context'    => 'fixar_shop_header_image',
				   'settings'   => 'fixar_shop_header_image',
				   'priority'   => 20
				)
	       )
	    );

	    $wp_customize->add_setting( 'fixar_shop_settings_global_product' , array(
			'default'     => 'on',
			'transport'   => 'refresh',
			'sanitize_callback' => 'fixar_sanitize_onoff'
		) );
		$wp_customize->add_control(
			'fixar_shop_settings_global_product',
			array(
				'label'    => esc_html__( 'Global sidebar settings for Product pages', 'fixar' ),
				'section'  => 'fixar_shop_settings',
				'settings' => 'fixar_shop_settings_global_product',
				'description' => esc_html__( 'Global sidebar settings for all Product pages.', 'fixar' ),
				'type'     => 'select',
				'choices'  => array(
					'on'  => esc_html__( 'On', 'fixar' ),
					'off'  => esc_html__( 'Off', 'fixar' ),
				),
				'priority'   => 30
			)
		);

		$wp_customize->add_setting( 'fixar_shop_settings_sidebar_type' , array(
			'default'     => '2',
			'transport'   => 'refresh',
			'sanitize_callback' => 'fixar_sanitize_sidebar_blog_type'
		) );
		$wp_customize->add_control(
			'fixar_shop_settings_sidebar_type',
			array(
				'label'    => esc_html__( 'Product sidebar type', 'fixar' ),
				'section'  => 'fixar_shop_settings',
				'settings' => 'fixar_shop_settings_sidebar_type',
				'description' => esc_html__( 'Select sidebar type for Product pages.', 'fixar' ),
				'type'     => 'select',
				'choices'  => array(
					'1' => esc_html__( 'Full width', 'fixar' ),
					'2' => esc_html__( 'Right Sidebar', 'fixar' ),
					'3' => esc_html__( 'Left Sidebar', 'fixar' ),
				),
				'priority' => 40
			)
		);

		$wp_customize->add_setting( 'fixar_shop_settings_sidebar_content' , array(
			'default'     => 'product-sidebar-1',
			'transport'   => 'refresh',
			'sanitize_callback' => 'fixar_sanitize_sidebar_blog_content'
		) );
		$wp_customize->add_control(
			'fixar_shop_settings_sidebar_content',
			array(
				'label'    => esc_html__( 'Product sidebar content', 'fixar' ),
				'section'  => 'fixar_shop_settings',
				'settings' => 'fixar_shop_settings_sidebar_content',
				'description' => esc_html__( 'Select sidebar content for product pages', 'fixar' ),
				'type'     => 'select',
				'choices'  => array(
					'sidebar-1' => esc_html__( 'WP Default Sidebar', 'fixar' ),
					'global-sidebar-1' => esc_html__( 'Blog Sidebar', 'fixar' ),
					'portfolio-sidebar-1' => esc_html__( 'Portfolio Sidebar', 'fixar' ),
					'shop-sidebar-1' => esc_html__( 'Shop Sidebar', 'fixar' ),
					'product-sidebar-1' => esc_html__( 'Product Sidebar', 'fixar' ),
					'custom-area-1' => esc_html__( 'Custom Area', 'fixar' ),
				),
				'priority' => 50
			)
		);

		$wp_customize->add_setting( 'fixar_shop_settings_checkout' , array(
			'default'     => 'off',
			'transport'   => 'refresh',
			'sanitize_callback' => 'fixar_sanitize_onoff'
		) );
		$wp_customize->add_control(
			'fixar_shop_settings_checkout',
			array(
				'label'    => esc_html__( 'Checkout without Cart', 'fixar' ),
				'section'  => 'fixar_shop_settings',
				'settings' => 'fixar_shop_settings_checkout',
				'description' => esc_html__( 'Add to cart go to checkout', 'fixar' ),
				'type'     => 'select',
				'choices'  => array(
					'on'  => esc_html__( 'On', 'fixar' ),
					'off'  => esc_html__( 'Off', 'fixar' ),
				),
				'priority'   => 60
			)
		);
				
	}
?>