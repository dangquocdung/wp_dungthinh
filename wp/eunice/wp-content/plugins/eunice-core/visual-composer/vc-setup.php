<?php
/**
 * Visual Composer Related Functions
 */

// Init Visual Composer
if( ! function_exists( 'ence_init_vc_shortcodes' ) ) {
  function ence_init_vc_shortcodes() {
    if ( defined( 'WPB_VC_VERSION' ) ) {

      /* Visual Composer - Setup */
      require_once( EUNICE_SHORTCODE_BASE_PATH . '/lib/add-params.php' );
      require_once( EUNICE_SHORTCODE_BASE_PATH . '/pre_pages/pre-pages.php' );

      /* All Shortcodes */
      if (class_exists('WPBakeryVisualComposerAbstract')) {

        // Templates
        $dir = EUNICE_SHORTCODE_BASE_PATH . '/vc_templates';
        vc_set_shortcodes_templates_dir( $dir );

        /* Set VC editor as default in following post types */
        $list = array(
          'post',
          'page'
        );
        vc_set_default_editor_post_types( $list );

      } // class_exists

      // Add New Param - VC_Row
      $vc_row_attr = array(
        array(
          "type" => "switcher",
          "heading" => esc_html__( "Need Overlay Dotted Image?", 'eunice-core' ),
          "description" => esc_html__( "Enable it, if you want overlay dotted image.", 'eunice-core' ),
          "param_name" => "overlay_dotted",
          "on_text" => esc_html__( "Yes", 'eunice-core'),
          "off_text" => esc_html__( "No", 'eunice-core'),
          "group" => esc_html__( "Design Options", 'eunice-core'),
          "std" => false,
        ),
        array(
          "type" => "colorpicker",
          "heading" => esc_html__( "Overlay Color", 'eunice-core' ),
          "description" => esc_html__( "Pick your overlay color, make sure you've controlled opacity.", 'eunice-core' ),
          "param_name" => "overlay_color",
          "group" => esc_html__( "Design Options", 'eunice-core'),
        ),
      );
      vc_add_params( 'vc_row', $vc_row_attr );
      // Add New Param - VC_Column
      $vc_column_attr = array(
        array(
          'type' => 'dropdown',
          'value' => array(
            esc_html__( 'Text Left', 'eunice-core' ) => 'text-left',
            esc_html__( 'Text Right', 'eunice-core' ) => 'text-right',
            esc_html__( 'Text Center', 'eunice-core' ) => 'text-center',
          ),
          'heading' => esc_html__( 'Text Alignment', 'eunice-core' ),
          'param_name' => 'text_alignment',
        ),
      );
      vc_add_params( 'vc_column', $vc_column_attr );

    }
  }

  add_action( 'vc_before_init', 'ence_init_vc_shortcodes' );
}

/* Remove VC Teaser metabox */
if ( is_admin() ) {
  if ( ! function_exists('eunice_vt_remove_vc_boxes') ) {
    function eunice_vt_remove_vc_boxes(){
      $post_types = get_post_types( '', 'names' );
      foreach ( $post_types as $post_type ) {
        remove_meta_box('vc_teaser',  $post_type, 'side');
      }
    } // End function
  } // End if
  add_action('do_meta_boxes', 'eunice_vt_remove_vc_boxes');
}