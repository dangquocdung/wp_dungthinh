<?php
/**
 * List - Shortcode Options
 */
add_action( 'init', 'ence_list_vc_map' );
if ( ! function_exists( 'ence_list_vc_map' ) ) {
  function ence_list_vc_map() {
    vc_map( array(
      "name" => esc_html__( "List", 'eunice-core'),
      "base" => "ence_list",
      "description" => esc_html__( "List Styles", 'eunice-core'),
      "icon" => "fa fa-list color-red",
      "category" => EuniceLib::ence_cat_name(),
      "params" => array(
        array(
          'type' => 'textfield',
          'value' => '',
          'admin_label' => true,
          'heading' => esc_html__( 'Title', 'eunice-core' ),
          'param_name' => 'title',
        ),
        // List
        array(
          'type' => 'param_group',
          'value' => '',
          'heading' => esc_html__( 'Lists', 'eunice-core' ),
          'param_name' => 'list_items',
          // Note params is mapped inside param-group:
          'params' => array(
            array(
              'type' => 'textfield',
              'value' => '',
              'admin_label' => true,
              'heading' => esc_html__( 'Title', 'eunice-core' ),
              'param_name' => 'list_title',
            ),
            array(
              'type' => 'textfield',
              'value' => '',
              'heading' => esc_html__( 'URL', 'eunice-core' ),
              'param_name' => 'list_url',
              'edit_field_class'  => 'vc_col-md-6 vc_column vt_field_space',
            ),
            array(
              "type" => "switcher",
              "heading" => __( "Open New Tab?", 'eunice-core' ),
              "param_name" => "open_link",
              "std" => false,
              'value' => '',
              "on_text" => __( "Yes", 'eunice-core' ),
              "off_text" => __( "No", 'eunice-core' ),
              'edit_field_class'  => 'vc_col-md-6 vc_column vt_field_space',
            ),

          )
        ),
        EuniceLib::vt_class_option(),

        // Style
        array(
          'type' => 'colorpicker',
          'value' => '',
          'heading' => esc_html__( 'Title Color', 'eunice-core' ),
          'param_name' => 'title_color',
          'group' => esc_html__( 'Style', 'eunice-core' ),
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
          'description' => esc_html__( 'Pick your title color.', 'eunice-core' ),
        ),
        array(
          'type' => 'textfield',
          'value' => '',
          'heading' => esc_html__( 'Title Size', 'eunice-core' ),
          'param_name' => 'title_size',
          'group' => esc_html__( 'Style', 'eunice-core' ),
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
          'description' => esc_html__( 'Enter the px value.', 'eunice-core' ),
        ),
        array(
          'type' => 'colorpicker',
          'value' => '',
          'heading' => esc_html__( 'Text Color', 'eunice-core' ),
          'param_name' => 'text_color',
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
          'group' => esc_html__( 'Style', 'eunice-core' ),
        ),
        array(
          'type' => 'textfield',
          'value' => '',
          'heading' => esc_html__( 'Text Size', 'eunice-core' ),
          'param_name' => 'text_size',
          'group' => esc_html__( 'Style', 'eunice-core' ),
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
          'description' => esc_html__( 'Enter the px value.', 'eunice-core' ),
        ),

      )
    ) );
  }
}
