<?php

if ( function_exists('vc_map') && class_exists('WPBakeryShortCode') ) {
	function studylms_educator_get_category_childs( $categories, $id_parent, $level, &$dropdown ) {
        foreach ( $categories as $key => $category ) {
            if ( $category->category_parent == $id_parent ) {
                $dropdown = array_merge( $dropdown, array( str_repeat( "- ", $level ) . $category->name  => $category->slug ) );
                unset($categories[$key]);
                studylms_educator_get_category_childs( $categories, $category->term_id, $level + 1, $dropdown );
            }
        }
    }

    function studylms_educator_get_categories() {
        $return = array( esc_html__(' --- Choose a Category --- ', 'studylms') => '' );

        $args = array(
            'type' => 'post',
            'child_of' => 0,
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => false,
            'hierarchical' => 1,
            'taxonomy' => 'edr_course_category'
        );

        $categories = get_categories( $args );
        studylms_educator_get_category_childs( $categories, 0, 0, $return );

        return $return;
    }

	if ( !function_exists('studylms_load_educator_element')) {
		function studylms_load_educator_element() {
			vc_map( array(
				'name'        => esc_html__( 'Apus Courses','studylms'),
				'base'        => 'apus_courses',
				"category" => esc_html__('Apus Education', 'studylms'),
				'description' => esc_html__( 'Create Courses for one Widget', 'studylms' ),
				"params"      => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Title', 'studylms' ),
						'param_name' => 'title',
						"admin_label" => true,
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Get Course By", 'studylms'),
						"param_name" => "course_type",
						'value' 	=> array(
							esc_html__('Lastest Courses', 'studylms') => 'most_recent', 
							esc_html__('Random Courses', 'studylms') => 'random', 
						)
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Number', 'studylms' ),
						'param_name' => 'number',
						"admin_label" => true,
						'value' => 4
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Columns", 'studylms'),
						"param_name" => "columns",
						'value' 	=> array(1,2,3,4,6)
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Layout Type", 'studylms'),
						"param_name" => "layout_type",
						'value' 	=> array(
							esc_html__('Grid', 'studylms') => 'grid', 
							esc_html__('List', 'studylms') => 'list', 
							esc_html__('List 1', 'studylms') => 'list-v1',
							esc_html__('Carousel', 'studylms') => 'carousel', 
						)
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'studylms' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'studylms' )
					)
				),
			));

			$categories = array();
	        if ( is_admin() ) {
	            $categories = studylms_educator_get_categories();
	        }
			vc_map( array(
				'name'        => esc_html__( 'Apus Courses Categories','studylms'),
				'base'        => 'apus_course_categories',
				"category" => esc_html__('Apus Education', 'studylms'),
				'description' => esc_html__( 'Display course categories in frontend', 'studylms' ),
				"params"      => array(
					array(
						'type' => 'param_group',
						'heading' => esc_html__('Categories', 'studylms' ),
						'param_name' => 'categories',
						'description' => '',
						'value' => '',
						'params' => array(
							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Category Name', 'studylms' ),
								'param_name' => 'name',
								"admin_label" => true,
							),
							array(
								"type" => "dropdown",
								"heading" => esc_html__("Select Category", 'studylms'),
								"param_name" => "category",
								'value' => $categories
							),
				            array(
								"type" => "textfield",
								"heading" => esc_html__("Material Design Icon and Awesome Icon", 'studylms'),
								"param_name" => "icon",
								"value" => '',
								'description' => esc_html__( 'This support display icon from Material Design and Awesome Icon, Please click', 'studylms' )
												. '<a href="' . ( is_ssl()  ? 'https' : 'http') . '://zavoloklom.github.io/material-design-iconic-font/icons.html" target="_blank">'
												. esc_html__( 'here to see the list', 'studylms' ) . '</a>'
							),
							array(
								"type" => "attach_image",
								"heading" => esc_html__("Icon Image", 'studylms'),
								"param_name" => "image",
								"description" => esc_html__('If you upload an image, icon will not show.', 'studylms')
							),
						),
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Columns", 'studylms'),
						"param_name" => "columns",
						'value' 	=> array(1,2,3,4,6)
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Style", 'studylms'),
						"param_name" => "style",
						'value' 	=> array(
							esc_html__('Style 1', 'studylms') => 'style1', 
							esc_html__('Style 2', 'studylms') => 'style2', 
						)
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'studylms' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'studylms' )
					)
				),
			));

			vc_map( array(
				'name'        => esc_html__( 'Apus Courses Lecturers','studylms'),
				'base'        => 'apus_course_lecturer',
				"category" => esc_html__('Apus Education', 'studylms'),
				'description' => esc_html__( 'Display course lecturers in frontend', 'studylms' ),
				"params"      => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Number', 'studylms' ),
						'param_name' => 'number',
						"admin_label" => true,
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Columns", 'studylms'),
						"param_name" => "columns",
						'value' 	=> array(1,2,3,4,6)
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'studylms' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'studylms' )
					)
				),
			));

			vc_map( array(
				'name'        => esc_html__( 'Apus Courses Memberships','studylms'),
				'base'        => 'apus_course_membership',
				"category" => esc_html__('Apus Education', 'studylms'),
				'description' => esc_html__( 'Display course membership in frontend', 'studylms' ),
				"params"      => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Number', 'studylms' ),
						'param_name' => 'number',
						"admin_label" => true,
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'studylms' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'studylms' )
					)
				),
			));

			vc_map( array(
				'name'        => esc_html__( 'Apus Courses Search Form','studylms'),
				'base'        => 'apus_course_search',
				"category" => esc_html__('Apus Education', 'studylms'),
				'description' => esc_html__( 'Display course search form in frontend', 'studylms' ),
				"params"      => array(
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Layout Type", 'studylms'),
						"param_name" => "layout_type",
						'value' 	=> array(
							esc_html__('Layout 1', 'studylms') => 'layout1', 
							esc_html__('Layout 2', 'studylms') => 'layout2', 
						)
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'studylms' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'studylms' )
					)
				),
			));

			vc_map( array(
				'name'        => esc_html__( 'Apus Courses Bookmark','studylms'),
				'base'        => 'apus_course_bookmark',
				"category" => esc_html__('Apus Education', 'studylms'),
				'description' => esc_html__( 'Display course bookmark form in frontend', 'studylms' ),
				"params"      => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'studylms' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'studylms' )
					)
				),
			));
			
		}
	}
	add_action( 'vc_after_set_mode', 'studylms_load_educator_element', 99 );

	class WPBakeryShortCode_apus_courses extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_course_categories extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_course_lecturer extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_course_membership extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_course_search extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_course_bookmark extends WPBakeryShortCode {}
}