<?php
/**
 * Contact - Shortcode Options
 */
add_action( 'init', 'contact_vc_map' );
if ( ! function_exists( 'contact_vc_map' ) ) {
  function contact_vc_map() {
    $cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );
    $contact_forms = array();
    if ( $cf7 ) {
      foreach ( $cf7 as $cform ) {
        $contact_forms[ $cform->post_title ] = $cform->ID;
      }
    } else {
      $contact_forms[ esc_html__( 'No contact forms found', 'js_composer' ) ] = 0;
    }

    vc_map( array(
    "name" => esc_html__( "Eunice : Contact Form 7", 'eunice-core'),
    "base" => "ence_contact",
    "icon" => "icon-wpb-contactform7",
    "category" => EuniceLib::ence_cat_name(),
    "params" => array(
      array(
        'type' => 'dropdown',
        'heading' => esc_html__( 'Select contact form', 'js_composer' ),
        'param_name' => 'id',
        'value' => $contact_forms,
        'save_always' => true,
        'admin_label' => true,
        'description' => esc_html__( 'Choose previously created contact form from the drop down list.', 'js_composer' ),
      ),
      array(
        'type' => 'textfield',
        'value' => '',
        'heading' => esc_html__( 'Title', 'eunice-core' ),
        'description' => esc_html__( 'Enter Form title for your contact form.', 'eunice-core' ),
        'param_name' => 'form_title',
      ),
      EuniceLib::vt_class_option(),

      array(
        'type' => 'textarea',
        'value' => '',
        'heading' => esc_html__( 'Form Description', 'eunice-core' ),
        'description' => esc_html__( 'Enter description that shows below title.', 'eunice-core' ),
        'param_name' => 'description',
      ),
      array(
        'type' => 'param_group',
        'value' => '',
        'heading' => esc_html__( 'Address Title one', 'eunice-core' ),
        'param_name' => 'contact_adrs',
        'params' => array(
          array(
            'type' => 'textfield',
            'value' => '',
            'heading' => 'Ender Address Title',
            'param_name' => 'adrs_titl',
          ),
          array(
            'type' => 'textarea',
            'value' => '',
            'heading' => 'Ender Address Info',
            'param_name' => 'adrs_contact',
          )
          )
      ),

      ), // Params
    ) );
  }
}