<?php
//Shortcodes for Visual Composer

add_action( 'vc_before_init', 'digitech_vc_shortcodes' );
function digitech_vc_shortcodes() {

	//Main Menu
	vc_map( array(
		'name' => esc_html__( 'Main Menu', 'digitech'),
		'base' => 'roadmainmenu',
		'class' => '',
		'category' => esc_html__( 'Theme', 'digitech'),
		'params' => array(
			array(
				'type' => 'attach_image',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Upload sticky logo image', 'digitech' ),
				'param_name' => 'sticky_logoimage',
				'value' => '',
			),
		)
	) );

	//Categories Menu
	vc_map( array(
		'name' => esc_html__( 'Categories Menu', 'digitech'),
		'base' => 'roadcategoriesmenu',
		'class' => '',
		'category' => esc_html__( 'Theme', 'digitech'),
		'params' => array(
		)
	) );

	//Social Icons
	vc_map( array(
		'name' => esc_html__( 'Social Icons', 'digitech'),
		'base' => 'roadsocialicons',
		'class' => '',
		'category' => esc_html__( 'Theme', 'digitech'),
		'params' => array(
		)
	) );

	//Mini Cart
	vc_map( array(
		'name' => esc_html__( 'Mini Cart', 'digitech'),
		'base' => 'roadminicart',
		'class' => '',
		'category' => esc_html__( 'Theme', 'digitech'),
		'params' => array(
		)
	) );

	//Products Search without dropdown
	vc_map( array(
		'name' => esc_html__( 'Product Search (No dropdown)', 'digitech'),
		'base' => 'roadproductssearch',
		'class' => '',
		'category' => esc_html__( 'Theme', 'digitech'),
		'params' => array(
		)
	) );

	//Products Search with dropdown
	vc_map( array(
		'name' => esc_html__( 'Product Search (Dropdown)', 'digitech'),
		'base' => 'roadproductssearchdropdown',
		'class' => '',
		'category' => esc_html__( 'Theme', 'digitech'),
		'params' => array(
		)
	) );

	//Brand logos
	vc_map( array(
		'name' => esc_html__( 'Brand Logos', 'digitech' ),
		'base' => 'ourbrands',
		'class' => '',
		'category' => esc_html__( 'Theme', 'digitech'),
		'params' => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Number of columns', 'digitech' ),
				'param_name' => 'colsnumber',
				'value' => esc_html__( '6', 'digitech' ),
			),
			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Number of rows', 'digitech' ),
				'param_name' => 'rowsnumber',
				'value' => array(
						'1'	=> '1',
						'2'	=> '2',
						'3'	=> '3',
						'4'	=> '4',
					),
			),
		)
	) );
	
	//Latest posts
	vc_map( array(
		'name' => esc_html__( 'Latest posts', 'digitech' ),
		'base' => 'latestposts',
		'class' => '',
		'category' => esc_html__( 'Theme', 'digitech'),
		'params' => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Number of posts', 'digitech' ),
				'param_name' => 'posts_per_page',
				'value' => esc_html__( '10', 'digitech' ),
			),
			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Image scale', 'digitech' ),
				'param_name' => 'image',
				'value' => array(
						'Wide'	=> 'wide',
						'Square'	=> 'square',
					),
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Excerpt length', 'digitech' ),
				'param_name' => 'length',
				'value' => esc_html__( '20', 'digitech' ),
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Number of columns', 'digitech' ),
				'param_name' => 'colsnumber',
				'value' => esc_html__( '2', 'digitech' ),
			),
			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Number of rows', 'digitech' ),
				'param_name' => 'rowsnumber',
				'value' => array(
						'1'	=> '1',
						'2'	=> '2',
						'3'	=> '3',
						'4'	=> '4',
					),
			),
		)
	) );
	
	//Testimonials
	vc_map( array(
		'name' => esc_html__( 'Testimonials', 'digitech' ),
		'base' => 'woothemes_testimonials',
		'class' => '',
		'category' => esc_html__( 'Theme', 'digitech'),
		'params' => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Number of testimonial', 'digitech' ),
				'param_name' => 'limit',
				'value' => esc_html__( '10', 'digitech' ),
			),
			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Display Author', 'digitech' ),
				'param_name' => 'display_author',
				'value' => array(
					'Yes'	=> 'true',
					'No'	=> 'false',
				),
			),
			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Display Avatar', 'digitech' ),
				'param_name' => 'display_avatar',
				'value' => array(
					'Yes'	=> 'true',
					'No'	=> 'false',
				),
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Avatar image size', 'digitech' ),
				'param_name' => 'size',
				'value' => '',
				'description' => esc_html__( 'Avatar image size in pixels. Default is 50', 'digitech' ),
			),
			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Display URL', 'digitech' ),
				'param_name' => 'display_url',
				'value' => array(
					'Yes'	=> 'true',
					'No'	=> 'false',
				),
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Category', 'digitech' ),
				'param_name' => 'category',
				'value' => esc_html__( '0', 'digitech' ),
				'description' => esc_html__( 'ID/slug of the category. Default is 0', 'digitech' ),
			),
		)
	) );
	
	//Counter
	vc_map( array(
		'name' => esc_html__( 'Counter', 'digitech' ),
		'base' => 'digitech_counter',
		'class' => '',
		'category' => esc_html__( 'Theme', 'digitech'),
		'params' => array(
			array(
				'type' => 'attach_image',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Image icon', 'digitech' ),
				'param_name' => 'image',
				'value' => '',
				'description' => esc_html__( 'Upload icon image', 'digitech' ),
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Number', 'digitech' ),
				'param_name' => 'number',
				'value' => '',
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Text', 'digitech' ),
				'param_name' => 'text',
				'value' => '',
			),
		)
	) );
}
?>