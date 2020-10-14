<?php
// Registers the new post type 

function rdn_slider_posttype() {
	register_post_type( 'rdn-slider',
		array(
			'labels' => array(
				'name' => __( 'Homepage Slider', 'cordon_plg' ),
				'singular_name' => __( 'Homepage Slider' , 'cordon_plg'),
				'add_new' => __( 'Add New Homepage Slider', 'cordon_plg' ),
				'add_new_item' => __( 'Add New Homepage Slider', 'cordon_plg' ),
				'edit_item' => __( 'Edit Homepage Slider', 'cordon_plg' ),
				'new_item' => __( 'Add Homepage Slider', 'cordon_plg' ),
				'view_item' => __( 'View Homepage Slider', 'cordon_plg' ),
				'search_items' => __( 'Search Homepage Slider', 'cordon_plg' ),
				'not_found' => __( 'No Homepage Slider found', 'cordon_plg' ),
				'not_found_in_trash' => __( 'No Homepage Slider found in trash', 'cordon_plg' )
			),
			'public' => true,
			'supports' => array( 'title'),
			'capability_type' => 'post',
			'rewrite' => array("slug" => "rdn-slider"), // Permalinks format
			'menu_position' => 5,
			'menu_icon'           => 'dashicons-slides',
			'exclude_from_search' => true 
		)
	);

}

add_action( 'init', 'rdn_slider_posttype' );

/**
 * Initialize the slider Meta Boxes. 
 */
add_action( 'admin_init', 'rdn_slide_mb' );
function rdn_slide_mb() {
  
  /**
   * Create a custom meta boxes array that we pass to 
   * the OptionTree Meta Box API Class.
   */
  $rdn_slide_mb_array = array(
    'id'          => 'rdn_slider_meta_box',
    'title'       => __( 'Slider Setting', 'cordon_plg' ),
    'desc'        => '',
    'pages'       => array( 'rdn-slider' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(



	  array(
        'id'          => 'slider_list',
        'label'       => esc_html__('Homepage Slider List', 'cordon_plg' ),
        'desc'        => esc_html__('Create your slider list here.<br/> For homepage with video/youtube background <b>the slider images will appear on touch devices</b> (replacing the video/youtube video).', 'cordon_plg' ),
        'std'         => '',
        'type'        => 'list-item',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array( 

          array(
            'id'          => 'slider_image',
            'label'       => esc_html__('Slider Image', 'cordon_plg' ),
            'desc'        => esc_html__('Upload your slider image here.', 'cordon_plg' ),
            'std'         => '',
            'type'        => 'upload',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),

          array(
            'id'          => 'bottom_text',
            'label'       => esc_html__('Slider Bottom Text', 'cordon_plg' ),
            'desc'        => esc_html__('Input your slider bottom text here.', 'cordon_plg' ),
            'std'         => '',
            'type'        => 'textarea-simple',
            'rows'        => '5',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
		  array(
            'id'          => 'slider_text',
            'label'       => esc_html__('Slider Text Button', 'cordon_plg' ),
            'desc'        => esc_html__('Input your text for button here.( leave it blank if you don\'t want it)', 'cordon_plg' ),
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
		  		  array(
            'id'          => 'slider_link',
            'label'       => esc_html__( 'Slider Link Button', 'cordon_plg' ),
            'desc'        => esc_html__( 'Input your slider button link here( leave it blank if you don\'t want it)', 'cordon_plg' ),
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
		  
        )
      ),
	
	  array(
        'label'       => __( 'Parallax Slider', 'cordon_plg' ),
		'desc'        => esc_html__('If you want to use this slider inside the page/not at the very top of the page, please turn off the parallax to prevent any display error in slider.', 'cordon_plg' ),
        'id'          => 'para_slide',
        'type'        => 'on-off',
		'std'		 => 'off'
      ),
	  array(
        'label'       => __( 'Parallax Ratio', 'cordon_plg' ),
        'id'          => 'para_ratio',
        'type'        => 'numeric-slider',
		'std'         => '0.8',
		'min_max_step'=> '0,2,0.1',
        'desc'        => __( 'Set your parallax ratio here. <br>Try to play with the right value here. Default/recomennded value is <strong>0.8</strong>.', 'cordon_plg' ),
        'condition'   => 'para_slide:is(on)'
      ),
      array(
        'id'          => 'slider_delay',
        'label'       => esc_html__('Homepage Slider Delay', 'cordon_plg' ),
        'desc'        => esc_html__('Set your slider delay here.', 'cordon_plg' ),
        'std'         => '10000',
        'type'        => 'numeric-slider',
        'section'     => 'slider_sectio',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '1,10000,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
    )
  );
  
  /**
   * Register our meta boxes using the 
   * ot_register_meta_box() function.
   */
  if ( function_exists( 'ot_register_meta_box' ) )
    ot_register_meta_box( $rdn_slide_mb_array );

}

