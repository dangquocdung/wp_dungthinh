<?php
/**
 * Initialize the About Post Meta Boxes. 
 */
add_action( 'admin_init', 'client_mb' );
function client_mb() {
  
  /**
   * Create a custom meta boxes array that we pass to 
   * the OptionTree Meta Box API Class.
   */
  $client_mb = array(
    'id'          => 'rdn_testi_meta',
    'title'       => __( 'Testimonial Setting', 'cordon_plg' ),
    'desc'        => '',
    'pages'       => array( 'client' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
		array(
			'id'          => 'client_img',
			'label'       => esc_html__('Client Image', 'cordon_plg' ),
			'desc'        => esc_html__('Upload You client image here.', 'cordon_plg' ),
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

    )
  );
  
  /**
   * Register our meta boxes using the 
   * ot_register_meta_box() function.
   */
  if ( function_exists( 'ot_register_meta_box' ) )
    ot_register_meta_box( $client_mb );

}

