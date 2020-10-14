<?php
if ( function_exists('vc_map') && class_exists('WPBakeryShortCode') ) {
	if ( !function_exists('studylms_load_load_theme_element')) {
		function studylms_load_load_theme_element() {
			$columns = array(1,2,3,4,6);
			// Heading Text Block
			vc_map( array(
				'name'        => esc_html__( 'Apus Widget Heading','studylms'),
				'base'        => 'apus_title_heading',
				"class"       => "",
				"category" => esc_html__('Apus Elements', 'studylms'),
				'description' => esc_html__( 'Create title for one Widget', 'studylms' ),
				"params"      => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Widget title', 'studylms' ),
						'param_name' => 'title',
						'description' => esc_html__( 'Enter heading title.', 'studylms' ),
						"admin_label" => true,
					),
					array(
						"type" => "textarea",
						'heading' => esc_html__( 'Description', 'studylms' ),
						"param_name" => "descript",
						"value" => '',
						'description' => esc_html__( 'Enter description for title.', 'studylms' )
				    ),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Style", 'studylms'),
						"param_name" => "style",
						'value' 	=> array(
							esc_html__('Style Default', 'studylms') => 'default', 
							esc_html__('Style 1', 'studylms') => 'style1', 
							esc_html__('Style 2', 'studylms') => 'style2', 
						),
						'std' => ''
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'studylms' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'studylms' )
					)
				),
			));

			// calltoaction
			vc_map( array(
				'name'        => esc_html__( 'Apus Call To Action','studylms'),
				'base'        => 'apus_call_action',
				"class"       => "",
				"category" => esc_html__('Apus Elements', 'studylms'),
				'description' => esc_html__( 'Create title for one Widget', 'studylms' ),
				"params"      => array(
					array(
						"type" => "attach_image",
						"heading" => esc_html__("Image Feature for style Default", 'studylms'),
						"param_name" => "image"
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Title', 'studylms' ),
						'param_name' => 'title',
						'value'       => esc_html__( 'Title', 'studylms' ),
						'description' => esc_html__( 'Enter heading title.', 'studylms' ),
						"admin_label" => true
					),
					array(
						"type" => "textarea_html",
						'heading' => esc_html__( 'Description', 'studylms' ),
						"param_name" => "content",
						"value" => '',
						'description' => esc_html__( 'Enter description for title.', 'studylms' )
				    ),

				    array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Text Button 1', 'studylms' ),
						'param_name' => 'textbutton1',
						'description' => esc_html__( 'Text Button', 'studylms' ),
						"admin_label" => true
					),

					array(
						'type' => 'textfield',
						'heading' => esc_html__( ' Link Button 1', 'studylms' ),
						'param_name' => 'linkbutton1',
						'description' => esc_html__( 'Link Button 1', 'studylms' ),
						"admin_label" => true
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Button Style", 'studylms'),
						"param_name" => "buttons1",
						'value' 	=> array(
							esc_html__('Default ', 'studylms') => 'btn-default ', 
							esc_html__('Primary ', 'studylms') => 'btn-primary ', 
							esc_html__('Success ', 'studylms') => 'btn-success radius-0 ', 
							esc_html__('Info ', 'studylms') => 'btn-info ', 
							esc_html__('Warning ', 'studylms') => 'btn-warning ', 
							esc_html__('Theme Color ', 'studylms') => 'btn-theme',
							esc_html__('Theme Gradient Color ', 'studylms') => 'btn-theme btn-gradient',
							esc_html__('Second Color ', 'studylms') => 'btn-theme-second',
							esc_html__('Danger ', 'studylms') => 'btn-danger ', 
							esc_html__('Pink ', 'studylms') => 'btn-pink ', 
							esc_html__('White ', 'studylms') => 'btn-white', 
							esc_html__('Primary Outline', 'studylms') => 'btn-primary btn-outline', 
							esc_html__('White Outline ', 'studylms') => 'btn-white btn-outline ',
							esc_html__('Theme Outline ', 'studylms') => 'btn-theme btn-outline ',
						),
						'std' => ''
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Style", 'studylms'),
						"param_name" => "style",
						'value' 	=> array(
							esc_html__('Default', 'studylms') => 'styledefault',
							esc_html__('Center', 'studylms') => 'default center',
							esc_html__('Center White', 'studylms') => 'center-white',
							esc_html__('Default Dark', 'studylms') => 'styledefault dark',
						),
						'std' => ''
					),

					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'studylms' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'studylms' )
					)
				),
			));
			
			// Apus Counter
			vc_map( array(
			    "name" => esc_html__("Apus Counter",'studylms'),
			    "base" => "apus_counter",
			    "class" => "",
			    "description"=> esc_html__('Counting number with your term', 'studylms'),
			    "category" => esc_html__('Apus Elements', 'studylms'),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'studylms'),
						"param_name" => "title",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Number", 'studylms'),
						"param_name" => "number",
						"value" => ''
					),
					array(
						"type" => "colorpicker",
						"heading" => esc_html__("Color Number and Title", 'studylms'),
						"param_name" => "text_color",
						'value' 	=> '',
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'studylms'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'studylms')
					)
			   	)
			));
			// Banner CountDown
			vc_map( array(
				'name'        => esc_html__( 'Apus Banner CountDown','studylms'),
				'base'        => 'apus_banner_countdown',
				"class"       => "",
				"category" => esc_html__('Apus Elements', 'studylms'),
				'description' => esc_html__( 'Show CountDown with banner', 'studylms' ),
				"params"      => array(
					array(
						'type' => 'textarea_html',
						'heading' => esc_html__( 'Widget title', 'studylms' ),
						'param_name' => 'content',
						'value'       => esc_html__( 'Title', 'studylms' ),
						'description' => esc_html__( 'Enter heading title.', 'studylms' ),
						"admin_label" => true
					),
					array(
						"type" => "textarea",
						'heading' => esc_html__( 'Description', 'studylms' ),
						"param_name" => "descript",
						"value" => '',
						'description' => esc_html__( 'Enter description for title.', 'studylms' )
				    ),
				    array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Url Readmore', 'studylms' ),
						'param_name' => 'url',
						'description' => esc_html__( 'Link Button', 'studylms' ),
					),
				    array(
						"type" => "attach_image",
						"heading" => esc_html__("Image Feature", 'studylms'),
						"param_name" => "image"
					),
					array(
						"type" => "textarea",
						'heading' => esc_html__( 'Setting Description', 'studylms' ),
						"param_name" => "setting",
						"value" => '',
						'description' => esc_html__( 'Enter description for Setting.', 'studylms' )
				    ),
					array(
					    'type' => 'textfield',
					    'heading' => esc_html__( 'Date Expired', 'studylms' ),
					    'param_name' => 'input_datetime'
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Style", 'studylms'),
						"param_name" => "style_widget",
						'value' 	=> array(
							esc_html__('Default', 'studylms') => 'default', 
						),
						'std' => ''
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'studylms' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'studylms' )
					),
				),
			));

			// Banner
			vc_map( array(
				'name'        => esc_html__( 'Apus Banner','studylms'),
				'base'        => 'apus_banner',
				"class"       => "",
				"category" => esc_html__('Apus Elements', 'studylms'),
				'description' => esc_html__( 'Show  banner', 'studylms' ),
				"params"      => array(
					array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'studylms'),
						"param_name" => "title",
						"value" => '',
						"admin_label"	=> true
					),
				    array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Url Readmore', 'studylms' ),
						'param_name' => 'url',
						'description' => esc_html__( 'Link Button', 'studylms' ),
					),
				    array(
						"type" => "attach_image",
						"heading" => esc_html__("Image Feature", 'studylms'),
						"param_name" => "image"
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'studylms' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'studylms' )
					),
				),
			));

			// Apus Brands
			vc_map( array(
			    "name" => esc_html__("Apus Brands",'studylms'),
			    "base" => "apus_brands",
			    "class" => "",
			    "description"=> esc_html__('Display brands on front end', 'studylms'),
			    "category" => esc_html__('Apus Elements', 'studylms'),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'studylms'),
						"param_name" => "title",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Number", 'studylms'),
						"param_name" => "number",
						"value" => ''
					),
				 	array(
						"type" => "dropdown",
						"heading" => esc_html__("Layout Type", 'studylms'),
						"param_name" => "layout_type",
						'value' 	=> array(
							esc_html__('Carousel', 'studylms') => 'carousel', 
							esc_html__('Grid', 'studylms') => 'grid'
						),
						'std' => ''
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Style Type", 'studylms'),
						"param_name" => "style",
						'value' 	=> array(
							esc_html__('Border Dasher', 'studylms') => '', 
							esc_html__('Border Solid', 'studylms') => 'solid',
							esc_html__('No Border', 'studylms') => 'no-border',
						),
						'std' => ''
					),
					array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Columns','studylms'),
		                "param_name" => 'columns',
		                "value" => array(1,2,3,4,5,6),
		            ),
		            array(
						"type" => "dropdown",
						"heading" => esc_html__("Rows for style Carousel", 'studylms'),
						"param_name" => "rows",
						"value" => array(1,2,3),
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'studylms'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'studylms')
					)
			   	)
			));
			
			vc_map( array(
			    "name" => esc_html__("Apus Socials link",'studylms'),
			    "base" => "apus_socials_link",
			    "description"=> esc_html__('Show socials link', 'studylms'),
			    "category" => esc_html__('Apus Elements', 'studylms'),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'studylms'),
						"param_name" => "title",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textarea",
						"heading" => esc_html__("Description", 'studylms'),
						"param_name" => "description",
						"value" => '',
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Facebook Page URL", 'studylms'),
						"param_name" => "facebook_url",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Twitter Page URL", 'studylms'),
						"param_name" => "twitter_url",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Youtube Page URL", 'studylms'),
						"param_name" => "youtube_url",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Pinterest Page URL", 'studylms'),
						"param_name" => "pinterest_url",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Google Plus Page URL", 'studylms'),
						"param_name" => "google-plus_url",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Instagram Page URL", 'studylms'),
						"param_name" => "instagram_url",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Align", 'studylms'),
						"param_name" => "align",
						'value' 	=> array(
							esc_html__('Left', 'studylms') => '', 
							esc_html__('Right', 'studylms') => 'right'
						),
						'std' => ''
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Style", 'studylms'),
						"param_name" => "style",
						'value' 	=> array(
							esc_html__('Small', 'studylms') => '', 
							esc_html__('Large', 'studylms') => 'large'
						),
						'std' => ''
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'studylms'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'studylms')
					)
			   	)
			));
			// newsletter
			vc_map( array(
			    "name" => esc_html__("Apus Newsletter",'studylms'),
			    "base" => "apus_newsletter",
			    "class" => "",
			    "description"=> esc_html__('Show newsletter form', 'studylms'),
			    "category" => esc_html__('Apus Elements', 'studylms'),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'studylms'),
						"param_name" => "title",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textarea",
						"heading" => esc_html__("Description", 'studylms'),
						"param_name" => "description",
						"value" => '',
					),
					array(
						"type" => "attach_image",
						"description" => esc_html__("Image Icon.", 'studylms'),
						"param_name" => "image_icon",
						"value" => '',
						'heading'	=> esc_html__('Image Icon', 'studylms' )
					),
					array(
		                'type' => 'dropdown',
		                'heading' => esc_html__( 'Style', 'studylms' ),
		                'param_name' => 'style',
		                'value' => array(
		                    esc_html__( 'Style White', 'studylms' ) 	=> 'style1',
		                    esc_html__( 'Style 2', 'studylms' ) 	=> 'style2',
		                )
		            ),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'studylms'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'studylms')
					)
			   	)
			));
			// google map
			$map_styles = array( esc_html__('Choose a map style', 'studylms') => '' );
			if ( is_admin() && class_exists('Studylms_Google_Maps_Styles') ) {
				$styles = Studylms_Google_Maps_Styles::styles();
				foreach ($styles as $style) {
					$map_styles[$style['title']] = $style['slug'];
				}
			}
			vc_map( array(
			    "name" => esc_html__("Apus Google Map",'studylms'),
			    "base" => "apus_googlemap",
			    "description" => esc_html__('Diplay Google Map', 'studylms'),
			    "category" => esc_html__('Apus Elements', 'studylms'),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'studylms'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
					array(
		                "type" => "textarea",
		                "class" => "",
		                "heading" => esc_html__('Description','studylms'),
		                "param_name" => "des",
		            ),
		            array(
		                'type' => 'googlemap',
		                'heading' => esc_html__( 'Location', 'studylms' ),
		                'param_name' => 'location',
		                'value' => ''
		            ),
		            array(
		                'type' => 'hidden',
		                'heading' => esc_html__( 'Latitude Longitude', 'studylms' ),
		                'param_name' => 'lat_lng',
		                'value' => '21.0173222,105.78405279999993'
		            ),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Map height", 'studylms'),
						"param_name" => "height",
						"value" => '',
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Map Zoom", 'studylms'),
						"param_name" => "zoom",
						"value" => '13',
					),
		            array(
		                'type' => 'dropdown',
		                'heading' => esc_html__( 'Map Type', 'studylms' ),
		                'param_name' => 'type',
		                'value' => array(
		                    esc_html__( 'roadmap', 'studylms' ) 		=> 'ROADMAP',
		                    esc_html__( 'hybrid', 'studylms' ) 	=> 'HYBRID',
		                    esc_html__( 'satellite', 'studylms' ) 	=> 'SATELLITE',
		                    esc_html__( 'terrain', 'studylms' ) 	=> 'TERRAIN',
		                )
		            ),
		            array(
						"type" => "attach_image",
						"heading" => esc_html__("Custom Marker Icon", 'studylms'),
						"param_name" => "marker_icon"
					),
					array(
		                'type' => 'dropdown',
		                'heading' => esc_html__( 'Custom Map Style', 'studylms' ),
		                'param_name' => 'map_style',
		                'value' => $map_styles
		            ),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'studylms'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'studylms')
					)
			   	)
			));
			// Testimonial
			vc_map( array(
	            "name" => esc_html__("Apus Testimonials",'studylms'),
	            "base" => "apus_testimonials",
	            'description'=> esc_html__('Display Testimonials In FrontEnd', 'studylms'),
	            "class" => "",
	            "category" => esc_html__('Apus Elements', 'studylms'),
	            "params" => array(
	              	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'studylms'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
	              	array(
		              	"type" => "textfield",
		              	"heading" => esc_html__("Number", 'studylms'),
		              	"param_name" => "number",
		              	"value" => '4',
		            ),
		            array(
		              	"type" => "textfield",
		              	"heading" => esc_html__("Columns", 'studylms'),
		              	"param_name" => "columns",
		              	"value" => '1',
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Layout Type','studylms'),
		                "param_name" => 'layout_type',
		                'value' 	=> array(
		                	esc_html__('Style 1 ', 'studylms') => 'style1', 
		                	esc_html__('Style 2', 'studylms') => 'style2',
		                	esc_html__('Style 3', 'studylms') => 'style3',
						),
						'std' => ''
		            ),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'studylms'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'studylms')
					)
	            )
	        ));
	        
	        // Gallery Images
			vc_map( array(
	            "name" => esc_html__("Apus Gallery",'studylms'),
	            "base" => "apus_gallery",
	            'description'=> esc_html__('Display Gallery In FrontEnd', 'studylms'),
	            "class" => "",
	            "category" => esc_html__('Apus Elements', 'studylms'),
	            "params" => array(
	              	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'studylms'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
	              	array(
						"type" => "attach_images",
						"heading" => esc_html__("Images", 'studylms'),
						"param_name" => "images"
					),
					array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Columns','studylms'),
		                "param_name" => 'columns',
		                "value" => $columns
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Row','studylms'),
		                "param_name" => 'rows',
		                "value" => array(1,2),
		            ),
		            array(
						"type" => "textarea",
						'heading' => esc_html__( 'Description', 'studylms' ),
						"param_name" => "description",
						"value" => '',
						'description' => esc_html__( 'This field is used for Style 2.', 'studylms' )
				    ),
					array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Layout','studylms'),
		                "param_name" => 'style',
		                'value' 	=> array(
							esc_html__('Default ', 'studylms') => 'default', 
							esc_html__('Small ', 'studylms') => 'small',
						),
						'std' => ''
		            ),
		            array(
						"type" => "dropdown",
						"heading" => esc_html__("Style Next and Preview", 'studylms'),
						"param_name" => "style_border",
						'value' 	=> array(
							esc_html__('Border Dasher', 'studylms') => '', 
							esc_html__('Border Solid', 'studylms') => 'solid'
						),
						'std' => ''
					),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'studylms'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'studylms')
					)
	            )
	        ));
	        // Gallery Images
			vc_map( array(
	            "name" => esc_html__("Apus Video",'studylms'),
	            "base" => "apus_video",
	            'description'=> esc_html__('Display Video In FrontEnd', 'studylms'),
	            "class" => "",
	            "category" => esc_html__('Apus Elements', 'studylms'),
	            "params" => array(
	              	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'studylms'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
					array(
						"type" => "textarea_html",
						'heading' => esc_html__( 'Description', 'studylms' ),
						"param_name" => "content",
						"value" => '',
						'description' => esc_html__( 'Enter description for title.', 'studylms' )
				    ),
	              	array(
						"type" => "attach_image",
						"heading" => esc_html__("Icon Play Image", 'studylms'),
						"param_name" => "image"
					),
					array(
		                "type" => "textfield",
		                "heading" => esc_html__('Youtube Video Link','studylms'),
		                "param_name" => 'video_link'
		            ),
		           	array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Link Button', 'studylms' ),
						'param_name' => 'linkbutton',
						'description' => esc_html__( 'Link Button Join Us!', 'studylms' ),
						"admin_label" => true
					),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'studylms'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'studylms')
					)
	            )
	        ));
	        // Features Box
			vc_map( array(
	            "name" => esc_html__("Apus Features Box",'studylms'),
	            "base" => "apus_features_box",
	            'description'=> esc_html__('Display Features In FrontEnd', 'studylms'),
	            "class" => "",
	            "category" => esc_html__('Apus Elements', 'studylms'),
	            "params" => array(
	            	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'studylms'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
					array(
						'type' => 'param_group',
						'heading' => esc_html__('Members Settings', 'studylms' ),
						'param_name' => 'items',
						'description' => '',
						'value' => '',
						'params' => array(
							array(
								"type" => "attach_image",
								"description" => esc_html__("Image for box.", 'studylms'),
								"param_name" => "image",
								"value" => '',
								'heading'	=> esc_html__('Image', 'studylms' )
							),
							array(
								"type" => "attach_image",
								"description" => esc_html__("Image Hover for Style Box hover.", 'studylms'),
								"param_name" => "image_hover",
								"value" => '',
								'heading'	=> esc_html__('Image Hover', 'studylms' )
							),
							array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Title','studylms'),
				                "param_name" => "title",
				            ),
	        				array(
								"type" => "colorpicker",
								"heading" => esc_html__("Background Color", 'studylms'),
								"param_name" => "bg_color",
								'value' 	=> '',
							),
				            array(
				                "type" => "textarea",
				                "class" => "",
				                "heading" => esc_html__('Description','studylms'),
				                "param_name" => "description",
				            ),
				            array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Link Button','studylms'),
				                "param_name" => "url",
				            ),
						),
					),
	             	array(
		              	"type" => "textfield",
		              	"heading" => esc_html__("Number Columns", 'studylms'),
		              	"param_name" => "number",
		              	'value' => '1',
		            ),
		           	array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Style','studylms'),
		                "param_name" => 'style',
		                'value' 	=> array(
							esc_html__('Default Box', 'studylms') => 'default', 
							esc_html__('Center ', 'studylms') => 'center',
							esc_html__('Center Line', 'studylms') => 'center-line',
						),
						'std' => ''
		            ),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'studylms'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'studylms')
					)
	            )
	        ));
			$custom_menus = array();
			if ( is_admin() ) {
				$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
				if ( is_array( $menus ) && ! empty( $menus ) ) {
					foreach ( $menus as $single_menu ) {
						if ( is_object( $single_menu ) && isset( $single_menu->name, $single_menu->slug ) ) {
							$custom_menus[ $single_menu->name ] = $single_menu->slug;
						}
					}
				}
			}
			// Menu
			vc_map( array(
			    "name" => esc_html__("Apus Custom Menu",'studylms'),
			    "base" => "apus_custom_menu",
			    "class" => "",
			    "description"=> esc_html__('Show Custom Menu', 'studylms'),
			    "category" => esc_html__('Apus Elements', 'studylms'),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'studylms'),
						"param_name" => "title",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Menu', 'studylms' ),
						'param_name' => 'nav_menu',
						'value' => $custom_menus,
						'description' => empty( $custom_menus ) ? esc_html__( 'Custom menus not found. Please visit Appearance > Menus page to create new menu.', 'studylms' ) : esc_html__( 'Select menu to display.', 'studylms' ),
						'admin_label' => true,
						'save_always' => true,
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'studylms'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'studylms')
					)
			   	)
			));

			// contact info
			vc_map( array(
	            "name" => esc_html__('Apus Contact Info','studylms'),
	            "base" => "apus_contact_info",
	            'description'=> esc_html__('Display contact info In FrontEnd', 'studylms'),
	            "class" => "",
	            "category" => esc_html__('Apus Elements', 'studylms'),
	            "params" => array(
	            	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'studylms'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
					array(
						'type' => 'param_group',
						'heading' => esc_html__('Contact Info Settings', 'studylms' ),
						'param_name' => 'items',
						'params' => array(
							
							array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Title','studylms'),
				                "param_name" => "title",
				            ),
				            array(
				                "type" => "textarea",
				                "class" => "",
				                "heading" => esc_html__('Description','studylms'),
				                "param_name" => "description",
				            ),
							array(
								"type" => "attach_image",
								"description" => esc_html__("If you upload an image, icon will not show.", 'studylms'),
								"param_name" => "image",
								"value" => '',
								'heading'	=> esc_html__('Icon Image', 'studylms' )
							),
						),
					),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'studylms'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'studylms')
					)
	            )
	        ));
		}
	}
	add_action( 'vc_after_set_mode', 'studylms_load_load_theme_element', 99 );

	class WPBakeryShortCode_apus_title_heading extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_call_action extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_brands extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_socials_link extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_newsletter extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_googlemap extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_testimonials extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_banner_countdown extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_banner extends WPBakeryShortCode {}

	class WPBakeryShortCode_apus_counter extends WPBakeryShortCode {
		public function __construct( $settings ) {
			parent::__construct( $settings );
			$this->load_scripts();
		}

		public function load_scripts() {
			wp_register_script('jquery-counterup', get_template_directory_uri().'/js/jquery.counterup.min.js', array('jquery'), false, true);
		}
	}
	class WPBakeryShortCode_apus_gallery extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_video extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_features_box extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_custom_menu extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_contact_info extends WPBakeryShortCode {}
}