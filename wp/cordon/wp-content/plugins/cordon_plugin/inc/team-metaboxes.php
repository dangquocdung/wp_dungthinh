<?php
/**
 * Initialize the Team Post Meta Boxes. 
 */
add_action( 'admin_init', 'team_mb' );
function team_mb() {
  
  /**
   * Create a custom meta boxes array that we pass to 
   * the OptionTree Meta Box API Class.
   */
  $teamp_mb = array(
    'id'          => 'team_meta_box',
    'title'       => __( 'Team Post Setting', 'cordon_plg' ),
    'desc'        => '',
    'pages'       => array( 'team-post' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(



	  array(
        'id'          => 'team_cp',
        'label'        => __( 'Recommended size for team featured image is 800x582px. Try to use the same size/ratio for each team images.', 'cordon_plg' ),
		'desc'        => '',
        'std'         => '',
        'type'        => 'textblock-titled',
      ),

	  
      array(
        'label'       => __( 'Team Position', 'cordon_plg' ),
        'id'          => 'tp_post',
        'type'        => 'text',
        'desc'        => __( 'Input team position here.', 'cordon_plg' ),
      ),

	   array(
        'label'       => __( 'Facebook link', 'cordon_plg' ),
        'id'          => 'fb_si',
        'type'        => 'text',
        'desc'        => __( 'Input link for Facebook', 'cordon_plg' ),
      ),
	  array(
        'label'       => __( 'Twitter link', 'cordon_plg' ),
        'id'          => 'twit_si',
        'type'        => 'text',
        'desc'        => __( 'Input link for Twitter', 'cordon_plg' )
      ),
	  array(
        'label'       => __( 'Pinterest link', 'cordon_plg' ),
        'id'          => 'pinterest_si',
        'type'        => 'text',
        'desc'        => __( 'Input link for Pintereset', 'cordon_plg' )
      ),
	  array(
        'label'       => __( 'Google Plus link', 'cordon_plg' ),
        'id'          => 'gp_si',
        'type'        => 'text',
        'desc'        => __( 'Input link for Google Plus', 'cordon_plg' )
      ),
	  array(
        'label'       => __( 'Instagram link', 'cordon_plg' ),
        'id'          => 'instagram_si',
        'type'        => 'text',
        'desc'        => __( 'Input link for Instagram', 'cordon_plg' )
      ),
	  array(
        'label'       => __( 'Xing link', 'cordon_plg' ),
        'id'          => 'xing_si',
        'type'        => 'text',
        'desc'        => __( 'Input link for Xing', 'cordon_plg' )
      ),
	  array(
        'label'       => __( 'Another Social icon list', 'cordon_plg' ),
        'id'          => 'another_si',
        'type'        => 'list-item',
        'desc'        => __( 'Create another social icon list here.', 'cordon_plg' ),
		'settings'    => array( 
          array(
            'id'          => 'si_icon',
            'label'       => __( 'Social Icon', 'cordon_plg' ),
            'desc'        => __( 'Input your social icon here. <br/> You can check <a href="http://fontawesome.io/icons/" target="_blank">Here</a> for icon list. eg. fa-github', 'cordon_plg' ),
            'type'        => 'text',
          ),
		  array(
            'id'          => 'si_icon_link',
            'label'       => __( 'Social Icon Link', 'cordon_plg' ),
            'desc'        => __( 'Input your social icon link here.', 'cordon_plg' ),
            'type'        => 'text',
          ),
		)
      ),
	  array(
        'label'       => __( 'Email link', 'cordon_plg' ),
        'id'          => 'email_si',
        'type'        => 'text',
        'desc'        => __( 'Input email here(email address only,without mailto:)', 'cordon_plg' )
      ),
    )
  );
  
  /**
   * Register our meta boxes using the 
   * ot_register_meta_box() function.
   */
  if ( function_exists( 'ot_register_meta_box' ) )
    ot_register_meta_box( $teamp_mb );

}