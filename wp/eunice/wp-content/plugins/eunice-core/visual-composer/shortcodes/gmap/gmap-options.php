<?php
/**
 * Gmap - Shortcode Options
 */
add_action( 'init', 'ence_gmap_vc_map' );
if ( ! function_exists( 'ence_gmap_vc_map' ) ) {
  function ence_gmap_vc_map() {
    vc_map( array(
      "name" => esc_html__( "Google Map", 'eunice-core'),
      "base" => "ence_gmap",
      "description" => esc_html__( "Google Map Styles", 'eunice-core'),
      "icon" => "fa fa-map color-cadetblue",
      "category" => EuniceLib::ence_cat_name(),
      "params" => array(

        array(
          "type"        => "notice",
          "heading"     => esc_html__( "API KEY", 'eunice-core' ),
          "param_name"  => 'api_key',
          'class'       => 'cs-info',
          'value'       => '',
        ),
        array(
          "type"        =>'textfield',
          "heading"     => esc_html__('Enter Map ID', 'eunice-core'),
          "param_name"  => "gmap_id",
          "value"       => "",
          "description" => __( 'Enter google map ID. If you\'re using this in <strong>Map Tab</strong> shortcode, enter unique ID for each map tabs. Else leave it as blank. <strong>Note : This should same as Tab ID in Map Tabs shortcode.</strong>', 'eunice-core'),
          'admin_label' => true,
        ),
        array(
          "type"        =>'textfield',
          "heading"     => esc_html__('Enter your Google Map API Key', 'eunice-core'),
          "param_name"  => "gmap_api",
          "value"       => "",
          "description" => __( 'New Google Maps usage policy dictates that everyone using the maps should register for a free API key. <br />Please create a key for "Google Static Maps API" and "Google Maps Embed API" using the <a href="https://console.developers.google.com/project" target="_blank">Google Developers Console</a>.<br /> Or follow this step links : <br /><a href="https://console.developers.google.com/flows/enableapi?apiid=maps_embed_backend&keyType=CLIENT_SIDE&reusekey=true" target="_blank">1. Step One</a> <br /><a href="https://console.developers.google.com/flows/enableapi?apiid=static_maps_backend&keyType=CLIENT_SIDE&reusekey=true" target="_blank">2. Step Two</a><br /> If you still receive errors, please check following link : <a href="https://churchthemes.com/2016/07/15/page-didnt-load-google-maps-correctly/" target="_blank">How to Fix?</a>', 'eunice-core'),
        ),

        array(
          "type"        => "notice",
          "heading"     => esc_html__( "Map Settings", 'eunice-core' ),
          "param_name"  => 'map_settings',
          'class'       => 'cs-info',
          'value'       => '',
        ),
        array(
          'type' => 'dropdown',
          'heading' => esc_html__( 'Google Map Type', 'eunice-core' ),
          'value' => array(
            esc_html__( 'Select Type', 'eunice-core' ) => '',
            esc_html__( 'ROADMAP', 'eunice-core' ) => 'ROADMAP',
            esc_html__( 'SATELLITE', 'eunice-core' ) => 'SATELLITE',
            esc_html__( 'HYBRID', 'eunice-core' ) => 'HYBRID',
            esc_html__( 'TERRAIN', 'eunice-core' ) => 'TERRAIN',
          ),
          'admin_label' => true,
          'param_name' => 'gmap_type',
          'description' => esc_html__( 'Select your google map type.', 'eunice-core' ),
        ),
        array(
          'type' => 'dropdown',
          'heading' => esc_html__( 'Google Map Style', 'eunice-core' ),
          'value' => array(
            esc_html__( 'Select Style', 'eunice-core' ) => '',
            esc_html__( 'Eunice Custom', 'eunice-core' ) => "eunice-custom",
            esc_html__( 'Gray Scale', 'eunice-core' ) => "gray-scale",
            esc_html__( 'Mid Night', 'eunice-core' ) => "mid-night",
            esc_html__( 'Blue Water', 'eunice-core' ) => 'blue-water',
            esc_html__( 'Light Dream', 'eunice-core' ) => 'light-dream',
            esc_html__( 'Pale Dawn', 'eunice-core' ) => 'pale-dawn',
            esc_html__( 'Apple Maps-esque', 'eunice-core' ) => 'apple-maps',
            esc_html__( 'Blue Essence', 'eunice-core' ) => 'blue-essence',
            esc_html__( 'Unsaturated Browns', 'eunice-core' ) => 'unsaturated-browns',
            esc_html__( 'Paper', 'eunice-core' ) => 'paper',
            esc_html__( 'Midnight Commander', 'eunice-core' ) => 'midnight-commander',
            esc_html__( 'Light Monochrome', 'eunice-core' ) => 'light-monochrome',
            esc_html__( 'Flat Map', 'eunice-core' ) => 'flat-map',
            esc_html__( 'Retro', 'eunice-core' ) => 'retro',
            esc_html__( 'becomeadinosaur', 'eunice-core' ) => 'becomeadinosaur',
            esc_html__( 'Neutral Blue', 'eunice-core' ) => 'neutral-blue',
            esc_html__( 'Subtle Grayscale', 'eunice-core' ) => 'subtle-grayscale',
            esc_html__( 'Ultra Light with Labels', 'eunice-core' ) => 'ultra-light-labels',
            esc_html__( 'Shades of Grey', 'eunice-core' ) => 'shades-grey',
          ),
          'admin_label' => true,
          'param_name' => 'gmap_style',
          'description' => esc_html__( 'Select your google map style.', 'eunice-core' ),
          'dependency' => array(
            'element' => 'gmap_type',
            'value' => 'ROADMAP',
          ),
        ),
        array(
          "type"        =>'textfield',
          "heading"     => esc_html__('Height', 'eunice-core'),
          "param_name"  => "gmap_height",
          "value"       => "",
          "description" => esc_html__( "Enter the px value for map height. This will not work if you add this shortcode into the Map Tab shortcode.", 'eunice-core'),
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
        ),
        array(
          "type"        =>'attach_image',
          "heading"     => esc_html__('Common Marker', 'eunice-core'),
          "param_name"  => "gmap_common_marker",
          "value"       => "",
          "description" => esc_html__( "Upload your custom marker.", 'eunice-core'),
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
        ),
        array(
          "type"        => "notice",
          "heading"     => esc_html__( "Enable & Disable", 'eunice-core' ),
          "param_name"  => 'enb_disb',
          'class'       => 'cs-info',
          'value'       => '',
        ),
        array(
          "type"        =>'switcher',
          "heading"     => esc_html__('Scroll Wheel', 'eunice-core'),
          "param_name"  => "gmap_scroll_wheel",
          "value"       => "",
          "std"         => false,
          'edit_field_class'   => 'vc_col-md-4 vc_column vt_field_space',
        ),
        array(
          "type"        =>'switcher',
          "heading"     => esc_html__('Street View Control', 'eunice-core'),
          "param_name"  => "gmap_street_view",
          "value"       => "",
          "std"         => false,
          'edit_field_class'   => 'vc_col-md-4 vc_column vt_field_space',
        ),
        array(
          "type"        =>'switcher',
          "heading"     => esc_html__('Map Type Control', 'eunice-core'),
          "param_name"  => "gmap_maptype_control",
          "value"       => "",
          "std"         => false,
          'edit_field_class'   => 'vc_col-md-4 vc_column vt_field_space',
        ),

        // Map Markers
        array(
          "type"        => "notice",
          "heading"     => esc_html__( "Map Pins", 'eunice-core' ),
          "param_name"  => 'map_pins',
          'class'       => 'cs-info',
          'value'       => '',
        ),
        array(
          'type' => 'param_group',
          'value' => '',
          'heading' => esc_html__( 'Map Locations', 'eunice-core' ),
          'param_name' => 'locations',
          'params' => array(

            array(
              'type' => 'textfield',
              'value' => '',
              'heading' => esc_html__( 'Latitude', 'eunice-core' ),
              'param_name' => 'latitude',
              'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
              'admin_label' => true,
              'description' => __( 'Find Latitude : <a href="http://www.latlong.net/" target="_blank">latlong.net</a>', 'eunice-core' ),
            ),
            array(
              'type' => 'textfield',
              'value' => '',
              'heading' => esc_html__( 'Longitude', 'eunice-core' ),
              'param_name' => 'longitude',
              'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
              'admin_label' => true,
              'description' => __( 'Find Longitude : <a href="http://www.latlong.net/" target="_blank">latlong.net</a>', 'eunice-core' ),
            ),
            array(
              'type' => 'attach_image',
              'value' => '',
              'heading' => esc_html__( 'Custom Marker', 'eunice-core' ),
              'param_name' => 'custom_marker',
              "description" => esc_html__( "Upload your unique map marker if your want to differentiate from others.", 'eunice-core'),
            ),
            array(
              'type' => 'textfield',
              'value' => '',
              'heading' => esc_html__( 'Heading', 'eunice-core' ),
              'param_name' => 'location_heading',
              'admin_label' => true,
            ),
            array(
              'type' => 'textarea',
              'value' => '',
              'heading' => esc_html__( 'Content', 'eunice-core' ),
              'param_name' => 'location_text',
            ),

          ),
        ),
        EuniceLib::vt_class_option(),

        // Design Tab
        array(
          "type" => "css_editor",
          "heading" => esc_html__( "Text Size", 'eunice-core' ),
          "param_name" => "css",
          "group" => esc_html__( "Design", 'eunice-core'),
        ),

      )
    ) );
  }
}
