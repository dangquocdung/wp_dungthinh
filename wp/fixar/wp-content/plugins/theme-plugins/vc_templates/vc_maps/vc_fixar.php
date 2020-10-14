<?php

	$args = array( 'hide_empty' => false );
	$categories = get_terms( $args );
	$cats = $cats_woo = $cats_serv = array();
	foreach($categories as $category){
		if( is_object($category) ){
			if( $category->taxonomy == 'portfolio_category' ){
				$cats[$category->name] = $category->slug;
			} 
		}
	}

	$args = array( 'post_type' => 'portfolio');
	$portfolio = get_posts($args);
	$port = array();
	if(empty($portfolio['errors'])){
		foreach($portfolio as $port_card){
			$port[$port_card->post_title] = $port_card->ID;
		}
	}


	$icon_attributes = array(
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"heading" => esc_html__( "Content", 'fixar' ),
			"param_name" => "content",
			"value" => '',
			"description" => '',
		),
	);

	vc_add_params( 'vc_icon', $icon_attributes );


	
	/// fixar_big_title
	vc_map(
		array(
			'name' => esc_html__( 'Big Title', 'fixar' ),
			'base' => 'fixar_big_title',
			'class' => 'pix-fixar-icon',
			'category' => esc_html__( 'Theme Widgets', 'fixar'),
			'params' => array(
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'heading' => esc_html__( 'Title', 'fixar' ),
					'param_name' => 'title',
					'value' => esc_html__( 'I am Title', 'fixar' ),
					'description' => esc_html__( 'Title param.', 'fixar' )
				),

 				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Color', 'fixar' ),
					'param_name' => 'color',
					'value' => '',
					'description' => esc_html__( 'Leave empty to use theme colors.', 'fixar' ),
				),
 
				vc_map_add_css_animation(),
				array(
					'type' => 'checkbox',
					'holder' => 'div',
					'heading' => esc_html__( 'Shuffle', 'fixar' ),
					'param_name' => 'shuffle',
					'value' =>  'shuffle'   ,
					'description' => esc_html__( 'Enable shuffle effect.', 'fixar' )
				)
			)
		)
	);

	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_fixar_Big_Title extends WPBakeryShortCode {

		}
	}
	
	

	/// fixar_icon_card
	vc_map(
		array(
			'name' => esc_html__( 'Icon Card', 'fixar' ),
			'base' => 'fixar_icon_card',
			'class' => 'pix-fixar-icon',
			'category' => esc_html__( 'Theme Widgets', 'fixar'),
			'params' => array_merge(
				array(
					array(
						'type' => 'textfield',
						'holder' => 'div',
						'heading' => esc_html__( 'Title', 'fixar' ),
						'param_name' => 'title',
						'value' => esc_html__( 'I am title', 'fixar' ),
						'description' => esc_html__( 'Add Title ', 'fixar' )
					),
					array(
						'type' => 'textfield',
						'holder' => 'div',
						'heading' => esc_html__( 'Subtitle', 'fixar' ),
						'param_name' => 'subtitle',
						'value' => '',
						'description' => ''
					),
				),
				fixar_get_vc_icons($vc_icons_data),
				array(
					array(
						'type' => 'vc_link',
						'holder' => 'div',
						'heading' => esc_html__( 'Button Link', 'fixar' ),
						'param_name' => 'link',
						'value' => '',
						'description' =>''
					),
					array(
						'type' => 'textfield',
						'holder' => 'div',
						'heading' => esc_html__( 'Button Text', 'fixar' ),
						'param_name' => 'btn_text',
						'value' => '',
						'description' => '',
					),
					array(
						'type' => 'textarea_html',
						'holder' => 'div',
						'heading' => esc_html__( 'Content', 'fixar' ),
						'param_name' => 'content',
						'value' => wp_kses_post(__( '<p>I am test text block. Click edit button to change this text.</p>', 'fixar' )),
						'description' => esc_html__( 'Enter your content.', 'fixar' )
					),
				)
			)
		)
	);
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_fixar_Icon_Card extends WPBakeryShortCode {

		}
	}


	/// fixar_flip_box
	vc_map(
		array(
			'name' => esc_html__( 'Flip Box', 'fixar' ),
			'base' => 'fixar_flip_box',
			'class' => 'pix-fixar-icon',
			'category' => esc_html__( 'Theme Widgets', 'fixar'),
			'params' => array_merge( 
				array(
					array(
						'type' => 'textfield',
						'holder' => 'div',
						'heading' => esc_html__( 'Title', 'fixar' ),
						'param_name' => 'title',
						'value' => esc_html__( 'I am title', 'fixar' ),
						'description' => esc_html__( 'Add Title ', 'fixar' )
					),
					array(
						'type' => 'textfield',
						'holder' => 'div',
						'heading' => esc_html__( 'Subtitle', 'fixar' ),
						'param_name' => 'subtitle',
						'value' => '',
						'description' => esc_html__( 'Text under title.', 'fixar' )
					),
				),
				fixar_get_vc_icons($vc_icons_data),	
				array(
					array(
						'type' => 'textarea_html',
						'holder' => 'div',
						'heading' => esc_html__( 'Content', 'fixar' ),
						'param_name' => 'content',
						'value' => wp_kses_post(__( '<p>I am test text block. Click edit button to change this text.</p>', 'fixar' )),
						'description' => esc_html__( 'Enter your content.', 'fixar' )
					)	
				)
			)	
		)
	);
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_fixar_Flip_Box extends WPBakeryShortCode {

		}
	}


	

	////////////////////////
		

		/// fixar_video_box
	vc_map(
		array(
			'name' => esc_html__( 'Video Box', 'fixar' ),
			'base' => 'fixar_video',
			'class' => 'pix-fixar-icon',
			'category' => esc_html__( 'Theme Widgets', 'fixar'),
			'params' => array(
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Title Left', 'fixar' ),
					'param_name' => 'title',
					'value' => esc_html__( 'I am Title', 'fixar' ),
					'description' => esc_html__( 'Title param.', 'fixar' )
				),
 
 			array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Title Right', 'fixar' ),
					'param_name' => 'title2',
					'value' => esc_html__( 'I am Title', 'fixar' ),
					'description' => esc_html__( 'Title param.', 'fixar' )
				),
 
				vc_map_add_css_animation(),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Youtube ID', 'fixar' ),
					'param_name' => 'youtube',
					'value' => 'qEJ4spdiTxw',
					'description' => esc_html__( 'Enter youtube video id.', 'fixar' )
				)
			)
		)
	);

	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_fixar_Video extends WPBakeryShortCode {

		}
	}



	$args = array( 'post_type' => 'wpcf7_contact_form');
	$forms = get_posts($args);
	$cform7 = array('Select Form' => '');
	if(empty($forms['errors'])){
		foreach($forms as $form){
			$cform7[$form->post_title] = $form->ID;
		}
	}


	if(function_exists('kaswara_cf7_forms')) {
		$cf_array = array(
			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'heading' => esc_html__( 'Contact Form 7', 'fixar' ),
				'param_name' => 'cf',
				'value' => $cform7,
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Select CF7 Style', 'fixar'),
				'param_name' => 'cf7_style',
				'value' => kaswara_cf7_styles()
			),
		);
	} else {
		$cf_array = array(
			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'heading' => esc_html__( 'Contact Form 7', 'fixar' ),
				'param_name' => 'cf',
				'value' => $cform7,
			),
		);
	}
	/// fixar_contact
	vc_map(
		array(
			'name' => esc_html__( 'Contact', 'fixar' ),
			'base' => 'fixar_contact',
			'class' => 'pix-fixar-icon',
			'category' => esc_html__( 'Theme Widgets', 'fixar'),
			'params' => array_merge( $cf_array,
				array(
					array(
						'type' => 'attach_image',
						'heading' => esc_html__( 'Marker Image', 'fixar' ),
						'param_name' => 'image',
						'value' => '',
						'description' => esc_html__( 'Select image from media library.', 'fixar' )
					),
					array(
						'type' => 'textfield',
						'holder' => 'div',
						'heading' => esc_html__( 'LAT', 'fixar' ),
						'param_name' => 'lat',
						'value' => '40.6700',
						'description' => esc_html__( 'Latitude', 'fixar' )
					),
					array(
						'type' => 'textfield',
						'holder' => 'div',
						'heading' => esc_html__( 'LNG', 'fixar' ),
						'param_name' => 'lng',
						'value' => '-73.9400',
						'description' => esc_html__( 'Longtitude', 'fixar' )
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"heading" => esc_html__( "Map Width", 'fixar' ),
						"param_name" => "width",
						"value" => '',
						"description" => esc_html__( "Default 100%", 'fixar' )
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"heading" => esc_html__( "Map Height", 'fixar' ),
						"param_name" => "height",
						"value" => '',
						"description" => esc_html__( "Default 100%", 'fixar' )
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"heading" => esc_html__( "Zoom", 'fixar' ),
						"param_name" => "zoom",
						"value" => '',
						"description" => esc_html__( "Zoom 0-20. Default 8.", 'fixar' )
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__( "Scroll Wheel", 'fixar' ),
						"param_name" => "scrollwheel",
						'value' => array(
							esc_html__( "Off", 'fixar' ) => 'false',
							esc_html__( "On", 'fixar' ) => 'true',
						),
						"description" => esc_html__( "Zoom map with scroll", 'fixar' )
					),
				)
			)
		)
	);

	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_fixar_Contact extends WPBakeryShortCode {

		}
	}	

	/// fixar_services3
	vc_map(
		array(
			'name' => esc_html__( 'Threebox ', 'fixar' ),
			'base' => 'fixar_service3',
			'class' => 'pix-fixar-icon',
			'category' => esc_html__( 'Theme Widgets', 'fixar'),
			'params' => array(
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Title 1', 'fixar' ),
					'param_name' => 'title1',
					'value' => esc_html__( 'Title1', 'fixar' ),
					'description' => esc_html__( 'Title', 'fixar' )
				),
 
 			array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Icon 1', 'fixar' ),
					'param_name' => 'icon1',
					'value' => '',
					'description' => esc_html__( 'Icon', 'fixar' )
				),
			 array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Text 1', 'fixar' ),
					'param_name' => 'text1',
					'value' => '',
					'description' => esc_html__( 'Text', 'fixar' )
				),
			array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Title 2', 'fixar' ),
					'param_name' => 'title2',
					'value' => esc_html__( 'Title1', 'fixar' ),
					'description' => esc_html__( 'Title', 'fixar' )
				),
 
 			array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Icon 2', 'fixar' ),
					'param_name' => 'icon2',
					'value' => '',
					'description' => esc_html__( 'Icon', 'fixar' )
				),
			 array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Text 2', 'fixar' ),
					'param_name' => 'text2',
					'value' => '',
					'description' => esc_html__( 'Text', 'fixar' )
				),
			array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Title 3', 'fixar' ),
					'param_name' => 'title3',
					'value' => esc_html__( 'Title3', 'fixar' ),
					'description' => esc_html__( 'Title', 'fixar' )
				),
 			array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Link', 'fixar' ),
					'param_name' => 'link',
					'value' => '',
					'description' => esc_html__( 'Link', 'fixar' )
				),
 			array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Icon 3', 'fixar' ),
					'param_name' => 'icon3',
					'value' => '',
					'description' => esc_html__( 'Icon', 'fixar' )
				),
			 array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Text 3', 'fixar' ),
					'param_name' => 'text3',
					'value' => '',
					'description' => esc_html__( 'Text', 'fixar' )
				),				 			 
				vc_map_add_css_animation(),
		 
			)
		)
	);

	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_fixar_Service3 extends WPBakeryShortCode {

		}
	}	
	
	/// fixar_departaments
	vc_map(
		array(
			'name' => esc_html__( 'Departments Slider', 'fixar' ),
			'base' => 'fixar_departaments',
			'class' => 'pix-fixar-icon',
			'category' => esc_html__( 'Theme Widgets', 'fixar'),
			'params' => array(
			 	array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Ids', 'fixar' ),
					'param_name' => 'ids',
					'value' => '',
					'description' => esc_html__( 'Separate by comma.', 'fixar' )
				),		 			 
				vc_map_add_css_animation(),
		 
			)
		)
	);

	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_fixar_Departaments extends WPBakeryShortCode {

		}
	}	


	/// fixar_departaments
	vc_map(
		array(
			'name' => esc_html__( 'Threesteps', 'fixar' ),
			'base' => 'fixar_steps',
			'class' => 'pix-fixar-icon',
			'category' => esc_html__( 'Theme Widgets', 'fixar'),
			'params' => array(
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Title 1', 'fixar' ),
					'param_name' => 'title1',
					'value' => esc_html__( 'Title1', 'fixar' ),
					'description' => esc_html__( 'Title', 'fixar' )
				),
 
 				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Icon 1', 'fixar' ),
					'param_name' => 'icon1',
					'value' => '',
					'description' => esc_html__( 'Icon', 'fixar' )
				),
			 	array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Text 1', 'fixar' ),
					'param_name' => 'text1',
					'value' => '',
					'description' => esc_html__( 'Text', 'fixar' )
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Title 2', 'fixar' ),
					'param_name' => 'title2',
					'value' => esc_html__( 'Title1', 'fixar' ),
					'description' => esc_html__( 'Title', 'fixar' )
				),
 
 				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Icon 2', 'fixar' ),
					'param_name' => 'icon2',
					'value' => '',
					'description' => esc_html__( 'Icon', 'fixar' )
				),
			 	array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Text 2', 'fixar' ),
					'param_name' => 'text2',
					'value' => '',
					'description' => esc_html__( 'Text', 'fixar' )
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Title 3', 'fixar' ),
					'param_name' => 'title3',
					'value' => esc_html__( 'Title3', 'fixar' ),
					'description' => esc_html__( 'Title', 'fixar' )
				),
 
 				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Icon 3', 'fixar' ),
					'param_name' => 'icon3',
					'value' => '',
					'description' => esc_html__( 'Icon', 'fixar' )
				),
			 	array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Text 3', 'fixar' ),
					'param_name' => 'text3',
					'value' => '',
					'description' => esc_html__( 'Text', 'fixar' )
				),				 			 
				//vc_map_add_css_animation(),
		 
			)
		)
	);

	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_fixar_Steps extends WPBakeryShortCode {

		}
	}		
		
	






	/// box_teammember
	vc_map( array(
		"name" => esc_html__( "Team Member Box", 'fixar' ),
		"base" => "fixar_teammember_box",
		"class" => "pix-fixar-icon",
		"category" => esc_html__( "Theme Widgets", 'fixar'),
		'params' => array(
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Image', 'fixar' ),
				'param_name' => 'image',
				'description' => esc_html__( 'Select image.', 'fixar' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Name', 'fixar' ),
				'param_name' => 'name',
				'description' => esc_html__( 'Team member name.', 'fixar' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Position', 'fixar' ),
				'param_name' => 'position',
				'description' => esc_html__( 'Member position.', 'fixar' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Link 1', 'fixar' ),
				'param_name' => 'scn1',
				'description' => esc_html__( 'https://www.facebook.com/', 'fixar' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Network Icon 1', 'fixar' ),
				'param_name' => 'scn_icon1',
				'description' => wp_kses_post(__( 'Add icon fa-facebook <a href="//fortawesome.github.io/Font-Awesome/icons/" target="_blank">See all icons</a>', 'fixar' )),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Link 2', 'fixar' ),
				'param_name' => 'scn2',
				'description' => esc_html__( 'https://twitter.com/', 'fixar' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Network Icon 2', 'fixar' ),
				'param_name' => 'scn_icon2',
				'description' => wp_kses_post(__( 'Add icon fa-twitter <a href="//fortawesome.github.io/Font-Awesome/icons/" target="_blank">See all icons</a>', 'fixar' )),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Link 3', 'fixar' ),
				'param_name' => 'scn3',
				'description' => esc_html__( 'https://plus.google.com/', 'fixar' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Network Icon 3', 'fixar' ),
				'param_name' => 'scn_icon3',
				'description' => wp_kses_post(__( 'Add icon fa-google-plus <a href="//fortawesome.github.io/Font-Awesome/icons/" target="_blank">See all icons</a>', 'fixar' ))
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Link 4', 'fixar' ),
				'param_name' => 'scn4',
				'description' => esc_html__( '//www.w3.org/TR/html5/', 'fixar' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Network Icon 4', 'fixar' ),
				'param_name' => 'scn_icon4',
				'description' => wp_kses_post(__( 'Add icon fa-html5 <a href="//fortawesome.github.io/Font-Awesome/icons/" target="_blank">See all icons</a>', 'fixar' ))
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Link 5', 'fixar' ),
				'param_name' => 'scn5',
				'description' => esc_html__( 'https://github.com/', 'fixar' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Network Icon 5', 'fixar' ),
				'param_name' => 'scn_icon5',
				'description' => wp_kses_post(__( 'Add icon fa-github <a href="//fortawesome.github.io/Font-Awesome/icons/" target="_blank">See all icons</a>', 'fixar' ))
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Link 6', 'fixar' ),
				'param_name' => 'scn6',
				'description' => esc_html__( 'https://github.com/', 'fixar' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Network Icon 6', 'fixar' ),
				'param_name' => 'scn_icon6',
				'description' => esc_html__( 'Add icon fa-github <a href="//fortawesome.github.io/Font-Awesome/icons/" target="_blank">See all icons</a>', 'fixar' )
			),
			vc_map_add_css_animation(),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Info", 'fixar' ),
				"param_name" => "content",
				"value" => wp_kses_post(__( "<p>I am test text block. Click edit button to change this text.</p>", 'fixar' )),
				"description" => esc_html__( "Enter information.", 'fixar' )
			),
		)
	) );
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_fixar_Teammember_Box extends WPBakeryShortCode {
		}
	}
	////////////////////////


	/// fixar_imagescarousel
	vc_map(
		array(
			"name" => esc_html__( "Images Carousel", 'fixar' ),
			"base" => "fixar_imagescarousel",
			"class" => "pix-fixar-icon",
			"category" => esc_html__( "Theme Widgets", 'fixar'),
			"params" => array(
				array(
					'type' => 'attach_images',
					'heading' => esc_html__( 'Images', 'fixar' ),
					'param_name' => 'images',
					'value' => '',
					'description' => esc_html__( 'Select images from media library.', 'fixar' )
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Image size', 'fixar' ),
					'param_name' => 'img_size',
					'value' => 'thumbnail',
					'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size. If used slides per view, this will be used to define carousel wrapper size.', 'fixar' ),
				),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Desktop Items Count', 'fixar' ),
                    'param_name' => 'itemscount',
                    'value' => '4',
                    'description' => esc_html__( 'Enter desktop items count', 'fixar' ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Mobile Items Count', 'fixar' ),
                    'param_name' => 'ritemcount',
                    'value' => '2',
                    'description' => esc_html__( 'Enter mobile items count', 'fixar' ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__( 'Enable pagination', 'fixar' ),
                    'param_name' => 'pagination',
                    'value' => array(
                        esc_html__( "Yes", 'fixar' ) => 'true',
                        esc_html__( "No", 'fixar' ) => 'false',
                    ),
                    'description' => esc_html__( 'Enable or disable pagination', 'fixar' ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__( 'Enable navigation', 'fixar' ),
                    'param_name' => 'navigation',
                    'value' => array(
                        esc_html__( "Yes", 'fixar' ) => 'true',
                        esc_html__( "No", 'fixar' ) => 'false',
                    ),
                    'description' => esc_html__( 'Enable or disable pagination', 'fixar' ),
                ),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Auto Play', 'fixar' ),
					'param_name' => 'autoplay',
					'value' => '4000',
					'description' => esc_html__( 'Enter autoplay speed in milliseconds. 0 is turn off autoplay.', 'fixar' ),
				),

				vc_map_add_css_animation(),
			)
		)
	);
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_fixar_Imagescarousel extends WPBakeryShortCode {

		}
	}

	/// section_laptop
	vc_map(
		array(
			"name" => esc_html__( "Laptop Images Carousel", 'fixar' ),
			"base" => "fixar_laptop",
			"class" => "pix-fixar-icon",
			"category" => esc_html__( "Theme Widgets", 'fixar'),
			"params" => array(
				array(
					'type' => 'attach_images',
					'heading' => esc_html__( 'Images', 'fixar' ),
					'param_name' => 'images',
					'value' => '',
					'description' => esc_html__( 'Select images from media library.', 'fixar' )
				),
				 
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'More Works Link', 'fixar' ),
					'param_name' => 'link',
					'value' => '4000',
					'description' => esc_html__( 'Enter link for more works page', 'fixar' ),
				),
				vc_map_add_css_animation(),
			)
		) 
	);
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_fixar_Laptop extends WPBakeryShortCode {
			
		}
	}



	/// fixar_tabs_vertical
	vc_map( array(
		'name' => esc_html__( 'Vertical Content Tabs ', 'fixar' ),
		'base' => 'fixar_tabs_vertical',
		'class' => 'pix-fixar-icon',
		'category' => esc_html__( 'Theme Widgets', 'fixar'),
		'params' => array(
			array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Tab Values', 'fixar' ),
				'param_name' => 'tabs',
				'params' => array_merge(
					array(
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Title', 'fixar' ),
							'param_name' => 'title',
							'description' => esc_html__( 'Tab title.', 'fixar' )
						),
						array(
							'type' => 'attach_image',
							'heading' => esc_html__( 'Image', 'fixar' ),
							'param_name' => 'image',
							'value' => '',
							'description' => esc_html__( 'Select image from media library.', 'fixar' )
						),
					),
					fixar_get_vc_icons($vc_icons_data),
					array(
						array(
							'type' => 'textarea',
							'holder' => 'div',
							'heading' => esc_html__( 'Content', 'fixar' ),
							'param_name' => 'content',
							'value' => wp_kses_post(__( '<p>I am test text block. Click edit button to change this text.</p>', 'fixar' )),
							'description' => esc_html__( 'Enter your content.', 'fixar' )
						),
					)
				),
			),
		),
	) );
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_fixar_Tabs_Vertical extends WPBakeryShortCode {
		}
	}
	//////////////////////////////////


	/// fixar_anchor
	vc_map( array(
		'name' => esc_html__( 'Anchor Link', 'fixar' ),
		'base' => 'fixar_anchor',
		'class' => 'pix-fixar-icon',
		'category' => esc_html__( 'Theme Widgets', 'fixar'),
		'params' => array_merge(
			array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title', 'fixar' ),
					'param_name' => 'title',
					'description' => esc_html__( 'Tab title.', 'fixar' )
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Anchor', 'fixar' ),
					'param_name' => 'anchor',
					'value' => '',
					'description' => esc_html__( 'Anchor for section', 'fixar' )
				),
			),
			fixar_get_vc_icons($vc_icons_data)
		),
	) );
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_fixar_Anchor extends WPBakeryShortCode {
		}
	}
	//////////////////////////////////

    //////// Content  Container /////////
    vc_map(
        array(
            "name" => esc_html__( "Content  Container", 'fixar' ),
            "base" => "fixar_content_container",
            "class" => "pix-fixar-icon",
            "category" => esc_html__( "Theme Widgets", 'fixar'),
            "content_element" => true,
            "show_settings_on_create" => true,
            'as_parent' => array('except' => 'fixar_content_container'),
            "js_view" => 'VcColumnView',
            'params' => array(
                array(
                    'type' => 'dropdown',
                    'heading' => "Style",
                    'param_name' => 'style',
                    'value' => array(
                        esc_html__( "Default", 'fixar' ) => 'default',
                        esc_html__( "Shadow", 'fixar' ) => 'shadow',
                    ),
                    'description' => esc_html__( "Style of content", 'fixar' ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => "Container position",
                    'param_name' => 'position',
                    'value' => array(
                        esc_html__( "Left", 'fixar' ) => 'left',
                        esc_html__( "Right", 'fixar' ) => 'right',
                        esc_html__( "Center", 'fixar' ) => 'center'
                    ),
                    'description' => esc_html__( "Style of content", 'fixar' ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => "Container Width",
                    'param_name' => 'cwidth',
                    'value' => '100%',
                    'description' => esc_html__( "Enter container width eg. ( 100px or  70% )", 'fixar' ),
                ),
				array(
                    'type' => 'textfield',
                    'heading' => "Box Width",
                    'param_name' => 'width',
                    'value' => '100%',
                    'description' => esc_html__( "Enter box width eg. ( 100px or  70% )", 'fixar' ),
                ),
				array(
                    'type' => 'textfield',
                    'heading' => "Box height",
                    'param_name' => 'height',
                    'value' => '100%',
                    'description' => esc_html__( "Enter box height eg. ( 100px or  70% )", 'fixar' ),
                ),
                array(
                    'type' => 'css_editor',
                    'heading' => __( 'CSS box', 'fixar' ),
                    'param_name' => 'css',
                    'group' => __( 'Design Options', 'fixar' ),
                )
            )
        )
    );
    if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
        class WPBakeryShortCode_fixar_Content_Container extends WPBakeryShortCodesContainer {
        }
    }
    /////////////////////////////////

	//////// Carousel Reviews ////////
	vc_map( array(
		'name' => esc_html__( 'Reviews', 'fixar' ),
		'base' => 'fixar_reviews',
		'class' => 'pix-fixar-icon pix-theme-icon_info',
		'category' => esc_html__( 'Theme Widgets', 'fixar'),
		'params' => array(
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Display Type', 'fixar' ),
				'param_name' => 'type',
				'value' => array(
					esc_html__('Double', 'fixar') => 'double',
					esc_html__('Single', 'fixar') => 'single',
				),
				'description' => ''
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Carousel', 'fixar' ),
				'param_name' => 'carousel',
				'value' => array(
					esc_html__('Enable', 'fixar') => 1,
					esc_html__('Disable', 'fixar') => 0,
				),
				'description' => esc_html__( 'On/off carousel', 'fixar' ),
				'dependency' => array(
					'element' => 'type',
					'value' => 'double',
				),
			),
			array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Reviews', 'fixar' ),
				'param_name' => 'reviews_d',
				'params' => array(
					array(
						'type' => 'attach_image',
						'heading' => esc_html__( 'Image', 'fixar' ),
						'param_name' => 'image_d',
						'description' => esc_html__( 'Select image.', 'fixar' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Name', 'fixar' ),
						'param_name' => 'name_d',
						'description' => esc_html__( 'Person name.', 'fixar' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Position', 'fixar' ),
						'param_name' => 'position',
						'description' => esc_html__( 'Text under the name.', 'fixar' ),
					),
					array(
						'type' => 'vc_link',
						'heading' => esc_html__( 'Link', 'fixar' ),
						'param_name' => 'link',
						'description' => esc_html__( 'Author link', 'fixar' )
					),
					array(
						"type" => "textarea",
						"holder" => "div",
						"heading" => esc_html__( "Review Text", 'fixar' ),
						"param_name" => "content_d",
						"value" => wp_kses_post(__( "<p>I am test text block. Click edit button to change this text.</p>", 'fixar' )),
						"description" => esc_html__( "Enter text.", 'fixar' )
					),
				),
				'dependency' => array(
					'element' => 'type',
					'value' => 'double',
				),
			),
			array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Reviews', 'fixar' ),
				'param_name' => 'reviews_s',
				'params' => array(
					array(
						'type' => 'attach_image',
						'heading' => esc_html__( 'Image', 'fixar' ),
						'param_name' => 'image_s',
						'description' => esc_html__( 'Select image.', 'fixar' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Name', 'fixar' ),
						'param_name' => 'name_s',
						'description' => esc_html__( 'Person name.', 'fixar' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Title', 'fixar' ),
						'param_name' => 'title',
						'description' => esc_html__( 'Review title', 'fixar' ),
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"heading" => esc_html__( "Rating", 'fixar' ),
						"param_name" => "rating",
						'value' => array('5', '4', '3', '2', '1', ''),
						"description" => '',
					),
					array(
						"type" => "textarea",
						"holder" => "div",
						"heading" => esc_html__( "Review Text", 'fixar' ),
						"param_name" => "content_s",
						"value" => esc_html__( "I am test text block. Click edit button to change this text.", 'fixar' ),
						"description" => esc_html__( "Enter text.", 'fixar' )
					),
				),
				'dependency' => array(
					'element' => 'type',
					'value' => 'single',
				),
			)
		),


	) );
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_fixar_Reviews extends WPBakeryShortCode {
		}
	}


		
	// fixar_amount_box
	$params1 = array(
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Title', 'fixar' ),
					'param_name' => 'title',
					'value' => esc_html__( 'Completed projects', 'fixar' ),
					'description' => esc_html__( 'Title.', 'fixar' )
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Amount', 'fixar' ),
					'param_name' => 'amount',
					'value' => esc_html__( '25', 'fixar' ),
					'description' => esc_html__( 'Amount.', 'fixar' )
				),
				array(
					'type' => 'textarea_html',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Text', 'fixar' ),
					'param_name' => 'text',
					'value' => esc_html__( 'Pellentesque eget quam vel velit mollis	tempus a nec mauris.', 'fixar' ),
					'description' => esc_html__( 'Text.', 'fixar' )
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Icon', 'fixar' ),
					'param_name' => 'icon',
					'value' => esc_html__( 'arrow_move', 'fixar' ),
					'description' => esc_html__( 'Icon.', 'fixar' )
				),
			);
		$params2 = array(
				vc_map_add_css_animation(),
			);
	 
		$params = array_merge($params1, $params2);
	 
	vc_map(
		array(
			'name' => esc_html__( 'Amount Box', 'fixar' ),
			'base' => 'fixar_amount_box',
			'class' => 'pix-fixar-icon',
			'category' => esc_html__( 'Theme Widgets', 'fixar'),
			'params' => $params,
		)
	);
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_fixar_Amount_Box extends WPBakeryShortCode {

		}
	}

	// fixar_amount_single
	$params1 = array(
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Title', 'fixar' ),
					'param_name' => 'title',
					'value' => esc_html__( 'Completed projects', 'fixar' ),
					'description' => esc_html__( 'Title.', 'fixar' )
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Amount', 'fixar' ),
					'param_name' => 'amount',
					'value' => esc_html__( '25', 'fixar' ),
					'description' => esc_html__( 'Amount.', 'fixar' )
				),
				array(
					'type' => 'textarea_html',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Text', 'fixar' ),
					'param_name' => 'text',
					'value' => esc_html__( '', 'fixar' ),
					'description' => esc_html__( 'Text.', 'fixar' )
				),
			);
		
	 
		$params = array_merge($params1);
	 
	vc_map(
		array(
			'name' => esc_html__( 'Amount Single', 'fixar' ),
			'base' => 'fixar_amount_single',
			'class' => 'pix-fixar-icon',
			'category' => esc_html__( 'Theme Widgets', 'fixar'),
			'params' => $params,
		)
	);
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_fixar_Amount_Single extends WPBakeryShortCode {

		}
	} 




	/////////////////////////////////

	//////// Carousel Reviews ////////
	vc_map( array(
		'name' => esc_html__( 'Smart Tabs', 'fixar' ),
		'base' => 'fixar_tab_links',
		'class' => 'pix-fixar-icon',
		'show_settings_on_create' => true,
		'category' => esc_html__( 'Theme Widgets', 'fixar'),
		'params' => array(
			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'heading' => esc_html__( 'Links or Content', 'fixar' ),
				'param_name' => 'type',
				'value' => array(
					esc_html__('Links', 'fixar') => 'links',
					esc_html__('Content', 'fixar') => 'contents',
				),
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => esc_html__( 'Title', 'fixar' ),
				'param_name' => 'title',
				'description' => esc_html__( 'Can be empty.', 'fixar' ),
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => esc_html__( 'ID', 'fixar' ),
				'param_name' => 'tab_id',
				'description' => esc_html__( 'Necessary for container item.', 'fixar' ),
			),
			array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Links', 'fixar' ),
				'param_name' => 'tab_links',
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Tab Title', 'fixar' ),
						'param_name' => 'tab_title',
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Active on Load', 'fixar' ),
						'param_name' => 'active',
						'value' => array(
							esc_html__('No', 'fixar') => '',
							esc_html__('Yes', 'fixar') => 'active',
						),
					),
					array(
						'type' => 'textfield',
						'holder' => 'div',
						'heading' => esc_html__( 'Content ID', 'fixar' ),
						'param_name' => 'content_id',
						'description' => esc_html__( 'Link to Content ID', 'fixar' )
					),
				),
				'dependency' => array(
					'element' => 'type',
					'value' => 'links'
				)
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Active on Load', 'fixar' ),
				'param_name' => 'active_content',
				'value' => array(
					esc_html__('No', 'fixar') => '',
					esc_html__('Yes', 'fixar') => 'active',
				),
				'dependency' => array(
					'element' => 'type',
					'value' => 'contents'
				)
			),
			array(
				'type' => 'textarea_html',
				'heading' => esc_html__( 'Content', 'fixar' ),
				'param_name' => 'content',
				'value' => wp_kses_post(__( '<p>I am test text block. Click edit button to change this text.</p>', 'fixar' )),
				'description' => esc_html__( 'Enter text.', 'fixar' ),
				'dependency' => array(
					'element' => 'type',
					'value' => 'contents'
				)
			),
		)

	) );
	vc_map( array(
		'name' => esc_html__( 'Smart Tabs Content', 'fixar' ),
		'base' => 'fixar_tab_content',
		'class' => 'pix-fixar-icon',
		'as_parent' => array('only' => 'fixar_tab_links'),
		'content_element' => true,
		'category' => esc_html__( 'Theme Widgets', 'fixar'),
		'front_enqueue_js' => get_template_directory_uri() . '/library/functions/shortcodes/shortcode.js',
		'params' => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => esc_html__( 'Title', 'fixar' ),
				'param_name' => 'content_title',
			),
		),
		'js_view' => 'VcColumnView',
	) );
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_fixar_Tab_Content extends WPBakeryShortCodesContainer {
		}
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_fixar_Tab_Links extends WPBakeryShortCode {
		}
	}
	///////////////////////////////
	

	//////// Carousel History ////////
	vc_map( array(
		'name' => esc_html__( 'History', 'fixar' ),
		'base' => 'fixar_history',
		'class' => 'pix-fixar-icon',
		'category' => esc_html__( 'Theme Widgets', 'fixar'),
		'params' => array(
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Type', 'fixar' ),
				'param_name' => 'type',
				'value' => array(
					esc_html__('Horizontal', 'fixar') => 'horizontal',
					esc_html__('Vertical', 'fixar') => 'vertical',
				),
				'description' => ''
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'History blocks per page', 'fixar' ),
				'param_name' => 'count',
				'value' => '3',
				'description' => esc_html__( 'If empty, display all blocks', 'fixar' ),
				'dependency' => array(
					'element' => 'type',
					'value' => 'vertical'
				)
			),
		 	array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Moments', 'fixar' ),
				'param_name' => 'moments_h',
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Title', 'fixar' ),
						'param_name' => 'title_h',
						'description' => esc_html__( 'Review title', 'fixar' )
					),
					array(
						'type' => 'textfield',
						'holder' => 'div',
						'heading' => esc_html__( 'Date', 'fixar' ),
						'param_name' => 'd_h',
						'value' =>   '25 MAY, 2017',
						'description' => ''
					),
					array(
						'type' => 'textarea',
						'holder' => 'div',
						'heading' => esc_html__( 'Text', 'fixar' ),
						'param_name' => 'content_h',
						'value' => wp_kses_post(__( '<p>I am test text block. Click edit button to change this text.</p>', 'fixar' )),
						'description' => esc_html__( 'Enter text', 'fixar' )
					),
				),
				'dependency' => array(
					'element' => 'type',
					'value' => 'horizontal'
				)
			),
			array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Moments', 'fixar' ),
				'param_name' => 'moments_v',
				'params' => array(
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Position On Timeline', 'fixar' ),
						'param_name' => 'position',
						'value' => array(
							esc_html__('Left', 'fixar') => 'left',
							esc_html__('Right', 'fixar') => 'right',
						),
						'description' => esc_html__( 'Left/right position on timeline', 'fixar' ),
					),
					array(
						'type' => 'attach_image',
						'heading' => esc_html__( 'Image', 'fixar' ),
						'param_name' => 'image',
						'description' => esc_html__( 'Select image.', 'fixar' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Title', 'fixar' ),
						'param_name' => 'title_v',
						'description' => esc_html__( 'Review title', 'fixar' )
					),
					array(
						'type' => 'textfield',
						'holder' => 'div',
						'heading' => esc_html__( 'Date', 'fixar' ),
						'param_name' => 'd_v',
						'value' =>   '25 MAY, 2017',
						'description' => ''
					),
					array(
						'type' => 'textarea',
						'holder' => 'div',
						'heading' => esc_html__( 'Text', 'fixar' ),
						'param_name' => 'content_v',
						'value' => wp_kses_post(__( '<p>I am test text block. Click edit button to change this text.</p>', 'fixar' )),
						'description' => esc_html__( 'Enter text', 'fixar' )
					),
				),
				'dependency' => array(
					'element' => 'type',
					'value' => 'vertical'
				)
			),
		),
	) );
	vc_map( array(
		'name' => esc_html__( 'Date', 'fixar' ),
		'base' => 'fixar_date',
		'class' => 'pix-fixar-icon',
		'as_child' => array('only' => 'fixar_dates'),
		'content_element' => true,
		'front_enqueue_js' => get_template_directory_uri() . '/library/functions/shortcodes/shortcode.js',
		'params' => array(
 
 
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title', 'fixar' ),
				'param_name' => 'title',
				'description' => esc_html__( 'Review title', 'fixar' )
			),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"heading" => esc_html__( "Text", 'fixar' ),
				"param_name" => "content",
				"value" => wp_kses_post(__( "<p>I am test text block. Click edit button to change this text.</p>", 'fixar' )),
				"description" => esc_html__( "Enter text.", 'fixar' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"heading" => esc_html__( "Date", 'fixar' ),
				"param_name" => "d",
				"value" =>   '25 MAY, 2017',
				"description" => esc_html__( "date", 'fixar' )
			),
		)
	) );
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_fixar_History extends WPBakeryShortCode {
		}
	}
	/////////////////////////////////	
	



	vc_map( array(
		'name' => esc_html__( 'My Services', 'fixar' ),
		'base' => 'fixar_service',
		'class' => 'pix-fixar-icon',
		'as_child' => array('only' => 'fixar_services'),
		'content_element' => true,
		'front_enqueue_js' => get_template_directory_uri() . '/library/functions/shortcodes/shortcode.js',
		'params' => array(
 
 
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title text', 'fixar' ),
				'param_name' => 'title',
				'description' => esc_html__( 'Text title', 'fixar' )
			),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text", 'fixar' ),
				"param_name" => "content",
				"value" => wp_kses_post(__( "<p>I am test text block. Click edit button to change this text.</p>", 'fixar' )),
				"description" => esc_html__( "Enter text.", 'fixar' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Button Text", 'fixar' ),
				"param_name" => "btn",
				"value" => wp_kses_post(__( "Learn More", 'fixar' )),
				"description" => esc_html__( "Enter text.", 'fixar' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Button Link", 'fixar' ),
				"param_name" => "link",
				"value" => wp_kses_post(__( "#", 'fixar' )),
				"description" => esc_html__( "Enter text.", 'fixar' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Service title", 'fixar' ),
				"param_name" => "service_title",
				"value" =>   'title',
				"description" => esc_html__( "Service title", 'fixar' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Service icon", 'fixar' ),
				"param_name" => "icon",
				"value" =>   'title',
				"description" => esc_html__( "Service icon", 'fixar' )
			),
		)
	) );
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_fixar_Services extends WPBakeryShortCodesContainer {
		}
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_fixar_Service extends WPBakeryShortCode {
		}
	}
	/////////////////////////////////		
	
	
	
	/// fixar_team
	//////// Our Team ////////
	vc_map( array(
		'name' => esc_html__( 'Team Members', 'fixar' ),
		'base' => 'fixar_team',
		'class' => 'pix-fixar-icon',
		'as_parent' => array('only' => 'fixar_team_member'),
		'content_element' => true,
		'show_settings_on_create' => true,
		'category' => esc_html__( 'Theme Widgets', 'fixar'),
		'params' => array(
		 	array(
				'type' => 'dropdown',
				'heading' => "Type",
				'param_name' => 'type',
				'value' => array(
					esc_html__( "Type 1", 'fixar' ) => '',
					esc_html__( "Type 2", 'fixar' ) => '-mod',	 
				),
				'description' => esc_html__( "Type of box", 'fixar' ),
	 
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title', 'fixar' ),
				'param_name' => 'title',
				'description' => esc_html__( 'Title of box', 'fixar' ),
				'dependency' => array(
					'element' => 'type',
					'value' => '-mod',
				),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Text', 'fixar' ),
				'param_name' => 'text',
				'description' => esc_html__( 'Text.', 'fixar' ),
				'dependency' => array(
					'element' => 'type',
					'value' => '-mod',
				),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Button text', 'fixar' ),
				'param_name' => 'button',
				'description' => esc_html__( 'Button text.', 'fixar' ),
				'dependency' => array(
					'element' => 'type',
					'value' => '-mod',
				),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Link', 'fixar' ),
				'param_name' => 'link',
				'description' => esc_html__( 'Button Link.', 'fixar' ),
				'dependency' => array(
					'element' => 'type',
					'value' => '-mod',
				),
			),
			vc_map_add_css_animation(),
		),
		'js_view' => 'VcColumnView',

	) );
	vc_map( array(
		'name' => esc_html__( 'Team Member', 'fixar' ),
		'base' => 'fixar_team_member',
		'class' => 'pix-fixar-icon',
		'as_child' => array('only' => 'fixar_team'),
		'content_element' => true,
		'params' => array(
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Image', 'fixar' ),
				'param_name' => 'image',
				'description' => esc_html__( 'Select image.', 'fixar' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Name', 'fixar' ),
				'param_name' => 'name',
				'description' => esc_html__( 'Team member name.', 'fixar' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Position', 'fixar' ),
				'param_name' => 'position',
				'description' => esc_html__( 'Member position.', 'fixar' )
			),
		 
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Link 1', 'fixar' ),
				'param_name' => 'scn1',
				'description' => esc_html__( 'https://www.facebook.com/', 'fixar' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Network Icon 1', 'fixar' ),
				'param_name' => 'scn_icon1',
				'description' => wp_kses_post(__( 'Add icon social_facebook_circle <a href="//fontawesome.github.io/Font-Awesome/icons/" target="_blank">See all icons</a>', 'fixar' ))
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Link 2', 'fixar' ),
				'param_name' => 'scn2',
				'description' => esc_html__( 'https://twitter.com/', 'fixar' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Network Icon 2', 'fixar' ),
				'param_name' => 'scn_icon2',
				'description' => wp_kses_post(__( 'Add icon social_twitter_circle <a href="//fontawesome.github.io/Font-Awesome/icons/" target="_blank">See all icons</a>', 'fixar' ))
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Link 3', 'fixar' ),
				'param_name' => 'scn3',
				'description' => esc_html__( 'https://www.pinterest.com/', 'fixar' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Network Icon 3', 'fixar' ),
				'param_name' => 'scn_icon3',
				'description' => wp_kses_post(__( 'Add icon social_pinterest_circle <a href="//fontawesome.github.io/Font-Awesome/icons/" target="_blank">See all icons</a>', 'fixar' ))
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Link 4', 'fixar' ),
				'param_name' => 'scn4',
				'description' => esc_html__( 'https://plus.google.com/', 'fixar' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Network Icon 4', 'fixar' ),
				'param_name' => 'scn_icon4',
				'description' => wp_kses_post(__( 'Add icon social_googleplus_circle <a href="//fontawesome.github.io/Font-Awesome/icons/" target="_blank">See all icons</a>', 'fixar' ))
			),
			vc_map_add_css_animation(),
		 
		)
	) );
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_fixar_Team extends WPBakeryShortCodesContainer {
		}
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_fixar_Team_Member extends WPBakeryShortCode {
		}
	}
	////////////////////////



	vc_map( array(
		'name' => esc_html__( 'Item Options', 'fixar' ),
		'base' => 'fixar_item_options',
		'class' => 'pix-fixar-icon',
		'category' => esc_html__( 'Theme Widgets', 'fixar'),
		'params' => array(
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Item Image', 'fixar' ),
				'param_name' => 'image',
				'description' => esc_html__( 'Select image.', 'fixar' )
			),
			array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Options', 'fixar' ),
				'param_name' => 'options',
				'params' => array_merge(
					array(
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Title', 'fixar' ),
							'param_name' => 'title',
							'description' => ''
						),
						array(
							'type' => 'attach_image',
							'heading' => esc_html__( 'Image', 'fixar' ),
							'param_name' => 'image_inner',
							'description' => esc_html__( 'Select image. (Size 476x850 px)', 'fixar' )
						),
					),
					fixar_get_vc_icons($vc_icons_data),
					array(
						array(
							'type' => 'textarea',
							'heading' => esc_html__( 'Content', 'fixar' ),
							'param_name' => 'content',
							'description' => ''
						),
					)
				),
			),
		),

	) );

	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_fixar_Item_Options extends WPBakeryShortCode {
		}
	}
	////////////////////////
	
	
 
	vc_map( array(
		'name' => esc_html__( 'Quote', 'fixar' ),
		'base' => 'fixar_quote',
		'class' => 'pix-fixar-icon',
 		"category" => esc_html__( "Theme Widgets", 'fixar'),
		'params' => array(
		 	array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title', 'fixar' ),
				'param_name' => 'title',
				'description' => esc_html__( 'Quote title.', 'fixar' )
			),
			array(
				'type' => 'textarea',
				'heading' => esc_html__( 'Text', 'fixar' ),
				'param_name' => 'text',
				'description' => esc_html__( 'Quote text.', 'fixar' )
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Image', 'fixar' ),
				'param_name' => 'image',
				'description' => esc_html__( 'Select image.', 'fixar' )
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Signature', 'fixar' ),
				'param_name' => 'signature',
				'description' => esc_html__( 'Select image.', 'fixar' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Name', 'fixar' ),
				'param_name' => 'name',
				'description' => esc_html__( 'Team member name.', 'fixar' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Position', 'fixar' ),
				'param_name' => 'position',
				'description' => esc_html__( 'Member position.', 'fixar' )
			),
		 
			 
			vc_map_add_css_animation(),
		 
		)
	) );
 
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_fixar_Quote extends WPBakeryShortCode {
		}
	}
	////////////////////////



///////////////////////////////////// Theme Post Types Widgets /////////////////////////////////////

	/// fixar_posts_block
	vc_map(
		array(
			"name" => esc_html__( "News Block", 'fixar' ),
			"base" => "fixar_posts_block",
			"class" => "pix-fixar-icon",
			"category" => esc_html__( "Theme Widgets", 'fixar'),
			"params" => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Posts Count', 'fixar' ),
					'param_name' => 'count',
					'description' => esc_html__( 'If empty, display all posts.', 'fixar' )
				),
			)
		)
	);
	
	//////////////////////////////////////////////////////////////////////
	
	
	/// fixar_brand
	vc_map(
		array(
			'name' => esc_html__( 'Brand Box', 'fixar' ),
			'base' => 'fixar_brand',
			'class' => 'pix-fixar-icon',
			'category' => esc_html__( 'Theme Widgets', 'fixar'),
			'params' => array(
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Image', 'fixar' ),
					'param_name' => 'image',
					'value' => '',
					'description' => esc_html__( 'Select image from media library.', 'fixar' )
				),
				array(
					'type' => 'vc_link',
					'holder' => 'div',
					'heading' => esc_html__( 'Url', 'fixar' ),
					'param_name' => 'url',
					'value' => '',
					'description' => '',
				),
				vc_map_add_css_animation(),
			)
		)
	);
	
	
	////////////////////////	
	
	
	/***   Widget Order   ***/
	
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_fixar_Brand extends WPBakeryShortCode {
		}
	}
	
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_fixar_Posts_Block extends WPBakeryShortCode {
		}
	}
	
	
?>