<?php
/**
 * Initialize the Portfolio Post Meta Boxes. 
 */
add_action( 'admin_init', 'portfolio_mb' );
function portfolio_mb() {
  
  /**
   * Create a custom meta boxes array that we pass to 
   * the OptionTree Meta Box API Class.
   */
  $portfolio_mb = array(
    'id'          => 'portfolio_meta_box',
    'title'       => esc_html__( 'Portfolio Setting', 'cordon_plg' ),
    'desc'        => '',
    'pages'       => array( 'portfolio' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
  
      array(
        'label'       => esc_html__( 'Portfolio Format Setting', 'cordon_plg' ),
        'id'          => 'portfolio_format',
        'type'        => 'tab',
      ),
	  array(
        'id'          => 'port_setting_block',
        'label'       => esc_html__('Try to use the same ratio/size for each featured images.', 'cordon_plg' ),
        'desc'        => esc_html__('Recommended size for portfolio featured images is 800x582px', 'cordon_plg' ),
        'std'         => '',
        'type'        => 'textblock-titled',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  
	  array(
        'label'       => esc_html__( 'Choose Portfolio Format Here', 'cordon_plg' ),
        'id'          => 'port_format',
        'type'        => 'select',
		'std'		 => 'port_standard',
		'choices'     => array( 
			  array(
                'value'       => 'port_standard',
                'label'       => esc_html__( 'Portfolio Gallery at Top', 'cordon_plg' )
              ),
			  array(
                'value'       => 'port_two',
                'label'       => esc_html__( 'Portfolio Gallery at Right', 'cordon_plg' )
              ),
		)
      ),
	 
	  array(
        'label'       => esc_html__( 'Portfolio Bottom Title Text', 'cordon_plg' ),
        'id'          => 'port_text_bottom',
        'type'        => 'textarea-simple',
		'condition'   => 'port_format:is(port_two)',
		'rows'        => '4',
        'desc'        => esc_html__( 'Inser the bottom title text here. The bottom text will appear on single portfolio page below the title.', 'cordon_plg' ),
      ),
	  
	  array(
        'label'       => esc_html__( 'Top Content Format', 'cordon_plg' ),
        'id'          => 'top_type',
        'type'        => 'select',
		'condition'   => 'port_format:is(port_two)',
		'std'		 => 'top_content_slider',
		'desc'        => esc_html__( 'Choose the content that will appear on the top of the single portfolio page.', 'cordon_plg' ),
		'choices'     => array( 
			  array(
                'value'       => 'top_content_slider',
                'label'       => esc_html__( 'Images Background', 'cordon_plg' )
              ),
			  array(
                'value'       => 'top_content_video',
                'label'       => esc_html__( 'Video Background', 'cordon_plg' )
              ),
			  array(
                'value'       => 'top_content_youtube',
                'label'       => esc_html__( 'Youtube Background', 'cordon_plg' )
              )
		)
      ),
	  
	  array(
        'label'       => esc_html__( 'Portfolio Top Image', 'cordon_plg' ),
        'id'          => 'port_slider_setting',
        'type'        => 'upload',
        'desc'        => esc_html__( 'Upload Your Top Image here. <br/>You still need to fill this if you choose the video/youtube background. <br/>
		So the image will replace the video/youtube background in touch devices. ', 'cordon_plg' ),
        'condition'   => 'port_format:is(port_two)'
      ),
	  array(
        'label'       => esc_html__( 'Youtube ID', 'cordon_plg' ),
        'id'          => 'port_youtube_link',
        'type'        => 'text',
        'desc'        => esc_html__( 'Insert Youtube ID here. e.g EMy5krGcoOU', 'cordon_plg' ),
        'condition'   => 'port_format:is(port_two),top_type:is(top_content_youtube)'
      ),
	  array(
        'label'       => esc_html__( 'Youtube Quality', 'cordon_plg' ),
        'id'          => 'port_youtube_quality',
        'type'        => 'text',
        'desc'        => esc_html__( 'Insert Youtube video quality here. You can input <b>small, medium, large, hd720, hd1080, highres</b>. Default value is <b>large</b>', 'cordon_plg' ),
        'condition'   => 'port_format:is(port_two),top_type:is(top_content_youtube)'
      ),
	  array(
        'label'       => esc_html__( 'Video Link', 'cordon_plg' ),
        'id'          => 'port_video_link',
        'type'        => 'text',
        'desc'        => esc_html__( 'Insert the video directlink here. eg. https://www.quirksmode.org/html5/videos/big_buck_bunny.mp4', 'cordon_plg' ),
        'condition'   => 'port_format:is(port_two),top_type:is(top_content_video)'
      ),


	  array(
        'id'          => 'gallery_list',
        'label'       => esc_html__('Portfolio Gallery Images', 'cordon_plg' ),
        'desc'        => esc_html__('Create your gallery here.', 'cordon_plg' ),
        'type'        => 'list-item',
        'operator'    => 'and',
        'settings'    => array( 

          array(
            'id'          => 'gallery_port_img',
            'label'       => esc_html__('Slider Image', 'cordon_plg' ),
            'desc'        => esc_html__('Upload your gallery image here.', 'cordon_plg' ),
            'type'        => 'upload',
          ),
		  array(
            'id'          => 'gallery_size',
            'label'       => esc_html__('Image Gallery Size', 'cordon_plg' ),
            'desc'        => esc_html__('Choose your image size here.', 'cordon_plg' ),
			'type'        => 'select',
			'std'		 => 'gallery_size_standard',
			'choices'     => array( 
				  array(
					'value'       => 'gallery_size_standard',
					'label'       => esc_html__( 'Default Size', 'cordon_plg' )
				  ),
				  array(
					'value'       => 'gallery_size_big',
					'label'       => esc_html__( 'Big Size', 'cordon_plg' )
				  ),
			)
          ),
		  
        )
      ),
	  array(
        'label'       => esc_html__( 'Use Banner', 'cordon_plg' ),
        'id'          => 'port_banner',
        'type'        => 'on-off',
		'std'		 => 'off',
        'desc'        => esc_html__( 'Turn on if you want to use banner at the bottom of single portfolio page.', 'cordon_plg' ),
      ),
	  array(
        'label'       => esc_html__( 'Image for Banner', 'cordon_plg' ),
        'id'          => 'port_img_banner',
        'type'        => 'upload',
        'desc'        => esc_html__( 'Upload the image for banner here.', 'cordon_plg' ),
        'condition'   => 'port_banner:is(on)'
      ),
	  array(
        'label'       => esc_html__( 'Banner Title', 'cordon_plg' ),
        'id'          => 'port_text_banner',
        'type'        => 'text',
		'rows'        => '5',
        'desc'        => esc_html__( 'Insert the banner title here.', 'cordon_plg' ),
        'condition'   => 'port_banner:is(on)'
      ),
	  array(
        'label'       => esc_html__( 'Banner Button Text', 'cordon_plg' ),
        'id'          => 'banner_btn_text',
        'type'        => 'text',
		'rows'        => '5',
        'desc'        => esc_html__( 'Insert the banner button text here. Leave it blank if you don\'t want it.', 'cordon_plg' ),
        'condition'   => 'port_banner:is(on)'
      ),
	  array(
        'label'       => esc_html__( 'Banner Button Link', 'cordon_plg' ),
        'id'          => 'banner_btn_link',
        'type'        => 'text',
		'rows'        => '5',
        'desc'        => esc_html__( 'Insert the banner button link here. Leave it blank if you don\'t want it.', 'cordon_plg' ),
        'condition'   => 'port_banner:is(on)'
      ),
	  array(
		'id'          => 'banner_position',
		'label'       => esc_html__('Banner Image Position', 'cordon_plg' ),
		'desc'        => esc_html__('Choose your banner Image position.', 'cordon_plg' ),
		'type'        => 'select',
		'condition'   => 'port_banner:is(on)',
		'std'		 => 'right',
		'choices'     => array( 
			  array(
				'value'       => 'right',
				'label'       => esc_html__( 'Right Side', 'cordon_plg' )
			  ),
			  array(
				'value'       => 'left',
				'label'       => esc_html__( 'Left Side', 'cordon_plg' )
			  ),
		)
	  ),
	  array(
		'id'          => 'banner_scheme',
		'label'       => esc_html__('Banner Color Scheme', 'cordon_plg' ),
		'desc'        => esc_html__('Choose your banner color scheme.', 'cordon_plg' ),
		'type'        => 'select',
		'condition'   => 'port_banner:is(on)',
		'std'		 => 'white',
		'choices'     => array( 
			  array(
				'value'       => 'white',
				'label'       => esc_html__( 'White Background', 'cordon_plg' )
			  ),
			  array(
				'value'       => 'color',
				'label'       => esc_html__( 'Theme Background Color', 'cordon_plg' )
			  ),
			  array(
				'value'       => 'dark',
				'label'       => esc_html__( 'Dark Background', 'cordon_plg' )
			  ),
		)
	  ),
	  array(
        'label'       => esc_html__( 'Portfolio Detail Setting', 'cordon_plg' ),
        'id'          => 'port_detail_tab',
        'type'        => 'tab',
      ),
	  
	  array(
        'label'       => esc_html__( 'Portfolio Button Link', 'cordon_plg' ),
        'id'          => 'port_item_btn_link',
        'type'        => 'text',
        'desc'        => esc_html__( 'Insert your button link here. Leave it blank if you dont want it.', 'cordon_plg' ),
      ),
	  array(
        'label'       => esc_html__( 'Portfolio Button Text', 'cordon_plg' ),
        'id'          => 'port_item_btn_text',
        'type'        => 'text',
        'desc'        => esc_html__( 'Insert your button text here. Leave it blank if you dont want it.', 'cordon_plg' ),
      ),
    )
  );
  
  /**
   * Register our meta boxes using the 
   * ot_register_meta_box() function.
   */
  if ( function_exists( 'ot_register_meta_box' ) )
    ot_register_meta_box( $portfolio_mb );

}

