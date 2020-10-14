<?php
/**
 * Team - Shortcode Options
 */
add_action( 'init', 'team_vc_map' );
if ( ! function_exists( 'team_vc_map' ) ) {
  function team_vc_map() {
  $teams = get_posts( 'post_type="teams"&numberposts=-1' );
  $team_members = array();
  if ( $teams ) {
    foreach ( $teams as $team ) {
      $team_members[ $team->post_title ] = $team->ID;
    }
  } else {
    $team_members[ esc_html__( 'No contact forms found', 'eunice-core' ) ] = 0;
  }
  vc_map( array(
    "name" => __( "Team", 'eunice-core'),
    "base" => "ence_team",
    "description" => __( "Team Style", 'eunice-core'),
    "icon" => "fa fa-users color-grey",
    "category" => EuniceLib::ence_cat_name(),
    "params" => array(
      array(
        "type" => "dropdown",
        "heading" => __( "Team Column", 'eunice-core' ),
        "param_name" => "team_column",
        "value" => array(
          __('Column Three', 'eunice-core') => 'col-three',
          __('Column Four', 'eunice-core') => 'col-four',
        ),
        "admin_label" => true,
        "description" => __( "Select team column.", 'eunice-core'),
      ),
      array(
        "type"        => "notice",
        "heading"     => __( "Listing", 'eunice-core' ),
        "param_name"  => 'lsng_opt',
        'class'       => 'cs-warning',
        'value'       => '',
      ),
      array(
        "type" => "checkbox",
        "heading" => __( "Show Members", 'eunice-core' ),
        "param_name" => "perticular_team_member",
        "value" => $team_members,
        "admin_label" => true,
        "description" => __( "Select team column.", 'eunice-core'),
      ),
      array(
        "type"        =>'textfield',
        "heading"     =>__('Limit', 'eunice-core'),
        "param_name"  => "team_limit",
        "value"       => "",
        'admin_label' => true,
        "description" => __( "Enter the number of items to show.", 'eunice-core'),
      ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Order', 'eunice-core' ),
        'value' => array(
          __( 'Select Team Order', 'eunice-core' ) => '',
          __('Asending', 'eunice-core') => 'ASC',
          __('Desending', 'eunice-core') => 'DESC',
        ),
        'param_name' => 'team_order',
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
        'param_name' => 'team_orderby',
        'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
      ),
      EuniceLib::vt_class_option(),

      // Style
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
      array(
        "type"        =>'colorpicker',
        "heading"     =>__('Social Color', 'eunice-core'),
        "param_name"  => "social_color",
        "value"       => "",
        "group"       => __('Style', 'eunice-core'),
        'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
      ),
      array(
        "type"        =>'colorpicker',
        "heading"     =>__('Social Hover Color', 'eunice-core'),
        "param_name"  => "social_hover_color",
        "value"       => "",
        "group"       => __('Style', 'eunice-core'),
        'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
      ),
      // Size
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
      array(
        "type"        =>'textfield',
        "heading"     =>__('Social Size', 'eunice-core'),
        "param_name"  => "social_size",
        "value"       => "",
        "group"       => __('Style', 'eunice-core'),
        'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
      ),

      ), // Params
    ) );
  }
}