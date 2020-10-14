<?php
/**
 * Initialize the About Post Meta Boxes. 
 */
add_action( 'admin_init', 'testi_mb' );
function testi_mb() {
  
  /**
   * Create a custom meta boxes array that we pass to 
   * the OptionTree Meta Box API Class.
   */
  $testi_mb = array(
    'id'          => 'rdn_testi_meta',
    'title'       => __( 'Testimonial Setting', 'cordon_plg' ),
    'desc'        => '',
    'pages'       => array( 'testimonial' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
		array(
			'id'          => 'testi_post',
			'label'       => esc_html__('Testimonial Author Position', 'cordon_plg' ),
			'desc'        => esc_html__('Input your text for testimonial author position/job here. <br/><b>The testimonial title</b> will be the testimonial author.', 'cordon_plg' ),
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
  );
  
  /**
   * Register our meta boxes using the 
   * ot_register_meta_box() function.
   */
  if ( function_exists( 'ot_register_meta_box' ) )
    ot_register_meta_box( $testi_mb );

}

