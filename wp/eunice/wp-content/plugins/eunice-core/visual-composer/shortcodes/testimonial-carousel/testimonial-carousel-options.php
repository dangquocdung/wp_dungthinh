<?php
/**
 * Testimonial Carousel - Shortcode Options
 */
add_action( 'init', 'testimonial_carousel_vc_map' );
if ( ! function_exists( 'testimonial_carousel_vc_map' ) ) {
  function testimonial_carousel_vc_map() {
    vc_map( array(
    "name" => __( "Testimonial Carousel", 'eunice-core'),
    "base" => "ence_testimonial_carousel",
    "description" => __( "Carousel Style Testimonial", 'eunice-core'),
    "icon" => "fa fa-comments color-green",
    "category" => EuniceLib::ence_cat_name(),
    "params" => array(
      array(
        "type"        =>'textfield',
        "heading"     =>__('Title', 'eunice-core'),
        "param_name"  => "title",
        "value"       => "",
        'admin_label' => true,
        "description" => __( "Enter the testimonial block title.", 'eunice-core'),
      ),
      array(
        "type"        => "notice",
        "heading"     => __( "Listing", 'eunice-core' ),
        "param_name"  => 'lsng_opt',
        'class'       => 'cs-warning',
        'value'       => '',
      ),
      array(
        "type"        =>'textfield',
        "heading"     =>__('Limit', 'eunice-core'),
        "param_name"  => "testimonial_limit",
        "value"       => "",
        'admin_label' => true,
        "description" => __( "Enter the number of items to show.", 'eunice-core'),
      ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Order', 'eunice-core' ),
        'value' => array(
          __( 'Select Testimonial Order', 'eunice-core' ) => '',
          __('Asending', 'eunice-core') => 'ASC',
          __('Desending', 'eunice-core') => 'DESC',
        ),
        'param_name' => 'testimonial_order',
        'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
      ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Order By', 'eunice-core' ),
        'value' => array(
          __('None', 'eunice-core') => 'none',
          __('ID', 'eunice-core') => 'ID',
          __('Author', 'eunice-core') => 'author',
          __('Title', 'eunice-core') => 'title',
          __('Date', 'eunice-core') => 'date',
        ),
        'param_name' => 'testimonial_orderby',
        'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
      ),
      EuniceLib::vt_class_option(),
      array(
        "type"        =>'colorpicker',
        "heading"     =>__('Title Color', 'eunice-core'),
        "param_name"  => "title_color",
        "value"       => "",
        "group"       => __('Style', 'eunice-core'),
        'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
      ),
      array(
        "type"        =>'colorpicker',
        "heading"     =>__('Content Color', 'eunice-core'),
        "param_name"  => "content_color",
        "value"       => "",
        "group"       => __('Style', 'eunice-core'),
        'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
      ),
      array(
        "type"        =>'colorpicker',
        "heading"     =>__('Name Color', 'eunice-core'),
        "param_name"  => "name_color",
        "value"       => "",
        "group"       => __('Style', 'eunice-core'),
        'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
      ),
      array(
        "type"        =>'colorpicker',
        "heading"     =>__('Profession Color', 'eunice-core'),
        "param_name"  => "profession_color",
        "value"       => "",
        "group"       => __('Style', 'eunice-core'),
        'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
      ),
      // Size
      array(
        "type"        =>'textfield',
        "heading"     =>__('Title Size', 'eunice-core'),
        "param_name"  => "title_size",
        "value"       => "",
        "group"       => __('Style', 'eunice-core'),
        'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
      ),
      array(
        "type"        =>'textfield',
        "heading"     =>__('Content Size', 'eunice-core'),
        "param_name"  => "content_size",
        "value"       => "",
        "group"       => __('Style', 'eunice-core'),
        'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
      ),
      array(
        "type"        =>'textfield',
        "heading"     =>__('Name Size', 'eunice-core'),
        "param_name"  => "name_size",
        "value"       => "",
        "group"       => __('Style', 'eunice-core'),
        'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
      ),
      array(
        "type"        =>'textfield',
        "heading"     =>__('Profession Size', 'eunice-core'),
        "param_name"  => "profession_size",
        "value"       => "",
        "group"       => __('Style', 'eunice-core'),
        'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
      ),

      ), // Params
    ) );
  }
}