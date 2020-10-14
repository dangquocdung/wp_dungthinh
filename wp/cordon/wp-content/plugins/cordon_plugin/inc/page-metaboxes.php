<?php
/**
 * Initialize the Post Post Meta Boxes. 
 */
add_action( 'admin_init', 'cordon_page_mb' );
function cordon_page_mb() {
  
  /**
   * Create a custom meta boxes array that we pass to 
   * the OptionTree Meta Box API Class.
   */
  $cordon_page_mb = array(
    'id'          => 'page_meta_box',
    'title'       => esc_html__( 'Page Settings', 'cordon_plg' ),
    'desc'        => '',
    'pages'       => array( 'page','portfolio' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
	  array(
        'label'       => esc_html__( 'Header Format', 'cordon_plg' ),
		'desc'          =>  esc_html__( 'The Black text settings doesn\'t affect if you use dark color scheme <br> 
		The header will always be using white text, but you can still use the different menu position ( <b>relative/absolute</b> ).<br/>
		<b>This settings won\'t apply on any Blog Template & Default Template.</b> ', 'cordon_plg' ),
        'id'          => 'menu_format',
        'type'        => 'select',
		'std'		 => 'head_clean',
		'choices'     => array( 
			  array(
                'value'       => 'head_clean',
                'label'       => esc_html__( 'Black Text with White Background Header in Relative Position', 'cordon_plg' )
              ),
			  array(
                'value'       => 'head_standard',
                'label'       => esc_html__( 'White Text with Transparent Background Header in Absolute Position', 'cordon_plg' )
              ),
			  
		)
      ),
	  
    )
  );
  
  /**
   * Register our meta boxes using the 
   * ot_register_meta_box() function.
   */
  if ( function_exists( 'ot_register_meta_box' ) )
    ot_register_meta_box( $cordon_page_mb );

}

