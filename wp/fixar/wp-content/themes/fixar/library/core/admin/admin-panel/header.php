<?php

	function fixar_header_type_callback( $control ) {
	    if ( $control->manager->get_setting('fixar_header_type')->value() == 'header3' ) {
	        return true;
	    } else {
	        return false;
	    }
	}

	function fixar_header_type12_callback( $control ) {
	    if ( $control->manager->get_setting('fixar_header_type')->value() != 'header3' ) {
	        return true;
	    } else {
	        return false;
	    }
	}

	function fixar_header_type4_callback( $control ) {
	    if ( $control->manager->get_setting('fixar_header_type')->value() == 'header4' ) {
	        return true;
	    } else {
	        return false;
	    }
	}

	function fixar_header_background_callback( $control ) {
	    if (  in_array($control->manager->get_setting('fixar_header_background')->value(), array('trans-white', 'trans-black')) ) {
	        return true;
	    } else {
	        return false;
	    }
	}

	function fixar_header_menu_callback( $control ) {
	    if (  $control->manager->get_setting('fixar_header_menu')->value() != 0 ) {
	        return true;
	    } else {
	        return false;
	    }
	}

	function fixar_header_decore_callback ( $control ) {
		if ( $control->manager->get_setting('fixar_header_type')->value() == 'header4' ) {
	        return true;
	    } else {
	        return false;
	    }
	}

	function fixar_header_type5_callback( $control ) {
	    if ( $control->manager->get_setting('fixar_header_type')->value() == 'header5' ) {
	        return true;
	    } else {
	        return false;
	    }
	}

	function fixar_customize_header_tab($wp_customize, $theme_name){

		$header_elements = array(
			'logo'  => esc_html__( 'Logo', 'fixar' ),
			'menu' => esc_html__( 'Menu', 'fixar' ),
			'hamburger' => esc_html__( 'Hamburger Menu', 'fixar' ),
			'logo_menu' => esc_html__( 'Menu With Centered Logo', 'fixar' ),
			'search'  => esc_html__( 'Search', 'fixar' ),
			'cart'  => esc_html__( 'Cart', 'fixar' ),
			'socials' => esc_html__( 'Socials', 'fixar' ),
			'phone'  => esc_html__( 'Phone', 'fixar' ),
			'email' => esc_html__( 'E-mail', 'fixar' ),
			'text' => esc_html__( 'Custom Text', 'fixar' ),
		);

		$header_elements_position = array(
			'1'  => esc_html__( 'On', 'fixar' ),
			'0'  => esc_html__( 'Off', 'fixar' ),
			'level_1_left'  => esc_html__( 'Level 1 Left', 'fixar' ),
			'level_1_right' => esc_html__( 'Level 1 Right', 'fixar' ),
			'level_1_center' => esc_html__( 'Level 1 Center', 'fixar' ),
			'level_2_left'  => esc_html__( 'Level 2 Left', 'fixar' ),
			'level_2_right'  => esc_html__( 'Level 2 Right', 'fixar' ),
			'level_2_center' => esc_html__( 'Level 2 Center', 'fixar' ),
			'top_bar_left'  => esc_html__( 'Top Bar Left', 'fixar' ),
			'top_bar_right' => esc_html__( 'Top Bar Right', 'fixar' ),
			'top_bar_center' => esc_html__( 'Top Bar Center', 'fixar' ),
		);

		$wp_customize->add_panel('fixar_header_panel',  array(
            'title' => 'Header',
            'priority' => 30,
            )
        );


		$wp_customize->add_section( 'fixar_header_settings' , array(
		    'title'      => esc_html__( 'General Settings', 'fixar' ),
		    'priority'   => 5,
			'panel' => 'fixar_header_panel'
		) );

		$wp_customize->add_setting( 'fixar_header_type' , array(
				'default'     => 'header1',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'fixar_header_type',
            array(
                'label'    => esc_html__( 'Type', 'fixar' ),
                'section'  => 'fixar_header_settings',
                'settings' => 'fixar_header_type',
                'type'     => 'select',
                'choices'  => array(
                    'header1'  => esc_html__( 'Classic', 'fixar' ),
                    'header2' => esc_html__( 'Shop', 'fixar' ),
		            'header3' => esc_html__( 'Sidebar', 'fixar' ),
		            'header4' => esc_html__( 'Middle', 'fixar' ),
                    'header5' => esc_html__( 'Advanced', 'fixar' ),
                ),
                'priority'   => 10
            )
        );

        /* MIDDLE TYPE */
        $wp_customize->add_setting( 'fixar_header_type4_lmenu' , array(
			'default'     => '',
			'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		) );
		$args = array(
			'taxonomy' => 'nav_menu',
			'hide_empty' => true,
		);
		$menus = get_terms( $args );
		$menus_arr = array();
		$menus_arr[''] = esc_html__( 'Select Menu', 'fixar' );
		foreach ($menus as $key => $value) {
			if(is_object($value)) {
				$menus_arr[$value->term_id] = $value->name;
			}
		}
		$wp_customize->add_control( 'fixar_header_type4_lmenu', array(
			'label'    => esc_html__( 'Left Menu', 'fixar' ),
			'section'         => 'fixar_header_settings',
			'settings' => 'fixar_header_type4_lmenu',
			'type'          => 'select',
            'choices'       => $menus_arr,
            'active_callback' => 'fixar_header_type4_callback',
			'priority'   => 11,
		));
		$wp_customize->add_setting( 'fixar_header_type4_rmenu' , array(
			'default'     => '',
			'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control( 'fixar_header_type4_rmenu', array(
			'label'    => esc_html__( 'Right Menu', 'fixar' ),
			'section'         => 'fixar_header_settings',
			'settings' => 'fixar_header_type4_rmenu',
			'type'          => 'select',
            'choices'       => $menus_arr,
            'active_callback' => 'fixar_header_type4_callback',
			'priority'   => 11
		));

		/* CREATE TINYMCE FIELD */
		class Text_Editor_Custom_Control extends WP_Customize_Control
		{
		    public $type = 'textarea';
		    public function render_content() {
		    	echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
		        $settings = array(
		            'media_buttons' => false,
		            'quicktags' => true,
		            'textarea_rows' => 5
		        );
		        $this->filter_editor_setting_link();
		        wp_editor($this->value(), $this->id, $settings );
		        do_action('admin_footer');
		        do_action('admin_print_footer_scripts');
		    }
		    private function filter_editor_setting_link() {
		        add_filter( 'the_editor', function( $output ) { 
		        	return preg_replace( '/<textarea/', '<textarea ' . $this->get_link(), $output, 1 ); 
		        } );
		    }
		}
		function editor_customizer_script() {
		    wp_enqueue_script( 'wp-editor-customizer', get_template_directory_uri() . '/library/core/admin/js/customizer.js', array( 'jquery' ), rand(), true );
		}
		add_action( 'customize_controls_enqueue_scripts', 'editor_customizer_script' );

		/* ADVANCED TYPE */
		/* BLOCK 1 */
		$wp_customize->add_setting( 'fixar_header_type5_block1_icon' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control( 'fixar_header_type5_block1_icon',
            array(
                'label'         => esc_html__( 'Block #1 Icon Class', 'fixar' ),
                'section'       => 'fixar_header_settings',
                'settings'      => 'fixar_header_type5_block1_icon',
                'type'          => 'text',
                'priority'   => 12,
                'active_callback' => 'fixar_header_type5_callback',
            )
        );
		$wp_customize->add_setting( 'fixar_header_type5_block1_content' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'wp_kses_post'
		) );
		$wp_customize -> add_control(
		    new Text_Editor_Custom_Control(
		        $wp_customize,
		        'fixar_header_type5_block1_content',
		        array(
		            'label'         => esc_html__( 'Block #1 Content', 'fixar' ),
	                'section'       => 'fixar_header_settings',
	                'settings'      => 'fixar_header_type5_block1_content',
	                'priority'   => 12,
	                'active_callback' => 'fixar_header_type5_callback',
		        )
		    )
		);
        /* BLOCK 2 */
        $wp_customize->add_setting( 'fixar_header_type5_block2_icon' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control( 'fixar_header_type5_block2_icon',
            array(
                'label'         => esc_html__( 'Block #2 Icon Class', 'fixar' ),
                'section'       => 'fixar_header_settings',
                'settings'      => 'fixar_header_type5_block2_icon',
                'type'          => 'text',
                'priority'   => 12,
                'active_callback' => 'fixar_header_type5_callback',
            )
        );
		$wp_customize->add_setting( 'fixar_header_type5_block2_content' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'wp_kses_post'
		) );
		$wp_customize -> add_control(
		    new Text_Editor_Custom_Control(
		        $wp_customize,
		        'fixar_header_type5_block2_content',
		        array(
		            'label'         => esc_html__( 'Block #2 Content', 'fixar' ),
	                'section'       => 'fixar_header_settings',
	                'settings'      => 'fixar_header_type5_block2_content',
	                'priority'   => 12,
	                'active_callback' => 'fixar_header_type5_callback',
		        )
		    )
		);
        /* BLOCK 3 */
        $wp_customize->add_setting( 'fixar_header_type5_block3_icon' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control( 'fixar_header_type5_block3_icon',
            array(
                'label'         => esc_html__( 'Block #3 Icon Class', 'fixar' ),
                'section'       => 'fixar_header_settings',
                'settings'      => 'fixar_header_type5_block3_icon',
                'type'          => 'text',
                'priority'   => 12,
                'active_callback' => 'fixar_header_type5_callback',
            )
        );
		$wp_customize->add_setting( 'fixar_header_type5_block3_content' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'wp_kses_post'
		) );
		$wp_customize -> add_control(
		    new Text_Editor_Custom_Control(
		        $wp_customize,
		        'fixar_header_type5_block3_content',
		        array(
		            'label'         => esc_html__( 'Block #3 Content', 'fixar' ),
	                'section'       => 'fixar_header_settings',
	                'settings'      => 'fixar_header_type5_block3_content',
	                'priority'   => 12,
	                'active_callback' => 'fixar_header_type5_callback',
		        )
		    )
		);
		/* RIGHT BLOCK */
		$wp_customize->add_setting( 'fixar_header_type5_rblock_text' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control( 'fixar_header_type5_rblock_text',
            array(
                'label'         => esc_html__( 'Right Block Text', 'fixar' ),
                'section'       => 'fixar_header_settings',
                'settings'      => 'fixar_header_type5_rblock_text',
                'type'          => 'text',
                'priority'   => 12,
                'active_callback' => 'fixar_header_type5_callback',
            )
        );
        $wp_customize->add_setting( 'fixar_header_type5_rblock_link' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control( 'fixar_header_type5_rblock_link',
            array(
                'label'         => esc_html__( 'Right Block Link', 'fixar' ),
                'section'       => 'fixar_header_settings',
                'settings'      => 'fixar_header_type5_rblock_link',
                'type'          => 'text',
                'priority'   => 12,
                'active_callback' => 'fixar_header_type5_callback',
            )
        );


		$wp_customize->add_setting( 'fixar_header_sidebar_view' , array(
				'default'     => 'fixed',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'fixar_header_sidebar_view',
            array(
                'label'    => esc_html__( 'Sidebar View', 'fixar' ),
                'section'  => 'fixar_header_settings',
                'settings' => 'fixar_header_sidebar_view',
                'type'     => 'select',
                'choices'  => array(
                    'fixed'  => esc_html__( 'Fixed', 'fixar' ),
                    'horizontal' => esc_html__( 'Horizontal Button', 'fixar' ),
		            'vertical' => esc_html__( 'Vertical Button', 'fixar' ),
                ),
                'active_callback' => 'fixar_header_type_callback',
                'priority'   => 20
            )
        );


		$wp_customize->add_setting( 'fixar_header_sticky' , array(
				'default'     => '0',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'fixar_header_sticky',
            array(
                'label'         => esc_html__( 'Behavior', 'fixar' ),
                'section'       => 'fixar_header_settings',
                'settings'      => 'fixar_header_sticky',
                'type'          => 'select',
                'choices'       => array(
                    '0' => esc_html__( 'Default', 'fixar' ),
                    'sticky'  => esc_html__( 'Sticky Top', 'fixar' ),
		            'fixed'  => esc_html__( 'Sticky and Scroll ', 'fixar' ),
                    'scroll'  => esc_html__( 'Sticky Scroll ', 'fixar' ),
                ),
                'priority'   => 30
            )
        );
        
        $wp_customize->add_setting( 'fixar_header_decore' , array(
				'default'     => 'none',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'fixar_header_decore',
            array(
                'label'         => esc_html__( 'Header decore', 'fixar' ),
                'section'       => 'fixar_header_settings',
                'settings'      => 'fixar_header_decore',
                'type'          => 'select',
                'choices'       => array(
                    'none' => esc_html__( 'none', 'fixar' ),
                    'style_1'  => esc_html__( 'Style 1', 'fixar' ),
		            'style_2'  => esc_html__( 'Style 2', 'fixar' ),
                ),
                'priority'   => 30,
                'active_callback' => 'fixar_header_decore_callback',
            )
        );


		$wp_customize->add_setting( 'fixar_header_menu' , array(
				'default'     => '1',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'fixar_header_menu',
            array(
                'label'    => esc_html__( 'Menu', 'fixar' ),
                'section'  => 'fixar_header_settings',
                'settings' => 'fixar_header_menu',
                'type'     => 'select',
                'choices'  => array(
                    '1'  => esc_html__( 'On', 'fixar' ),
                    '0' => esc_html__( 'Off', 'fixar' ),
                ),
                'priority'   => 40
            )
        );


		$wp_customize->add_setting( 'fixar_header_menu_add' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$args = array(
			'taxonomy' => 'nav_menu',
			'hide_empty' => true,
		);
		$menus = get_terms( $args );
		$menus_arr = array();
		$menus_arr[''] = esc_html__( 'Select Menu', 'fixar' );
		foreach ($menus as $key => $value) {
			if(is_object($value)) {
				$menus_arr[$value->term_id] = $value->name;
			}
		}
        $wp_customize->add_control(
            'fixar_header_menu_add',
            array(
                'label'         => esc_html__( 'Additional Menu', 'fixar' ),
                'section'       => 'fixar_header_settings',
                'settings'      => 'fixar_header_menu_add',
                'type'          => 'select',
                'choices'       => $menus_arr,
                'active_callback' => 'fixar_header_type12_callback',
                'priority'   => 50
            )
        );


		$wp_customize->add_setting( 'fixar_header_menu_add_position' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'fixar_header_menu_add_position',
            array(
                'label'    => esc_html__( 'Additional Menu Position', 'fixar' ),
                'section'  => 'fixar_header_settings',
                'settings' => 'fixar_header_menu_add_position',
                'type'     => 'select',
                'choices'  => array(
                    'left'  => esc_html__( 'Left Sidebar', 'fixar' ),
                    'right' => esc_html__( 'Right Sidebar', 'fixar' ),
		            'top' => esc_html__( 'Top Sidebar', 'fixar' ),
		            'bottom'  => esc_html__( 'Bottom Sidebar', 'fixar' ),
                    'screen' => esc_html__( 'Full Screen', 'fixar' ),
                    'fly' => esc_html__( 'Fly Menu', 'fixar' ),
		            'disable' => esc_html__( 'Disabled', 'fixar' ),
                ),
                'active_callback' => 'fixar_header_type12_callback',
                'priority'   => 60
            )
        );


        $wp_customize->add_setting( 'fixar_header_advanced_page' , array(
				'default'     => '0',
				'transport'   => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'fixar_header_advanced_page',
            array(
                'label'    => esc_html__( 'Advanced Options on Page', 'fixar' ),
                'description'   => '',
                'section'  => 'fixar_header_settings',
                'settings' => 'fixar_header_advanced_page',
                'type'     => 'select',
                'choices'  => array(
                    '0' => esc_html__( 'Off', 'fixar' ),
                    '1'  => esc_html__( 'On', 'fixar' ),
                ),
                'priority'   => 70
            )
        );



		/// HEADER STYLE ///

		$wp_customize->add_section( 'fixar_header_settings_style' , array(
		    'title'      => esc_html__( 'Style', 'fixar' ),
		    'priority'   => 10,
			'panel' => 'fixar_header_panel'
		) );


		$wp_customize->add_setting( 'fixar_header_layout' , array(
				'default'     => 'normal',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'fixar_header_layout',
            array(
                'label'    => esc_html__( 'Layout', 'fixar' ),
                'section'  => 'fixar_header_settings_style',
                'settings' => 'fixar_header_layout',
                'type'     => 'select',
                'choices'  => array(
                    'normal'  => esc_html__( 'Normal', 'fixar' ),
                    'boxed' => esc_html__( 'Boxed', 'fixar' ),
		            'full' => esc_html__( 'Full Width', 'fixar' ),
                ),
                'priority'   => 10
            )
        );


		$wp_customize->add_setting( 'fixar_header_background' , array(
				'default'     => 'trans-black',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'fixar_header_background',
            array(
                'label'    => esc_html__( 'Background', 'fixar' ),
                'description'   => esc_html__( 'Background header color', 'fixar' ),
                'section'  => 'fixar_header_settings_style',
                'settings' => 'fixar_header_background',
                'type'     => 'select',
                'choices'  => array(
                    ''  => esc_html__( 'Default', 'fixar' ),
                    'white' => esc_html__( 'White', 'fixar' ),
		            'black' => esc_html__( 'Black', 'fixar' ),
	                'trans-white' => esc_html__( 'Transparent White', 'fixar' ),
		            'trans-black' => esc_html__( 'Transparent Black', 'fixar' ),
                ),
                'priority'   => 20
            )
        );


		$wp_customize->add_setting( 'fixar_header_transparent' , array(
				'default'     => '4',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'fixar_header_transparent',
            array(
                'label'    => esc_html__( 'Transparent', 'fixar' ),
                'section'  => 'fixar_header_settings_style',
                'settings' => 'fixar_header_transparent',
                'type'     => 'select',
                'choices'  => array(
                    '0' => "0.0",
					'1' => "0.1",
					'2' => "0.2",
					'3' => "0.3",
					'4' => "0.4",
					'5' => "0.5",
					'6' => "0.6",
					'7' => "0.7",
					'8' => "0.8",
					'9' => "0.9",
                ),
                'priority'   => 30
            )
        );


        $wp_customize->add_setting( 'fixar_header_menu_animation' , array(
				'default'     => 'overlay',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'fixar_header_menu_animation',
            array(
                'label'         => esc_html__( 'Sidebar Menu Animation', 'fixar' ),
                'description'   => esc_html__( 'Overlay or reveal Sidebar menu animation', 'fixar' ),
                'section'       => 'fixar_header_settings_style',
                'settings'      => 'fixar_header_menu_animation',
                'type'          => 'select',
                'choices'       => array(
                    'overlay' => esc_html__( 'Overlay', 'fixar' ),
                    'reveal'  => esc_html__( 'Reveal', 'fixar' ),
                ),
                'priority'   => 40
            )
        );


		$wp_customize->add_setting( 'fixar_header_hover_effect' , array(
				'default'     => '0',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'fixar_header_hover_effect',
            array(
                'label'    => esc_html__( 'Menu Hover Effect', 'fixar' ),
                'section'  => 'fixar_header_settings_style',
                'settings' => 'fixar_header_hover_effect',
                'type'     => 'select',
                'choices'  => array(
                    '0' => esc_html__( 'Without effect', 'fixar' ),
					'1' => "a",
					'3' => "b",
					'4' => "c",
					'6' => "d",
					'7' => "e",
					'8' => "f",
					'9' => "g",
					'11' => "h",
					'12' => "i",
		            '13' => "j",
					'14' => "k",
		            '17' => "l",
					'18' => "m",
                ),
                'active_callback' => 'fixar_header_menu_callback',
                'priority'   => 50
            )
        );


		$wp_customize->add_setting( 'fixar_header_marker' , array(
				'default'     => 'menu-marker-arrow',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
			'fixar_header_marker',
			array(
				'label'    => esc_html__( 'Menu Markers', 'fixar' ),
				'section'  => 'fixar_header_settings_style',
				'settings' => 'fixar_header_marker',
				'type'     => 'select',
				'choices'  => array(
						'menu-marker-arrow'  => esc_html__( 'Arrows', 'fixar' ),
						'menu-marker-dot' => esc_html__( 'Dots', 'fixar' ),
						'no-marker' => esc_html__( 'Without markers', 'fixar' ),
				),
				'active_callback' => 'fixar_header_menu_callback',
				'priority'   => 60
			)
		);




        /// HEADER ELEMENTS ///

		$wp_customize->add_section( 'fixar_header_settings_elements' , array(
		    'title'      => esc_html__( 'Elements', 'fixar' ),
		    'priority'   => 15,
			'panel' => 'fixar_header_panel'
		) );


		$wp_customize->add_setting( 'fixar_header_bar' , array(
				'default'     => '0',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
			'fixar_header_bar',
			array(
				'label'    => esc_html__( 'Top Bar', 'fixar' ),
				'section'  => 'fixar_header_settings_elements',
				'settings' => 'fixar_header_bar',
				'type'     => 'select',
				'choices'  => array(
						'1'  => esc_html__( 'On', 'fixar' ),
						'0' => esc_html__( 'Off', 'fixar' ),
				),
				'priority'   => 10
			)
		);


		$wp_customize->add_setting( 'fixar_header_minicart' , array(
				'default'     => '1',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'fixar_header_minicart',
            array(
                'label'    => esc_html__( 'Minicart', 'fixar' ),
                'section'  => 'fixar_header_settings_elements',
                'settings' => 'fixar_header_minicart',
                'type'     => 'select',
                'choices'  => array(
                    '1'  => esc_html__( 'On', 'fixar' ),
                    '0' => esc_html__( 'Off', 'fixar' ),
                ),
                'priority'   => 20
            )
        );


		$wp_customize->add_setting( 'fixar_header_search' , array(
				'default'     => '1',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'fixar_header_search',
            array(
                'label'    => esc_html__( 'Search', 'fixar' ),
                'section'  => 'fixar_header_settings_elements',
                'settings' => 'fixar_header_search',
                'type'     => 'select',
                'choices'  => array(
                    '1'  => esc_html__( 'On', 'fixar' ),
                    '0' => esc_html__( 'Off', 'fixar' ),
                ),
                'priority'   => 30
            )
        );


		$wp_customize->add_setting( 'fixar_header_socials' , array(
				'default'     => '1',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'fixar_header_socials',
            array(
                'label'    => esc_html__( 'Socials', 'fixar' ),
                'section'  => 'fixar_header_settings_elements',
                'settings' => 'fixar_header_socials',
                'type'     => 'select',
                'choices'  => array(
                    '1'  => esc_html__( 'On', 'fixar' ),
                    '0' => esc_html__( 'Off', 'fixar' ),
                ),
                'priority'   => 40
            )
        );





		/// HEADER ELEMENTS POSITION ///

		$wp_customize->add_section( 'fixar_header_settings_elements_position' , array(
		    'title'      => esc_html__( 'Elements Position', 'fixar' ),
		    'priority'   => 20,
			'panel' => 'fixar_header_panel'
		) );


		$wp_customize->add_setting( 'fixar_header_topbarbox_1_position' , array(
				'default'     => 'left',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'fixar_header_topbarbox_1_position',
            array(
                'label'    => esc_html__( 'Top Bar Email', 'fixar' ),
                'section'  => 'fixar_header_settings_elements_position',
                'settings' => 'fixar_header_topbarbox_1_position',
                'type'     => 'select',
                'choices'  => array(
                    'left'  => esc_html__( 'Left', 'fixar' ),
                    'right' => esc_html__( 'Right', 'fixar' ),
                ),
                'priority'   => 50
            )
        );

		$wp_customize->add_setting( 'fixar_header_topbarbox_2_position' , array(
				'default'     => 'right',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'fixar_header_topbarbox_2_position',
            array(
                'label'    => esc_html__( 'Top Bar Menu', 'fixar' ),
                'section'  => 'fixar_header_settings_elements_position',
                'settings' => 'fixar_header_topbarbox_2_position',
                'type'     => 'select',
                'choices'  => array(
                    'left'  => esc_html__( 'Left', 'fixar' ),
                    'right' => esc_html__( 'Right', 'fixar' ),
                ),
                'priority'   => 60
            )
        );


		$wp_customize->add_setting( 'fixar_header_navibox_1_position' , array(
				'default'     => 'left',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'fixar_header_navibox_1_position',
            array(
                'label'    => esc_html__( 'Logo', 'fixar' ),
                'section'  => 'fixar_header_settings_elements_position',
                'settings' => 'fixar_header_navibox_1_position',
                'type'     => 'select',
                'choices'  => array(
                    'left'  => esc_html__( 'Left', 'fixar' ),
                    'right' => esc_html__( 'Right', 'fixar' ),
                ),
                'priority'   => 70
            )
        );


		$wp_customize->add_setting( 'fixar_header_navibox_2_position' , array(
				'default'     => 'right',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'fixar_header_navibox_2_position',
            array(
                'label'    => esc_html__( 'Main Menu', 'fixar' ),
                'section'  => 'fixar_header_settings_elements_position',
                'settings' => 'fixar_header_navibox_2_position',
                'type'     => 'select',
                'choices'  => array(
                    'left'  => esc_html__( 'Left', 'fixar' ),
                    'right' => esc_html__( 'Right', 'fixar' ),
                ),
                'priority'   => 80
            )
        );


		$wp_customize->add_setting( 'fixar_header_navibox_3_position' , array(
				'default'     => 'right',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'fixar_header_navibox_3_position',
            array(
                'label'    => esc_html__( 'Socials And Phone', 'fixar' ),
                'section'  => 'fixar_header_settings_elements_position',
                'settings' => 'fixar_header_navibox_3_position',
                'type'     => 'select',
                'choices'  => array(
                    'left'  => esc_html__( 'Left', 'fixar' ),
                    'right' => esc_html__( 'Right', 'fixar' ),
                ),
                'priority'   => 90
            )
        );


		$wp_customize->add_setting( 'fixar_header_navibox_4_position' , array(
				'default'     => 'right',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
            'fixar_header_navibox_4_position',
            array(
                'label'    => esc_html__( 'Minicart', 'fixar' ),
                'section'  => 'fixar_header_settings_elements_position',
                'settings' => 'fixar_header_navibox_4_position',
                'type'     => 'select',
                'choices'  => array(
                    'left'  => esc_html__( 'Left', 'fixar' ),
                    'right' => esc_html__( 'Right', 'fixar' ),
                ),
                'priority'   => 100
            )
        );


		$wp_customize->add_setting( 'fixar_header_adm_bar' , array(
				'default'     => '0',
				'sanitize_callback' => 'sanitize_text_field'
		) );
        $wp_customize->add_control(
            'fixar_header_adm_bar',
            array(
                'label'    => esc_html__( 'Admin Bar Opacity', 'fixar' ),
                'description'   => '',
                'section'  => 'fixar_header_settings_elements_position',
                'settings' => 'fixar_header_adm_bar',
                'type'     => 'select',
                'choices'  => array(
                    '0'  => esc_html__( 'No', 'fixar' ),
                    '1' => esc_html__( 'Yes', 'fixar' ),
                ),
                'priority'   => 110
            )
        );




        /// HEADER INFO ///

		$wp_customize->add_section( 'fixar_header_settings_info' , array(
		    'title'      => esc_html__( 'Phone and email', 'fixar' ),
		    'priority'   => 25,
			'panel' => 'fixar_header_panel'
		) );


		$wp_customize->add_setting( 'fixar_header_phone' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'wp_kses_post'
		) );
		$wp_customize->add_control(
			'fixar_header_phone',
			array(
				'label'    => esc_html__( 'Phone', 'fixar' ),
				'section'  => 'fixar_header_settings_info',
				'settings' => 'fixar_header_phone',
				'type'     => 'text',
				'priority'   => 10
			)
		);


		$wp_customize->add_setting( 'fixar_header_email' , array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'wp_kses_post'
		) );
		$wp_customize->add_control(
			'fixar_header_email',
			array(
				'label'    => esc_html__( 'Email', 'fixar' ),
				'section'  => 'fixar_header_settings_info',
				'settings' => 'fixar_header_email',
				'type'     => 'text',
				'priority'   => 20
			)
		);

		
	}
		
?>