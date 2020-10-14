<?php
/**
 * Initialize the custom theme options.
 */
add_action( 'admin_init', 'cordon_custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 */
function cordon_custom_theme_options() {
  
  /* OptionTree is not loaded yet */
  if ( ! function_exists( 'ot_settings_id' ) )
    return false;
    
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( ot_settings_id(), array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array( 
    'contextual_help' => array( 
      'sidebar'       => ''
    ),
    'sections'        => array( 
      array(
        'id'          => 'general',
        'title'       => esc_html__('General Setting', 'cordon' )
      ),
	  array(
        'id'          => 'social_icon_section',
        'title'       => esc_html__('Social Icon Setting', 'cordon' )
      ),
   

	  array(
        'id'          => 'page_sections_setting',
        'title'       => esc_html__('Page Setting', 'cordon' )
      ),
	  array(
        'id'          => 'footer_section',
        'title'       => esc_html__('Footer Setting', 'cordon' )
      ),

	  
    ),
    'settings'        => array( 

	  array(
        'id'          => 'style_tab',
        'label'       => esc_html__('Style Setting', 'cordon' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'theme_style',
        'label'       => esc_html__('Theme style', 'cordon' ),
        'desc'        => esc_html__('Choose theme style here. The default is Light Style', 'cordon' ),
        'std'         => 'light',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'light',
            'label'       => esc_html__('Light Style', 'cordon' ),
            'src'         => ''
          ),
          array(
            'value'       => 'dark',
            'label'       => esc_html__('Dark Style', 'cordon' ),
            'src'         => ''
          )
        )
      ),
	  array(
        'id'          => 'color_general',
        'label'       => esc_html__('Color Scheme', 'cordon' ),
        'desc'        => esc_html__('Pick your color scheme. Default color is #ff1744 ', 'cordon' ),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'color_scheme',
        'label'       => esc_html__('Hyperlink Color', 'cordon' ),
        'desc'        => esc_html__('Pick your color for hyperlink. Default color is black #999999', 'cordon' ),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'custom_hovers',
        'label'       => esc_html__('Hyperlink color on hover state', 'cordon' ),
        'desc'        => esc_html__('Pick your color for hover state in hyperlink. Default color is #ff1744', 'cordon' ),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'heading_color',
        'label'       => esc_html__('Color on Heading', 'cordon' ),
        'desc'        => esc_html__('Pick your color for heading text. Default color is black #000000', 'cordon' ),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'general_color',
        'label'       => esc_html__('Color on General Paragraph', 'cordon' ),
        'desc'        => esc_html__('Pick your color for general paragraph text. Default color is black #939393', 'cordon' ),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

	  array(
        'id'          => 'footer_color',
        'label'       => esc_html__('Footer Background color', 'cordon' ),
        'desc'        => esc_html__('Pick your background color for footer. Default color is black #000000', 'cordon' ),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'stick_menu',
        'label'       => esc_html__('Sticky Menu Background color', 'cordon' ),
        'desc'        => esc_html__('Pick your background color for sticky menu in white text header. Default color is #1f1f1f', 'cordon' ),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'logo_tab',
        'label'       => esc_html__('Logo', 'cordon' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'logo_img',
        'label'       => esc_html__('Logo White Text Upload', 'cordon' ),
        'desc'        => esc_html__('Upload your logo for white text header and dark style theme.<br> Recommended size 240x80px', 'cordon' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'logo_black',
        'label'       => esc_html__('Logo Black Text Upload', 'cordon' ),
        'desc'        => esc_html__('Upload your logo only for black text header here.<br> Recommended size 240x80px', 'cordon' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  
      array(
        'id'          => 'favicon_logo',
        'label'       => esc_html__('Favicon Logo', 'cordon' ),
        'desc'        => esc_html__('Upload your favicon here. Recommended size 30x30px', 'cordon' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'touch_logo',
        'label'       => esc_html__('Touch Logo', 'cordon' ),
        'desc'        => esc_html__('Upload your touch logo here. Recommended size 129x129px', 'cordon' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'preload_tab',
        'label'       => esc_html__('Preloader', 'cordon' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'preloader_set',
        'label'       => esc_html__('Preloader Setting', 'cordon' ),
        'desc'        => esc_html__('Choose Loader setting', 'cordon' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'show_home',
            'label'       => esc_html__('Show in Homepage only', 'cordon' ),
            'src'         => ''
          ),
          array(
            'value'       => 'show_all',
            'label'       => esc_html__('Show in All pages', 'cordon' ),
            'src'         => ''
          ),
          array(
            'value'       => 'hide_in_all',
            'label'       => esc_html__('Hide in All Pages', 'cordon' ),
            'src'         => ''
          )
        )
      ),

      array(
        'id'          => 'loader_color',
        'label'       => esc_html__('Preloader Background Color', 'cordon' ),
        'desc'        => esc_html__('Choose your background color for preloader', 'cordon' ),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'soc_head',
        'label'       => esc_html__('Social icon on Header', 'cordon' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'social_icon_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'soc_tabhead_text',
        'label'       => esc_html__('Set your social icon here.', 'cordon' ),
        'desc'        => esc_html__('This social icon list will appear on the header. <br/>Recommended only use max 4 social icon on header to prevent any error layout in menu.', 'cordon' ),
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'social_icon_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'fb_head',
        'label'       => esc_html__('Facebook Link', 'cordon' ),
        'desc'        => esc_html__('Input facebook link here', 'cordon' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_icon_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'gp_head',
        'label'       => esc_html__('Google Plus Link', 'cordon' ),
        'desc'        => esc_html__('Input google plus link here', 'cordon' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_icon_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'twit_head',
        'label'       => esc_html__('Twitter Link', 'cordon' ),
        'desc'        => esc_html__('Input twitter link here', 'cordon' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_icon_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'pint_head',
        'label'       => esc_html__('Pinterest Link', 'cordon' ),
        'desc'        => esc_html__('Input pinterest link here', 'cordon' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_icon_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'insta_head',
        'label'       => esc_html__('Instagram Link', 'cordon' ),
        'desc'        => esc_html__('Input instagram link here', 'cordon' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_icon_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'xing_head',
        'label'       => esc_html__('Xing Link', 'cordon' ),
        'desc'        => esc_html__('Input xing link here', 'cordon' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_icon_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'head_as_icon',
        'label'       => esc_html__('Another Social Icon', 'cordon' ),
        'desc'        => esc_html__('Create list for another social icon.', 'cordon' ),
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'social_icon_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array( 
          array(
            'id'          => 'head_soc_icon',
            'label'       => esc_html__('Social Icon', 'cordon' ),
            'desc'        => esc_html__('Input your social icon here. <br /> You can check <a target="_blank" href="http://fontawesome.io/icons/">Here</a> for icon list. eg. fa-github', 'cordon' ),
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
            'id'          => 'head_as_link',
            'label'       => esc_html__('Social Icon Link', 'cordon' ),
            'desc'        => esc_html__('Input social icon link here', 'cordon' ),
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          )
        )
      ),
	  array(
        'id'          => 'soc_foot',
        'label'       => esc_html__('Social Icon on Footer', 'cordon' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'social_icon_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'soc_tab_text',
        'label'       => esc_html__('Set your social icon here.', 'cordon' ),
        'desc'        => esc_html__('This social icon list will appear on the footer.', 'cordon' ),
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'social_icon_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'fb_foot',
        'label'       => esc_html__('Facebook Link', 'cordon' ),
        'desc'        => esc_html__('Input facebook link here', 'cordon' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_icon_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'gp_foot',
        'label'       => esc_html__('Google Plus Link', 'cordon' ),
        'desc'        => esc_html__('Input google plus link here', 'cordon' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_icon_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'twit_foot',
        'label'       => esc_html__('Twitter Link', 'cordon' ),
        'desc'        => esc_html__('Input twitter link here', 'cordon' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_icon_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'pint_foot',
        'label'       => esc_html__('Pinterest Link', 'cordon' ),
        'desc'        => esc_html__('Input pinterest link here', 'cordon' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_icon_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'insta_link',
        'label'       => esc_html__('Instagram Link', 'cordon' ),
        'desc'        => esc_html__('Input instagram link here', 'cordon' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_icon_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'xing_foot',
        'label'       => esc_html__('Xing Link', 'cordon' ),
        'desc'        => esc_html__('Input xing link here', 'cordon' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_icon_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'foot_as_icon',
        'label'       => esc_html__('Another Social Icon', 'cordon' ),
        'desc'        => esc_html__('Create list for another social icon.', 'cordon' ),
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'social_icon_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array( 
          array(
            'id'          => 'foot_soc_icon',
            'label'       => esc_html__('Social Icon', 'cordon' ),
            'desc'        => esc_html__('Input your social icon here. <br /> You can check <a target="_blank" href="http://fontawesome.io/icons/">Here</a> for icon list. eg. fa-github', 'cordon' ),
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
            'id'          => 'foot_as_link',
            'label'       => esc_html__('Social Icon Link', 'cordon' ),
            'desc'        => esc_html__('Input social icon link here', 'cordon' ),
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          )
        )
      ),

	  array(
        'label'       => esc_html__( 'Footer Style', 'cordon' ),
        'id'          => 'footer_style',
        'type'        => 'select',
		'section'     => 'footer_section',
		'std'		 => 'top_content',
		'choices'     => array( 
			  array(
                'value'       => 'foot_standard',
                'label'       => esc_html__( 'Standard Footer', 'cordon' )
              ),
			  array(
                'value'       => 'foot_fixed',
                'label'       => esc_html__( 'Fixed Footer', 'cordon' )
              )
		)
      ),
	  array(
        'id'          => 'foot_img',
        'label'       => esc_html__('Footer Image', 'cordon' ),
        'desc'        => esc_html__('Upload your footer image here. Recommended size 240x120px', 'cordon' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'footer_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'fot_text',
        'label'       => esc_html__('Footer Text', 'cordon' ),
        'desc'        => esc_html__('Input footer text here. You can use HTML tag here.', 'cordon' ),
        'std'         => '',
        'type'        => 'textarea-simple',
		'rows'        => '3',
        'section'     => 'footer_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	
	
	  


	 array(
        'id'          => 'port_tab',
        'label'       => esc_html__('Portfolio Page', 'cordon' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'page_sections_setting',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'portfolios_all',
        'label'       => esc_html__('Portfolio Text Filter for all categories', 'cordon' ),
        'desc'        => esc_html__('Insert your text for portfolio filter for all categories. The default text is "All"', 'cordon' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'page_sections_setting',
        'rows'        => '3',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'port_ani',
        'label'       => esc_html__('Portfolio Animation', 'cordon' ),
        'desc'        => esc_html__('You can turn the portfolio animation(swipe) off here.', 'cordon' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'page_sections_setting',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'port_delay',
        'label'       => esc_html__('Portfolio delay animation', 'cordon' ),
        'desc'        => esc_html__('Insert your portfolio delay (increment) for each portofolio item here. The default value is 0.2', 'cordon' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'page_sections_setting',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'port_ani:is(on)',
        'operator'    => 'and'
      ),
	   array(
        'id'          => 'other_port_title',
        'label'       => esc_html__( 'Other Portfolio Section Title', 'cordon' ),
        'desc'        => esc_html__( 'Insert your text for title of other portfolio section on single portfolio page.<br/>Leave it blank if you want to use the default text.', 'cordon' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'page_sections_setting',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'other_port_sub',
        'label'       => esc_html__( 'Other Portfolio Section Subtitle', 'cordon' ),
        'desc'        => esc_html__( 'Insert your text for subt title of other portfolio section on single portfolio page.<br/>Leave it blank if you want to use the default text.', 'cordon' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'page_sections_setting',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'blog_tab',
        'label'       => esc_html__('Blog Page', 'cordon' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'page_sections_setting',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

	  
	  array(
        'id'          => 'blog_slide_delay',
        'label'       => esc_html__( 'Blog Slider Delay', 'cordon' ),
        'desc'        => esc_html__( 'Insert the slider delay for all slider in blog page here. The default value 8000', 'cordon' ),
        'std'         => '8000',
        'type'        => 'numeric-slider',
        'section'     => 'page_sections_setting',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '1,10000,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( ot_settings_id(), $custom_settings ); 
  }
  
  /* Lets OptionTree know the UI Builder is being overridden */
  global $ot_has_custom_theme_options;
  $ot_has_custom_theme_options = true;
  
}